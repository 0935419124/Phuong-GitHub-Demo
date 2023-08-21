@extends('admin.master')
@section('content')
<div class="content-wrapper">
<div class="table-agile-info">
  
  <div >
    <div class="wrapper">
        
        <div class="row">
            <div class="col col-6 form-details">
                <h1 class="form-h1">Shipping details</h1>
                <span></span>
                <div class="spacer"></div>
                @foreach($details as $detail)
                <form action="" method="POST" class="form" id="form-1">
                    <div class="form-group">
                        <label class="form-lable" for="">Name</label>
                        <input type="text"class="form-control" value="{{$order->user->name}}" readonly placeholder="" />
                    </div>
                    <div class="form-group">
                        <label class="form-lable" for="">Phone</label>
                        <input type="text"class="form-control" value="{{$order->phone}}" readonly placeholder="" />
                    </div>
                    <div class="form-group">
                        <label class="form-lable" for="">Email</label>
                        <input type="text"class="form-control" value="{{$order->user->email}}" readonly placeholder="" />
                    </div>
                    <div class="form-group">
                        <label class="form-lable" for="">Total</label>
                        <input type="text"class="form-control" value="{{$order->total}}" readonly placeholder="" />
                    </div>
                    <div class="form-group">
                        <label class="form-lable" for="">Address</label>
                        <input type="text"class="form-control" value="{{$order->address}}" readonly placeholder="" />
                    </div>
                    <div class="form-group">
                        <label class="form-lable" for="">Ghi chú</label>
                        <input type="text"class="form-control" value="{{$order->note}}" readonly placeholder="" />
                    </div>
                    <div class="form-group">
                        <label class="form-lable" for="">Status</label>
                        <input type="text"class="form-control" value="{{$order->status}}" readonly placeholder="" />
                    </div>
                    <button class="form-submit">Đăng ký</button>
                </form>
            </div>
            <div class="col col-6 form-details">
                <table  class="table">
                    <h1 class="form-h1">Oder details</h1>
                    <span></span>
                    <div class="spacer"></div>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$detail->product_name}}</td>
                            <td>{{$detail->number}}</td>
                            <td>{{$detail->price}}</td>
                            <td>
                                <div class="product_image">
                                    <img src="{{asset('images/products/')}}" alt="" style="width:100px; height:100px"></td>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="total">
                    <h2 class="total-text">Tổng:</h2>
                    <p>test</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection