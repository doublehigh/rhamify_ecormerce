@php
    $address = json_decode($order->order_address);
    $shipping = json_decode($order->shpping_method);
    $coupon = json_decode($order->coupon);
@endphp

@extends('admin.layouts.master')

@section('content')
    <section class="section admin-order-details-page">
        <div class="section-header admin-order-page-header">
            <div>
                <h1><i class="fas fa-receipt"></i> Order Details</h1>
                <p>Invoice #{{ $order->invocie_id }} and fulfillment controls.</p>
            </div>
            <div class="admin-order-header-actions">
                <a href="{{ route('admin.order.index') }}" class="admin-order-header-link"><i class="fas fa-arrow-left"></i> Back to orders</a>
                <button class="admin-order-print-btn print_invoice" type="button"><i class="fas fa-print"></i> Print</button>
            </div>
        </div>

        <div class="section-body">
            <div class="card admin-order-details-card">
                <div class="card-body">
                    <section class="invoice-print">
                        <div class="admin-invoice-area">
                            <div class="order-invoice-brand">
                                <div class="order-invoice-brand__identity">
                                    <img src="{{ asset(@$logoSetting->logo ?? 'frontend/images/logo_2.png') }}" alt="Rhamify Technology logo">
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
                                    <strong>{{ config('order_status.order_status_admin')[$order->order_status]['status'] ?? $order->order_status }}</strong>
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

                            <div class="admin-invoice-header">
                                <div class="row">
                                    <div class="col-xl-4 col-md-4 mb-3 mb-md-0">
                                        <div class="admin-invoice-single">
                                            <h5>Billing Information</h5>
                                            <h6>{{ @$address->name }}</h6>
                                            <p>{{ @$address->email }}</p>
                                            <p>{{ @$address->phone }}</p>
                                            <p>{{ @$address->address }}, {{ @$address->city }}, {{ @$address->state }}, {{ @$address->zip }}</p>
                                            <p>{{ @$address->country }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 mb-3 mb-md-0">
                                        <div class="admin-invoice-single text-md-center">
                                            <h5>Shipping Information</h5>
                                            <h6>{{ @$address->name }}</h6>
                                            <p>{{ @$address->email }}</p>
                                            <p>{{ @$address->phone }}</p>
                                            <p>{{ @$address->address }}, {{ @$address->city }}, {{ @$address->state }}, {{ @$address->zip }}</p>
                                            <p>{{ @$address->country }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4">
                                        <div class="admin-invoice-single text-md-right">
                                            <h5>Order Information</h5>
                                            <h6>#{{ $order->invocie_id }}</h6>
                                            <p>Order Date: {{ date('d F, Y', strtotime($order->created_at)) }}</p>
                                            <p>Payment Method: {{ $order->payment_method }}</p>
                                            <p>Transaction ID: {{ @$order->transaction->transaction_id ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="admin-invoice-description">
                                <div class="table-responsive">
                                    <table class="table">
                                        <colgroup>
                                            <col class="image-col">
                                            <col class="product-col">
                                            <col class="vendor-col">
                                            <col class="amount-col">
                                            <col class="quantity-col">
                                            <col class="total-col">
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th class="image">Image</th>
                                                <th class="name">Product</th>
                                                <th class="vendor">Vendor</th>
                                                <th class="amount">Amount</th>
                                                <th class="quantity">Quantity</th>
                                                <th class="total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->orderProducts as $product)
                                                @php
                                                    $variants = json_decode($product->variants) ?? [];
                                                    $lineTotal = ($product->unit_price * $product->qty) + $product->variant_total;
                                                @endphp
                                                <tr>
                                                    <td class="image" data-label="Image">
                                                        <img src="{{ asset($product->product->thumb_image ?? 'frontend/images/ts-2.jpg') }}" alt="{{ $product->product_name }}">
                                                    </td>
                                                    <td class="name" data-label="Product">
                                                        @if (isset($product->product->slug))
                                                            <p><a target="_blank" href="{{ route('product-detail', $product->product->slug) }}">{{ $product->product_name }}</a></p>
                                                        @else
                                                            <p>{{ $product->product_name }}</p>
                                                        @endif
                                                        @foreach ($variants as $key => $variant)
                                                            <span>{{ $key }}: {{ $variant->name }} ({{ $settings->currency_icon }}{{ $variant->price }})</span>
                                                        @endforeach
                                                    </td>
                                                    <td class="vendor" data-label="Vendor">{{ @$product->vendor->shop_name }}</td>
                                                    <td class="amount" data-label="Amount">{{ $settings->currency_icon }}{{ $product->unit_price }}</td>
                                                    <td class="quantity" data-label="Quantity">{{ $product->qty }}</td>
                                                    <td class="total" data-label="Total">{{ $settings->currency_icon }}{{ $lineTotal }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="admin-order-lower">
                                <div class="admin-order-controls">
                                    <div class="form-group">
                                        <label for="payment_status">Payment status</label>
                                        <select id="payment_status" class="form-control" data-id="{{ $order->id }}">
                                            <option {{ $order->payment_status === 0 ? 'selected' : '' }} value="0">Pending</option>
                                            <option {{ $order->payment_status === 1 ? 'selected' : '' }} value="1">Completed</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="order_status">Order Status</label>
                                        <select name="order_status" id="order_status" data-id="{{ $order->id }}" class="form-control">
                                            @foreach (config('order_status.order_status_admin') as $key => $orderStatus)
                                                <option {{ $order->order_status === $key ? 'selected' : '' }} value="{{ $key }}">{{ $orderStatus['status'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="admin-invoice-footer">
                                    <p><span>Subtotal:</span> {{ $settings->currency_icon }} {{ $order->sub_total }}</p>
                                    <p><span>Shipping (+):</span> {{ $settings->currency_icon }} {{ @$shipping->cost }}</p>
                                    <p><span>Coupon (-):</span> {{ $settings->currency_icon }} {{ @$coupon->discount ? @$coupon->discount : 0 }}</p>
                                    <p><span>Total:</span> {{ $settings->currency_icon }} {{ $order->amount }}</p>
                                </div>
                            </div>

                            <div class="order-invoice-print-footer">
                                <strong>Thank you for choosing Rhamify Technology.</strong>
                                <span>For support, visit https://rhamify.com or keep this invoice for your records.</span>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('#order_status').on('change', function(){
                let status = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    method: 'PUT',
                    url: "{{ route('admin.order.status') }}",
                    data: {status: status, id:id},
                    success: function(data){
                        if(data.status === 'success'){
                            toastr.success(data.message)
                        }
                    },
                    error: function(data){
                        console.log(data);
                    }
                })
            })

            $('#payment_status').on('change', function(){
                let status = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    method: 'PUT',
                    url: "{{ route('admin.payment.status') }}",
                    data: {status: status, id:id},
                    success: function(data){
                        if(data.status === 'success'){
                            toastr.success(data.message)
                        }
                    },
                    error: function(data){
                        console.log(data);
                    }
                })
            })

            $('.print_invoice').on('click', function(){
                document.body.classList.add('printing-order-invoice');
                requestAnimationFrame(function() {
                    window.print();
                });
            })

            window.addEventListener('afterprint', function() {
                document.body.classList.remove('printing-order-invoice');
            });
        })
    </script>
@endpush
