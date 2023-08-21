@extends('client.master')
@section('title','Danh mục')
@section('content')
@include('client/partials/_nav')
<section class="cat_product_area section_gap">
      <div class="container">
        <div class="row flex-row-reverse">
          <div class="col-lg-9">
            <div class="product_top_bar">
              <div class="left_dorp">
                <select class="sorting">
                  <option value="1">Mặc định phân loại</option>
                  <option value="2">Mặc định phân loại 01</option>
                  <option value="4">Mặc định phân loại 02</option>
                </select>
                
                  <select class="show ">
                    <option value="1">Trình diễn 12</option>
                    <option value="2">Trình diễn 14</option>
                    <option value="4">Trình diễn 16</option>
                    <option value="4">Trình diễn 16</option>
                    <option value="4">Trình diễn 16</option>
                    <option value="4">Trình diễn 16</option>
                    <option value="4">Trình diễn 16</option>
                    <option value="4">Trình diễn 16</option>
                    <option value="4">Trình diễn 16</option>
                    <option value="4">Trình diễn 16</option>
                  </select>
               
                @if (isset($MesSearch))
                <div style="float: left; clear: both; padding: 6% 0% 1% 3%; margin: -3%;">
                    <h4 style="font-size: 130%;">{{$MesSearch}}</h4>
                </div>
                @endif
              </div>
            </div>
            
            <div class="latest_product_inner">
              <div class="row list-pro">
                @foreach ($listPro as $pro)
                <div class="col-lg-4 col-md-6">
                  <div class="single-product" >
                    <div class="product-img bg-white d-flex align-items-center" >
                      <img
                        class="card-img p-4"
                        src="{{asset('images/products/'.$pro->image)}}"
                        alt=""
                      />
                      <div class="p_icon">
                        <a href="{{route('getProById',$pro->id)}}">
                          <i class="ti-eye"></i>
                        </a>
                        <a href="{{route('addWish',$pro->id)}}">
                          <i class="ti-heart"></i>
                        </a>
                        <a href="#">
                          <i class="ti-shopping-cart"></i>
                        </a>
                      </div>
                    </div>
                    <div class="product-btm">
                      <a href="{{route('getProById',$pro->id)}}" class="d-block">
                        <h4>{{$pro->name}}</h4>
                      </a>
                      <div class="mt-3">
                        <span class="mr-4">{{number_format($pro->price - (($pro->price*$pro->discount)/100), 0, '.', '.')}} đ</span>
                        @if($pro->discount > 0)
                          <del>{{ number_format($pro->price, 0, '.', '.')}} đ</del>
                        @endif
                      </div>
                    </div>
                    @if($pro->discount != 0)
                    <div class="product-item">
                        <div class="product-item_sale">
                            <div>Giảm {{$pro->discount}}%</div>
                        </div>
                    </div>
                    @endif 
                    @if($pro->hot == 1)
                    <div class="product-top">
                        <span class="product-top--text">HOT</span>
                    </div>
                    @endif
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="left_sidebar_area">
              <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Danh mục</h3>
                </div>
                <div class="widgets_inner">
                  <form action="" method="post">
                  <ul class="list" id="cate">
                    @foreach ($allCate as $cate)
                    <li class="categories" data-cateid="{{$cate->id}}">
                      <a class="">{{$cate->name}}</a>
                    </li>
                    @endforeach
                    
                  </ul>
                </form>
                </div>
              </aside>

              <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Thương hiệu sản phẩm</h3>
                </div>
                <div class="widgets_inner">
                  <ul class="list" id="cate_items">
                    @foreach ($cti_bar as $item)
                    <li>
                      <a href="{{route('getProByCateItem',$item->id)}}">{{$item->name}}</a>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </aside>

              <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Bộ lọc giá</h3>
                </div>
                <div class="widgets_inner">
                  <div class="range_item">
                    <div id="slider-range"></div>
                    <div class="">
                      <label for="amount">Gía : </label>
                      <input type="text" id="amount" readonly />
                    </div>
                  </div>
                </div>
              </aside>
            </div>
          </div>
        </div>
      </div>
    </section>
      <script src="{{ URL::asset('js/jquery-3.2.1.min.js')}}"></script>
     <script type="text/javascript">
      $(document).ready(function(){
        
        $('.categories').click(function(){
          var id_cate=$(this).data('cateid');
          $.ajax({
            url: '{{route('getCateItemByCate')}}',
            method: 'post',
            data:{
              _token: "{{ csrf_token() }}",
              id_cate:id_cate
            },
            success:function(data){
              $("#cate_items").html('');
                    $.each(data, function(key, value){
                        $("#cate_items").append(
                          "<li><a >" +value.name +"</a></li>"
                        );
                    });
            }
          })
        });
      });
    </script> 
@endsection