@extends('client.master')
@section('title','Đăng ký')
@section('content')
<main>
  <section class="signup-section">
  <div class="container">    
    <div class="card bg-light" style="border: none">
    <article class="card-body mx-auto" style="max-width: 400px;">
      <h4 class="card-title mt-3 text-center">Tạo tài khoản</h4>
      <p class="text-center">Bắt đầu với tài khoản miễn phí của bạn</p>
      <p>
        <a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>   Đăng nhập với Twitter</a>
        <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>    Đăng nhập với facebook</a>
      </p>
      <p class="divider-text">
            <span class="bg-light">hoặc</span>
        </p>
    <form method="POST" action="{{ route('register') }}" id ="form-register" enctype="multipart/form-data">
            @csrf
      <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
        </div>
            <input name="name" class="form-control fullname" placeholder="Họ và tên" type="text">
            <span style="font-size: 15px; color: #f33a58;width: 100%;" class="form-message"></span>
      </div>
 <!-- form-group// -->
        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
         </div>
            <input name="email" class="form-control email" placeholder="Địa chỉ email" type="email">
            <span style="font-size: 15px; color: #f33a58;width: 100%;" class="form-message"></span>
        </div> 
  <!-- form-group// -->
        <div class="form-group input-group">
          <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i> </span>
          </div>
          <input name="password" class="form-control password" placeholder="Mật khẩu" type="password">
          <span style="font-size: 15px; color: #f33a58;width: 100%;" class="form-message"></span>
        </div>
        <div class="form-group input-group">
          <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i> </span>
            </div>
            <input name="" class="form-control password_confirmation" placeholder="Nhập lại Mật khẩu" type="password">
            <span style="font-size: 15px; color: #f33a58;width: 100%;" class="form-message"></span>
        </div>
        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text "> <i class="fa fa-building"></i> </span>
            </div>
            <input name="address" class="form-control address" placeholder="Địa chỉ của bạn" type="text">
            <span style="font-size: 15px; color: #f33a58;width: 100%;" class="form-message"></span>

        </div>
        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
            </div>
          <input name="phone" class="form-control myPhone" placeholder="Số điện thoại" type="text">
          <span style="font-size: 15px; color: #f33a58;width: 100%;" class="form-message"></span>
        </div> 
        <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fa fa-building"></i> </span>
              </div>
              <input name="file_upload" class="form-control avatar" placeholder="Ảnh của bạn" type="file">
              <span style="font-size: 15px; color: #f33a58;width: 100%;" class="form-message"></span>
  
          </div><!-- form-group// -->
 <!-- form-group end.// -->                                  
        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-block btn-form"> Đăng ký tài khoản </button>
        </div> <!-- form-group// -->      
        <p class="text-center">Bạn đã có tài khoản? <a href="/">Đăng nhập</a> </p>                                                                 
    </form>
    </article>
    </div> <!-- card.// -->
    
    </div> 
    <!--container end.//-->
    </main>
</section>


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

          if(inputElement) {
            inputElement.onblur = function() {
              validate(inputElement,rule)
            }
           
            inputElement.oninput = function() {
              errorElement.innerHTML = ''
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
        return value.trim() ? undefined : 'Vui lòng nhập tên'
      }
    }
}
Validator.isPassword = function (selector) {
  return {
    selector,
    test(value) {
      return value ? undefined : 'Vui lòng nhập mật khẩu'
    }
  }
}
Validator.formEmail = function (selector) {
    return {
      selector,
      test(value) {
        return value ? undefined : 'Vui lòng nhập địa chỉ email'
      }
    }
}
Validator.isEmail= function (selector) {
  return {
      selector,
      test(value) {
          var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
          return regex.test(value) ? undefined : 'Vui lòng nhập đúng định dạng email'
      }
        }
}

Validator.minLength = function (selector,min) {
        return {
            selector,
            test(value) {
                return value.length >= min ? undefined : `Vui lòng nhập tối đa ${min} ký tự`
            }
        }
}


Validator.setMess = function (selector) {
    return {
      selector,
      test(value) {
        return value ? undefined : 'Vui lòng xác nhận mật khẩu'
      }
    }
}

Validator.isComfirmed = function (selector,getComfirmed, message) {
  return {
    selector,
    test(value) {
      return value == getComfirmed() ? undefined : message|| 'Giá trị sai'
    }
  }
}

Validator.isAddress = function(selector, message) {
  return {
    selector,
    test(value) {
      return value ? undefined : message|| 'Vui lòng nhập'
    }
  }
}

Validator.isPhone = function (selector,min, message) {
        return {
            selector,
            test(value) {
                return value.length >= min ? undefined :`Vui lòng nhập tối thiểu ${min} số `
            }
        }
}


Validator.isAvatar = function (selector) {
  return {
    selector,
    test(value) {
      return value ? undefined : 'Vui lòng chọn ảnh'
    }
  }
}

   Validator({
    form: '#form-register',
    errorSelector: '.form-message',
    rules: [
      Validator.isRequired('.fullname'),
      Validator.formEmail('.email'),
      Validator.isEmail('.email'),
      Validator.isPassword('.password'),
      Validator.minLength('.password', 6),
      Validator.setMess('.password_confirmation'),
      Validator.isComfirmed('.password_confirmation', function() {
                return document.querySelector('#form-register .password').value
              }, 'Mật khẩu nhập lại không chính xác'),
      Validator.isAddress('.address', 'Vui lòng nhập địa chỉ'),
      Validator.isPhone('.myPhone',10),
      Validator.isAvatar('.avatar')
    ],
  })
</script>
@endsection