    <script src="{{asset('dashboard/assets/js/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('dashboard/assets/js/bootstrap.bundle.min.js')}}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{asset('dashboard/assets/js/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('dashboard/assets/js/sparkline.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('dashboard/assets/js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{asset('dashboard/assets/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('dashboard/assets/js/custom.min.js')}}"></script>
    
    <!-- this page js -->
    <script src="{{asset('dashboard/assets/js/datatables.min.js')}}"></script>
    <script>
      /****************************************
       *       Basic Table                   *
       ****************************************/
      $("#zero_config").DataTable();
    </script>


<script>
    document.querySelectorAll('.read-more').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const p = this.previousElementSibling; // العنصر <p> قبل الزر
            
            if(p.style.maxHeight && p.style.maxHeight !== '90px') {
                // لو النص مفتوح، اقفل النص
                p.style.maxHeight = '90px';
                this.textContent = 'Read more';
            } else {
                // لو النص مقفول، افتحه كامل
                p.style.maxHeight = 'none';
                this.textContent = 'Read less';
            }
        });
    });
</script>



<script>
    if (window.history && window.history.pushState) {
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function () {
            window.history.go(1);
        };
    }
</script>

