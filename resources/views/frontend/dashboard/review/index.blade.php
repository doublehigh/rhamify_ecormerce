@extends('frontend.dashboard.layouts.master')

@section('title')
{{$settings->site_name}} || Reviews
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
          <div class="dashboard_content mt-2 mt-md-0 dashboard-reviews-page">
            <div class="dashboard-page-header">
              <div>
                <h3><i class="far fa-star"></i> All Reviews</h3>
                <p>See the product reviews you have submitted.</p>
              </div>
            </div>
            <div class="wsus__dashboard_profile dashboard-orders-card">
              <div class="wsus__dash_pro_area dashboard-table-shell">
                {{ $dataTable->table(['class' => 'table dashboard-orders-table w-100']) }}
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

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endpush
