@extends('client.master')
@section('title','Giỏ hàng')
@section('content')
@include('client/partials/_nav')
@php
  $cart_total=0;
  if (Session::has('coupon')){
    $disc=Session::get('coupon');
  }
@endphp

    <!--================Cart Area =================-->
    <section class="cart_area">
      <div class="container">
        <div class="row">
          <div class="cart_inner col-md-9">
           <div class="table-responsive">
            <table class="table cart-table">
              <thead>
                <tr>    
                  <th class="col-md-5" scope="col">Sản phẩm</th>
                  <th class="col-md-2" scope="col">Giá</th>
                  <th class="col-md-2" scope="col">Số lượng</th>
                  <th class="col-md-2" scope="col">Tổng cộng</th>
                  <th class="col-md-1" scope="col"></th>
                </tr>
              </thead>
              <tbody>

                @if(isset($allProCart) && count($allProCart)>0)
                @foreach ($allProCart as $pro)
                  @php
                      $cart_total+=$pro['total']
                  @endphp
                <tr>
                  <td>
                    <div class="media">
                      <div class="d-flex">
                        <img width="100px"
                          src="{{asset('images/products/'.$pro['image'])}}"
                          alt=""
                        />
                      </div>
                      <div class="media-body cart-pro-name">
                        <p>{{$pro['name']}}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <h5>{{ number_format($pro['price'], 0, '.', '.');}} VNĐ</h5>
                  </td>
                  <td>
                      <input
                        type="number"
                        name="qty"
                        maxlength="12"
                        value={{$pro['qty']}}
                        data-proName="{{$pro['name']}}"
                        title="Quantity:"
                        class="qty"
                        style="width: 40px;"
                        min="1"
                      />
                  </td>
                  <td>
                    <h5 class="cart-total">{{ number_format($pro['total'], 0, '.', '.');}} VNĐ</h5>
                  </td>
                  <td>
                    <a href="{{route('deleteItemCart',$pro['name'])}}" class="genric-btn danger-border radius delete-cart"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                <tr class="bottom_button">
                  <td colspan="2">
                    <a class="gray_btn" href="#">Cập nhật giỏ hàng</a>
                  </td>

                  <td colspan="3">
                    <div class="cupon_text">
                      <form action="{{route('discountCode')}}" method="post">
                        @csrf
                        
                        <input type="text" 
                            @if (isset($disc[0]))
                            value="{{$disc[0]['code']}}"
                            @endif  name="discountCode" placeholder="Mã giảm giá" />
                        <button type="submit" class="main_btn apply_btn">Áp dụng</button>
                      </form>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>          
           </div>

           {{-- Payment --}}
           @if (Auth::check() && $allProCart)
           <div class="payment">
            <form action="{{route('insertOrder')}}" method="post">
              @csrf
              <div class="patment-title">
              <h2>Tiến hành thanh toán</h2>
            </div>
              <div class="row">
                <div class="col-6">
                  <div class="mt-10">
                    <label for="">Khách hàng</label>
                    <input type="text" name="name" disabled value="{{Auth::user()->name}}" class="single-input">
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    @if (isset($disc[0]))
                      <input type="hidden" name="discount" value="{{$disc[0]['discount']}}">
                    @endif
                  </div>
                  <div class="mt-5">
                    <label for="">Chọn địa chỉ giao hàng</label>
                    <div class="input-group-icon">
                    <div class="icon">
                      <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                    </div>
                    <div class="form-select" id="default-select">
                      @if (isset($userAddress))
                      <select id="userAddress" name="user_address" style="display: none;">
                          @foreach ($userAddress as $address)
                          <option value="{{$address->id}}">{{$address->address}},{{$address->name}},{{$address->phone}}</option>
                          @endforeach
                      </select>
                      @else
                      <input type="text" name="name" disabled value="Vui lòng thêm địa chỉ giao hàng" class="single-input">
                      @endif
                    </div>
                  </div>
                  </div>
                  <div class="mt-5">
                    <label for="">Loại hình giao hàng</label>
                    <div class="input-group-icon">
                    <div class="icon">
                      <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                    </div>
                    <div class="form-select" id="default-select">
                      <select id="ship_select" name="deli_id" style="display: none;">
                        @foreach ($delivery as $deli)
                          <option data-value="{{$deli->value}}" value="{{$deli->id}}">{{$deli->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6">
                @if (isset($userAddress))
                  <div class="mt-10">
                    <label for="">Địa chỉ nhận hàng</label>
                    <input type="text" id="addressChange" name="address" disabled value="{{$userAddress[0]->address}}" class="single-input">
                  </div>
                  <div class="mt-5">
                    <label for="">Tên người nhận</label>
                    <input type="text" id="nameChange" disabled value="{{$userAddress[0]->name}}"  class="single-input" placeholder="Vui lòng thêm địa chỉ giao hàng">
                  </div>
                  <div class="mt-5">
                    <label for="">Số điện thoại</label>
                    <input type="text" id="phoneChange" disabled value="0{{$userAddress[0]->phone}}"  class="single-input" placeholder="Vui lòng thêm địa chỉ giao hàng">                </div>
                  <div class="mt-5">
                    <label for="">Ghi chú</label>
                    <textarea class="single-textarea" name="note" placeholder="Nhập ghi chú ở đây" ></textarea>
                  </div>
                @endif
              </div>
              </div>
              <div class="row payment-money mt-10">
                <div class="col-3">
                  <div class="element">
                    <h3>Giỏ hàng <i class="fa fa-cart-plus" aria-hidden="true"></i> </h3>
                    <p><span id="cart-total-price">{{$cart_total}}</span> <span>Đ</span></p>
                  </div>
                </div>
                <div class="col-3">
                  <div class="element">
                    <h3>Giao hàng: <i class="fa fa-truck" aria-hidden="true"></i></h3>
                      <p><span id="ship_value"></span><span> Đ</span></p>
                  </div>
                </div>
                <div class="col-3">
                  <div class="element">
                    <h3>Giảm giá: <i class="fa fa-download" aria-hidden="true"></i></h3>
                    <p><span id="payment-discount"> @if (isset($disc[0]))
                            {{$disc[0]['discount']}}
                            @endif</span><span> Đ</span></p>
                  </div>
                </div>
                <div class="col-3">
                  <div class="element">
                    <h3 class="element-total">Tổng tiền: <i class="fa fa-credit-card" aria-hidden="true"></i></h3>
                    <p class="odr-total"><span id="order-total"></span><span> Đ</span></p>
                    <input type="hidden" name="total" id="order-total-input">
                  </div>
                </div>
                <div class="row mt-10">
                  <p data-toggle="modal" data-target="#exampleModal" class="genric-btn primary confirm">Xác nhận thanh toán</p> 
                </div>
                <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title" id="exampleModalLabel">Xác nhận</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Bạn chắc chắn thanh toán đơn hàng này
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                      <button type="submit" class="btn btn-success">Xác nhận</button>
                    </div>
                  </div>
                </div>
              </div>

              </div>
            </div>
           </form>
           @endif
          </div>
          
          {{-- Payment sidebar --}}
          <div class="payment_info col-md-3">
            <div class="payment_item">
              <h3>Thông tin thanh toán</h3>
            </div>
            <br>
            <div class="payment_item">
              <p>Giỏ hàng: <span>VNĐ</span> <span data-total="{{$cart_total}}">{{ number_format($cart_total, 0, '.', '.');}}</span></p>
              <p>Giảm Giá: <span>VNĐ</span> <span > @if (isset($disc[0])) {{number_format($disc[0]['discount'], 0, '.', '.')}} @endif</span> </p>

            </div>
            <div class="payment_item payment_total">
              @if (isset($disc[0])) 
              <p>Tổng tiền <span>VNĐ</span ><span data-total="{{$cart_total}}">{{ number_format($cart_total - $disc[0]['discount'], 0, '.', '.');}}</span></p>
              @else
              <p>Tổng tiền <span>VNĐ</span ><span data-total="{{$cart_total}}">{{ number_format($cart_total, 0, '.', '.');}}</span></p>
              @endif
            </div>
            @if(Auth::check())
            <a href="#" class="btn_pay">Tiến hành thanh toán</a>
            @else
            <a href="#" class="btn_pay">Đăng nhập để thanh toán</a>
            @endif
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
      $('#payment-discount').html(format_currency($('#payment-discount').html()))
      total=$('#order-total')
      totalInput=$('#order-total-input')
      $('#cart-total-price').html(format_currency($('#cart-total-price').html()))
      $('#ship_value').html(format_currency(ship_select))
      total.html(Number(ship_select)+ Number(cart_total) - Number(discount))
      totalInput.val(total.html())
      total.html(format_currency(total.html()))
      $('#ship_select').change(function( e){
        e.preventDefault();
        ship_select=$('#ship_select').find(':selected').attr('data-value');
        $('#ship_value').html(format_currency(ship_select))
        $('#ship_price').html(ship_select)
        total.html(Number(cart_total) + Number( ship_select) - Number(discount))
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

      $('.qty').change(function(e){
        e.preventDefault();
          var qty=$(this).val();
          var proName=$(this).attr('data-proName');
          // alert(proName);
          $.ajax({
            url: '{{route('updateCart')}}',
            method: 'POST',
            data:{
             _token: "{{ csrf_token() }}",
              qty: qty
              // proName: proName
            },
            success: function(data){
              alert('ok')
            }
          })
      })
    })



  </script>
@endsection