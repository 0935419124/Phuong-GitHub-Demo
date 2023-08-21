@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Trạng thái đơn hàng</p>     
            <div class="table-responsive">
              <form class="needs-validation" novalidate action="{{url('admin/order/update',[$orders->id])}}" method="POST" enctype="mutilpart/form-data">
                @method('PUT')
                @csrf
                <div class="mb-1">
                  <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Mã đơn hàng</label>
                  <input type="text" id="basic-addon-name" class="form-control" value="{{$orders->id}}" readonly placeholder="" aria-label="Name" name="title" aria-describedby="basic-addon-name" required />
              <table id="recent-purchases-listing" class="table table-hover">
                <div class="mb-1">  
                  <div class="card-body"></div>                                                                              
                  <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Trạng thái</label>
                    <select class="form-control form-control-lg" name="status">
                      <option value="">----Chọn hình thức đơn hàng-----</option>
                      <option  value="0">Đã xử lý</option>
                      <option  value="1">Đang giao hàng</option>
                      <option  value="2">Đã giao hàng</option>
                      <option  value="3">Đã hủy hàng</option>
                    </select>               
                </div>
                <div>
                  <button type="submit" class="btn btn-danger">Cập nhật</button>  
                </div>
              </table>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection