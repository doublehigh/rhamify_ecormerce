<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class VendorOrderController extends Controller
{
    public function index(VendorOrderDataTable $dataTable)
    {
        return $dataTable->render('vendor.order.index');
    }

    public function show(string $id)
    {
        $vendorId = Auth::user()->vendor->id;
        $order = Order::with(['orderProducts' => fn ($query) => $query->where('vendor_id', $vendorId)->with('product')])
            ->whereHas('orderProducts', fn ($query) => $query->where('vendor_id', $vendorId))
            ->findOrFail($id);

        return view('vendor.order.show', compact('order'));
    }

    public function orderStatus(Request $request, string $id)
    {
        $request->validate([
            'status' => ['required', Rule::in(array_keys(config('order_status.order_status_vendor')))],
        ]);

        $vendorId = Auth::user()->vendor->id;
        $order = Order::whereHas('orderProducts', fn ($query) => $query->where('vendor_id', $vendorId))
            ->findOrFail($id);

        $order->order_status = $request->status;
        $order->save();

        toastr('Status Updated Successfully!', 'success', 'Success');

        return redirect()->back();
    }
}
