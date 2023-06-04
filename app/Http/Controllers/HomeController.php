<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{

    /**
     * метод отображения главной страницы
     */

    public function index()
    {
        $carouselProducts = Product::inRandomOrder()->limit(2)->get();
        $products = Product::orderBy('created_at', 'DESC')->limit(4)->get();
        return view('home', compact('products', 'carouselProducts'));
    }

    /**
     * метод отображения страницы товара
     * $products - связанные товары(той же категории что и отображаемый товар)
     */

    public function show(Product $product)
    {
        $products = Product::where('category_id', $product->category_id)->whereNot('id', $product->id)->get();
        return view('product-single', compact('product', 'products'));
    }

    /**
     * метод отображения страницы каталога
     */

    public function shop()
    {
        $products = Product::paginate(8);
        return view('shop', compact('products'));
    }
}
