@extends('client.master')
@section('title','Thông tin tài khoản')
@section('content')
<main>
<section>
<div class="container bg-light"> 
    <form method="POST" action="{{route('addAddress')}}" enctype="multipart/form-data" id="form-addres" class="forms-sample">
    @csrf
        <div class="row"> 
            <div class="col border-right"> 
                <div class="p-3 py-5"> 
                    <div class="d-flex justify-content-between align-items-center mb-3"> 
                        <h4 class="text-right">Thêm địa chỉ</h4> 
                    </div> <div class="row mt-2"> 
                      <input type="hidden" class="form-control" placeholder="" name="user_id" value="{{Auth::user()->id}}">

                        <div class="col-md-6">
                            <label class="labels">Họ và tên</label>

                            <input type="text" class="form-control fullname" placeholder="" name="name" value="">
                            <span style="font-size: 15px; color: #f33a58;width: 100%;" class="form-message"></span>
                        </div> 
                        <div class="col-md-6">
                            <label class="labels">Số điện thoại</label>
                            <input type="text" class="form-control myPhone" value="" name="phone" placeholder="">
                            <span style="font-size: 15px; color: #f33a58;width: 100%;" class="form-message"></span>
                        </div> 
                        
                    </div> 
                    <div class="row mt-3"> 
                        <div class="col-md-6">
                            <label class="labels">Địa chỉ</label>
                            <input type="text" class="form-control address" name="address" value="" placeholder="">
                            <span style="font-size: 15px; color: #f33a58;width: 100%;" class="form-message"></span>
                        </div> 
                        <div class="col-md-6">
                            <label class="labels">Trạng thái</label>
                            <input type="hidden" class="form-control" placeholder="Mặc định" value="1" name="role">

                            <input type="text" disabled class="form-control" placeholder="Mặc định">
                        </div> 
                        
                    </div> 
                    <div class="mt-5 text-center">
                        <button class="btn btn-form" type="submit">Thêm địa chỉ</button>
                    </div> 
                </div> 
            </div> 

        </div>
    </form>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Danh Sách Địa Chỉ</h4>
            <div class="table-responsive pt-3">
              <table id="recent-purchases-listing" class="table table-bordered">
                <thead>
                  <tr>
                    <th>
                      #
                    </th>
                    <th>
                        Họ và tên
                    </th>
                    <th>
                        Số điện thoại
                    </th>
                    <th>
                        Địa chỉ
                    </th>
                    <th>
                        Trạng thái
                    </th>
                    <th>
                        Hành động
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @foreach ($listAdr as $adr)
                    <td>
                      <p>{{$adr->id}}</p>
                    </td>
                    <td>
                      <p>{{$adr->name}}</p>
                    </td>
                    <td>
                      <p>{{$adr->phone}}</p>
                    </td>
                      <td>
                        <p>{{$adr->address}}</p>
                      </td>
                      <td>
                        @if($adr->role == 1)
                            <p class="btn btn-success">Mặc định</p>
                            @else
                            <p class="btn btn-danger">Tạm thời</p>
                        @endif
                      </td>
                    <td class="d-flex">
                        <a href="{{route('geteditAddress',$adr->id)}}" class="btn btn-primary mx-2">Sửa</a>
                        
                        <a href="{{route('deleteAddress',$adr->id)}}" onclick="return confirm('Xóa mục này?')"><button type="button" class="btn btn-danger">Xóa</button></a>
                    </td>

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
</div>
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


Validator.isAddress = function(selector, message) {
  return {
    selector,
    test(value) {
      return value ? undefined : message|| 'Vui lòng nhập'
    }
  }
}

Validator.phoneMail = function (selector) {
  return {
    selector,
    test(value) {
      return value.trim() ? undefined : 'Vui lòng nhập số điện thoại'
    }
  }
}

Validator.isPhone = function (selector,min, message) {
        return {
            selector,
            test(value) {
                return value.length == min ? undefined :`Vui lòng nhập tối thiểu ${min} số `
            }
        }
}


  Validator({
  form: '#form-addres',
  errorSelector: '.form-message',
  rules: [
    Validator.isRequired('.fullname'),
    Validator.isAddress('.address', 'Vui lòng nhập địa chỉ'),
    Validator.phoneMail('.myPhone'),
    Validator.isPhone('.myPhone',10),
  ],
})
</script>
@endsection
