<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{route('indexAdmin')}}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Trang chủ</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('listCate')}}">
          <i class="mdi mdi-format-list-bulleted menu-icon"></i>
          <span class="menu-title">Danh Mục</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-cellphone-iphone menu-icon"></i>
          <span class="menu-title">
            Sản phẩm</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('loadCreatePro')}}">Thêm mới</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('listPro')}}">Danh sách</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-sale menu-icon"></i>
          <span class="menu-title">Mã giảm giá</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('loadDiscount_code')}}">Thêm mới</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('listDiscount')}}">Danh sách</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="mdi mdi-collage menu-icon"></i>
          <span class="menu-title">Slider</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{Route('createSlide')}}"> Thêm mới </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{Route('listSlide')}}"> Danh sách </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{Route('orders')}}">
          <i class="mdi mdi-file-document-box-outline menu-icon"></i>
          <span class="menu-title">Đơn hàng</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{Route('contact')}}">
          <i class="mdi mdi-contact-mail menu-icon"></i>
          <span class="menu-title">Liên hệ</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('listCom')}}">
          <i class="mdi mdi-emoticon menu-icon"></i>
          <span class="menu-title">Bình luận</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">Tài khoản</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('listUser')}}"> Danh sách</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('listUserAd')}}"> Danh sách quản trị </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="mdi mdi-truck-delivery menu-icon"></i>
          <span class="menu-title">Phương thức giao hàng</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('CreateDelivery')}}"> Thêm mới</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('ListDelivery')}}"> Danh sách </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="documentation/documentation.html">
          <i class="mdi mdi-file-document-box-outline menu-icon"></i>
          <span class="menu-title">Documentation</span>
        </a>
      </li>
    </ul>
  </nav>