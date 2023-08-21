<!DOCTYPE html>
<html lang="en">
@include('Admin.partials.head')
<body>
  <div class="container-scroller">
    <!-- partial:Admin.partials/_navbar.html -->
    @include('Admin.partials.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:Admin.partials/_sidebar.html -->
      @include('Admin.partials.sidebar')
      <!-- partial -->
      <div class="main-panel">
        @yield('content')
        <!-- content-wrapper ends -->
        <!-- partial:Admin.partials/_footer.html -->
        @include('Admin.partials.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  @include('Admin.partials.pluginsJS')
</body>

</html>

