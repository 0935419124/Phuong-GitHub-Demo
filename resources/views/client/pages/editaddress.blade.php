@extends('client.master')
@section('title','Thông tin tài khoản')
@section('content')
<main>
<section>
<div class="container bg-light"> 
    <form method="POST" action="{{route('editAddress')}}" enctype="multipart/form-data" class="forms-sample">
    @csrf
        <div class="row"> 
            <div class="col border-right"> 
                <div class="p-3 py-5"> 
                    <div class="d-flex justify-content-between align-items-center mb-3"> 
                        <h4 class="text-right">Chỉnh sửa địa chỉ</h4> 
                    </div> <div class="row mt-2"> 
                        <input type="hidden" class="form-control" placeholder="" name="id" value="{{$adr->id}}">

                      <input type="hidden" class="form-control" placeholder="" name="user_id" value="{{Auth::user()->id}}">

                        <div class="col-md-6">
                            <label class="labels">Họ và tên</label>

                            <input type="text" class="form-control" placeholder="" name="name" value="{{$adr->name}}">
                        </div> 
                        <div class="col-md-6">
                            <label class="labels">Số điện thoại</label>
                            <input type="text" class="form-control" value="{{$adr->phone}}" name="phone" placeholder="">
                        </div> 
                        
                    </div> 
                    <div class="row mt-3"> 
                        <div class="col-md-6">
                            <label class="labels">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" value="{{$adr->address}}" placeholder="">
                        </div> 
                        <div class="col-md-6">
                            <label class="labels">Trạng thái</label>
                            <select class="form-control w-100" name="role" required>
                                <option value="0">Tạm thời</option>
                                <option value="1" >Mặc định</option>
                            </select>
                            
                        </div> 
                        
                    </div> 
                    <div class="mt-5 text-center">
                        <button class="btn btn-form" type="submit">Chỉnh sửa địa chỉ</button>
                    </div> 
                </div> 
            </div> 

        </div>
    </form>
</div>
</section>
@endsection