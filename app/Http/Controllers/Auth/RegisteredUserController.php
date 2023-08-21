<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\UserAddress;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        if($request->has('file_upload')){
            $file=$request->file_upload;
            $file_name= date('YmdHi').$file->getClientOriginalName();
            //dd($file_name);
            $file->move(public_path('images/users'),$file_name);
        }
        $request->merge(['image'=>$file_name]);
        
        $user = User::create([ 
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image'=> $file_name,
            'address'=>$request->address,
            'phone'=>$request->phone
        ]);
        $adr = new UserAddress();
        $adr->user_id = $user->id;
        $adr->name = $request->name;
        $adr->phone = $request->phone;
        $adr->address = $request->address;
        $adr->role = 1;
        $adr -> save();

        event(new Registered($user));

        Auth::login($user);
        toastr()->success('Thành công', 'Đăng ký thành công!');
        return redirect(RouteServiceProvider::HOME);
    }
}
