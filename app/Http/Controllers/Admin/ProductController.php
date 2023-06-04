<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sizes = Product::getSizes();
        $categories = Category::all();
        return view('admin.products.create', compact('categories', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // валидируем запрос
        $data = $request->validated();
        try {
            DB::beginTransaction();

            // записываем полученные изображения из поля images в переменную из удаляем из массива в данными
            $images = $data['images'];
            unset($data['images']);

            // сохраняем обложку в storage/images
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);

            // создаем продукт и записываем в БД
            $product = Product::create($data);

            // сохраняем картинки в storage/images
            foreach ($images as $image) {
                $imagePath = Storage::disk('public')->put('/images', $image);

                // записываем картинки в БД
                Image::create([
                    'product_id' => $product->id,
                    'path' => $imagePath
                ]);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }



        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $images = Image::where('product_id', $product->id)->get();
        $sizes = Product::getSizes();
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories', 'sizes', 'images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            // если в инпут передается файл, то загружаем файл на сервер и записываем путь в атрибут preview_image
            if (isset($data['preview_image'])) {
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }
            // если в инпут передаются файлы, то записываем их в $updateImages и удаляем из массива с данными
            if (isset($data['images'])) {
                $updateImages = $data['images'];
                unset($data['images']);

                // удаляем все связанные с товаром картинки
                Image::where('product_id', $product->id)->delete();
                foreach ($updateImages as $image) {
                    $imagePath = Storage::disk('public')->put('/images', $image);

                    // записываем картинки в БД
                    Image::create([
                        'product_id' => $product->id,
                        'path' => $imagePath
                    ]);
                }
            }
            // обновляем товар
            $product->update($data);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back();
    }
}
