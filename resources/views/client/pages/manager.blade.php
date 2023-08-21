@extends('client.master')
@section('title','Thông tin tài khoản')
@section('content')
<main>
    <section class="vh-100" style="background-color: #f4f5f7;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-12 mb-4 mb-lg-0">
              <div class="card mb-3" style="border-radius: .5rem;">
                <div class="row g-0">
                  <div class="col-md-3 gradient-custom text-center text-white"
                    style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                    <img src="{{asset('images/users')}}/{{Auth::user()->image}}"
                      alt="Avatar" class="img-fluid m-auto pt-4" style="width: 150px;" />
                      <p class="text-dark m-0">ID: {{Auth::user()->id}}</p>
                    <h5>{{Auth::user()->name}}</h5>
                    <a class="text-dark" href="edit_profile"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <div class="d-flex justify-content-center">
                      <a class="text-dark" href="#!"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                      <a class="text-dark" href="#!"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                      <a class="text-dark" href="#!"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="card-body p-4">
                      <h6>Thông tin tài khoản</h6>
                      <hr class="mt-0 mb-4">
                      <div class="row pt-1">
                        <div class="col-6 mb-3">
                          <h6>Email</h6>
                          <p class="text-muted">{{Auth::user()->email}}</p>
                        </div>
                        <div class="col-6 mb-3">
                          <h6>Số điện thoại</h6>
                          <p class="text-muted">{{Auth::user()->phone}}</p>
                        </div>
                      </div>
                      <h6>Chi tiết</h6>
                      <hr class="mt-0 mb-4">
                      <div class="row pt-1">
                        <div class="col-6 mb-3">
                          <h6>Địa chỉ</h6>
                          <p class="text-muted">{{Auth::user()->address}}</p>
                        </div>
                        <div class="col-6 mb-3">
                          <h6>Vai trò</h6>
                          <p class="text-muted">@if (Auth::user()->role == 1)
                            Quản trị viên
                            @else
                            Thành viên
                            @endif </p>
                        </div>
                      </div>
                      <h6>Thông tin giao hàng</h6>
                      <hr class="mt-0 mb-4">
                      <div class="row pt-1">
                        <div class="col-6 mb-3">
                          <h6>Địa chỉ <a class="text-dark mx-2" href="useraddress"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></h6>
                          <p class="text-muted">Xem địa chỉ giao hàng</p>
                        </div>
                        
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
@endsection