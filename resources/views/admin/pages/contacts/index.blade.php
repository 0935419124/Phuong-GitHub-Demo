@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Danh sách tin nhắn liên hệ.</p>

            <div class="col-md-3" style="float: left;">
                <form class="card-title" action="{{route('searchContact')}}" method="GET">
                @csrf
                    <div class="form-group">
                        <input type="text" name="keywords" class="form-control mb-2 mr-sm-2" id="fullname"  placeholder="Tìm kiếm">
                    </div>
                </form>
            </div>

            <div class="row" style=" clear: both; color: red; margin-left: 1%;">
              <h5>
                <?php
                  if(isset($mess)){
                    echo $mess;
                  }
                ?>
              </h5>
            </div>

            <div class="table-responsive">
              <table id="recent-purchases-listing" class="table table-hover">
                <thead>
                  <tr>
                      <th>Id</th>
                      <th>Tên người dùng</th>
                      <th>Email</th>
                      <th>Nội dung</th>
                      <th>Ngày đăng</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($allContac as $con)
                  <tr>
                    <td>{{$con->id}}</td>
                    <td>{{$con->user_name}}</td>
                    <td>{{$con->user_email}}</td>
                    <td>{{$con->message}}</td>
                    <td>{{$con->created_at}}</td>
                </tr>
                  @endforeach           
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection