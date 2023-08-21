@extends('client.master')
@section('title','Danh mục')
@section('content')

<section style="padding: 80px 0px;" class="cat_product_area section_gap">
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
                <select class="show">
                  <option value="1">Trình diễn 12</option>
                  <option value="2">Trình diễn 14</option>
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
              <div class="row">
                @foreach ($listPro as $pro)
                <div class="col-lg-4 col-md-6">
                  <div class="single-product">
                    <div class="product-img">
                      <img
                        class="card-img"
                        src="{{asset('images/products/'.$pro->image)}}"
                        alt=""
                      />
                      <div class="p_icon">
                        <a href="{{route('getProById',$pro->id)}}">
                          <i class="ti-eye"></i>
                        </a>
                        <a href="#">
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
                        <span class="mr-4">{{$pro->price-$pro->discount}} đ</span>
                        <del>{{$pro->price}} đ</del>
                      </div>
                    </div>
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
                  <h3>Duyệt qua danh mục</h3>
                </div>
                <div class="widgets_inner">
                  <ul class="list" id="cate">
                    @foreach ($allCate as $cate)
                    <li>
                      <a href="{{route('getProByCate',$cate->id)}}">{{$cate->name}}</a>
                    </li>
                    @endforeach
                    
                  </ul>
                </div>
              </aside>

              <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Thương hiệu sản phẩm</h3>
                </div>
                <div class="widgets_inner">
                  <ul class="list">
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
    <script type="text/javascript">
      $(document).ready(function(){
        
        $('#cate').click(function(){
          var id_cate=$(this).val();
          $.ajax({
            url: '{{route('loadCateItems')}}',
            method: 'POST',
            data:{
              _token: "{{ csrf_token() }}",
              id_cate:id_cate
            },
            success:function(data){
              $("select[name='cate_id'").html('');
                    $.each(data, function(key, value){
                        $("select[name='cate_id']").append(
                            "<option value=" + value.id + ">" + value.name + "</option>"
                        );
                    });
            }
          })
        });
      });
    </script>
@endsection