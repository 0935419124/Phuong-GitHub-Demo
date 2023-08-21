<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\CateItems;

class CateItemController extends Controller
{
    public function index($id)
    {
        $cateItems=CateItems::where('cate_id','=',$id)->get();
        $cate=Categories::find($id);
        return view('admin.pages.categories.items')->with(compact('cateItems','cate'));
    }
    public function create(Request $request)
    {
        if($request->has('file_upload')){
            $file=$request->file_upload;
            $file_name= date('YmdHi').$file->getClientoriginalName();
            $file->move(public_path('images/products'),$file_name);
        }
        $request->merge(['image'=>$file_name]);
        $cate= new CateItems();
        $cate->name=$request->name;
        $cate->image=$request->image;
        $cate->cate_id=$request->cate_id;
        $cate->save();
        toastr()->success('Thành công', 'Thêm danh mục con thành công');
        return redirect('admin/cateitems/index/'.$cate->cate_id);
    }
    public function loadEdit($id)
    {
        $cateItem=CateItems::find($id);
        $id=$cateItem->cate_id;

        $cateItems=CateItems::where('cate_id','=',$id)->get();
        return view('admin.pages.categories.editItem',['cateItem'=>$cateItem,'cateItems'=>$cateItems]);

    }
    public function edit(Request $request)
    {
        if($request->file_upload==''){
            $image=$request->input('image1');
        }
        else if($request->has('file_upload')){
            $file=$request->file_upload;
            $file_name= $file->getClientoriginalName();
            $file->move(public_path('images/products'),$file_name);
            $image=$file_name;
        }
            $cate=CateItems::find($request->id);
            $cate->name=$request->name;
            $cate->image=$image;
            $cate->cate_id=$request->cate_id;
            $cate->save();

            toastr()->success('Thành công', 'Cập nhật danh mục con thành công');
            return redirect('admin/cateitems/index/'.$cate->cate_id);
    }
    public function delete($id)
    {
        $cate=CateItems::find($id);
        $id=$cate->cate_id;
        $cate->delete();

        toastr()->success('Thành công', 'Cập nhật danh mục con thành công');
        return redirect('admin/cateitems/index/'.$id);
    }
}
