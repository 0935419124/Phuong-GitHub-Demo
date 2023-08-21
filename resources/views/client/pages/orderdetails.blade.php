@extends('client.master')
@section('title','Giỏ hàng')
@section('content')
@include('client/partials/_nav')

    <!--================Cart Area =================-->
    <section class="cart_area">
      <div class="container">
        <div class="row">
          <div class="cart_inner col-md-8">
           <div class="table-responsive">
            <table class="table cart-table">
              <thead>
                <tr>    
                  <th class="col-md-6" scope="col">Sản phẩm</th>
                  <th class="col-md-2" scope="col">Số lượng</th>
                  <th class="col-md-4" scope="col">Tổng tiền</th>
                </tr>
              </thead>
              <tbody>
                @if(isset($details) && count($details)>0)
                @foreach ($details as $detail)
                <tr>
                  <td>
                    <div class="media">
                      <div class="d-flex">
                        <img width="100px"
                          src="{{asset('images/products/'.$detail->Products->image)}}"
                          alt=""
                        />
                      </div>
                      <div class="media-body cart-pro-name">
                        <p>{{$detail->product_name}}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p>{{$detail->number}}</p>
                  </td>
                  <td>
                    <h5 class="cart-total">{{ number_format($detail->price, 0, '.', '.');}} VNĐ</h5>
                  </td>
                </tr>
                 @endforeach
                @else
                <tr>
                  <td colspan="5">
                    <p class="no_cart">Chưa có sản phẩm nào trong giỏ hàng</p>
                  </td>
                </tr>
                @endif
              </tbody>
            </table>
           </div>
          </div>
          
          {{-- Payment sidebar --}}
          <div class="payment_info info-order col-md-4">
            <div class="payment_item">
              <h3>Thông tin đơn hàng</h3>
            </div>
            <br>
            <div class="payment_item">
              <p>Mã ĐH: {{$order->id}}</p>
              <p>Người nhận: {{$order->UserAddress->name}}</p>
              <p>Địa chỉ: {{$order->UserAddress->address}}</p>
              <p>SĐT:  {{$order->UserAddress->phone}}</p>

            </div>
            <div class="payment_item">
              <p>Ngày tạo: {{$order->created_at}}</p>
              <p>PTGH: {{$order->Delivery->name}}</p>
              <p>Trạng thái:  @if ($order->status==0)
                  Đang xử lý
              @elseif($order->status==1)
                  Đã xác nhận
              @elseif($order->status==2)
                  Đang giao hàng
              @elseif($order->status==3)
                  Đã thanh toán
              @elseif($order->status==4)
                  Đã hủy
              @endif</p>
              <p>Ghi chú: {{$order->note}}</p>
            </div>
            <div class="payment_item payment_total">
              <p>Giao hàng: {{ number_format($order->Delivery->value, 0, '.', '.');}} VNĐ</p>
              <p>Giảm giá: {{ number_format($order->discount, 0, '.', '.');}} VNĐ</p>
              <p>Tổng tiền:  {{ number_format($order->total, 0, '.', '.');}} VNĐ</p>
            </div>
          </div>
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