<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
<div class="bg-secondary p-4" style="position:fixed;bottom:0px;width:100%">
  <a style="text-align: right;" class="text-white dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
    <!-- <i class="ti-power-off text-primary"></i> -->
    <i class="fa fa-sign-out" aria-hidden="true"></i>
    Logout
  </a>
</div>


<!-- jQuery -->
<script src="{{ asset('layout/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('layout/adminlte3/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('layout/adminlte3/plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- Loading Overlay -->
<script src='https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js'></script>
 <!-- SweetAlert2 -->
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <!-- Global -->
<script src="{{ asset('js/global.js') }}"></script>