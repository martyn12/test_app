<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\ConfirmRequest;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    /**
     * метод для отображения страницы подтверждения заказа
     */

    public function checkout()
    {
        return view('checkout');
    }

    /**
     * метод для записи заказа в БД
     */

    public function placeOrder(ConfirmRequest $request)
    {
        // валидация запроса
        $data = $request->validated();
        try {
            DB::beginTransaction();
            // создаем заказ
            $order = Order::create($data);
            // получаем корзину из сессии
            $products = session()->get('cart');
            // записываем в таблицу связи товары из заказа
            foreach ($products as $id => $productCart) {
                DB::table('order_product')
                    ->insert(
                        [
                            'order_id' => $order->id,
                            'product_id' => $id,
                            'product_quantity' => $productCart['quantity'],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
            }
            // обнуляем корзину
            session()->put('cart', []);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500);
        }

        return redirect()->route('home')->with('order_placed', 'Заказ принят в обработку');
    }

}
