@extends('client.master')
@section('title','Thanh toán')
@section('content')
@include('client/partials/_nav')
    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
      <div class="container">
        <div class="returning_customer">
          <div class="check_title">
            <h2>
            Phản hồi khách hàng?
              <a href="#">Nhấn vào đây để đăng nhập</a>
            </h2>
          </div>
          <p>
            Nếu bạn đã mua sắm với chúng tôi trước đây, vui lòng nhập thông tin chi tiết của bạn vào
            hộp bên dưới. Nếu bạn là khách hàng mới, vui lòng tiếp tục
            Phần Thanh toán & Vận chuyển.
          </p>
          <form
            class="row contact_form"
            action="#"
            method="post"
            novalidate="novalidate"
          >
            <div class="col-md-6 form-group p_star">
              <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                value=" "
              />
              <span
                class="placeholder"
                data-placeholder="Username or Email"
              ></span>
            </div>
            <div class="col-md-6 form-group p_star">
              <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                value=""
              />
              <span class="placeholder" data-placeholder="Password"></span>
            </div>
            <div class="col-md-12 form-group">
              <button type="submit" value="submit" class="btn submit_btn">
              Gửi tin nhắn
              </button>
              <div class="creat_account">
                <input type="checkbox" id="f-option" name="selector" />
                <label for="f-option">Nhớ tôi</label>
              </div>
              <a class="lost_pass" href="#">Quên mật khẩu?</a>
            </div>
          </form>
        </div>
        <div class="cupon_area">
          <div class="check_title">
            <h2>
              Có phiếu giảm giá?
              <a href="#">Bấm vào đây để nhập mã của bạn</a>
            </h2>
          </div>
          <input type="text" placeholder="Enter coupon code" />
          <a class="tp_btn" href="#">Áp dụng phiếu giảm giá</a>
        </div>
        <div class="billing_details">
          <div class="row">
            <div class="col-lg-8">
              <h3>Chi tiết thanh toán</h3>
              <form
                class="row contact_form"
                action="#"
                method="post"
                novalidate="novalidate"
              >
                <div class="col-md-6 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="first"
                    name="name"
                  />
                  <span
                    class="placeholder"
                    data-placeholder="First name"
                  ></span>
                </div>
                <div class="col-md-6 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="last"
                    name="name"
                  />
                  <span class="placeholder" data-placeholder="Last name"></span>
                </div>
                <div class="col-md-12 form-group">
                  <input
                    type="text"
                    class="form-control"
                    id="company"
                    name="company"
                    placeholder="Company name"
                  />
                </div>
                <div class="col-md-6 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="number"
                    name="number"
                  />
                  <span
                    class="placeholder"
                    data-placeholder="Phone number"
                  ></span>
                </div>
                <div class="col-md-6 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="compemailany"
                  />
                  <span
                    class="placeholder"
                    data-placeholder="Email Address"
                  ></span>
                </div>
                <div class="col-md-12 form-group p_star">
                  <select class="country_select">
                    <option value="1">Quốc gia</option>
                    <option value="2">Quốc gia</option>
                    <option value="4">Quốc gia</option>
                  </select>
                </div>
                <div class="col-md-12 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="add1"
                    name="add1"
                  />
                  <span
                    class="placeholder"
                    data-placeholder="Address line 01"
                  ></span>
                </div>
                <div class="col-md-12 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="add2"
                    name="add2"
                  />
                  <span
                    class="placeholder"
                    data-placeholder="Address line 02"
                  ></span>
                </div>
                <div class="col-md-12 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="city"
                    name="city"
                  />
                  <span class="placeholder" data-placeholder="Town/City"></span>
                </div>
                <div class="col-md-12 form-group p_star">
                  <select class="country_select">
                    <option value="1">Huyện</option>
                    <option value="2">Huyện</option>
                    <option value="4">Huyện</option>
                  </select>
                </div>
                <div class="col-md-12 form-group">
                  <input
                    type="text"
                    class="form-control"
                    id="zip"
                    name="zip"
                    placeholder="Postcode/ZIP"
                  />
                </div>
                <div class="col-md-12 form-group">
                  <div class="creat_account">
                    <input type="checkbox" id="f-option2" name="selector" />
                    <label for="f-option2">Tạo một tài khoản?</label>
                  </div>
                </div>
                <div class="col-md-12 form-group">
                  <div class="creat_account">
                    <h3>Chi tiết vận chuyển</h3>
                    <input type="checkbox" id="f-option3" name="selector" />
                    <label for="f-option3">Gửi đến một địa chỉ khác?</label>
                  </div>
                  <textarea
                    class="form-control"
                    name="message"
                    id="message"
                    rows="1"
                    placeholder="Order Notes"
                  ></textarea>
                </div>
              </form>
            </div>
            <div class="col-lg-4">
              <div class="order_box">
                <h2>Đơn hàng của bạn</h2>
                <ul class="list">
                  <li>
                    <a href="#"
                      >Sản phẩm
                      <span>Tổng cộng</span>
                    </a>
                  </li>
                  <li>
                    <a href="#"
                      >Fresh Blackberry
                      <span class="middle">x 02</span>
                      <span class="last">$720.00</span>
                    </a>
                  </li>
                  <li>
                    <a href="#"
                      >Cà chua tươi
                      <span class="middle">x 02</span>
                      <span class="last">$720.00</span>
                    </a>
                  </li>
                  <li>
                    <a href="#"
                      >Bông cải xanh tươi
                      <span class="middle">x 02</span>
                      <span class="last">$720.00</span>
                    </a>
                  </li>
                </ul>
                <ul class="list list_2">
                  <li>
                    <a href="#"
                      >Tổng phụ
                      <span>$2160.00</span>
                    </a>
                  </li>
                  <li>
                    <a href="#"
                      >Đang chuyển hàng
                      <span>Flat rate: $50.00</span>
                    </a>
                  </li>
                  <li>
                    <a href="#"
                      >Tổng cộng
                      <span>$2210.00</span>
                    </a>
                  </li>
                </ul>
                <div class="payment_item">
                  <div class="radion_btn">
                    <input type="radio" id="f-option5" name="selector" />
                    <label for="f-option5">Kiểm tra các khoản thanh toán</label>
                    <div class="check"></div>
                  </div>
                  <p>
                    Vui lòng gửi séc đến Tên cửa hàng, Phố cửa hàng, Thị trấn cửa hàng,
                    Lưu trữ Tiểu bang / Quận, Lưu trữ Mã bưu điện.
                  </p>
                </div>
                <div class="payment_item active">
                  <div class="radion_btn">
                    <input type="radio" id="f-option6" name="selector" />
                    <label for="f-option6">Paypal </label>
                    <img src="img/product/single-product/card.jpg" alt="" />
                    <div class="check"></div>
                  </div>
                  <p>
                    Vui lòng gửi séc đến Tên cửa hàng, Phố cửa hàng, Thị trấn cửa hàng,
                    Lưu trữ Tiểu bang / Quận, Lưu trữ Mã bưu điện.
                  </p>
                </div>
                <div class="creat_account">
                  <input type="checkbox" id="f-option4" name="selector" />
                  <label for="f-option4">Tôi đã đọc và chấp nhận </label>
                  <a href="#">Điều khoản và điều kiện*</a>
                </div>
                <a class="main_btn" href="#">Tiếp tục đến Paypal</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Checkout Area =================-->

@endsection