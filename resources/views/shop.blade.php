@extends('layouts.app')

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('assets/images/bg_6.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Home</a></span> <span>Products</span></p>
                    <h1 class="mb-0 bread">Collection Products</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-10 order-md-last">
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-sm-6 col-md-6 col-lg-4 ftco-animate">
                                <div class="product">
                                    <a href="{{ route('show', $product->id) }}" class="img-prod"><img class="img-fluid"
                                                                                                      src="{{ asset('storage/' . $product->preview_image) }}"
                                                                                                      alt="Colorlib Template">
                                    </a>
                                    <div class="text py-3 px-3">
                                        <h3><a href="{{ route('show', $product->id) }}">{{ $product->title }}</a></h3>
                                        <div class="d-flex">
                                            <div class="pricing">
                                                <p class="price"><span class="mr-2 price">${{ $product->price }}</span>
                                            </div>
                                        </div>
                                        <p class="bottom-area d-flex px-3">
                                            <a href="{{ route('cart.add', $product->id) }}"
                                               class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i
                                                        class="ion-ios-add ml-1"></i></span></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row col-12 d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
