@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Biến Thể Sản Phẩm</h4>
            <p class="card-description">
              Nhập thông tin
            </p>
              <input type="hidden" name="id" value="{{$pro->id}}" id="">
              <input type="hidden" name="image1" value="{{$pro->image}}" id="">
              <div class="form-group">
                <label for="exampleInputName1">Tên Sản Phẩm</label>
                <input type="text" name="name" value="{{$pro->name}}" disabled class="form-control fullname" id="exampleInputName1" placeholder="Nhập tên sản phẩm">
                <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleSelectGender">Danh Mục</label>
                      <input type="text" name="name" value="{{$pro->Cate_items->Categories->name}}" disabled class="form-control fullname" id="exampleInputName1" placeholder="Nhập tên sản phẩm">
                      <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleSelectGender">Hãng</label>
                    <input type="text" name="name" value="{{$pro->Cate_items->name}}" disabled class="form-control fullname" id="exampleInputName1" placeholder="Nhập tên sản phẩm">
                    <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputName1">Giá</label>
                    <input type="number" value="{{$pro->price}}" disabled name="price" class="form-control price" id="exampleInputName1" placeholder="Nhập Giá Sản Phẩm">
                    <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputName1">Giảm Giá</label>
                    <input type="number" value="{{$pro->discount}}" disabled name="discount" class="form-control discount" id="exampleInputName1" placeholder="Nhập % Giảm giá">
                    <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Hình Ảnh</label>
                    <input type="file" name="" disabled class="form-control ">
                  </div>
                </div>
                <div class="col-sm-6">
                  <img src="{{asset('images/products/'.$pro->image)}}" width="30%" alt="ko cos anh">
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="content-wrapper var">
  <div class="row">
    {{-- Màu Sắc --}}
    <div class="col-6 grid-margin stretch-card" id="">
    @if($pro_color)
       <div class="row">
      @php
          $i=0;   
      @endphp
      @foreach ($pro_color as $pc)
      @php
          $i++;
      @endphp
        <div class="col-12 mt-1">
          <div class="card card-body">
          <h4 class="card-title">Biến Thể Màu Sắc {{$i}}</h4>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleSelectGender">Màu sắc</label>
                <input type="text" name="color" disabled value="{{$pc->color}}" class="form-control amount" id="exampleInputName1" placeholder="">                         
                <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
              </div>
              <div class="form-group">
                <label for="exampleSelectGender">Gía thêm </label>
                <input type="text" name="price" disabled value="{{$pc->price}} Đ" class="form-control amount" id="exampleInputName1" placeholder="Nhập giá bán">                         
                <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <img src="{{asset('images/products/'.$pc->image)}}" width="65%" alt="ko cos anh">
                <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
              </div>
            </div>
          </div>
          <a class="badge badge-danger rounded" style="width: 150px" onclick="return confirm('Xóa mục này?')" href="{{route('deleteColor',$pc->id)}}">Xóa</a></td>
          </div>
        </div>
         @endforeach
      @endif

         {{-- add color --}}
         <div class="col-12 mt-1">
          <form method="POST" action="{{route('createColor')}}" enctype="multipart/form-data" id="form-product" class="forms-sample">
              @csrf
              <input type="hidden" name="id" value="{{$pro->id}}">
          <div class="card card-body">
          <h4 class="card-title">Thêm Biến Thể Màu Sắc</h4>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleSelectGender">Màu sắc</label>
                <input type="text" name="color" class="form-control amount" id="exampleInputName1" placeholder="">                         
                <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
              </div>
              <div class="form-group">
                <label for="exampleSelectGender">Gía thêm </label>
                <input type="text" name="price_color" class="form-control amount" id="exampleInputName1" placeholder="Nhập giá bán">                         
                <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="">Hình ảnh</label>
                <input type="file" name="file_image_color" class="form-control avatar">
                <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Thêm mới</button>
          </div>
          </form>
        </div>
      </div>
    </div>


{{-- Bo Nho --}}
    <div class="col-6 grid-margin stretch-card" id="">
       <div class="row">
      @if($pro_memory)
      @php
          $i=0;   
      @endphp
      @foreach ($pro_memory as $pm)
      @php
          $i++;
      @endphp
        <div class="col-md-12 mt-1">
          <div class="card card-body">
          <h4 class="card-title">Biến Thể Bộ Nhớ {{$i}}</h4>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleSelectGender">Bộ nhớ</label>
                <input type="text" name="color" disabled value="{{$pm->memory}} GB" class="form-control amount" id="exampleInputName1" placeholder="">                         
                <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleSelectGender">Ram</label>
                <input type="text" name="color" disabled value="{{$pm->ram}} GB" class="form-control amount" id="exampleInputName1" placeholder="">                         
                <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleSelectGender">Gía thêm </label>
                <input type="text" name="price" disabled value="{{$pm->price}} Đ" class="form-control amount" id="exampleInputName1" placeholder="Nhập giá bán">                         
                <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
              </div>
            </div>
          </div>
          <a class="badge badge-danger rounded" style="width: 150px" onclick="return confirm('Xóa mục này?')" href="{{route('deleteMemory',$pm->id)}}">Xóa</a></td>
        </div>
         </div>
       @endforeach
        @endif
       <div class="col-md-12 mt-1">
        <form method="POST" action="{{route('createMemory')}}" enctype="multipart/form-data" id="form-product" class="forms-sample">
              @csrf
              <input type="hidden" name="id" value="{{$pro->id}}">
          <div class="card card-body">
          <h4 class="card-title">Thêm Biến Thể Bộ Nhớ</h4>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleSelectGender">Bộ nhớ</label>
                <input type="number" name="memory" class="form-control amount"  placeholder="">                         
                <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleSelectGender">Ram</label>
                <input type="number" name="ram" class="form-control amount" placeholder="">                         
                <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleSelectGender">Gía thêm </label>
                <input type="text" name="price_memory"class="form-control amount" id="exampleInputName1" placeholder="Nhập giá bán">                         
                <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Thêm mới</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

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