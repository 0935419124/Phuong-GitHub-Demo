<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index(){
        $ListDelivery = Delivery::all();
        return view('admin.pages.delivery.index', compact('ListDelivery'));
    }
    public function CreateDelivery(){
        return view('admin.pages.delivery.create');
    }
    public function CreateDelivery_(Request $request){
        $deli = new Delivery();
        $deli->value=$request->value;
        $deli->name=$request->name;
        $deli->save();
        toastr()->success('Thành công', 'Thêm phương thức vận chuyển thành công');
        return redirect(route('ListDelivery'));
    }
    public function getedit($id){
        $allDeli = Delivery::find($id);
        return view('admin.pages.delivery.edit')->with(compact('allDeli'));
    }
    public function edit(Request $r){
        $deli = Delivery::find($r->id);
        $deli->value=$r->value;
        $deli->name=$r->name;
        $deli->save();
        toastr()->success('Thành công', 'Chỉnh sửa phương thức vận chuyển thành công');
        return redirect(route('ListDelivery'));
    }
    public function DeleteDelivery($id)
    {
        $deli = Delivery::find($id);
        $deli->delete();
        toastr()->success('Thành công', 'Xóa phương thức vận chuyển thành công');
        return redirect(route('ListDelivery'));
    }
}
