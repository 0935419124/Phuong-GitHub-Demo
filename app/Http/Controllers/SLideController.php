<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Session;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
class SLideController extends Controller
{
    public function __construct()
    {
        $allslide = Slider::all();
        view()->share('allslide', $allslide);
    }
    public function index()
    {
        $allslide = Slider::where('slide_status','=',1)->orderBy('id','DESC')->get();
        return view('admin.pages.slider.index');
    }
    public function loadCreate()
    {
        return view('admin.pages.slider.create');
    }
    public function create(Request $r)
    {
        $slide = new Slider();

        if($r->has('file_upload')){
            $file=$r->file_upload;
            $file_name= date('YmdHi').$file->getClientOriginalName();
            //dd($file_name);
            $file->move(public_path('images/slider'),$file_name);
        }
        $r->merge(['image'=>$file_name]);

        $slide->name=$r->name;
        $slide->image=$r->image;
        $slide->slide_status=$r->slide_status;
        $slide->slide_desc=$r->slide_desc;
        $slide->save();
        Session::put('success', 'Thêm slide thành công');
        return redirect(route('listSlide'));

    }
    public function loadEdit($id)
    {
        var_dump($id);
        $slide = Slider::find($id);
        return view('admin.pages.slider.edit',['slide'=>$slide]);
    }
    public function edit(Request $request)
    {
        $slide = Slider::find($request->id);

        if($request->file_upload==''){
            $image=$request->input('image1');
        }
        else if($request->has('file_upload')){
            $file=$request->file_upload;
            $file_name= $file->getClientoriginalName();
            $file->move(public_path('images/slider'),$file_name);
            $image=$file_name;
        }

        $slide->name=$request->name;
        $slide->image=$image;
        $slide->slide_status=$request->slide_status;
        $slide->slide_desc=$request->slide_desc;
        $slide->save();
        
        Session::put('success','Chỉnh sửa slider thành công');
        return redirect(route('listSlide'));

    }
    public function delete($id)
    {
        $slide = Slider::find($id);
        $slide -> delete($id);
        return redirect(route('listSlide'));
    }
    public function unactive($id){
        DB::table('slider')->where('id',$id)->update(['slide_status'=>0]);
        Session::put('error','Bạn chưa kích hoạt slider');
        return redirect(route('listSlide'));

    }
    public function active($id){
        DB::table('slider')->where('id',$id)->update(['slide_status'=>1]);
        Session::put('success','Kích hoạt slider thành công');
        return redirect(route('listSlide'));

    }
}
