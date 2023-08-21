<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CateItems;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Comments;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $allCate=Categories::all();
        view()->share('allCate', $allCate);
        $allUser=User::all();
        view()->share('allUser', $allUser);
    }

    public function adminLogin(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('admin/index')->with('success', 'Đăng nhập thành công');
        }
        else{
            return redirect('adminlogin')->withErrors(['err' => 'Sai tài khoản hoặc mật khẩu']);;
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //View client
        $allCom=Comments::all();
        $allPro=Products::all();
        $allUser=User::where('role', '=', 0)->get();
        return view('admin.pages.users.index')->with(compact('allPro', 'allUser', 'allCom'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index4()
    {
        //View client
        $keywords = $_GET['keywords'];
        $allCom=Comments::all();
        $allPro=Products::all();
        $allUser=User::when($keywords, function ($query, $keywords) {
            $query->where('id','LIKE', '%'.$keywords.'%')->orWhere('name','LIKE', '%'.$keywords.'%');
        })->where('role', '=', 0)->get();

        if((count($allUser)!=0)){
            $message = 'Kết quả của: '.$keywords.'.';
            return view('admin.pages.users.index')->with(compact('allPro' , 'allUser', 'allCom','message'));
        }
        else{
            $message = 'Không tìm thấy kết quả của: '.$keywords.'.';
            return view('admin.pages.users.index')->with(compact('allPro' , 'allUser', 'allCom','message'));
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // view admin
    public function index5()
    {
        //View client
        $allCom=Comments::all();
        $allPro=Products::all();
        $allUser=User::where('role', '=', 1)->get();
        return view('admin.pages.users.index1')->with(compact('allPro', 'allUser', 'allCom'));
    }
    public function index6()
    {
        //View client
        $keywords = $_GET['keywords'];
        $allCom=Comments::all();
        $allPro=Products::all();
        $allUser=User::when($keywords, function ($query, $keywords) {
            $query->where('id','=', '%'.$keywords.'%')->orWhere('name','LIKE', '%'.$keywords.'%');
        })->where('role', '=', 1)->get();

        if((count($allUser)!=0)){
            $message = 'Kết quả của: '.$keywords.'.';
            return view('admin.pages.users.index1')->with(compact('allPro' , 'allUser', 'allCom','message'));
        }
        else{
            $message = 'Không tìm thấy kết quả của: '.$keywords.'.';
            return view('admin.pages.users.index1')->with(compact('allPro' , 'allUser', 'allCom','message'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function block($id)
    {
        $user=User::find($id);

        $user->name=$user->name;
        $user->email=$user->email;
        $user->email_verified_at=$user->email_verified_at;
        $user->password=$user->password;
        $user->image=$user->image;
       // $pro->date=$request->date;
        $user->remember_token=$user->remember_token;

        $user->address=$user->address;
        $user->phone=$user->phone;

        if(($user->status)==1){
            $user->status=0;
        }else if(($user->status)==0){
            $user->status=1;
        }

        $user->role=$user->role;
        $user->save();


        toastr()->success('Thành công', 'Cập nhật tài khoản thành công');
        return back();
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.pages.users.edit')->with(compact('user'));
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
        $user=User::find($request->id);

        if($request->file_upload==''){
            $image=$request->input('image1');
        }
        else if($request->has('file_upload')){
            $file=$request->file_upload;
            $file_name= $file->getClientoriginalName();
            $file->move(public_path('images/users'),$file_name);
            $image=$file_name;
        }

        $user->name=$request->name;
        $user->email=$request->email;
        $user->email_verified_at=$request->email_verified_at;
        $user->password=$request->password;
        $user->image=$image;
        $user->remember_token=$request->remember_token;

        $user->address=$request->address;
        $user->phone=$request->phone;
        $user->status=$request->status;
        $user->role=$request->role;
        $user->save();

        toastr()->success('Thành công', 'Cập nhật tài khoản thành công');
        return redirect(route('listUser'));
    }
    // update client
    public function edit_profile()
    {
        return view('client.pages.edit_profile');
    }
    public function updateAccount(Request $request)
    {
      $id = Auth::user()->id;
      $user = User::find($id);
      if($request->file_upload==''){
          $image=$request->input('image1');
      }
      else if($request->has('file_upload')){
          $file=$request->file_upload;
          $file_name= $file->getClientoriginalName();
          $file->move(public_path('images/users'),$file_name);
          $image=$file_name;
      }
      $user->name = $request->name;
      $user->email = $request->email;
    //   $user->password = $request->password;
      $user->image = $image;
      $user->address = $request->address;
      $user->phone = $request->phone;
    //   $user->role = $request->role;
      $user->save();
      toastr()->success('Thành công', 'Cập nhật tài khoản thành công');
      return redirect(route('manager'));
      // return view('client.pages.manager');
    }
    // end update client
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::find($id);
        $user->delete();
        toastr()->success('Thành công', 'Xóa người dùng thành công');
        return back();
    }
}
