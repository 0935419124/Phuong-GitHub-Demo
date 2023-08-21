<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CateItems;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Comments;
use App\Models\User;
use DB;


class CommentController extends Controller
{
    public function __construct()
    {
        // $allCom = DB::table('comments')->join('users' , 'users.id', '=', 'comments.user_id')->join('products', 'products.id', '=', 'comments.pro_id')
        // ->select('comments.*', 'users.name', 'products.name')->get();
        $allCom=Comments::all();
        view()->share('allCom', $allCom);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allPro=Products::all();
        $allUser=User::all();
        $allCom1 = Comments::all();
        return view('admin.pages.comments.index')->with(compact('allPro' ,'allCom1', 'allUser'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1()
    {
        $keywords = $_GET['keywords_pro_id'];
        $allPro=Products::all();
        $allUser=User::all();
        $allCom = Comments::where('pro_id','=', $keywords)->get();
        $allCom1 = Comments::all();
        
        if(count($allCom)!=0){
            $cate1 = Products::where('id','=', $keywords)->select('name')->get();
            $sub1 = subStr($cate1, 10);
            $str1 = strrev($sub1);
            $sub2 = subStr($str1, 3);
            $str2 = strrev($sub2);
            $mess = 'Lọc theo tên: '.$str2.'.';
            return view('admin.pages.comments.index')->with(compact('allPro', 'allCom','allCom1', 'allUser','mess'));
        }else{
            $allCom=Comments::all();
            $mess = 'Không tìm thấy kết quả!!!. Hiển thị tất cả bình luận.';
            return view('admin.pages.comments.index')->with(compact('allPro', 'allCom','allCom1', 'allUser', 'mess'));
        }
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2()
    {
        $keywords = $_GET['keywords_user_id'];
        $allPro=Products::all();
        $allUser=User::all();
        $allCom = Comments::where('user_id','=', $keywords)->get();
        $allCom1 = Comments::all();

        if(count($allCom)!=0){
            $cate1 = User::where('id','=', $keywords)->select('name')->get();
            $sub1 = subStr($cate1, 10);
            $str1 = strrev($sub1);
            $sub2 = subStr($str1, 3);
            $str2 = strrev($sub2);
            $mess = 'Lọc theo tên: '.$str2.'.';
            return view('admin.pages.comments.index')->with(compact('allPro', 'allCom','allCom1', 'allUser','mess'));
        }else{
            $allCom=Comments::all();
            $mess = 'Không tìm thấy kết quả!!!. Hiển thị tất cả bình luận.';
            return view('admin.pages.comments.index')->with(compact('allPro', 'allCom','allCom1', 'allUser','mess'));
        }
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index3()
    {
        $keywords = $_GET['keywords_date'];
        $allPro=Products::all();
        $allUser=User::all();
        $allCom1 = Comments::all();
        $allCom = Comments::where('created_at','=', $keywords)->get();
        

        if(count($allCom)!=0){
            
            $mess = 'Kết quả của từ khóa: '.$keywords.'.';
            return view('admin.pages.comments.index')->with(compact('allPro', 'allCom1', 'allCom', 'allUser', 'mess'));
        }else{
            $allCom=Comments::all();
            $mess = 'Không tìm thấy kết quả của từ khóa: '.$keywords.'. Hiển thị danh sách sản phẩm:';
            return view('admin.pages.comments.index')->with(compact('allPro', 'allCom1', 'allCom','allUser', 'mess'));
        }
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
        $com= Comments::find($id);
        $com->delete();
        toastr()->success('Thành công', 'Xóa bình luận thành công');
        return redirect(route('listCom'));
    }
}
