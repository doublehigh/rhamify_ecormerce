@extends('vendor.layouts.master')

@section('title')
{{$settings->site_name}} || Product
@endsection

@section('content')
  <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
        @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0 vendor-products-page">
            <div class="dashboard-page-header">
                <div>
                    <h3><i class="fas fa-box-open"></i> Products</h3>
                    <p>Manage your catalog, availability, variants, and product media.</p>
                </div>
                <div class="dashboard-header-actions">
                    <a href="{{route('vendor.products.create')}}" class="dashboard-header-link"><i class="fas fa-plus"></i> Create Product</a>
                </div>
            </div>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                {{ $dataTable->table(['class' => 'table vendor-products-table w-100']) }}
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

    <script>
        $(document).ready(function(){
            $('body').on('click', '.change-status', function(){
                let statusInput = $(this);
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');
                let statusLabel = $(this).siblings('.vendor-status-toggle__text');
                let previousLabel = statusLabel.text();

                statusLabel.text(isChecked ? 'Active' : 'Inactive');

                $.ajax({
                    url: "{{route('vendor.product.change-status')}}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data){
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error){
                        statusInput.prop('checked', !isChecked);
                        statusLabel.text(previousLabel);
                        console.log(error);
                    }
                })

            })
        })
    </script>
@endpush
