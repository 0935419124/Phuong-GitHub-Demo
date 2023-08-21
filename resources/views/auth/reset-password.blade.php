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
                  <h2 class="text-center">Đặt lại mật khẩu</h2>
                  <p>Bạn có thể thiết lập lại mật khẩu của bạn ở đây.
                </p>
                  <div class="panel-body">
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form id="register-form" role="form" autocomplete="off" class="form" method="POST" action="{{ route('password.update') }}">
                        @csrf
                      <div class="form-group">
                        <div class="input-group d-inline">
                              <x-text-input id="email" class="block mt-1 w-full" type="email" placeholder="Địa chỉ email của bạn" class="form-control w-100"  name="email" :value="old('email')" required autofocus />

                              <x-input-error :messages="$errors->get('email')" class="mt-2 d-block" />
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group d-inline">
                              <x-text-input id="password" class="form-control w-100 block mt-1 w-full" placeholder="Mật khẩu mới" type="password" name="password" required />

                              <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group d-inline">
                            <x-text-input id="password_confirmation" class="form-control w-100 block mt-1 w-full" placeholder="Xác nhận mật khẩu" type="password" name="password_confirmation" required />

                          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                      </div>
                      <div class="form-group">
                        <x-primary-button class="btn btn-lg btn-block btn-form">
                              {{ __('Đặt lại mật khẩu') }}
                        </x-primary-button>
<!--                         <input name="recover-submit" class="btn btn-lg btn-block btn-form" value="Đặt lại mật khẩu của bạn" type="submit">
 -->                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                      <input type="hidden" name="token" value="{{ $request->route('token') }}">
                     
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
