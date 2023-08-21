@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Sửa Slide</h4>
            <p class="card-description">
            
            </p>
            <form method="POST" action="{{Route('editSlide')}}" enctype="multipart/form-data" class="forms-sample">
              @csrf
              <input type="hidden" name="id" value="{{$slide->id}}" id="">
              <input type="hidden" name="image1" value="{{$slide->image}}" id="">
              <div class="form-group">
                <label for="exampleInputName1">Tên Slide</label>
                <input type="text" name="name" value="{{$slide->name}}" class="form-control" id="exampleInputName1" placeholder="Nhập tên Slide">
              </div>

              <div class="form-group">
                <label>Hình Ảnh</label>
                <input type="file" name="file_upload" class="form-control">
              </div>
              <div class="col-sm-6">
                <img src="{{asset('images/slider/'.$slide->image)}}" width="30%" alt="Không có ảnh">
              </div>
              
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleSelectGender">Mô tả Slider</label>
                      <textarea style="resize: none" rows="8" class="form-control" name="slide_desc" id="
                      exampleInputPassword1" placeholder="Mô tả danh mục">{{$slide->slide_desc}}</textarea>
                  </div>
                </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Trạng Thái</label>
                  <select name="slide_status" class="form-control input-sm m-bot-15">
                    @if ($slide->slide_status==0)
                      <option selected value="0">Ẩn</option>
                      <option value="1">HIển thị</option>
                    @else
                      <option value="0">Ẩn</option>
                      <option selected value="1">HIển thị</option>
                    @endif
                    
                  </select>
                </div>
              <div>
         </div>
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <button type="button" class="btn btn-light">Cancel</button>    
          </div>
        </div>
      </div>
    </div>
</div>

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