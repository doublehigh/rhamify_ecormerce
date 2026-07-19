@php
    $address = json_decode($order->order_address);
    $vendorOrderTotal = 0;

@endphp

@extends('vendor.layouts.master')

@section('title')
    {{ $settings->site_name }} || Product
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
                    <div class="dashboard_content mt-2 mt-md-0 dashboard-order-details-page vendor-order-details-page">
                        <div class="dashboard-page-header">
                            <div>
                                <h3><i class="fas fa-receipt"></i> Order Details</h3>
                                <p>Invoice #{{ $order->invocie_id }} and vendor fulfillment controls.</p>
                            </div>
                            <div class="dashboard-header-actions">
                                <a href="{{ route('vendor.orders.index') }}" class="dashboard-header-link"><i class="fas fa-arrow-left"></i> Back to orders</a>
                                <button class="dashboard-print-btn print_invoice" type="button"><i class="fas fa-print"></i> Print</button>
                            </div>
                        </div>

                        <div class="wsus__dashboard_profile dashboard-order-details-card">

                            <!--============================
                            INVOICE PAGE START
                        ==============================-->
                            <section id="" class="invoice-print">
                                <div class="">
                                    <div class="wsus__invoice_area">
                                        <div class="order-invoice-brand">
                                            <div class="order-invoice-brand__identity">
                                                <img src="{{ asset($logoSetting->logo) }}" alt="Rhamify Technology logo">
                                                <div>
                                                    <h4>Rhamify Technology</h4>
                                                    <p>Trusted ecommerce marketplace for smart shopping, reliable vendors, and smooth delivery.</p>
                                                </div>
                                            </div>
                                            <div class="order-invoice-brand__meta">
                                                <span>Official Invoice</span>
                                                <strong>https://rhamify.com</strong>
                                            </div>
                                        </div>

                                        <div class="order-detail-summary">
                                            <div>
                                                <span>Order ID</span>
                                                <strong>#{{ $order->invocie_id }}</strong>
                                            </div>
                                            <div>
                                                <span>Order Status</span>
                                                <strong>{{ config('order_status.order_status_admin')[$order->order_status]['status'] }}</strong>
                                            </div>
                                            <div>
                                                <span>Payment</span>
                                                <strong>{{ $order->payment_status === 1 ? 'Complete' : 'Pending' }}</strong>
                                            </div>
                                            <div>
                                                <span>Customer</span>
                                                <strong>{{ @$address->name }}</strong>
                                            </div>
                                        </div>
                                        <div class="wsus__invoice_header">
                                            <div class="wsus__invoice_content">
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-4 mb-3 mb-md-0">
                                                        <div class="wsus__invoice_single">
                                                            <h5>Billing Information</h5>
                                                            <h6>{{ @$address->name }}</h6>
                                                            <p>{{ @$address->email }}</p>
                                                            <p>{{ @$address->phone }}</p>
                                                            <p>{{ @$address->address }}, {{ @$address->city }},
                                                                {{ @$address->state }}, {{ @$address->zip }}</p>
                                                            <p>{{ @$address->country }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 mb-3 mb-md-0">
                                                        <div class="wsus__invoice_single text-md-center">
                                                            <h5>shipping information</h5>
                                                            <h6>{{ @$address->name }}</h6>
                                                            <p>{{ @$address->email }}</p>
                                                            <p>{{ @$address->phone }}</p>
                                                            <p>{{ @$address->address }}, {{ @$address->city }},
                                                                {{ @$address->state }}, {{ @$address->zip }}</p>
                                                            <p>{{ @$address->country }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4">
                                                        <div class="wsus__invoice_single text-md-end">
                                                            <h5>Order id: #{{ $order->invocie_id }}</h5>
                                                            <h6>Order status:
                                                                {{ config('order_status.order_status_admin')[$order->order_status]['status'] }}
                                                            </h6>
                                                            <p>Payment Method: {{ $order->payment_method }}</p>
                                                            <p>Payment Status: {{ $order->payment_status === 1 ? 'Complete' : 'Pending' }}</p>
                                                            <p>Transaction id: {{ @$order->transaction->transaction_id ?? 'N/A' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wsus__invoice_description">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <colgroup>
                                                            <col class="image-col">
                                                            <col class="product-col">
                                                            <col class="amount-col">
                                                            <col class="quantity-col">
                                                            <col class="total-col">
                                                        </colgroup>
                                                        <thead>
                                                            <tr>
                                                                <th class="image">Image</th>
                                                                <th class="name">Product</th>
                                                                <th class="amount">Amount</th>
                                                                <th class="quentity">Quantity</th>
                                                                <th class="total">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($order->orderProducts as $product)
                                                            @if ($product->vendor_id === Auth::user()->vendor->id)
                                                                @php
                                                                    $variants = json_decode($product->variants) ?? [];
                                                                    $vendorOrderTotal += $product->unit_price * $product->qty;
                                                                @endphp
                                                                <tr>
                                                                    <td class="image" data-label="Image">
                                                                        <img src="{{ asset($product->product->thumb_image ?? 'frontend/images/ts-2.jpg') }}" alt="{{ $product->product_name }}">
                                                                    </td>
                                                                    <td class="name" data-label="Product">
                                                                        <p>{{ $product->product_name }}</p>
                                                                        @foreach ($variants as $key => $item)
                                                                            <span>{{ $key }} :
                                                                                {{ $item->name }}(
                                                                                {{ $settings->currency_icon }}{{ $item->price }}
                                                                                )</span>
                                                                        @endforeach
                                                                    </td>
                                                                    <td class="amount" data-label="Amount">
                                                                        {{ $settings->currency_icon }}
                                                                        {{ $product->unit_price }}
                                                                    </td>

                                                                    <td class="quentity" data-label="Quantity">
                                                                        {{ $product->qty }}
                                                                    </td>
                                                                    <td class="total" data-label="Total">
                                                                        {{ $settings->currency_icon }}
                                                                        {{ $product->unit_price * $product->qty }}
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wsus__invoice_footer">

                                            <p><span>Total Amount:</span> {{ $settings->currency_icon }}
                                                {{ $vendorOrderTotal }} </p>
                                        </div>
                                        <div class="order-invoice-print-footer">
                                            <strong>Thank you for partnering with Rhamify Technology.</strong>
                                            <span>For support, visit https://rhamify.com or keep this invoice for your records.</span>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!--============================
                            INVOICE PAGE END
                        ==============================-->

                            <div class="row vendor-order-actions">
                                <div class="col-md-4">
                                    <form action="{{ route('vendor.orders.status', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group mt-4">
                                            <label for="" class="mb-2">Order Status</label>
                                            <select name="status" id="" class="form-control">
                                                @foreach (config('order_status.order_status_vendor') as $key => $status)
                                                    <option {{ $key === $order->order_status ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $status['status'] }}</option>
                                                @endforeach
                                            </select>
                                            <button class="common_btn mt-3" type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
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
    <script>
        $('.print_invoice').on('click', function() {
            document.body.classList.add('printing-order-invoice');
            window.print();
        })

        window.addEventListener('afterprint', function() {
            document.body.classList.remove('printing-order-invoice');
        });
    </script>
@endpush
