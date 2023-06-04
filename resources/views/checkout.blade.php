@extends('layouts.app')

@section('content')

<div class="hero-wrap hero-bread" style="background-image: url('{{ asset('assets/images/bg_6.jpg') }}');">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span> <span>Checkout</span></p>
          <h1 class="mb-0 bread">Checkout</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-8 ftco-animate">
                      <form action="{{ route('order.place') }}" method="POST" class="billing-form">
                          @csrf
                          <h3 class="mb-4 billing-heading">Billing Details</h3>
                <div class="row align-items-end">
                    <div class="col-md-6">
                  <div class="form-group">
                      <label for="name">Name</label>
                    <input type="text" class="form-control" name="customer_name">
                  </div>
                        <div class="form-group">
                      <label for="firstname">Email</label>
                    <input type="text" class="form-control" name="customer_email">
                  </div>
                </div>
              </div>
            <!-- END -->



            <div class="row mt-5 pt-3 d-flex">
                <div class="col-md-6 d-flex">
                    <div class="cart-detail cart-total bg-light p-3 p-md-4">
                        <h3 class="billing-heading mb-4">Cart Total</h3>
                              <p class="d-flex total-price">
                                  <span>Total</span>
                                  <span>${{ session('total') }}</span>
                              </p>
                        <p><input type="submit" class="btn btn-primary py-3 px-4" value="Заказать"></p>
                    </div>
                </div>
            </div>
                      </form>
        </div> <!-- .col-md-8 -->
      </div>
    </div>
  </section> <!-- .section -->

@endsection
