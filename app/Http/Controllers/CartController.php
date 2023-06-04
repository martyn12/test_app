<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\UpdateRequest;
use App\Http\Requests\Cart\StoreRequest;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Метод для отображения товаров в корзине
     */

    public function index()
    {
        // получаем содержимое корзины из сессии, если в сессии не записана корзина, получаем пустой массив
        $cart = session()->get('cart', []);
        // записываем в сессию количество уникальных товаров и общую стоимость корзины
        $count = 0;
        $total = 0;
        if ($cart) {
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
                $count++;
            }
        }
        session()->put('total', $total);
        session()->put('count', $count);
        return view('cart', compact('cart'));
    }

    /**
     * метод добавления товара в корзину
     */

    public function addToCart(Product $product)
    {
        // получаем содержимое корзины из сессии
        $cart = session()->get('cart', []);

        // если добавляемый товар $product уже есть в корзине, то увеличиваем его количество
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
            // иначе добавляем товар с необходимыми атрибутами и количеством 1
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'title' => $product->title,
                'quantity' => 1,
                'price' => $product->price,
                'preview_image' => $product->preview_image
            ];
        }
        // записываем корзину в сесиию
        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }

    /**
     * метод добавления товара со страницы товара с указанием количества
     */

    public function addToCartWithQuantity(Product $product, StoreRequest $request)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'title' => $product->title,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'preview_image' => $product->preview_image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }


    /**
     * метод обновления количества товра в корзине
     */

    public function update(UpdateRequest $request, $productId)
    {
        // получаем корзину из сессии
        $cart = session('cart');
        // присваиваем количеству товара в корзине введенное число
        $cart[$productId]['quantity'] = $request->quantity;
        session()->put('cart', $cart);
        return redirect()->back();
    }

    /**
     * метод удаления товара из корзины
     */

    public function remove($productId)
    {
        // получаем корзину из сессии
        $cart = session('cart');
        // находим товар с id = $productId и удаляем его из сессии
        if ($cart) {
            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                session()->put('cart', $cart);
            }
        }
        return redirect()->back();
    }


}
