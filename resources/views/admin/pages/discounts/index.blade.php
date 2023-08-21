@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Danh sách mã giảm giá</p>
            <a class="card-title badge badge-info rounded" href="{{route('loadDiscount_code')}}">Thêm mới</a><br>

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
                      <th>Mã giảm giá</th>
                      <th>Số tiền giảm</th>
                      <th>Số lượng</th>
                      <th>Ngày bắt đầu</th>
                      <th>Ngày kết thức</th>
                      <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($allDisc as $disc)
                  <tr>
                    <td>{{$disc->id}}</td>
                    <td>{{$disc->code}}</td>
                    <td>{{$disc->dicount}} VNĐ</td>
                    <td>{{$disc->quantity}}</td>
                    <td>{{$disc->start_time}}</td>
                    <td>{{$disc->end_time}}</td>
                    <td><a class="badge badge-info rounded" href="{{route('loadUpdateDiscount_code',$disc->id)}}"><i class="mdi mdi-wrench"></i></a>
                    <a class="badge badge-danger rounded" onclick="return confirm('Xóa mục này?')" href="{{route('deleteDiscount_code',$disc->id)}}"><i class="mdi mdi-delete"></i></a></td>
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