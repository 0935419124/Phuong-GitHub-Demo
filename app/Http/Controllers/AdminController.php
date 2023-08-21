<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Orders;
use App\Models\OrderDetails;
use App\Models\User;
use App\Models\Categories;
use App\Models\CateItems;
use \Carbon\Carbon;
use DB;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalView = Products::sum('view');
        $revenue= Orders::sum('total');
        $orders= Orders::count();
        $totalPro= OrderDetails::sum('number');
        $date = Carbon::now();
        $orders = Orders::where('status', '=', 0)->orderBy('id','desc')->limit('5')->get();
        $cate= Categories::all();
        $chartPro=[];
        foreach ($cate as $key =>$c){
            $qty= $c->Products->sum('quantity');
            $name=$c->name;
            $chartPro[++$key]=[$name, $qty];
        }
        $higest_resolved=DB::select(DB::raw('SELECT product_id,SUM(number) as number_total,product_name 
        FROM order_details GROUP by product_id ORDER by number_total DESC'));
        return view('admin.pages.index', compact('totalView','revenue','orders','totalPro','date', 'chartPro'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
