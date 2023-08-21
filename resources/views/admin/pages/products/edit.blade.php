@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Sửa Sản Phẩm</h4>
            <p class="card-description">
              Nhập thông tin
            </p>
            <form method="POST" action="{{route('editPro')}}" enctype="multipart/form-data" id="form-edit-product" class="forms-sample">
              @csrf
              <input type="hidden" name="id" value="{{$pro->id}}" id="">
              <input type="hidden" name="image1" value="{{$pro->image}}" id="">
              <div class="form-group">
                <label for="exampleInputName1">Tên Sản Phẩm</label>
                <input type="text" name="name" value="{{$pro->name}}" class="form-control fullname" id="exampleInputName1" placeholder="Nhập tên sản phẩm">
                <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleSelectGender">Danh Mục</label>
                      <select class="form-control show-cti list" name="categories" id="cate">
                        @foreach ($allCate as $cate)
                            @if ($cate->id==$pro->Cate_items->Categories->id)
                              <option data-id="{{$cate->id}}" selected value="{{$cate->id}}">{{$cate->name}}</option>
                            @else
                              <option data-id="{{$cate->id}}" value="{{$cate->id}}">{{$cate->name}}</option>
                            @endif
                        @endforeach
                      </select>
                      <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleSelectGender">Hãng</label>
                    <select class="form-control show-cti firm" name="cate_id">
                      @foreach ($allCateItems as $cti)
                            @if ($cti->id==$pro->Cate_items->id)
                              <option selected value="{{$cti->id}}">{{$cti->name}}</option>
                            @else
                              <option value="{{$cti->id}}">{{$cti->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputName1">Giá</label>
                    <input type="number" value="{{$pro->price}}" name="price" class="form-control price" id="exampleInputName1" placeholder="Nhập Giá Sản Phẩm">
                    <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputName1">Giảm Giá</label>
                    <input type="number" value="{{$pro->discount}}" name="discount" class="form-control discount" id="exampleInputName1" placeholder="Nhập % Giảm giá">
                    <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleSelectGender">Ngày Đăng</label>
                    <input type="date" value="{{$pro->created_at}}" name="date" class="form-control date" id="exampleInputEmail3" placeholder="Nhập ngày đăng">
                    <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputName1">Số lượng</label>
                    <input type="number" value="{{$pro->quantity}}" name="quantity" class="form-control amount" id="exampleInputName1" placeholder="Nhập số lượng">
                    <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleSelectGender">Hot</label>
                      <select class="form-control" name="hot" id="exampleSelectGender">
                        @if ($pro->hot==0)
                          <option value="0" selected>Bình Thường</option>
                          <option value="1">Hot</option>
                        @else
                          <option value="0" >Bình Thường</option>
                          <option value="1" selected>Hot</option>
                        @endif
                        
                      </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleSelectGender">Trạng thái</label>
                      <select class="form-control status" name="status" id="exampleSelectGender">
                        @if ($pro->status==0)
                          <option value="0" selected>Hiển thị</option>
                          <option value="1">Ẩn</option>
                        @else
                          <option value="0" >Hiển thị</option>
                          <option value="1" selected>Ẩn</option>
                        @endif
                      </select>
                    <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Hình Ảnh</label>
                    <input type="file" name="file_upload" class="form-control ">
                  </div>
                </div>
                <div class="col-sm-6">
                  <img src="{{asset('images/products/'.$pro->image)}}" width="30%" alt="ko cos anh">
                </div>
              </div>
          
              <div class="form-group">
                <label for="exampleInputEmail3">Mô tả sản phẩm</label>
                <textarea class="form-control describe" name="detail" id="exampleTextarea1" cols="10" rows="25">{{$pro->detail}}</textarea>
                <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
              </div>    
              
              <div class="form-group">
                 @if (isset($pro_details))
                <p>
                  <a class="btn btn-primary col-sm-3" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" style="margin-right: 1%">Sửa chi tiết sản phẩm</a>
                </p>
                @else 
                  <p>
                  <a class="btn btn-primary col-sm-3" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" style="margin-right: 1%">Thêm chi tiết sản phẩm</a>
                </p>
                @endif
                <!-- Thêm biến thể-->
                @if (isset($pro_details))
                <div class="row">
                  <div class="col">
                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                      <br>
                      <h4 class="card-title">
                      <a class="col-sm-3" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" style="margin-right: 1%">Sửa chi tiết sản phẩm</a>
                      <hr></h4>
                      <div class="card card-body">

                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleSelectGender">CPU</label>
                              <input type="text" name="cpu" value="{{$pro_details->cpu}}" class="form-control cpu" id="exampleInputName1" placeholder="Nhập CPU">                         
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleSelectGender">Hệ điều hành</label>
                              <input type="text" name="os" value="{{$pro_details->os}}" class="form-control os" id="exampleInputName1" placeholder="Nhập hệ điều hành">                         
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleInputName1">Bộ nhớ</label>
                              <input type="number" name="memory" value="{{$pro_details->memory}}" class="form-control amount" id="exampleInputName1" placeholder="Nhập dung lượng bộ nhớ(GB)">
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleSelectGender">Dung ram</label>
                              <input type="number" name="ram" value="{{$pro_details->ram}}" class="form-control ram" id="exampleInputName1" placeholder="Nhập dung lượng ram(GB)">                         
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleSelectGender">Màn hình</label>
                              <input type="text" name="display" value="{{$pro_details->display}}" class="form-control display" id="exampleInputName1" placeholder="Nhập thông số màn hình">                         
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleSelectGender">Dung lượng pin</label>
                              <input type="number" name="batery" value="{{$pro_details->batery}}" class="form-control batery" id="exampleInputName1" placeholder="Nhập dung lượng pin">                         
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>
                        </div>

                        <div class="row">

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleSelectGender">Camera chính</label>
                              <input type="text" name="camera" value="{{$pro_details->camera}}" class="form-control camera" id="exampleInputName1" placeholder="Nhập độ phân giải cammera chính(MP)">                         
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleSelectGender">Camera phụ</label>
                              <input type="number" name="sub_camera" value="{{$pro_details->sub_camera}}" class="form-control sub_camera" id="exampleInputName1" placeholder="Nhập độ phân giải cammera phụ(MP)">                         
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="exampleSelectGender">Chiều dài</label>
                              <input type="text" name="width" class="form-control" value="{{$pro_details->width}}" id="exampleInputName1" placeholder="Nhập chiều dài(mm)">                         
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="exampleInputName1">Chiều rộng</label>
                              <input type="number" name="hight" class="form-control " value="{{$pro_details->hight}}" id="exampleInputName1" placeholder="Nhập chiều rộng(mm)">
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="exampleInputName1">Cân nặng</label>
                              <input type="number" name="weight" class="form-control" value="{{$pro_details->weight}}" id="exampleInputName1" placeholder="Nhập cân nặng(gam)">
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="exampleInputName1">Độ dày</label>
                              <input type="number" name="depth" class="form-control" value="{{$pro_details->depth}}" id="exampleInputName1" placeholder="Nhập độ dày(mm)">
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @else
                <div class="row">
                  <div class="col">
                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                      <br>
                      <h4 class="card-title">
                      <a class="col-sm-3" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" style="margin-right: 1%">Thêm chi tiết sản phẩm</a>
                      <hr></h4>
                      <div class="card card-body">

                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleSelectGender">CPU</label>
                              <input type="text" name="cpu" class="form-control cpu" id="exampleInputName1" placeholder="Nhập CPU">                         
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleSelectGender">Hệ điều hành</label>
                              <input type="text" name="os" class="form-control os" id="exampleInputName1" placeholder="Nhập hệ điều hành">                         
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleInputName1">Bộ nhớ</label>
                              <input type="number" name="memory" class="form-control amount" id="exampleInputName1" placeholder="Nhập dung lượng bộ nhớ(GB)">
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleSelectGender">Dung lượng Ram</label>
                              <input type="number" name="ram" class="form-control ram" id="exampleInputName1" placeholder="Nhập dung lượng ram(GB)">                         
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleSelectGender">Màn hình</label>
                              <input type="text" name="display" class="form-control display" id="exampleInputName1" placeholder="Nhập thông số màn hình">                         
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleSelectGender">Dung lượng pin</label>
                              <input type="number" name="batery" class="form-control batery" id="exampleInputName1" placeholder="Nhập dung lượng pin">                         
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>
                        </div>

                        <div class="row">

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleSelectGender">Camera chính</label>
                              <input type="text" name="camera" class="form-control camera" id="exampleInputName1" placeholder="Nhập độ phân giải cammera chính(MP)">                         
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleSelectGender">Camera phụ</label>
                              <input type="number" name="sub_camera" class="form-control sub_camera" id="exampleInputName1" placeholder="Nhập độ phân giải cammera phụ(MP)">                         
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="exampleSelectGender">Chiều dài</label>
                              <input type="text" name="width" class="form-control " id="exampleInputName1" placeholder="Nhập chiều dài(mm)">                         
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="exampleInputName1">Chiều rộng</label>
                              <input type="number" name="hight" class="form-control " id="exampleInputName1" placeholder="Nhập chiều rộng(mm)">
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="exampleInputName1">Cân nặng</label>
                              <input type="number" name="weight" class="form-control " id="exampleInputName1" placeholder="Nhập cân nặng(gam)">
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="exampleInputName1">Độ dày</label>
                              <input type="number" name="depth" class="form-control " id="exampleInputName1" placeholder="Nhập độ dày(mm)">
                              <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
              </div> 

              <button type="submit" class="btn btn-primary mr-2">Cập nhật</button>
              <button type="button" class="btn btn-light">Cancel</button>
            </form>
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


<script>

function Validator(options){
    var formElement = document.querySelector(options.form);
    var selectorRules = {}
// hàm thực hiện validate
var selectorRules = {}
function validate(inputElement, rule) {
      var input =inputElement.parentElement.querySelector('.form-control')
      var errorElement = inputElement.parentElement.querySelector('.form-message');
      var errorMessage 
      //
        var rules = selectorRules[rule.selector]
        
        for(var i = 0; i < rules.length; ++i){
          errorMessage = rules[i](inputElement.value)
          if (errorMessage) break;
        }
        if (errorMessage) {
          errorElement.innerText = errorMessage;
          input.style.borderColor = '#f33a58'
      
        }else{
          errorElement.innerText = ''
          input.style.borderColor = ''
        }
        return !errorMessage;
    }
    
    // lấy element của form
    if(formElement) {
      formElement.onsubmit = function(e) {
        

        var isFormValid = true

        options.rules.forEach( function(rule) {
         
          var inputElement = formElement.querySelector(rule.selector)
          var isValid = validate(inputElement,rule)
          if(!isValid) {
            isFormValid = false
          }
        });
        

        if(isFormValid){
          formElement.submit()
        }else{
          e.preventDefault();
        }
      }
        // lặp qua mỗi rule và xửa lý sự kiện
      options.rules.forEach( function(rule) {
        //lu lai cac rules cho moi input
        
        if(Array.isArray(selectorRules[rule.selector])) {
          selectorRules[rule.selector].push(rule.test)
        }else{
          selectorRules[rule.selector] = [rule.test]
        }

        var inputElement = formElement.querySelector(rule.selector)
        
        var errorElement = inputElement.parentElement.querySelector(options.errorSelector);
        var input =inputElement.parentElement.querySelector('.form-control')
        console.log(input)

          if(inputElement) {
            inputElement.onblur = function() {
              validate(inputElement,rule)
            }
            inputElement.oninput = function() {
              errorElement.innerText = ''
              input.style.borderColor = ''
            }
          }
      })
    }
}

Validator.isRequired = function (selector) {
    return {
      selector,
      test(value) {
        return value.trim() ? undefined : 'Vui lòng nhập tên sản phẩm'
      }
    }
}
Validator.isList = function(selector) {
  return {
      selector,
      test(value) {
        return value ? undefined : 'Vui lòng chọn danh mục'
      }
    }
}

Validator.isFirm = function(selector) {
  return {
      selector,
      test(value) {
        return value ? undefined : 'Vui lòng chọn hãng'
      }
    }
}
Validator.isPrice= function(selector) {
  return {
      selector,
      test(value) {
        return value ? undefined : 'Vui lòng nhập giá'
      }
    }
}
Validator.isDiscount= function(selector) {
  return {
      selector,
      test(value) {
        return value ? undefined : 'Vui lòng nhập % giảm giá'
      }
    }
}
Validator.isDate= function(selector) {
  return {
      selector,
      test(value) {
        return value ? undefined : 'Vui lòng chọn ngày'
      }
    }
}
Validator.isAmount= function(selector) {
  return {
      selector,
      test(value) {
        return value ? undefined : 'Vui lòng nhập số lượng'
      }
    }
}
Validator.isStatus= function(selector) {
  return {
      selector,
      test(value) {
        return value ? undefined : 'Vui lòng nhập số lượng'
      }
    }
}

Validator.isDescribe = function (selector) {
  return {
    selector,
    test(value) {
      return value ? undefined : 'Vui lòng nhập mô tả sản phẩm'
    }
  }
}

// Validator.isAvatar = function (selector) {
//   return {
//     selector,
//     test(value) {
//       return value ? undefined : 'Vui lòng chọn ảnh'
//     }
//   }
// }

   Validator({
    form: '#form-edit-product',
    errorSelector: '.form-message',
    rules: [
      Validator.isRequired('.fullname'),
      Validator.isList('.list'),
      Validator.isFirm('.firm'),
      Validator.isPrice('.price'),
      Validator.isDiscount('.discount'),
      Validator.isDate('.date'),
      Validator.isAmount('.amount'),
      Validator.isStatus('.status'),
      Validator.isDescribe('.describe'),
      // Validator.isAvatar('.avatar')
    ],
  })
</script>
@endsection