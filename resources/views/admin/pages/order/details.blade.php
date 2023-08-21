@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Order</p>
            <div class="table-responsive pt-3">
              <table id="recent-purchases-listing" class="table table-bordered">
                <thead>
                  <tr>
                      <th>Tên sản shẩm</th>
                      <th>Hình ảnh</th>
                      <th>Số lượng</th>
                      <th>Tổng tiền</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($details as $detail)
                  <tr>
                    <td>{{$detail->product_name}}</td>
                    <td><img src="{{asset('images/products/'.$detail->Products->image)}}" alt="" style="width:100px; height:100px"></td>
                    <td>{{$detail->number}}</td>
                    <td>{{ number_format($detail->price, 0, '.', '.');}} VNĐ</td>
                  </tr>  
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 ">
        <div class="order-info-user">
          <div class="info-user">
            <h3>Khách hàng</h3>
            <div class="info-user-content">
              <span><img width="50px" src="{{asset('images/users/'.$order->User->image)}}" alt=""></span>
              <span>{{$order->User->name}}</span>
            </div>
          </div>
        </div>
        <div class="order-info-user mt-2">
          <div class="info-user-content">
            <p>Tổng tiền:</p><span>{{ number_format($order->total, 0, '.', '.');}} VNĐ</span>
          </div>
        </div>
        <div class="order-info-user mt-2">
          <div class="info-user-content">
            <p>Giao hàng:</p><span>{{ number_format($order->Delivery->value, 0, '.', '.');}} VNĐ</span>
          </div>
          <div class="info-user-content">
            <p>Giảm giá</p><span>{{ number_format($order->discount, 0, '.', '.');}} VNĐ</span>
          </div>
          <div class="info-user-content ipt">
            <p>Tổng tiền</p><span>{{ number_format($order->total, 0, '.', '.');}} VNĐ</span>
          </div>
        </div>
        <div class="order-info-user mt-2">
          <div class="info-user-content">
            <p>Người nhận: <span>{{$order->UserAddress->name}}</span></p>
          </div>
          <div class="info-user-content">
            <p>SĐT: <span>0{{$order->UserAddress->phone}}</span></p>
          </div>
          <div class="info-user-content">
            <p>Địa chỉ: <span>{{$order->UserAddress->address}}</span></p>
          </div>
          <div class="info-user-content">
            <p>Ghi chú: <span>{{$order->note}}</span></p>
          </div>
          <div class="info-user-content">
            <p>PT Giao Hàng: <span>{{$order->Delivery->name}}</span></p>
          </div>
          <div class="info-user-content">
            <p>Ngày tạo đơn: <span>{{$order->created_at}}</span></p>
          </div>
          <div class="info-user-content">
            <p>Trạng Thái: <span>
              @if ($order->status==0)
                  Đang xử lý
              @elseif($order->status==1)
                  Đã xác nhận
              @elseif($order->status==2)
                  Đang giao hàng
              @elseif($order->status==3)
                  Đã thanh toán
              @elseif($order->status==4)
                  Đã hủy
              @endif
            </span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection