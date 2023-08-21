@extends('client.master')
@section('title','Quên mật khẩu')
@section('content')
<main>
<section>
<div class="form-gap"></div>
<div class="container py-4">
	<div class="card bg-light">
		<div class="card-body mx-auto">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3 class="icon-forgot"><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Quên mật khẩu</h2>
                  <p>Bạn có thể thiết lập lại mật khẩu của bạn ở đây.
                </p>
                  <div class="panel-body">
    
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="email" placeholder="Địa chỉ email của bạn" class="form-control"  type="email">
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-block btn-form" value="Đặt lại mật khẩu của bạn" type="submit">
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
</section>
@endsection