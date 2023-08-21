@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Sửa người dùng</h4>
            <p class="card-description">
              Nhập thông tin
            </p>
            <form method="POST" action="{{route('updateUser')}}" enctype="multipart/form-data" id="form-edit-user" class="forms-sample">
              @csrf
              <input type="hidden" name="id" value="{{$user->id}}" id="">
              <input type="hidden" name="image1" value="{{$user->image}}" id="">
              <input type="hidden" name="email_verified_at" value="{{$user->email_verified_at}}" id="">
              <input type="hidden" name="password" value="{{$user->password}}" id="">
              <input type="hidden" name="remember_token" value="{{$user->remember_token}}" id="">

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputName1">Tên người dùng</label>
                    <input type="text" name="name" value="{{$user->name}}" class="form-control fullname" id="exampleInputName1" placeholder="Nhập tên người dùng">
                    <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleSelectGender">Địa chỉ</label>
                    <input type="text" value="{{$user->address}}" name="address" class="form-control price" id="exampleInputName1" placeholder="Nhập địa chỉ">
                    <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputName1">Email</label>
                    <input type="email" value="{{$user->email}}" name="email" class="form-control price" id="exampleInputName1" placeholder="Nhập email">
                    <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputName1">Số điện thoại</label>
                    <input type="text" value="{{$user->phone}}" name="phone" class="form-control discount" id="exampleInputName1" placeholder="Nhập số điện thoại">
                    <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleSelectGender">Trạng thái</label>
                      <select class="form-control status" name="status" id="exampleSelectGender">
                        @if ($user->status==0)
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
                <!-- <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleSelectGender">Ngày tạo</label>
                    <input type="date" value="{{$user->created_at}}" name="created_at" class="form-control date" id="exampleInputEmail3" disabled>
                    <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                  </div>
                </div> -->
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleSelectGender">Phân quyền</label>
                    <select class="form-control" name="role" id="">
                      @if ($user->role==0)
                        <option selected value="0">Người Dùng</option>
                        <option value="1">Quản Trị</option>
                      @else
                        <option selected value="1">Quản Trị</option>
                        <option value="0">Người Dùng</option>
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
                  <img src="{{asset('images/users/'.$user->image)}}" width="30%" alt="Không có ảnh">
                </div>

              </div>
                         
              <button type="submit" class="btn btn-primary mr-2">Cập nhật</button>
              <button type="button" class="btn btn-light">Cancel</button>
            </form>
          </div>
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
    form: '#form-edit-user',
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