@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Danh sách Slider</p>
            <div class="table-responsive">
              <a class="card-title badge badge-info rounded" href="{{route('createSlide')}}">Thêm mới</a>
              <table id="recent-purchases-listing" class="table table-hover">
                <thead>
                  <tr>
                      <th>Id</th>
                      <th>Tên</th>
                      <th>Hình ảnh</th>
                      <th>Mô tả</th>
                      <th>Trạng thái</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($allslide as $slide)
                  <tr>
                    <td>{{$slide->id}}</td>
                    <td>{{$slide->name}}</td>
                    <td><img src="{{asset('images/slider/'.$slide->image)}}" alt="" style="width:150px; height: 70px; border-radius: 5px;"></td>
                    <td>{{$slide->slide_desc}}</td>
                    <td><span class="text-ellipsis">
                      <?php
                       if($slide->slide_status==1){
                        ?>
                        <a href="{{route('off', $slide->id)}}"><button type="button" class="btn btn-success">Đang Bật</button></a>
                        <?php
                         }else{
                        ?>  
                         <a href="{{route('on', $slide->id)}}"><button type="button" class="btn btn-danger">Đang Tắt</button></a>
                        <?php
                       }
                      ?>
                    </span></td>
                    <td><a class="badge badge-info rounded" href="{{route('loadEditSlide',$slide->id)}}"><i class="mdi mdi-wrench"></i></a>
                    <a class="badge badge-danger rounded" onclick="return confirm('Xóa mục này?')" href="{{route('deleteSlide',$slide->id)}}"><i class="mdi mdi-delete"></i></a></td>
                  
                  <tr>
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