@extends('client.master')
@section('title','Đăng ký')
@section('content')
<main>
  <section class="signup-section">
  <div class="container">    
    <div class="card bg-light" style="border: none">
    <article class="card-body mx-auto" style="max-width: 400px;">
      <h4 class="card-title mt-3 text-center">Tạo tài khoản</h4>
      <p class="text-center">Bắt đầu với tài khoản miễn phí của bạn</p>
      <p>
        <a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>   Đăng nhập với Twitter</a>
        <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>    Đăng nhập với facebook</a>
      </p>
      <p class="divider-text">
            <span class="bg-light">hoặc</span>
        </p>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
      <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
         </div>
            <input name="name" class="form-control" placeholder="Họ và tên" type="text">
      </div>
 <!-- form-group// -->
        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
         </div>
            <input name="email" class="form-control" placeholder="Địa chỉ email" type="email">
        </div> 
  <!-- form-group// -->
        <div class="form-group input-group">
          <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i> </span>
          </div>
          <input name="password" class="form-control" placeholder="Mật khẩu" type="password">
        </div>
        <div class="form-group input-group">
          <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i> </span>
          </div>
          <input name="" class="form-control" placeholder="Nhập lại Mật khẩu" type="password">
        </div>
        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
            </div>
        <input name="address" class="form-control" placeholder="Địa chỉ của bạn" type="text">

        </div>
        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
            </div>
          <input name="phone" class="form-control" placeholder="Số điện thoại" type="text">
        </div> 
        <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fa fa-building"></i> </span>
              </div>
          <input name="file_upload" class="form-control" placeholder="Ảnh của bạn" type="file">
  
          </div><!-- form-group// -->
 <!-- form-group end.// -->                                  
        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-block btn-form"> Đăng ký tài khoản </button>
        </div> <!-- form-group// -->      
        <p class="text-center">Bạn đã có tài khoản? <a href="/">Đăng nhập</a> </p>                                                                 
    </form>
    </article>
    </div> <!-- card.// -->
    
    </div> 
    <!--container end.//-->
    </main>
</section>
@endsection