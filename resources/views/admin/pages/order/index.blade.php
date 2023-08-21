@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Đơn hàng</p>

            {{-- Filter --}}
            <div class="col-md-3" style="float: left">
              <form class="card-title" action="{{route('orderByStatus')}}" method="POST">
                @csrf
                <div class="form-group">
                  <select class="form-control show-cti form-select list"  name="status" id="cate" onchange="this.form.submit()">
                    <option>Lọc theo tình trạng</option>
                    <option value="5">Tất cả </option>
                    <option value="0">Đang xử lý </option>
                    <option value="1">Đã xác nhận </option>
                    <option value="2">Đang giao hàng</option>
                    <option value="3">Đã giao hàng</option>
                    <option value="4">Đã hủy</option>   
                  </select>
                </div>
              </form>
            </div>
            <div class="table-responsive pt-3">
              <table id="recent-purchases-listing" class="table table-bordered">
                <thead>
                  <tr>
                      <th>ID</th>
                      <th>Tên Khách Hàng</th>
                      <th>Điện thoại</th>
                      <th>Địa chỉ</th>
                      <th>Tổng tiền</th>
                      <th>Tình trạng</th>
                      <th colspan="2">Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orders as $order)
                  <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->User->name}}</td>
                    <td>0{{$order->UserAddress->phone}}</td>
                    <td>{{$order->UserAddress->address}}</td>
                    <td>{{number_format($order->total, 0, '.', '.')}} VNĐ</td>
                    <td>
                      <select data-order_id="{{$order->id}}" class="order-status
                      @if($order->status==0)
                        btn btn-inverse-warning btn-fw
                      @elseif($order->status==1)
                        btn btn-inverse-secondary btn-fw
                      @elseif($order->status==2)
                        btn btn-inverse-primary btn-fw
                      @elseif($order->status==3)
                        btn btn-inverse-success btn-fw
                      @else
                        btn btn-inverse-danger btn-fw
                      @endif
                      " name="" id="">
                        @if ($order->status==0)
                            <option selected value='0'>Đang xử lý</option>
                            <option value='1'>Đã xác nhận</option>
                            <option value='2'>Đang giao hàng</option>
                            <option value='3'>Đã giao hàng</option>
                            <option value='4'>Đã hủy</option>
                        @elseif($order->status==1)
                            <option value='0'>Đang xử lý</option>
                            <option selected value='1'>Đã xác nhận</option>
                            <option value='2'>Đang giao hàng</option>
                            <option value='3'>Đã giao hàng</option>
                            <option value='4'>Đã hủy</option>
                        @elseif($order->status==2)
                            <option value='0'>Đang xử lý</option>
                            <option value='1'>Đã xác nhận</option>
                            <option selected value='2'>Đang giao hàng</option>
                            <option value='3'>Đã giao hàng</option>
                            <option value='4'>Đã hủy</option>
                        @elseif($order->status==3)
                            <option value='0'>Đang xử lý</option>
                            <option value='1'>Đã xác nhận</option>
                            <option value='2'>Đang giao hàng</option>
                            <option selected value='3'>Đã giao hàng</option>
                            <option value='4'>Đã hủy</option>
                          @else
                            <option value='0'>Đang xử lý</option>
                            <option value='1'>Đã xác nhận</option>
                            <option value='2'>Đang giao hàng</option>
                            <option value='3'>Đã giao hàng</option>
                            <option selected value='4'>Đã hủy</option>
                        @endif
                      </select>
                    </td>
                    </td>
                    <td>
                      <a class="badge badge-info rounded" href="{{Route('orderDetail',$order->id)}}">Chi tiết</a>
                      @if ($order->status==3 || $order->status==4)
                        <a class="badge badge-danger rounded"  onclick="confirm('Bạn chắc chắn xóa đơn hàng này')" href="{{Route('orderDelete', $order->id)}}">Xóa</a>
                      @endif
                    </td>
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

  <script type="text/javascript">
    $(document).ready(function(){
      $('.order-status').change(function (e) { 
        e.preventDefault();
         status=$(this).find(':selected').val();
         order_id=$(this).attr('data-order_id')
         $.ajax({
          url: '{{route('orderUpdate')}}',
            method: 'post',
            data:{
              _token: "{{ csrf_token() }}",
              order_id:order_id,
              status: status
            },
            success:function(data){
              window.location.reload();
            }
         })
      });
     })
  </script>
  @endsection