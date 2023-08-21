<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\CateItems;
use App\Models\Products;
use App\Models\ProVariants;
use App\Models\ProDetails;
use App\Models\ProMemory;
use App\Models\ProColors;

class ProductController extends Controller
{
    public function __construct()
    {
        $allPro=Products::all();
        view()->share('allPro', $allPro);
    }
    public function index()
    {
        $allCate = CateItems::all();
        $allPro = Products::all();
        $allPro1=Products::all();

        return view('admin.pages.products.index')->with(compact('allCate', 'allPro','allPro1'));
    }

    public function index5()
    {
        $keyword = $_GET['keywords_cate_id'];
        $allCate = CateItems::all();
        $allPro = Products::where('cate_id','=', $keyword)->get();
        $allPro1=Products::all();

        if(count($allPro)==0){
            $mess = 'Không tìm thấy kết quả!!!. Hiển thị tất cả sản phẩm.';
            $allPro=Products::all();
            return view('admin.pages.products.index')->with(compact('allCate', 'allPro', 'allPro1','mess'));
        }else{
            $cate1 = CateItems::where('id','=', $keyword)->select('name')->get();
            $sub1 = subStr($cate1, 10);
            $str1 = strrev($sub1);
            $sub2 = subStr($str1, 3);
            $str2 = strrev($sub2);
            $mess = 'Lọc theo loại: '.$str2.'.';
            return view('admin.pages.products.index')->with(compact('allCate', 'allPro', 'allPro1','mess','cate1'));
        }
    }
    public function index6()
    {
        $keyword = $_GET['keywords_pro_name'];
        $allCate = CateItems::all();
        $allPro = Products::where('name','=', $keyword)->get();
        $allPro1=Products::all();

        if(count($allPro)==0){
            $mess = 'Không tìm thấy kết quả!!!. Hiển thị tất cả sản phẩm.';
            $allPro=Products::all();
            return view('admin.pages.products.index')->with(compact('allCate', 'allPro', 'allPro1','mess'));
        }else{
            $mess = 'Lọc theo tên: '.$keyword.'.';
            return view('admin.pages.products.index')->with(compact('allCate', 'allPro', 'allPro1','mess'));
        }
    }

    public function index7()
    {
        $keyword = $_GET['keywords_price'];
        $allPro=Products::all();
        $allCate = CateItems::all();
        $allPro1=Products::all();

        if($keyword==0){
            $mess = 'Tất cả sản phẩm';
            $allPro=Products::all();
            return view('admin.pages.products.index')->with(compact('allCate', 'allPro', 'allPro1','mess'));
        }
        else if($keyword==1){
            $mess = 'Sản phẩm giá dưới 1tr';
            $allPro=Products::where('price','<', 1000000)->get();
            return view('admin.pages.products.index')->with(compact('allCate', 'allPro', 'allPro1', 'mess'));
        }
        else if($keyword==2){
            $mess = 'Sản phẩm giá từ 1tr đến 2tr';
            $allPro=Products::whereBetween('price',[1999900, 2000000])->get();

            return view('admin.pages.products.index')->with(compact('allCate', 'allPro', 'allPro1', 'mess'));
        }
        else if($keyword==3){
            $mess = 'Sản phẩm giá từ 2tr đến 4tr';
            $allPro=Products::whereBetween('price',[2999900, 4000000])->get();

            return view('admin.pages.products.index')->with(compact('allCate', 'allPro', 'allPro1', 'mess'));
        }
        else if($keyword==4){
            $mess = 'Sản phẩm giá từ 4tr đến 7tr';
            $allPro=Products::whereBetween('price',[4999900, 7000000])->get();

            return view('admin.pages.products.index')->with(compact('allCate', 'allPro', 'allPro1', 'mess'));
        }
        else if($keyword==5){
            $mess = 'Sản phẩm giá từ 7tr đến 10tr';
            $allPro=Products::whereBetween('price',[7999900, 10000000])->get();

            return view('admin.pages.products.index')->with(compact('allCate', 'allPro', 'allPro1', 'mess'));
        }
        else if($keyword==6){
            $mess = 'Sản phẩm giá từ 10tr đến 15tr';
            $allPro=Products::whereBetween('price',[99999900, 15000000])->get();

            return view('admin.pages.products.index')->with(compact('allCate', 'allPro', 'allPro1', 'mess'));
        }
        else if($keyword==7){
            $mess = 'Sản phẩm giá từ 15tr đến 20tr';
            $allPro=Products::whereBetween('price',[14999900, 20000000])->get();

            return view('admin.pages.products.index')->with(compact('allCate', 'allPro', 'allPro1', 'mess'));
        }
        else if($keyword==8){
            $mess = 'Sản phẩm giá trên 20tr';
            $allPro=Products::where('price','>',20000000)->get();

            return view('admin.pages.products.index')->with(compact('allCate', 'allPro', 'allPro1', 'mess'));
        }
    }

    
    public function createView()
    {
        $allCate=Categories::all();
        return view('admin.pages.products.create',['allCate'=>$allCate]);
    }
    public function loadCateItem(Request $request)
    {
        $allCateItems=CateItems::where('cate_id',$request->id_cate)->get();
        return response()->json($allCateItems);
    }
    public function create(Request $r)
    {
     
        $pro=new Products();

        if($r->has('file_upload')){
            $file=$r->file_upload;
            $file_name= date('YmdHi').$file->getClientOriginalName();
            //dd($file_name);
            $file->move(public_path('images/products'),$file_name);
        }
        $r->merge(['image'=>$file_name]);

        $pro->name=$r->name;
        $pro->cate_id=$r->cate_id;
        $pro->price=$r->price;
        $pro->discount=$r->discount;
        $pro->image=$r->image;
      // $pro->date=$r->date;
        $pro->quantity=$r->quantity;
        $pro->detail=$r->detail;
        $pro->hot=$r->hot;
        $pro->status=$r->status;
        $pro->save();

        $id_pro=$pro->id;

        if(isset($r->cpu)){
            $pro_details= new ProDetails();
            $pro_details->pro_id=$id_pro;
            $pro_details->memory=$r->memory;
            $pro_details->camera=$r->camera;
            $pro_details->display=$r->display;
            $pro_details->batery=$r->batery;
            $pro_details->os=$r->os;
            $pro_details->sub_camera=$r->sub_camera;
            $pro_details->cpu=$r->cpu;
            $pro_details->ram=$r->ram;
            $pro_details->hight=$r->hight;
            $pro_details->width=$r->width;
            $pro_details->depth=$r->depth;
            $pro_details->weight=$r->weight;
            $pro_details->save();
        }

        if(isset($r->memory_var)){
            $pro_memory= new ProMemory();
            $pro_memory->pro_id=$id_pro;
            $pro_memory->memory=$r->memory_var;
            $pro_memory->ram=$r->ram_var;
            $pro_memory->price=$r->price_memory;
            $pro_memory->save();
        }
        if(isset($r->color)){
            $pro_color= new ProColors();
            if($r->has('file_image_color')){
                $file=$r->file_image_color;
                $file_image_color= date('YmdHi').$file->getClientOriginalName();
                //dd($file_name);
                $file->move(public_path('images/products'),$file_image_color);
            }
            $r->merge(['image_color'=>$file_image_color]);

            $pro_color->pro_id=$id_pro;
            $pro_color->color=$r->color;
            $pro_color->image=$file_image_color;
            $pro_color->price=$r->price_color;
            $pro_color->save();
        }

        toastr()->success('Thành công', 'Thêm sản phẩm thành công');
        return redirect(route('listPro'));

    }
    
    // Biến thể
    public function showVariants($id)
    {
        $pro=Products::find($id);
        $allCate=Categories::all();
        $pro_color=ProColors::where('pro_id','=',$id)->get();
        // dd($pro_color);
        $pro_memory=ProMemory::where('pro_id','=',$id)->get();
        return view('admin.pages.products.variants')->with(compact('pro','allCate','pro_color','pro_memory'));
    }
    public function createVariant(Request $request)
    {
        $pro_var= new ProVariants();
        if($request->has('file_upload_var')){
            $file=$request->file_upload_var;
            $file_name= date('YmdHi').$file->getClientOriginalName();
            //dd($file_name);
            $file->move(public_path('images/products'),$file_name);
        }
        $request->merge(['image'=>$file_name]);

        $pro_var->pro_id=$request->id;
        $pro_var->color=$request->color;
        $pro_var->memory=$request->memory;
        $pro_var->price=$request->price_var;
        $pro_var->image=$request->image;
        $pro_var->width=$request->width;
        $pro_var->hight=$request->hight;
        $pro_var->weight=$request->weight;
        $pro_var->depth=$request->depth;
        $pro_var->save();

        toastr()->success('Thành công', 'Thêm biến sản phẩm thành công');
        return back();
    }

