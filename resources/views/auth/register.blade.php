<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
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
  <script src="{{ asset('js/global.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/skydash.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.css" integrity="sha512-uHuCigcmv3ByTqBQQEwngXWk7E/NaPYP+CFglpkXPnRQbSubJmEENgh+itRDYbWV0fUZmUz7fD/+JDdeQFD5+A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    .input-foto-error .custom-file-label{
      border: 1px solid red;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-6 mx-auto">
            <div class="brand-logo">
              <a href="{{url('/')}}"><img src="{{asset($template->logo_kecil)}}" alt="logo"></a>
            </div>
            <center>
              <h4><b>Daftar Akun</b></h4>
            </center>
            <div class="auth-form-light text-left py-5 px-4 px-sm-5 mt-4">
              <form class="pt-3" method="post" id="formRegister">
              @csrf
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Nama</label>
                      <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Masukkan Nama">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Nomor Telepon/Whatsapp</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text form-control-sm" style="border-top-left-radius:10px;border-bottom-left-radius:10px">+62</span>
                        </div>
                        <input style="border-top-left-radius:0px !important;border-bottom-left-radius:0px !important" type="text" class="form-control form-control-sm angka" id="no_wa" name="no_wa" placeholder="Masukkan Nomor Telepon/Whatsapp" aria-label="Masukkan Nomor Telepon/Whatsapp">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Email</label>
                      <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Masukkan Email">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Ulangi Email</label>
                      <input type="email" class="form-control form-control-sm" id="ulangi_email" name="ulangi_email" placeholder="Ulangi Email">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Masukkan Password</label>
                      <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Masukkan Password">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Ulangi Password</label>
                      <input type="password" class="form-control form-control-sm" id="ulangi_password" name="ulangi_password" placeholder="Ulangi Password">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Provinsi</label>
                        <select class="form-control form-control-sm _select2" id="provinsi" name="provinsi">
                          <option value=""></option>
                          @foreach($provinsi as $data)
                          <option value="{{$data->id_prov}}">{{$data->nama}}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Kota/Kabupaten</label>
                      <select class="form-control form-control-sm _select2" id="kabupaten" name="kabupaten">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                  <!-- <div class="col-lg-6">
                      <div class="form-group">
                        <label for="">Kecamatan</label>
                        <select class="form-control form-control-sm _select2" id="kecamatan" name="kecamatan">
                          <option value=""></option>
                        </select>
                      </div>
                  </div> -->
                  <!-- <div class="col-lg-6">
                    
                  </div> -->
                </div>
                <div class="form-group">
                  <label for="">Darimana tahu tryoutasn?</label>
                  <select class="form-control form-control-sm" id="referrer" name="referrer">
                  <option value=""></option>
                    @foreach(referrer() as $refer)
                    <option value="{{$refer[0]}}">{{$refer[1]}}</option>
                    @endforeach
                  </select>
                </div>
                
               
                <!-- <div class="form-group">
                    <textarea id="alamat" name="alamat" cols="30" rows="5" class="form-control form-control-lg" placeholder="Alamat Lengkap"></textarea>
                </div>
               
                
               
               
               
                <div class="form-group">
                  <select class="form-control form-control-lg" id="jenis_kelamin" name="jenis_kelamin">
                  <option value=""></option>
                    <option value="l">Laki-laki</option>
                    <option value="p">Perempuan</option>
                  </select>
                </div> -->

                <!-- <div class="form-group">
                  <select class="form-control form-control-lg" id="asal" name="asal">
                  <option value=""></option>
                    <option value="1">Sekolah</option>
                    <option value="2">Kampus</option>
                    <option value="3">Instansi</option>
                  </select>
                </div>

                <div class="form-group">
                  <select class="form-control form-control-lg" id="jenjang" name="jenjang">
                  <option value=""></option>
                    <option value="1">SD/Sederajat</option>
                    <option value="2">SMP/Sederajat</option>
                    <option value="3">SMA/Sederajat</option>
                    <option value="4">Mahasiswa</option>
                    <option value="5">Guru</option>
                  </select>
                </div>

                <label class="col-form-label">Scan Kartu Tanda Siswa/Mahasiswa/Guru<br><span class="input-keterangan">(jpg/jpeg/png)</span></label>
                <div class="form-group" style="align-items:center">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="input-foto" id="photo" name="photo" idlabel="label-photo">
                        <label id="label-photo" class="custom-file-label" style="border-radius: .25rem;" for="photo">Choose file</label>
                      </div>
                    </div> 
                </div> -->
                <div class="mb-4">
                  <div class="form-check">
                    <!-- <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      I agree to all Terms & Conditions
                    </label> -->
                  </div>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="">Daftar</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Sudah punya akun? <a href="{{url('login')}}" class="text-primary">Masuk Sekarang</a>
                </div>
              </form>
            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha512-NqYds8su6jivy1/WLoW8x1tZMRD7/1ZfhWG/jcRQLOzV1k1rIODCpMgoBnar5QXshKJGV7vi0LXLNXPoFsM5Zg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.js" integrity="sha512-GkPcugMfi6qlxrYTRUH4EwK4aFTB35tnKLhUXGLBc3x4jcch2bcS7NHb9IxyM0HYykF6rJpGaIJh8yifTe1Ctw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/themes@5.0.11/minimal/minimal.css"> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Global -->
