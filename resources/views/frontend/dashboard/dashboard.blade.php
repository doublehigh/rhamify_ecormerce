@extends('frontend.dashboard.layouts.master')

@section('title')
{{$settings->site_name}} || Dahsboard
@endsection

@section('content')
<section id="wsus__dashboard">

    <div class="container-fluid">
      @include('frontend.dashboard.layouts.sidebar')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content dashboard-home-page">
            <div class="dashboard-page-header">
              <div>
                <h3><i class="fas fa-tachometer-alt"></i> User Dashboard</h3>
                <p>Quick overview of your shopping activity.</p>
              </div>
              <a href="{{ url('/') }}" class="dashboard-header-link"><i class="fas fa-store"></i> Continue shopping</a>
            </div>
            <div class="wsus__dashboard">
              <div class="row">
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="{{route('user.orders.index')}}">
                    <i class="fas fa-cart-plus"></i>
                    <p>Total Order</p>
                    <h4>{{$totalOrder}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item green" href="{{route('user.orders.index')}}">
                    <i class="fas fa-clock"></i>
                    <p>Pending Orders</p>
                    <h4>{{$pendingOrder}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item sky" href="{{route('user.orders.index')}}">
                    <i class="fas fa-check-circle"></i>
                    <p>Complete Orders</p>
                    <h4>{{$completeOrder}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item blue" href="{{route('user.review.index')}}">
                    <i class="fas fa-star"></i>
                    <p>Reviews</p>
                    <h4>{{$reviews}}</h4>
                  </a>
                </div>

                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item purple" href="{{route('user.wishlist.index')}}">
                    <i class="fas fa-heart"></i>
                    <p>Wishlist</p>
                    <h4>{{$wishlist}}</h4>
                  </a>
                </div>

                <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item orange" href="{{route('user.profile')}}">
                      <i class="fas fa-user-shield"></i>
                      <p>profile</p>
                      <h4>-</h4>
                    </a>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
