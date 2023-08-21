@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Danh sách phương thức vận chuyển</p>
            <a class="card-title badge badge-info rounded" href="{{route('CreateDelivery')}}">Thêm mới</a><br>

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
                      <th>ID</th>
                      <th>Mức phí</th>
                      <th>Tên phương thức vận chuyển</th>
                      <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($ListDelivery as $deli)
                  <tr>
                    <td>{{$deli->id}}</td>
                    <td>{{ number_format($deli->value, 0, '.', '.');}}VND</td>
                    <td>{{$deli->name}}</td>

                    
                    <td><a class="badge badge-info rounded" href="{{route('EditDelivery',$deli->id)}}">Sửa</a>
                    <a class="badge badge-danger rounded" onclick="return confirm('Xóa mục này?')" href="{{route('DeleteDelivery',$deli->id)}}">Xóa</a></td>
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