<script src="{{ asset('js/global.js') }}"></script>
<!-- Custom Input File -->
<script src="{{ asset('layout/adminlte3/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script>
    $(document).ready(function(){
        // $('#jenis_kelamin').select2({
        //     placeholder: "Jenis Kelamin"
        // });
        $('#referrer').select2({
            placeholder: "Pilih Referrer"
        });
        // $('#jenjang').select2({
        //     placeholder: "Jenjang"
        // });

        // bsCustomFileInput.init();
        
        // $(document).on('change', '.input-foto', function (e) {
        //     var idphoto = $(this).attr('id');
        //     onlyPhoto(idphoto);
        // });

        // $('#kecamatan').select2({
        //     placeholder: "Pilih Kecamatan"
        // });
        getSemuaKota('provinsi','kabupaten','{{ url("/getKabupaten") }}','{{asset("/image/global/loading.gif")}}');

        // getKabupaten('provinsi','kabupaten','kecamatan','{{ url("/getKabupaten") }}','{{asset("/image/global/loading.gif")}}');
        // getKecamatan('kabupaten','kecamatan','{{ url("/getKecamatan") }}','{{asset("/image/global/loading.gif")}}');

        // Int
        $(".angka").on('input paste', function () {
          hanyaAngka(this);
        });
        // $('._nice_select').niceSelect();
        $('#formRegister').validate({
            rules: {
              name: {
                  required: true
              },
              no_wa: {
                  required: true,
                  minlength:10,
                  maxlength:15
              },
              email: {
                  required: true,
                  email:true
              },
              ulangi_email: {
                  email:true,
                  required: true,
                  equalTo : "#email"
              },
              password: {
                  required: true,
                  minlength:4
              },
              ulangi_password: {
                  required: true,
                  equalTo : "#password"
              },
              provinsi: {
                  required: true
              },
              kabupaten: {
                  required: true
              },
              referrer: {
                  required: true
              }
            },
            messages: {
              name: {
                  required: "Nama tidak boleh kosong"
              },
              no_wa: {
                required: "Nomor telepon/whatsapp tidak boleh kosong",
                minlength: "Masukkan nomor yang benar",
                maxlength: "Masukkan nomor yang benar"
              },
              email: {
                  required: "Email tidak boleh kosong",
                  email: "Masukkan email yang benar"
              },
              ulangi_email: {
                  equalTo: "Ulangi email harus sama",
                  required: "Ulangi email tidak boleh kosong",
                  email: "Masukkan email yang benar"
              },
              password: {
                  required: "Password tidak boleh kosong",
                  minlength: "Masukkan minimal 4 character"
              },
              ulangi_password: {
                required: "Ulangi password tidak boleh kosong",
                equalTo: "Ulangi password harus sama"
              },
              provinsi: {
                  required: "Provinsi tidak boleh kosong"
              },
              kabupaten: {
                  required: "Kota/Kabupaten tidak boleh kosong"
              },
              referrer: {
                  required: "Referrer tidak boleh kosong"
              },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                if (element.hasClass('select')) {     
                    element.parent().addClass('select2-error');
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                }else if (element.hasClass('input-foto')){
                    element.parent().addClass('input-foto-error');
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                }else {                                      
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                if(element.tagName.toLowerCase()=='select'){
                var x = element.getAttribute('id');
                $('#'+x).parent().addClass('select2-error');
                }else if(element.tagName.toLowerCase()=='input'){
                var x = element.getAttribute('class');
                var z = element.getAttribute('id');
                if(x=="input-foto is-invalid"){
                    $('#'+z).parent().addClass('input-foto-error');
                }
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                if(element.tagName.toLowerCase()=='select'){
                var x = element.getAttribute('id');
                $('#'+x).parent().removeClass('select2-error');
                }else if(element.tagName.toLowerCase()=='input'){
                var x = element.getAttribute('class');
                var z = element.getAttribute('id');
                if(x=="input-foto"){
                    $('#'+z).parent().removeClass('input-foto-error');
                }
                }
            },

            submitHandler: function () {
              var formData = new FormData($('#formRegister')[0]);

              var url = "{{ url('/storeregister') }}";
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
                              reload_url(3000,"{{url('/login')}}");
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
