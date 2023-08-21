@extends('client.master')
@section('title','Danh mục')
@section('content')
<!--================Home Banner Area =================-->
<section class="section_gap">
    <div class="container">
      <div class="row">
        <!-- Bannel -->
      </div>
      


      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">Liên hệ chúng tôi.</h2>
        </div>
        <div class="col-lg-8 mb-4 mb-lg-0">
          <form class="form-contact contact_form" action="{{route('editContact')}}" method="POST" id="contactForm" >
            @csrf
            <input type="hidden" name="id" value="{{$contacts->id}}">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                    <textarea class="form-control w-100" name="message" id="" cols="30" rows="9" required>{{$contacts->message}}</textarea>
                </div>
              </div>
              @if(isset($dataUser))
              <input type="hidden" name="id_user" value="{{$contacts->id_user}}">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input class="form-control" name="user_name" id="" type="text" value="{{$contacts->user_name}}" >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input class="form-control" name="user_email" id="" type="email" value="{{$contacts->user_email}}" >
                  </div>
                </div>
              @elseif(!isset($dataUser))
              <input type="hidden" name="id_user" value="{{$contacts->id_user}}">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input class="form-control" name="name" id="" type="text"  value="{{$contacts->user_name}}" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input class="form-control" name="email" id="" type="email"  value="{{$contacts->user_email}}" required>
                  </div>
                </div>
              @endif
            </div>
            <div class="form-group mt-lg-3">
              <button type="submit" class="main_btn">Cập nhật tin nhắn.</button>
            </div>
          </form>
        </div>

        <div class="col-lg-4">
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-home"></i></span>
            <div class="media-body">
              <h3>Liên Chiểu, Đà Nẵng</h3>
              <p>Đà Nẵng, CA 50002</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
            <div class="media-body">
              <h3><a href="tel:454545654">0964.033.455</a></h3>
              <p>Thứ Hai đến Thứ Sáu, 9 giờ sáng đến 6 giờ chiều.</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-email"></i></span>
            <div class="media-body">
              <h3><a href="mailto:support@colorlib.com">TECHSHOP@GMAIL.COM</a></h3>
              <p>Gửi cho chúng tôi câu hỏi của bạn bất cứ lúc nào!.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
      <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      </div>
      
      <div class= 'row' style="margin-bottom: 100px; ">
        <!-- <div class="d-none d-sm-block mb-5 pb-4  " style="height:300px"> -->
          <div class="col-lg-6">
            <div id="map" style=" width: 100%; height: 380px; float: left; " >
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2236.1374988314938!2d108.16966138988002!3d16.07428885033731!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314218e6e07b1c3f%3A0x459e4bf5a2af323e!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYyDEkMOgIE7hurVuZw!5e0!3m2!1svi!2s!4v1664677507528!5m2!1svi!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>

          <div class="col-lg-6">
            <div id="map" style=" width: 100%; height: 380px;  float: right; "  >
            <iframe src="https://youtube.com/embed/S7ElVoYZN0g" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
          <script>
            function initMap() {
              var uluru = {lat: -25.363, lng: 131.044};
              var grayStyles = [
                {
                  featureType: "all",
                  stylers: [
                    { saturation: -90 },
                    { lightness: 50 }
                  ]
                },
                {elementType: 'labels.text.fill', stylers: [{color: '#A3A3A3'}]}
              ];
              var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -31.197, lng: 150.744},
                zoom: 9,
                styles: grayStyles,
                scrollwheel:  false
              });
            }
          
            
          </script>
          <script src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2236.1374988314938!2d108.16966138988002!3d16.07428885033731!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314218e6e07b1c3f%3A0x459e4bf5a2af323e!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYyDEkMOgIE7hurVuZw!5e0!3m2!1svi!2s!4v1664677507528!5m2!1svi!2s"></script>
        <!-- </div> -->
      </div>
    </div>

  </section>
<!--================ End Blog Area =================-->

@endsection