@extends('frontend.dashboard.layouts.master')

@section('title')
{{$settings->site_name}} || Became a Vendor Today
@endsection

@section('content')
  <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
        @include('frontend.dashboard.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0 dashboard-vendor-request-page">
            <div class="dashboard-page-header">
              <div>
                <h3><i class="fas fa-store"></i> Vendor Request</h3>
                <p>Submit your shop information to start selling.</p>
              </div>
            </div>
            <div class="wsus__dashboard_profile dashboard-info-card">
              <div class="wsus__dash_pro_area">
                {!!@$content->content!!}
              </div>
            </div>
            <br>
            <div class="wsus__dashboard_profile dashboard-form-card">
                <div class="wsus__dash_pro_area">
                    <form action="{{route('user.vendor-request.create')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="wsus__dash_pro_single">
                            <i class="fas fa-user-tie" aria-hidden="true"></i>
                            <input type="file" name="shop_image" placeholder="Shop Banner Image">
                        </div>
                        <div class="wsus__dash_pro_single">
                            <i class="fas fa-user-tie" aria-hidden="true"></i>
                            <input type="text" name="shop_name" placeholder="Shop Name">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="wsus__dash_pro_single">
                                    <i class="fas fa-user-tie" aria-hidden="true"></i>
                                    <input type="text" name="shop_email" placeholder="Shop Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="wsus__dash_pro_single">
                                    <i class="fas fa-user-tie" aria-hidden="true"></i>
                                    <input type="text" name="shop_phone" placeholder="Shop Phone">
                                </div>
                            </div>
                        </div>
                        <div class="wsus__dash_pro_single">
                            <i class="fas fa-user-tie" aria-hidden="true"></i>
                            <input type="text" name="shop_address" placeholder="Shop Address">
                        </div>

                        <div class="wsus__dash_pro_single">
                            <textarea name="about" placeholder="About You"></textarea>
                        </div>

                        <button type="submit" class="common_btn">Submit</button>

                    </form>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->
@endsection
