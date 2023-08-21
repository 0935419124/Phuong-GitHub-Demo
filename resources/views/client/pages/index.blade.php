@extends('client.master')
@section('title','TechStore')
@section('content')
<!--================Home Banner Area =================-->
<section id="slider"><!--slider-->
    <div id="demo" class="carousel slide container" data-ride="carousel">
        <ul class="carousel-indicators">
          <li data-target="#demo" data-slide-to="0" class="active"></li>
          <li data-target="#demo" data-slide-to="1"></li>
          <li data-target="#demo" data-slide-to="2"></li>
        </ul>
        <div class="carousel-inner">
            @foreach ($allslide as $key =>$slide)
          <div class="carousel-item {{ $key == 0 ? 'active':''}}">
            @if ($slide->image)
            <img src="{{asset('images/slider/'.$slide->image)}}" alt="slide1" width="110%" height="200px">
            @endif 
            <!-- <div class="carousel-caption">
                <a class="main_btn mt-40" href="#">Xem ngay</a>
            </div>    -->
          </div>
        @endforeach
        </div>
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>
      </div>
</section><!--/slider-->
<!--================End Home Banner Area =================-->

<!-- Start feature Area -->
<section class="feature-area section_gap_bottom_custom">
    <div class="container">
        <div class="row" style="margin-top: 25px">
            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title">
                        <i class="flaticon-money"></i>
                        <h3>Người nhận tiền hoàn lại</h3>
                    </a>
                    <p>Sẽ mở chia một</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title">
                        <i class="flaticon-truck"></i>
                        <h3>Giao hàng miễn phí</h3>
                    </a>
                    <p>Sẽ mở chia một</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title">
                        <i class="flaticon-support"></i>
                        <h3>Luôn hỗ trợ</h3>
                    </a>
                    <p>Sẽ mở chia một</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title">
                        <i class="flaticon-blockchain"></i>
                        <h3>Thanh toán an toàn</h3>
                    </a>
                    <p>Sẽ mở chia một</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End feature Area -->

<div class="container">
    <div class=" row quick-sales">
        <div class="col-lg-3 item-img">
            <img src="https://cdn.hoanghamobile.com/i/home/Uploads/2022/08/11/chuyen-trang-samssung-11.png" alt="">
        </div>
        <div class="col-lg-3 item-img">
            <img src="https://cdn.hoanghamobile.com/i/home/Uploads/2022/11/10/sanphamhot-14.jpg" alt="">
        </div>
        <div class="col-lg-3 item-img">
            <img src="https://cdn.hoanghamobile.com/i/home/Uploads/2022/11/01/sanphamhot-12-lite-1.jpg" alt="">
        </div>
        <div class="col-lg-3 item-img">
            <img src="https://cdn.hoanghamobile.com/i/home/Uploads/2022/10/04/huawei-d14-banner-nho-01.jpg" alt="">
        </div>
    </div>
</div>
<!--================ Feature Product Area =================-->
<section class="feature_product_area section_gap_bottom_custom">
    <div class="container">
        <div class="row justify-content-center list-pro">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>Sản phẩm nổi bật</span></h2>
                </div>
            </div>
        </div>
        <div class="row list-pro">
            @foreach($homeTopPr as $pro)
            <div class="col-lg-3 col-md-6">
                <div class="single-product">
                    <div class="product-img bg-white d-flex align-items-center" style="height: 290px;">
                        <img class="img-fluid w-100 p-4" src="{{asset('images/products/'.$pro->image)}}" alt="" />
                        <div class="p_icon">
                            <a href="#">
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
                        <a href="{{Route('getProById',$pro->id)}}" class="d-block">
                            <h4>{{$pro->name}}</h4>
                        </a>
                        <div class="mt-2">
                            <span class="mr-4"><h2>{{ number_format($pro->price - (($pro->price*$pro->discount)/100), 0, '.', '.');}} VND</h2></span>
                            @if($pro->discount > 0)
                                <del>{{ number_format($pro->price, 0, '.', '.')}} VND</del>
                            @endif
                        </div>
                    </div>
                    @if($pro->hot == 1)
                    <div class="product-top">
                        <span class="product-top--text">HOT</span>
                    </div>
                    @endif
                    @if($pro->discount != 0)
                    <div class="product-item">
                        <div class="product-item_sale">
                        <div>Giảm {{$pro->discount}}%</div>       
                    </div>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--================ End Feature Product Area =================-->

