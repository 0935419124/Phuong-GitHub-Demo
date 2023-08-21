@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Chỉnh sửa danh mục</h4>
                <form method="POST" action="{{route('editCate')}}" enctype="multipart/form-data" id="form-edit" class="form-inline">
                  @csrf
                <div>
                  <input type="hidden" value="{{$cate->id}}" name="id">
                  <input type="hidden" value="{{$cate->cate_id}}" name="cate_id">
                  <label class="sr-only" for="inlineFormInputName2">Tên Danh Mục</label>
                  <input type="text" name="name" class="form-control mb-2 mr-sm-2" value="{{$cate->name}}" id="fullname" placeholder="Tên Danh Mục">
                  <span style="font-size: 15px; color: #f33a58; line-height: 3px;   display: block;" class="form-message"></span>
                </div>
                <div>
                  <label class="sr-only" for="inlineFormInputName2">Hình Ảnh</label>
                  <input type="hidden" value="{{$cate->image}}" name="image1">
                  <input type="file" name="file_upload" class="form-control mb-2 mr-sm-2" id="avatar" placeholder="Tên Danh Mục">
                  <span style="font-size: 15px; color: #f33a58; line-height: 3px;   display: block;" class="form-message"></span>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Cập nhật</button>
                </form>
            </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Danh Mục</h4>
                <div class="table-responsive pt-3">
                  <table id="recent-purchases-listing" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>
                          #
                        </th>
                        <th>
                          Tên Danh Mục
                        </th>
                        <th>
                          Số lượng Sản Phẩm
                        </th>
                        <th>
                          Hành động
                        </th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($allCate as $cate)
                      <tr>
                        <td>
                          {{$cate->id}}
                        </td>
                        <td>
                          {{$cate->name}}
                        </td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="20"></div>
                          </div>
                        </td>
                        <td style="width: 15%">
                            <a href=""><button type="button" class="btn btn-primary"><i class="mdi mdi-wrench"></i></button></a>
                            <a href="{{route('deleteCate',$cate->id)}}" onclick="return confirm('Xóa mục này?')"><button type="button" class="btn btn-danger"><i class="mdi mdi-delete"></i></button></a>
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
              console.log(inputElement.value)
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
        return value.trim() ? undefined : 'Vui lòng nhập tên danh mục'
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
    form: '#form-edit',
    errorSelector: '.form-message',
    rules: [
      Validator.isRequired('#fullname'),
      // Validator.isRequired('#avatar'),
      // Validator.isAvatar('#avatar')
    ],
  })
</script>
@endsection