<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Discounts_code;

class DiscountsCodeController extends Controller
{
    public function __construct()
    {
        $allDisc=Discounts_code::all();
        view()->share('allDisc', $allDisc);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.discounts.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $disc=new Discounts_code();

        $disc->code=$request->code;
        $disc->dicount=$request->dicount;
        $disc->quantity=$request->quantity;
        $disc->start_time=$request->start_time;
        $disc->end_time=$request->end_time;
        $disc->save();

        toastr()->success('Thành công', 'Thêm mã giảm giá thành công');
        return redirect(route('listDiscount'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $allPro = Products::all();
        return view('admin.pages.discounts.create')->with(compact('allPro'));
    }
    
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showid($id)
    {
        $allPro = Products::all();
        $allDisc = Discounts_code::find($id);
        return view('admin.pages.discounts.update')->with(compact('allPro','allDisc')); 
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $disc=Discounts_code::find($request->id);

        $disc->code=$request->code;
        $disc->dicount=$request->dicount;
        $disc->quantity=$request->quantity;
        $disc->start_time=$request->start_time;
        $disc->end_time=$request->end_time;
        $disc->save();

        toastr()->success('Thành công', 'Thêm mã giảm giá thành công');
        return redirect(route('listDiscount'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disc = Discounts_code::find($id);
        $disc->delete();
        toastr()->success('Thành công', 'Xóa mã giảm giá thành công');
        return redirect(route('listDiscount'));
    }
}
