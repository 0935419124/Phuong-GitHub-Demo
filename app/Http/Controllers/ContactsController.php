<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contacts;

class ContactsController extends Controller
{
    public function __construct()
    {
        // $allCom = DB::table('comments')->join('users' , 'users.id', '=', 'comments.user_id')->join('products', 'products.id', '=', 'comments.pro_id')
        // ->select('comments.*', 'users.name', 'products.name')->get();
        $allContac=Contacts::all();
        view()->share('allContac', $allContac);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allUser = Contacts::all();
        $allContac=Contacts::all();
        return view('admin.pages.contacts.index')->with(compact('allUser', 'allContac'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchContact()
    {
        $keywords = $_GET['keywords'];
        $allContac=Contacts::where('user_name','LIKE', '%'.$keywords.'%')
        ->orWhere('user_email','LIKE', '%'.$keywords.'%')->get();

        if(count($allContac)!=0){
            $mess = 'Kết quả của từ khóa: '.$keywords.'.';
            return view('admin.pages.contacts.index')->with(compact('allContac', 'mess'));
        }
        else if($keywords == null){
            $allContac=Contacts::all();
            $mess = 'Tất cả tin nhắn liên hệ';
            return view('admin.pages.contacts.index')->with(compact('allContac', 'mess'));
        }else{
            $allContac=Contacts::all();
            $mess = 'Không tìm thấy kết quả của từ khóa: '.$keywords.'. Hiển thị tất cả:';
            return view('admin.pages.contacts.index')->with(compact('allContac', 'mess'));
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
        //
    }
}
