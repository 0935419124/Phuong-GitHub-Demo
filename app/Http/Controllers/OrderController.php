<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Orders;
use App\Models\OrderDetails;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Orders::orderBy('id','desc')->get();
        return view('admin.pages.order.index', compact('orders'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $orders = new Orders();
        $orders->status = $request->status;
        $orders->save();
        return redirect(route('indexAdmin'));
    }

    public function detail($id)
    {
        $order=Orders::find($id);
        $details=OrderDetails::where('order_id','=', $id)->get();
        return view('admin.pages.order.details', compact('order','details'));
    }

    public function edit($id)
    {
        $orders = Orders::find($id);
        return view('admin.pages.order.edit', compact('orders'));
    }

    public function update(Request $r)
    {      
        $orders = Orders::find($r->order_id);
        $orders ->status = $r->status;

        $orders->save();
        return redirect('admin/order/index')->with('success', 'Cập nhật đơn hàng thành công');
    }

    public function delete($id)
    {
        $order = Orders::find($id);
        $order->delete();
        return redirect('admin/order/index')->with('success', 'Xóa đơn hàng thành công');
    }

    public function orderByStatus(Request $r)
    {
        if($r->status==5){
            $orders = Orders::orderBy('id','desc')->get();
        }
        $orders = Orders::where('status', '=', $r->status)->orderBy('id','desc')->get();
        return view('admin.pages.order.index', compact('orders'));
    }
}