    public function deleteVar($id)
    {
        $pro_var=ProVariants::find($id);
        $pro_id=$pro_var->pro_id;
        $pro_var->delete();
        $pro=Products::find($pro_id);
        $allCate=Categories::all();
        $pro_vars=ProVariants::where('pro_id','=',$pro_id)->get();

        toastr()->success('Thành công', 'Xóa biến sản phẩm thành công');
        return back();

        
    }
    public function loadEdit($id)
    {
        $pro=Products::find($id);
        $pro_details=Products::find($id)->ProDetails;
        $allCate=Categories::all();
        $allCateItems=CateItems::all();
        return view('admin.pages.products.edit')->with(compact('pro', 'allCate','pro_details','allCateItems'));
    }
    public function edit(Request $r)
    {
        $pro=Products::find($r->id);

        if($r->file_upload==''){
            $image=$r->input('image1');
        }
        else if($r->has('file_upload')){
            $file=$r->file_upload;
            $file_name= $file->getClientoriginalName();
            $file->move(public_path('images/products'),$file_name);
            $image=$file_name;
        }

        $pro->name=$r->name;
        $pro->cate_id=$r->cate_id;
        $pro->price=$r->price;
        $pro->discount=$r->discount;
        $pro->image=$image;
       // $pro->date=$r->date;
        $pro->quantity=$r->quantity;
        $pro->detail=$r->detail;
        $pro->hot=$r->hot;
        $pro->status=$r->status;
        $pro->save();

        if(isset($r->cpu)){
            $pro_details= ProDetails::where('pro_id', '=', $pro->id)->first();

            if($pro_details){
                $pro_details->pro_id=$pro->id;
                $pro_details->memory=$r->memory;
                $pro_details->camera=$r->camera;
                $pro_details->display=$r->display;
                $pro_details->batery=$r->batery;
                $pro_details->os=$r->os;
                $pro_details->sub_camera=$r->sub_camera;
                $pro_details->cpu=$r->cpu;
                $pro_details->ram=$r->ram;
                $pro_details->hight=$r->hight;
                $pro_details->width=$r->width;
                $pro_details->depth=$r->depth;
                $pro_details->weight=$r->weight;
                $pro_details->save();
            }else{
                $pro_details= new ProDetails();
                $pro_details->pro_id=$pro->id;
                $pro_details->memory=$r->memory;
                $pro_details->camera=$r->camera;
                $pro_details->display=$r->display;
                $pro_details->batery=$r->batery;
                $pro_details->os=$r->os;
                $pro_details->sub_camera=$r->sub_camera;
                $pro_details->cpu=$r->cpu;
                $pro_details->ram=$r->ram;
                $pro_details->hight=$r->hight;
                $pro_details->width=$r->width;
                $pro_details->depth=$r->depth;
                $pro_details->weight=$r->weight;
                $pro_details->save();
            }
            
        }

        toastr()->success('Thành công', 'Cập nhật sản phẩm thành công');
        return redirect(route('listPro'));
    }
    public function delete($id)
    {
        $pro=Products::find($id);
        $pro->delete();
        toastr()->success('Thành công', 'Xóa sản phẩm thành công');
        return redirect(route('listPro'));
    }

    /// Biến thể

    public function deleteColor($id)
    {
        $pro_color=ProColors::find($id);
        $pro_color->delete();
        toastr()->success('Thành công', 'Xóa biến thể thành công');
        return back();
    }

    public function createColor(Request $r)
    {
        $pro_color= new ProColors();
        if($r->has('file_image_color')){
            $file=$r->file_image_color;
            $file_image_color= date('YmdHi').$file->getClientOriginalName();
            //dd($file_name);
            $file->move(public_path('images/products'),$file_image_color);
        }
        $r->merge(['image_color'=>$file_image_color]);

        $pro_color->pro_id=$r->id;
        $pro_color->color=$r->color;
        $pro_color->image=$file_image_color;
        $pro_color->price=$r->price_color;
        $pro_color->save();

        toastr()->success('Thành công', 'Thêm biến thể thành công');
        return back();
    }


    public function createMemory(Request $r)
    {
        $pro_memory= new ProMemory();
        $pro_memory->pro_id=$r->id;
        $pro_memory->memory=$r->memory;
        $pro_memory->ram=$r->ram;
        $pro_memory->price=$r->price_memory;
        $pro_memory->save();

        toastr()->success('Thành công', 'Thêm biến thể thành công');
        return back();
    }

    public function deleteMemory($id)
    {
        $pro_memory=ProMemory::find($id);
        $pro_memory->delete();
        toastr()->success('Thành công', 'Xóa biến thể thành công');
        return back();
    }
}
