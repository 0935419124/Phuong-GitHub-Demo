@extends('client.master')
@section('title','Thông tin tài khoản')
@section('content')
<main>
<section>
<div class="container bg-light"> 
           <form method="POST" action="{{route('updateAccount')}}" enctype="multipart/form-data" class="forms-sample">
            @csrf
    <div class="row"> 
 
            <div class="col-md-3 border-right m-auto"> 
                <div class="d-flex flex-column relative align-items-center text-center p-3 py-5">
                    <img id="image" class="object-cover w-full h-full" src="{{asset('images/users')}}/{{Auth::user()->image}}" />
                    <div class="absolute top-0 left-0 right-0 bottom-0 w-full block cursor-pointer flex items-center justify-center" onClick="document.getElementById('fileInput').click()">
                        <button type="button"
                            style="background-color: rgba(255, 255, 255, 0.65)"
                            class="hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 text-sm border border-gray-300 rounded-lg shadow-sm"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-camera" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                <path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
                                <circle cx="12" cy="13" r="3" />
                            </svg>                            
                        </button>
                    </div>
                    <input name="file_upload" id="fileInput" accept="image/*" class="hidden" type="file" onChange="let file = this.files[0]; 
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            document.getElementById('image').src = e.target.result;
                            document.getElementById('image2').src = e.target.result;
                        };
                    
                        reader.readAsDataURL(file);
                    ">
                    <span class="font-weight-bold">{{Auth::user()->name}}</span>
                    <span class="text-black-50">hoadeptry02@gmail.com</span>
                    <span></span>
                </div> 
            </div> 
            <div class="col-md-9 border-right"> 
                <div class="p-3 py-5"> 

                        <input type="hidden" name="image1" value="{{Auth::user()->image}}" id="">

                    <div class="d-flex justify-content-between align-items-center mb-3"> 
                        <h4 class="text-right">Thay đổi thông tin</h4> 
                    </div> <div class="row mt-2"> 
                        <div class="col-md-6">
                            <label class="labels">Họ và tên</label>
                            <input type="text" class="form-control" placeholder="Họ và tên" name="name" value="{{Auth::user()->name}}">
                        </div> 
     
                        <div class="col-md-6">
                            <label class="labels">Địa chỉ email</label>
                            <input type="text" class="form-control" name="email" value="{{Auth::user()->email}}" placeholder="Địa chỉ email">
                        </div> 
                    </div> 
                    {{-- <div class="row mt-3"> 
                        <div class="col-md-6">
                            <label class="labels">Mật khẩu</label>
                            <input type="password" class="form-control" placeholder="Mật khẩu" value="" name="password">
                        </div> 
                        <div class="col-md-6">
                            <label class="labels">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" value="" placeholder="Xác nhận mật khẩu" name="password">
                        </div> 
                    </div>   --}}
                    
                    <div class="row mt-3"> 
                        <div class="col-md-6">
                            <label class="labels">Địa chỉ</label>
                            <input type="text" class="form-control" placeholder="Địa chỉ" value="{{Auth::user()->address}}" name="address">
                        </div> 
                        <div class="col-md-6">
                            <label class="labels">Số điện thoại</label>
                            <input type="text" class="form-control" value="{{Auth::user()->phone}}" name="phone" placeholder="Số điện thoại">
                        </div> 
                    </div> 
                    <div class="row mt-3"> 
                        <div class="col-md-6">
                            <label class="labels">Trạng thái</label>
                            <input type="text" disabled class="form-control" placeholder="Trạng thái" name="" value="@if (Auth::user()->status == 1)Chưa kích hoạt
                            @else Kích hoạt
                            @endif ">
                        </div> 
                        <div class="col-md-6">
                            <label class="labels">Vai trò</label>
                            <input type="text" disabled  class="form-control" value="@if (Auth::user()->role == 1)Quản trị viên
                            @else Thành viên
                            @endif " name="" placeholder="Vai trò">
                        </div> 
                        <!-- <div class="col-md-12">
                            <label class="labels">Hình ảnh</label>
                            <div class="row">
                                <img class="col-md-2" src="{{asset('images/users/'.Auth::user()->image)}}" width="30%" alt="Không có ảnh">
                                <input type="file" class="form-control col-md-10 m-auto" name="file_upload" >
                            </div>
                            
                        </div>  -->
                    </div> 
                    <div class="mt-5 text-center">
                        <button class="btn btn-form" type="submit">Cập nhật tài khoản</button>
                    </div> 
                </div> 
            </div> 

    </div>
            </form>

</div>
</div>
</div>
</section>
@endsection