<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @php
    $template = App\Models\Template::where('id','<>','~')->first();
  @endphp
  <title>{{$template->nama}}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('layout/skydash/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('layout/skydash/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('layout/skydash/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('layout/skydash/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset($template->logo_kecil)}}" />
  <link rel="stylesheet" href="{{ asset('css/skydash.css') }}">
</head>

<body>
  <div class="container-scroller">
    <div class="">
      <div class="align-items-center auth">
        <div class="row">
          <div class="col-md-5 col-lg-5">
            <!-- <div class="brand-logo mb-2">
              <a href="{{url('/')}}"><img src="{{asset($template->logo_kecil)}}" alt="logo"></a>
            </div> -->
            <center class="mt-5">
              <h2 class="text-success" style="font-family: sans-serif;"><b>{{$template->nama}}</b></h2>
            </center>
            <div class="text-left py-3 px-4 px-sm-5 mt-2 mb-5">
              @if($errors->any())
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{$errors->first()}}
              </div>
              @endif
              <form class="pt-3" method="post" id="formLogin">
              @csrf
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control form-control-sm" id="username" name="username" placeholder="Masukkan Email">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Masukkan Password">
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <!-- <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Ingat Saya
                    </label>
                  </div>
                  <a href="{{url('lupapassword')}}" class="auth-link text-black">Lupa password?</a> -->
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-success btn-sm font-weight-medium auth-form-btn">Masuk</button>
                  <!-- <a href="{{url('auth/google')}}" class="btn btn-block btn-primary btn-sm font-weight-medium auth-form-btn">LOOGIN GOOGLE</a> -->
                  <!-- <a href="{{url('auth/google')}}" type="button" class="btn btn-block btn-google auth-form-btn">
                    <i class="ti-google mr-2"></i>Masuk dengan Google
                  </a> -->
                </div>
                <!-- <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook mr-2"></i>Connect using facebook
                  </button>
                </div> -->
                <!-- <div class="text-center mt-4 font-weight-light">
                  Belum punya akun? <a href="{{url('buatakun')}}" class="text-primary">Daftar dulu, yuk !</a>
                </div> -->
              </form>
            </div>
          </div>
          <div class="col-md-7 col-lg-7">
              <img class="mb-3" src="{{ $template->banner ? asset($template->banner) : asset('image/global/login.png') }}" alt="" width="100%">
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('layout/skydash/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('layout/skydash/js/off-canvas.js') }}"></script>
  <script src="{{ asset('layout/skydash/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('layout/skydash/js/template.js') }}"></script>
  <script src="{{ asset('layout/skydash/js/settings.js') }}"></script>
  <script src="{{ asset('layout/skydash/js/todolist.js') }}"></script>
  <!-- endinject -->

  <!-- jQuery -->
<script src="{{ asset('layout/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('layout/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('layout/adminlte3/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- AdminLTE App -->
<!-- <script src="{{ asset('layout/adminlte3/dist/js/adminlte.min.js') }}"></script> -->

<!-- Loading Overlay -->
<script src='https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js'></script>
<!-- SweetAlert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/themes@5.0.11/minimal/minimal.css"> -->
<!-- Global -->
<script src="{{ asset('js/global.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#formLogin').validate({
            rules: {
            username: {
                required: true,
                email: true
            },
            password: {
                required: true
            },
            },
            messages: {
            username: {
                required: "Email tidak boleh kosong",
                email: "Masukkan email yang benar!"
            },
            password: {
                required: "Password tidak boleh kosong"
            },
        
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            },

            submitHandler: function () {
              var formData = new FormData($('#formLogin')[0]);

              var url = "{{ url('userauth') }}";
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  url: url,
                  type: 'POST',
                  dataType: "JSON",
                  data: formData,
                  contentType: false,
                  processData: false,
                  beforeSend: function () {
                      // $.LoadingOverlay("show");
                      $.LoadingOverlay("show", {
                          image       : "{{asset('/image/global/loading.gif')}}"
                      });
                  },
                  success: function (response) {
                      if (response.status === true) {
                      Swal.fire({
                          title: response.message,
                          icon: 'success',
                          showConfirmButton: false
                          });
                              reload_url(1000,"{{url('/home')}}");
                      }else{
                      Swal.fire({
                          title: response.message,
                          icon: 'error',
                          confirmButtonText: 'Ok',
                          showCloseButton: true,
                      });
                      }
                  },
                  error: function (xhr, status) {
                      alert('Error! Please Try Again');
                  },
                  complete: function () {
                      $.LoadingOverlay("hide");
                  }
              });   
            }
        });
    });
</script>

</body>

</html>
