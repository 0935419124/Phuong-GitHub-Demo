@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Danh sách sản phẩm</p>
            <a class="card-title badge badge-info rounded" href="{{route('loadCreatePro')}}">Thêm mới</a><br>

            <div class="col-md-3" style="float: left;">
              <form class="card-title" action="{{route('search6')}}" method="GET">
                @csrf
                <div class="form-group">
                  <select class="form-control show-cti form-select list"  name="keywords_pro_name" id="name" onchange="this.form.submit()">
                    <option>Lọc theo tên</option>
                    <option value="">Tất cả sản phẩm</option>
                      @foreach($allPro1 as $pro)
                        <option data-id="{{$pro->name}}" value="{{$pro->name}}">{{$pro->name}}<option> 
                      @endforeach
                  </select>
                </div>
              </form>
            </div>

            <div class="col-md-3" style="float: left">
              <form class="card-title" action="{{route('search5')}}" method="GET">
                @csrf
                <div class="form-group">
                  <select class="form-control show-cti form-select list"  name="keywords_cate_id" id="cate" onchange="this.form.submit()">
                    <option>Lọc theo loại</option>
                    <option value="">Tất cả sản phẩm</option>
                      @foreach($allCate as $cate)
                        <option data-id="{{$cate->id}}" value="{{$cate->id}}">{{$cate->name}}<option>
                      @endforeach
                  </select>
                </div>
              </form>
            </div>

            <div class="col-md-3" style="float: left;">
              <form class="card-title" action="{{route('search7')}}" method="GET">
                @csrf
                <div class="form-group">
                  <select class="form-control show-cti form-select list"  name="keywords_price" id="price" onchange="this.form.submit()">
                    <option>Lọc theo khoảng giá</option>
                    <option value="0">Tất cả sản phẩm</option>
                    <option value="1">Dưới 1tr</option>
                    <option value="2">Từ 1tr đến 2tr</option>
                    <option value="3">Từ 2tr đến 4tr</option>
                    <option value="4">Từ 4tr đến 7tr</option>
                    <option value="5">Từ 7tr đến 10tr</option>
                    <option value="6">Từ 10tr đến 15tr</option>
                    <option value="7">Từ 15tr đến 20tr</option>
                    <option value="8">Trên 20tr</option>
                  </select>
                </div>
              </form>
            </div>
            
            <div class="row" style=" clear: both; color: red; margin-left: 1%;">
              <h5>
                <?php
                  if(isset($mess)){
                    echo $mess;
                  }
                ?>
              </h5>
            </div>

            <div class="table-responsive">
              <table id="recent-purchases-listing" class="table table-hover">
                <thead>
                  <tr>
                      <th>Id</th>
                      <th>Loại</th>
                      <th>Tên</th>
                      <th>Hình</th>
                      <th>Giá</th>
                      <th>Ngày đăng</th>
                      <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($allPro as $pro)
                  <tr>
                    <td>{{$pro->id}}</td>
                    <td>{{$pro->Cate_items->name}}</td>
                    <td>{{$pro->name}}</td>
                    <td><img src="{{asset('images/products/'.$pro->image)}}" alt="" style="width:90px; height: auto !important;"></td>
                    <td>{{ number_format($pro->price, 0, '.', '.');}} VND</td>
                    <td>{{$pro->created_at}}</td>
                    <td>
                    <a class="badge badge-info rounded" href="{{route('showVariants',$pro->id)}}">Biến thể</a>
                    <a class="badge badge-info rounded" href="{{route('loadEditPro',$pro->id)}}"><i class="mdi mdi-wrench"></i></a>
                    <a class="badge badge-danger rounded" onclick="return confirm('Xóa mục này?')" href="{{route('deletePro',$pro->id)}}"><i class="mdi mdi-delete"></i></a></td>
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
  @endsection