<!--================ Offer Area =================-->
{{-- <section class="offer_area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="offset-lg-4 col-lg-6 text-center">
                <div class="offer_content">
                    <h3 class="text-uppercase mb-40">Bộ sưu tập của tất cả nam giới</h3>
                    <h2 class="text-uppercase">50% off</h2>
                    <a href="#" class="main_btn mb-20 mt-5">Khám phá ngay</a>
                    <p>Ưu đãi trong thời gian có hạn</p>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!--================ End Offer Area =================-->

<!--================ New Product Area =================-->
<section class="new_product_area section_gap_top section_gap_bottom_custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>Sản phẩm mới</span></h2>
                </div>
            </div>
        </div>

        <div class="row list-pro">
            <div class="col-lg-6">
                <div class="new_product">
                    <h5 class="text-uppercase">{{ $homeNewPr[0]->Cate_items->name }}</h5>
                    <h3 class="text-uppercase">{{ $homeNewPr[0]->name }}</h3>
                    <div class="product-img">
                        <img class="img-fluid" src="{{asset('images/products/'.$homeNewPr[0]->image)}}" alt="" />
                    </div>
                    <h4>{{ $homeNewPr[0]->price }} VNĐ</h4>
                    <a href="{{Route('getProById',$homeNewPr[0])}}" class="main_btn">Xem chi tiết</a>
                </div>
            </div>
         
            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="row ">
                    @for($i=1;$i<count($homeNewPr);$i++)
                    <div class="col-lg-6 col-md-6">
                        <div class="single-product">
                            <div class="product-img bg-white d-flex align-items-center" style="height: 290px;">
                                <img class="img-fluid w-100 p-4" src="{{asset('images/products/'.$homeNewPr[$i]->image)}}" alt="" />
                                <div class="p_icon">
                                    <a href="#">
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
                                <a href="{{Route('getProById',$homeNewPr[$i])}}" class="d-block">
                                    <h4>{{$homeNewPr[$i]->name}}</h4>
                                </a>
                                <div class="mt-2">
                                    <span class="mr-4"><h2>{{number_format($homeNewPr[$i]->price - (($homeNewPr[$i]->price*$homeNewPr[$i]->discount)/100), 0, '.', '.')}} VND</h2></span>
                                    @if($homeNewPr[$i]->discount > 0)
                                        <del>{{number_format($homeNewPr[$i]->price, 0, '.', '.')}} VND</del>
                                    @endif
                                </div>
                            </div>
                            @if($homeNewPr[$i]->discount != 0)
                            <div class="product-item">
                                <div class="product-item_sale">
                                <div>Giảm {{$homeNewPr[$i]->discount}}%</div>
                                </div>
                            </div>
                            @endif

                            @if($homeNewPr[$i]->hot == 1)
                            <div class="product-top">
                                <span class="product-top--text">HOT</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End New Product Area =================-->

<!--================ Inspired Product Area =================-->
<section class="inspired_product_area section_gap_bottom_custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>Sản phẩm khuyến mãi</span></h2>
                </div>
            </div>
        </div>

        <div class="row list-pro">
            @foreach($homeSalePr as $pro)
            <div class="col-lg-3 col-md-6">
                <div class="single-product">
                    <div class="product-img bg-white d-flex align-items-center" style="height: 290px;">
                        <img class="img-fluid w-100 p-4" src="{{asset('images/products/'.$pro->image)}}" alt="" />
                        <div class="p_icon">
                            <a href="#">
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
                        <a href="{{Route('getProById',$pro->id)}}" class="d-block">
                            <h4>{{$pro->name}}</h4>
                        </a>
                        <div class="mt-2">
                            <span class="mr-4"><h2>{{ number_format($pro->price - (($pro->price*$pro->discount)/100), 0, '.', '.');}} VND</h2></span>
                            @if($pro->discount > 0)
                                <del>{{ number_format($pro->price, 0, '.', '.')}} VND</del>
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
</section>
<!--================ End Inspired Product Area =================-->

<!--================ Start Blog Area =================-->
<section class="blog-area section-gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>blog mới nhất</span></h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-blog">
                    <div class="thumb">
                        <img class="img-fluid" src="../img/b1.jpg" alt="">
                    </div>
                    <div class="short_details">
                        <div class="meta-top d-flex">
                            <a href="#">Bởi quản trị viên</a>
                            <a href="#"><i class="ti-comments-smiley"></i>2 Bình luận</a>
                        </div>
                        <a class="d-block" href="single-blog.html">
                            <h4>Chiếc giường thông minh của Ford ngăn đối tác ngủ của bạn làm vướng bận toàn bộ</h4>
                        </a>
                        <div class="text-wrap">
                            <p>
                                Hãy để một phần năm tôi mang bay đến mặt chia để mang chia cho hạt giống có cánh chia rẽ ánh sáng Forth.
                            </p>
                        </div>
                        <a href="#" class="blog_btn">Tìm hiểu thêm <span class="ml-2 ti-arrow-right"></span></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-blog">
                    <div class="thumb">
                        <img class="img-fluid" src="../mg/b2.jpg" alt="">
                    </div>
                    <div class="short_details">
                        <div class="meta-top d-flex">
                            <a href="#">Bởi quản trị viên</a>
                            <a href="#"><i class="ti-comments-smiley"></i>2 Bình luận</a>
                        </div>
                        <a class="d-block" href="single-blog.html">
                            <h4>Chiếc giường thông minh của Ford ngăn đối tác ngủ của bạn làm vướng bận toàn bộ</h4>
                        </a>
                        <div class="text-wrap">
                            <p>
                                Hãy để một phần năm tôi mang bay đến mặt chia để mang chia cho hạt giống có cánh chia rẽ ánh sáng Forth.
                            </p>
                        </div>
                        <a href="#" class="blog_btn">Tìm hiểu thêm <span class="ml-2 ti-arrow-right"></span></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-blog">
                    <div class="thumb">
                        <img class="img-fluid" src="../img/b3.jpg" alt="">
                    </div>
                    <div class="short_details">
                        <div class="meta-top d-flex">
                            <a href="#">Bởi quản trị viên</a>
                            <a href="#"><i class="ti-comments-smiley"></i>2 Bình luận</a>
                        </div>
                        <a class="d-block" href="single-blog.html">
                            <h4>Chiếc giường thông minh của Ford ngăn đối tác ngủ của bạn làm vướng bận toàn bộ</h4>
                        </a>
                        <div class="text-wrap">
                            <p>
                                Hãy để một phần năm tôi mang bay đến mặt chia để mang chia cho hạt giống có cánh chia rẽ ánh sáng Forth.
                            </p>
                        </div>
                        <a href="#" class="blog_btn">Tìm hiểu thêm <span class="ml-2 ti-arrow-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Blog Area =================-->

@endsection