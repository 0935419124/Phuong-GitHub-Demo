@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Thêm mã giảm giá</h4>
            <p class="card-description">
              Nhập thông tin
            </p>
            <form method="POST" action="{{route('storeDiscount_code')}}" enctype="multipart/form-data" id="form-disc" class="forms-sample">
              @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputName1">Mã giảm giá</label>
                        <input type="text" name="code" class="form-control code" id="exampleInputName1" placeholder="Nhập mã giảm giá">
                        <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputName1">Số tiền giảm giá</label>
                        <input type="number" name="dicount" class="form-control dicount" id="exampleInputName1" placeholder="Nhập số tiền giảm giá">
                        <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputName1">Ngày bắt đầu</label>
                    <input type="date" name="start_time" class="form-control start_time" id="exampleInputName1" placeholder="Nhập ngày đăng">
                    <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputName1">Ngày kết thúc</label>
                    <input type="date" name="end_time" class="form-control end_time" id="exampleInputName1" placeholder="Nhập số lượng">
                    <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputName1">Số lượng</label>
                        <input type="number" name="quantity" class="form-control quantity" id="exampleInputName1" placeholder="Nhập số lượng">
                        <span style="font-size: 15px; color: #f33a58; line-height: 3px; padding-top: 10px;  display: block;" class="form-message"></span>
                    </div>
                </div>
            </div>
              <button type="submit" class="btn btn-primary mr-2">Thêm mới</button>
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


Validator.isCode= function(selector) {
  return {
      selector,
      test(value) {
        return value ? undefined : 'Vui nhập mã giảm giá'
      }
    }
}
Validator.isPro_id= function(selector) {
  return {
      selector,
      test(value) {
        return value ? undefined : 'Vui lòng chọn sản phẩm'
      }
    }
}
Validator.isDicount= function(selector) {
  return {
      selector,
      test(value) {
        return value ? undefined : 'Vui lòng nhập só tiền giảm giá'
      }
    }
}
Validator.isQuantity= function(selector) {
  return {
      selector,
      test(value) {
        return value ? undefined : 'Vui lòng nhập số lượng'
      }
    }
}
Validator.isStart_time= function(selector) {
  return {
      selector,
      test(value) {
        return value ? undefined : 'Vui lòng chọn ngày bắt đầu'
      }
    }
}

Validator.isEnd_time = function (selector) {
  return {
    selector,
    test(value) {
      return value ? undefined : 'Vui lòng chọn ngày kết thúc'
    }
  }
}

Validator.isType = function (selector) {
  return {
    selector,
    test(value) {
      return value ? undefined : 'Vui lòng chọn khoảng áp dụng'
    }
  }
}

   Validator({
    form: '#form-disc',
    errorSelector: '.form-message',
    rules: [
      Validator.isCode('.code'),
      Validator.isPro_id('.pro_id'),
      Validator.isDicount('.dicount'),
      Validator.isQuantity('.quantity'),
      Validator.isStart_time('.start_time'),
      Validator.isEnd_time('.end_time'),
      Validator.isType('.type')
    ],
  })
</script>
@endsection