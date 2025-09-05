
<!DOCTYPE html>
<html dir="ltr" lang="en">

@include ('admin.layouts.head')

  <body>

    <div
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin5"
      data-sidebartype="full"
      data-sidebar-position="absolute"
      data-header-position="absolute"
      data-boxed-layout="full"
    >

 @include('admin.layouts.header')

 @include('admin.layouts.aside')
 

      <div class="page-wrapper">
        @yield('breadcrumb')
        

        <!-- Bread crumb -->
       
        <!-- End Bread crumb -->

        <!-- Container fluid -->
        <div class="container-fluid">
         
          <!-- Start Page Content -->
          <div class="row">
            <div class="col-12">

            
<!-- card -->

                @yield('content')
                @yield('card')
            </div>
          </div>
        </div>
          <!-- End Page Content -->

        </div>
        <!-- End Container fluid -->

        <!-- footer -->
        <footer class="footer text-center">
          All Rights Reserved by Matrix-admin. Designed and Developed by
          <a href="https://www.wrappixel.com">WrapPixel</a>.
        </footer>
        <!-- End footer -->
        
      </div>
      <!-- End Page wrapper -->
    </div>
    <!-- End Wrapper -->

    <!-- All Jquery -->
    <!-- ============================================================== -->

    @yield('scripts')

@include('admin.layouts.scripts')
  </body>
</html>
