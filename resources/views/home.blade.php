@extends('layouts.app')

@section('content')
    @if(session()->has('order_placed'))
        <div class="text-success col-12 text-center blockquote">
            {{ session()->get('order_placed') }}
        </div>
    @endif
    <section id="home-section" class="hero">
        <div class="home-slider js-fullheight owl-carousel">
            @foreach($carouselProducts as $product)
            <div class="slider-item js-fullheight">
                <div class="overlay"></div>
                <div class="container-fluid p-0">
                    <div class="row d-md-flex no-gutters slider-text js-fullheight align-items-center justify-content-end"
                        data-scrollax-parent="true">
                        <div class="one-third order-md-last img js-fullheight" style="background-image:url({{ asset('/storage/' . $product->preview_image) }});">
                        </div>
                        <div class="one-forth d-flex js-fullheight align-items-center ftco-animate"
                            data-scrollax=" properties: { translateY: '70%' }">
                            <div class="text">
                                <span class="subheading">Some random eShop</span>
                                <div class="horizontal">
                                    <h3 class="vr">Made in
                                        2023</h3>
                                    <h1 class="mb-4 mt-3">Some random <br><span>phrase</span></h1>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary
                                        regelialia. It is a paradisematic country.</p>

                                    <p><a href="{{ route( 'show', $product->id) }}" class="btn btn-primary px-5 py-3 mt-3">Discover Now</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>


    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Новые поступления</h2>
                    <p>Товары, добавленные недавно </p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach($products as $product)
                <div class="col-sm col-md-6 col-lg ftco-animate">
                    <div class="product">
                        <a href="/product/1" class="img-prod"><img class="img-fluid" src="{{ asset("/storage/{$product->preview_image}") }}"
                                alt="Colorlib Template" style="height: 200px; width: auto">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 px-3">
                            <h3><a href="#">{{ $product->title }}</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span class="mr-2 price">${{ $product->price }}</span>
                                </div>

                            </div>
                            <p class="bottom-area d-flex px-3">
                                <a href="{{ route('cart.add', $product->id) }}" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i
                                            class="ion-ios-add ml-1"></i></span></a>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

