@extends('client.master')
@section('title','Giỏ hàng')
@section('content')

<section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div class="banner_content d-md-flex justify-content-between align-items-center">
            <div class="mb-3 mb-md-0">
              <h2>Đơn hàng của tôi</h2>
              <p>Tất cả đơn hàng của bạn</p>
            </div>
            <div class="page_link">
              <a href="index.html">Trang chủ</a>
              <a href="category.html">Đơn hàng</a>
            </div>
          </div>
        </div>
      </div>
</section>
    <!--================Cart Area =================-->
    <section class="cart_area">
      <div class="container">
        <div class="row">
          <div class="cart_inner col-md-12">
           <div class="table-responsive">
            <table class="table cart-table">
              <thead>
                <tr>    
                  <th class="col-md-1" scope="col">Mã ĐH </th>
                  <th class="col-md-2" scope="col">Người nhận</th>
                  <th class="col-md-2" scope="col">Địa chỉ</th>
                  <th class="col-md-2" scope="col">Ngày tạo</th>
                  <th class="col-md-1" scope="col">Trạng thái</th>
                  <th class="col-md-2 text-center" scope="col">Tổng tiền</th>
                  <th class="col-md-2" scope="col">Hành động</th>
                </tr>
              </thead>
              <tbody>

                @if(isset($orders) && count($orders)>0)
                @foreach ($orders as $order)
                <tr>
                  <td>{{$order->id}}</td>
                  <td class="text-primary">{{$order->UserAddress->name}}</td>
                  <td  class="text-primary">{{$order->UserAddress->address}}</td>
                  <td>{{$order->created_at}}</td>
                  <td >
                    @if ($order->status==0)
                        <p class="processing">Đang xử lý</p>
                    @elseif($order->status==1)
                       <p class="confirmed"> Đã xác nhận</p>
                    @elseif($order->status==2)
                        <p class="progress">Đang giao hàng</p>
                    @elseif($order->status==3)
                        <p class="paid">Đã thanh toán</p>
                    @elseif($order->status==4)
                        <p class="cancelled">Đã hủy</p>
                    @endif
                  </td>
                  <td class="text-center">{{ number_format($order->total, 0, '.', '.');}} VNĐ</td>
                  <td>
                    <a style="border: 1px solid #d3cdcd;" href="{{route('myOrderDetails',$order->id)}}" class="genric-btn default-border radius delete-cart"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    @if ($order->status==0)
                      <a href="{{route('cancelOrders',$order->id)}}" onclick="confirm('Bạn chắc chắn hủy đơn hàng này')" class="genric-btn danger-border radius delete-cart"><i class="fa fa-times" aria-hidden="true"></i></a>
                     @endif
                  </td>
                </tr>
                 @endforeach
                @else
                <tr>
                  <td colspan="5">
                    <p class="no_cart">Chưa có đơn hàng nào</p>
                  </td>
                </tr>
                @endif
              </tbody>
            </table>
           </div>
       
          {{-- Payment sidebar --}}
          {{-- <div class="payment_info col-md-3">
            <div class="payment_item">
              <h3>Thông tin thanh toán</h3>
            </div>
            <br>
            <div class="payment_item">
              <p>Giỏ hàng: <span>VNĐ</span> <span data-total="{{$cart_total}}">{{ number_format($cart_total, 0, '.', '.');}}</span></p>
              <p>Giảm Giá: <span>VNĐ</span> <span > 0 VNđ</span> </p>

            </div>
            <div class="payment_item payment_total">
              <p>Tổng tiền <span>VNĐ</span ><span data-total="{{$cart_total}}">{{ number_format($cart_total, 0, '.', '.');}}</span></p>
            </div>
            @if(Auth::check())
            <a href="#" class="btn_pay">Tiến hành thanh toán</a>
            @else
            <a href="#" class="btn_pay">Đăng nhập để thanh toán</a>
            @endif
          </div> --}}
        </div>
      </div>
    </section>
    <!--================End Cart Area =================-->


  <script type="text/javascript">
    $(document).ready(function(){ 
      function format_currency(number){
          return number.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
      }
      let ship_select=$('#ship_select').find(':selected').attr('data-value');
      let ship_value =$('#ship_value').html()
      let cart_total=$('#cart-total-price').html()
      discount=$('#payment-discount').html()
      total=$('#order-total')
      totalInput=$('#order-total-input')
      $('#cart-total-price').html(format_currency($('#cart-total-price').html()))
      $('#ship_value').html(format_currency(ship_select))
      total.html(Number(ship_select)+ Number(cart_total) + Number(discount))
      totalInput.val(total.html())
      total.html(format_currency(total.html()))
      $('#ship_select').change(function( e){
        e.preventDefault();
        ship_select=$('#ship_select').find(':selected').attr('data-value');
        $('#ship_value').html(format_currency(ship_select))
        $('#ship_price').html(ship_select)
        total.html(Number(cart_total) + Number( ship_select))
        totalInput.val(total.html())
        total.html(format_currency(total.html()))
      })

      $('#userAddress').change(function(e){
         e.preventDefault();

         addressId=$('#userAddress').val();
         $.ajax({
          url: '{{route('getAddressById')}}',
          method: 'post',
          data:{
            _token: "{{ csrf_token() }}",
            id:addressId
          },
          success:function(data){
            $('#addressChange').val(data.address)
            $('#nameChange').val(data.name)
            $('#phoneChange').val(data.phone)

          }
         })
      })
    })



  </script>
@endsection