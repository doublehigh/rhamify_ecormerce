@extends('frontend.dashboard.layouts.master')

@section('title')
{{$settings->site_name}} || Request to be a Vendor
@endsection

@section('content')
<section id="wsus__dashboard">
  <div class="container-fluid">
    @include('frontend.dashboard.layouts.sidebar')

    <div class="row">
      <main class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0 dashboard-vendor-request-page">
          <div class="vendor-request-hero">
            <h3><i class="fas fa-store"></i> Request to be a Vendor</h3>
            <p>Send your shop details for review and start selling on Rhamify.</p>
          </div>

          <div class="vendor-request-layout">
            <article class="vendor-request-card vendor-request-card--content">
              <span class="vendor-request-eyebrow">Vendor application</span>
              <h4>Before you submit</h4>
              <div class="vendor-request-content">
                {!! @$content->content !!}
              </div>
            </article>

            <form class="vendor-request-card vendor-request-form" action="{{ route('user.vendor-request.create') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="vendor-request-form__header">
                <span class="vendor-request-eyebrow">Shop information</span>
                <h4>Tell us about your store</h4>
              </div>

              <label class="vendor-request-field vendor-request-field--file">
                <span>Shop banner image</span>
                <input type="file" name="shop_image">
              </label>

              <label class="vendor-request-field">
                <span>Shop name</span>
                <input type="text" name="shop_name" placeholder="Enter shop name">
              </label>

              <div class="vendor-request-grid">
                <label class="vendor-request-field">
                  <span>Shop email</span>
                  <input type="email" name="shop_email" placeholder="store@example.com">
                </label>

                <label class="vendor-request-field">
                  <span>Shop phone</span>
                  <input type="text" name="shop_phone" placeholder="Phone number">
                </label>
              </div>

              <label class="vendor-request-field">
                <span>Shop address</span>
                <input type="text" name="shop_address" placeholder="Business address">
              </label>

              <label class="vendor-request-field">
                <span>About your business</span>
                <textarea name="about" placeholder="Briefly describe what you sell and how you operate"></textarea>
              </label>

              <button type="submit" class="common_btn vendor-request-submit">Submit request</button>
            </form>
          </div>
        </div>
      </main>
    </div>
  </div>
</section>
@endsection
