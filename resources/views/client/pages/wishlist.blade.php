@extends('client.master')
@section('title','Danh mục')
@section('content')
<section class="banner_area">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content d-md-flex justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
          <h2>Danh sách yêu thích</h2>
          <p>Sản phẩm yêu thích</p>
        </div>
        <div class="page_link">
          <a href="index.html">Home</a>
          <a href="#">Danh sách yêu thích</a>
          <a href="category.html"></a>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="cart_area">
  <div class="container">
    <div class="row">
      <div class="cart_inner col-md-11">
       <div class="table-responsive">
        <table class="table cart-table">
          <thead>
            <tr>
              <th class="col-md-5" scope="col">Sản phẩm</th>
              <th class="col-md-2" scope="col">Giá</th>
              <th class="col-md-1" scope="col">Hành động</th>
              <th class="col-md-1" scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($wishlist as $item)
            <tr>
              <td>
                <div class="media">
                  <div class="d-flex">
                    <img width="100px"
                      src="{{asset('/images/products/'.$item->products->image)}}"
                      alt=""
                    />
                  </div>
                  <div class="media-body cart-pro-name">
                    <a href="{{route('getProById',$item->products->id)}}"><p>{{$item->products->name}}</p></a>
                  </div>
                </div>
              </td>
              <td>
                <h5>{{$item->products->price}} VNĐ</h5>
              </td>
              <td>
                <a href="{{route('deleteWish',$item->id)}}" class="genric-btn danger-border radius delete-cart"><i class="fa fa-trash" aria-hidden="true"></i></a>
              </td>
              <td>
                <a href="{{route('getProById',$item->products->id)}}" class="main_btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
              </td>
            </tr>
             @endforeach
             @if($wishlist->count() > 0)
             @else
             <tr>
               <td colspan="5">
                 <p class="no_cart">Chưa có sản phẩm nào trong Wishlist</p>
               </td>
               <td>
                <button class="btn btn-success">Xem sản phẩm ngay</button>
              </td>
             </tr>
             @endif
            </tr>
          </tbody>
        </table>
       </div>
      </div>
</section>
      <script src="{{ URL::asset('js/jquery-3.2.1.min.js')}}"></script>
@endsection