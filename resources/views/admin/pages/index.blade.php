@extends('admin.master')
@section('content')
<div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="mr-md-3 mr-xl-5">
                    <h2>Trang quản trị</h2>
                    <p class="mb-md-0">Thống kê cửa hàng của bạn.</p>
                  </div>
                  <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Trang chủ&nbsp;/&nbsp;</p>
                    <p class="text-primary mb-0 hover-cursor">Thống kê</p>
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                  <button type="button" class="btn btn-light bg-white btn-icon mr-3 d-none d-md-block ">
                    <i class="mdi mdi-download text-muted"></i>
                  </button>
                  <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                    <i class="mdi mdi-clock-outline text-muted"></i>
                  </button>
                  <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                    <i class="mdi mdi-plus text-muted"></i>
                  </button>
                  <button class="btn btn-primary mt-2 mt-xl-0">Tải xuống bản ghi</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Tổng quan</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-calendar-heart icon-lg mr-3 text-primary"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Tính đến</small>
                            <div class="dropdown">
                              <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" aria-expanded="false">
                                <h5 class="mb-0 d-inline-block">{{$date}}</h5>
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-currency-usd mr-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Doanh thu</small>
                            <h5 class="mr-2 mb-0">{{number_format($revenue, 0, '.', '.')}} VNĐ</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-eye mr-3 icon-lg text-success"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Lượt xem sản phẩm</small>
                            <h5 class="mr-2 mb-0">{{$totalView}}</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-cellphone mr-3 icon-lg text-warning"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Sản phẩm đã bán</small>
                            <h5 class="mr-2 mb-0">{{$totalPro}}</h5>
                          </div>
                        </div>
                        <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-cart mr-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Tổng số đơn hàng</small>
                            <h5 class="mr-2 mb-0">{{$totalPro}}</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Thống kê kho hàng</p>
                  <div id="chart_div"></div>
                  @foreach ($chartPro as $pro)
                      <p>{{$pro[0]}}: {{$pro[1]}} sản phẩm</p>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Total sales</p>
                  <div id="curve_chart" style="width: 700px; height: 500px"></div>
              </div>
            </div>
          </div>
        </div>
         <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Đơn hàng mới</p>

                  {{-- Filter --}}
                  <div class="col-md-3" style="float: left">
                    <form class="card-title" action="{{route('orderByStatus')}}" method="POST">
                      @csrf
                      <div class="form-group">
                        <select class="form-control show-cti form-select list"  name="status" id="cate" onchange="this.form.submit()">
                          <option>Lọc theo tình trạng</option>
                          <option value="5">Tất cả </option>
                          <option value="0">Đang xử lý </option>
                          <option value="1">Đã xác nhận </option>
                          <option value="2">Đang giao hàng</option>
                          <option value="3">Đã giao hàng</option>
                          <option value="4">Đã hủy</option>   
                        </select>
                      </div>
                    </form>
                  </div>
                  <div class="table-responsive pt-3">
                    <table id="recent-purchases-listing" class="table table-bordered">
                      <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Khách Hàng</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th colspan="2">Hành động</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($orders as $order)
                        <tr>
                          <td>{{$order->id}}</td>
                          <td>{{$order->User->name}}</td>
                          <td>0{{$order->UserAddress->phone}}</td>
                          <td>{{$order->UserAddress->address}}</td>
                          <td>{{number_format($order->total, 0, '.', '.')}} VNĐ</td>
                          <td>
                            <select data-order_id="{{$order->id}}" class="order-status
                            @if($order->status==0)
                              btn btn-inverse-warning btn-fw
                            @elseif($order->status==1)
                              btn btn-inverse-secondary btn-fw
                            @elseif($order->status==2)
                              btn btn-inverse-primary btn-fw
                            @elseif($order->status==3)
                              btn btn-inverse-success btn-fw
                            @else
                              btn btn-inverse-danger btn-fw
                            @endif
                            " name="" id="">
                              @if ($order->status==0)
                                  <option selected value='0'>Đang xử lý</option>
                                  <option value='1'>Đã xác nhận</option>
                                  <option value='2'>Đang giao hàng</option>
                                  <option value='3'>Đã giao hàng</option>
                                  <option value='4'>Đã hủy</option>
                              @elseif($order->status==1)
                                  <option value='0'>Đang xử lý</option>
                                  <option selected value='1'>Đã xác nhận</option>
                                  <option value='2'>Đang giao hàng</option>
                                  <option value='3'>Đã giao hàng</option>
                                  <option value='4'>Đã hủy</option>
                              @elseif($order->status==2)
                                  <option value='0'>Đang xử lý</option>
                                  <option value='1'>Đã xác nhận</option>
                                  <option selected value='2'>Đang giao hàng</option>
                                  <option value='3'>Đã giao hàng</option>
                                  <option value='4'>Đã hủy</option>
                              @elseif($order->status==3)
                                  <option value='0'>Đang xử lý</option>
                                  <option value='1'>Đã xác nhận</option>
                                  <option value='2'>Đang giao hàng</option>
                                  <option selected value='3'>Đã giao hàng</option>
                                  <option value='4'>Đã hủy</option>
                                @else
                                  <option value='0'>Đang xử lý</option>
                                  <option value='1'>Đã xác nhận</option>
                                  <option value='2'>Đang giao hàng</option>
                                  <option value='3'>Đã giao hàng</option>
                                  <option selected value='4'>Đã hủy</option>
                              @endif
                            </select>
                          </td>
                          </td>
                          <td>
                            <a class="badge badge-info rounded" href="{{Route('orderDetail',$order->id)}}">Chi tiết</a>
                            @if ($order->status==3 || $order->status==4)
                              <a class="badge badge-danger rounded"  onclick="confirm('Bạn chắc chắn xóa đơn hàng này')" href="{{Route('orderDelete', $order->id)}}">Xóa</a>
                            @endif
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

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(revenue);
      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          @php
              foreach($chartPro as $chart) {
                  echo "['".$chart[0]."', ".$chart[1]."],";
              }
          @endphp
        ]);

        // Set chart options
        var options = {'title':'Biểu đồ tỉ lệ sản phẩm trong danh mục',
                       'width': 450,
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

      function revenue() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales'],
          ['2004',  1000],
          ['2005',  1170],
          ['2006',  660],
          ['2007',  1030]
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
@endsection