@extends('frontend.dashboard.layouts.master')

@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      @include('frontend.dashboard.layouts.sidebar')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content dashboard-address-page">
            <div class="dashboard-page-header">
              <div>
                <h3><i class="fal fa-gift-card"></i> Addresses</h3>
                <p>Keep your delivery information ready for checkout.</p>
              </div>
              <a href="{{route('user.address.create')}}" class="dashboard-header-link"><i class="far fa-plus"></i> Add address</a>
            </div>
            <div class="wsus__dashboard_add dashboard-form-card">
              <div class="row">
                @foreach ($addresses as $address)
                <div class="col-xl-6">
                  <div class="wsus__dash_add_single">
                    <h4>Billing Address</h4>
                    <ul>
                      <li><span>name :</span> {{$address->name}}</li>
                      <li><span>Phone :</span> {{$address->phone}}</li>
                      <li><span>email :</span> {{$address->email}}</li>
                      <li><span>country :</span> {{$address->country}}</li>
                      <li><span>state :</span> {{$address->state}}</li>
                      <li><span>city :</span> {{$address->city}}</li>
                      <li><span>zip code :</span> {{$address->zip}}</li>
                      <li><span>address :</span> {{$address->address}}</li>
                    </ul>
                    <div class="wsus__address_btn">
                      <a href="{{route('user.address.edit', $address->id)}}" class="edit"><i class="fal fa-edit"></i> edit</a>
                      <a href="{{route('user.address.destroy', $address->id)}}" class="del delete-item"><i class="fal fa-trash-alt"></i> delete</a>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
