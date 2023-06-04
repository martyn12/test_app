@extends('layouts.app')

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('assets/images/bg_6.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span> <span
                            class="mr-2"><a
                                href="/">Product</a></span> <span>Product Single</span></p>
                    <h1 class="mb-0 bread">{{ $product->title }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="{{ asset('storage/' . $product->preview_image) }}" class="image-popup"><img
                            src="{{ asset('storage/' . $product->preview_image) }}" class="img-fluid"
                            alt="Colorlib Template"></a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3>{{ $product->title }}</h3>
                    <p class="price"><span>${{ $product->price }}</span></p>
                    <p>{{ $product->description }}
                    </p>
                    <form action="{{ route('cart.addWithQuantity', $product->id) }}" method="GET">
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group d-flex">
                                <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="size" class="form-control">
                                        <option>{{ $product->size }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="input-group col-md-6 d-flex mb-3">
                            <span class="input-group-btn mr-2">
                                <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                    <i class="ion-ios-remove"></i>
                                </button>
                            </span>
                            <input type="text" id="quantity" name="quantity" class="form-control input-number"
                                   value="1" min="1" max="100">
                            <span class="input-group-btn ml-2">
                                <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                    <i class="ion-ios-add"></i>
                                </button>
                            </span>
                        </div>
                        <div class="w-100"></div>
                        <p>
                            <input type="submit" class="btn btn-black py-3 px-5" value="Add to Cart">
                        </p>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Похожие товары</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-sm col-md-6 col-lg ftco-animate">
                        <div class="product">
                            <a href="{{ route('show', $product->id) }}" class="img-prod"><img class="img-fluid"
                                                                                              src="{{ asset('storage/' . $product->preview_image ) }}"
                                                                                              alt="Colorlib Template">
                            </a>
                            <div class="text py-3 px-3">
                                <h3><a href="#"></a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span class="mr-2 price">${{ $product->price }}</span>
                                    </div>
                                </div>
                                <p class="bottom-area d-flex px-3">
                                    <a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i
                                                class="ion-ios-add ml-1"></i></span></a>
                                    <a href="#" class="buy-now text-center py-2">Buy now<span><i
                                                class="ion-ios-cart ml-1"></i></span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

            var quantitiy = 0;
            $('.quantity-right-plus').click(function (e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());
                // If is not undefined
                $('#quantity').val(quantity + 1);
                // Increment
            });

            $('.quantity-left-minus').click(function (e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());
                // If is not undefined
                // Increment
                if (quantity > 0) {
                    $('#quantity').val(quantity - 1);
                }
            });

        });
    </script>
@endsection
