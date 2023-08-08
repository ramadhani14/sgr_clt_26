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
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('layout/skydash/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('layout/skydash/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('layout/skydash/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('layout/skydash/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('layout/skydash/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('layout/skydash/js/select.dataTables.min.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('layout/skydash/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset($template->logo_kecil)}}" />
  <link rel="stylesheet" href="{{ asset('layout/skydash/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/skydash.css') }}">
  <script src="https://kit.fontawesome.com/f121295e13.js" crossorigin="anonymous"></script>

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="https://tryoutasn.com"><img src="{{asset($template->logo_besar)}}" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="https://tryoutasn.com"><img src="{{asset($template->logo_kecil)}}" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <!-- <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul> -->
        @php
          $cekdata = App\Models\Transaksi::where('fk_user_id','=',Auth::user()->id)->where('status',0)->get();
          $cekdatakeranjang = App\Models\Keranjang::where('fk_user_id','=',Auth::user()->id)->where('status',0)->get();
        @endphp
        <ul class="navbar-nav navbar-nav-right">
          <!-- <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="{{url('keranjangku')}}">
              <i class="ti-shopping-cart mx-0"></i>
              @if(count($cekdatakeranjang)>0)
              <span class="count"></span>
              @endif
            </a>
          </li> -->
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              @if(count($cekdata)>0)
              <span class="count"></span>
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifikasi</p>
              <a href="{{url('pembelian')}}" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-shopping-cart mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Transaksi</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    @if(count($cekdata)>0)
                      {{count($cekdata)}} transaksi belum dibayar
                    @else
                      Belum ada transaksi baru
                    @endif
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{ Auth::user()->photo ? asset(Auth::user()->photo) : asset('image/global/unknown_user.png') }}" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <!-- <a href="{{url('profileuser')}}" class="dropdown-item">
                <i class="ti-user text-primary"></i>
                Akun Saya
              </a> -->
              <!-- <a href="{{url('listalamat')}}" class="dropdown-item">
                <i class="ti-location-pin text-primary"></i>
                Alamat
              </a> -->
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            </div>
          </li>
          <!-- <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li> -->
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
      <div id="settings-trigger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hubungi Untuk Info Lebih Lanjut">
          <a href="https://api.whatsapp.com/send?phone={{ $template->no_hp }}&text=Halo%20Admin%20Saya%20Mau%20Bertanya" style="border-radius: 50%;" target="_blank" type="button" class="btn btn-success btn-sm btn-icon-text" style="white-space:nowrap">
          <img width="30px" src="{{asset('image/global/wa.png')}}" alt="">
          </a>
        </div>
        <!-- <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div> -->
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="{{ asset('layout/skydash/images/faces/face1.jpg') }}" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="{{ asset('layout/skydash/images/faces/face2.jpg') }}" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="{{ asset('layout/skydash/images/faces/face3.jpg') }}" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="{{ asset('layout/skydash/images/faces/face4.jpg') }}" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="{{ asset('layout/skydash/images/faces/face5.jpg') }}" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="{{ asset('layout/skydash/images/faces/face6.jpg') }}" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item {{$menu=='home' ? 'active' : '' }}">
            <a class="nav-link _nav-link" href="#" _ceklink="" _link="{{Auth::user()->user_level==3 ? url('dashboard') : url('home') }}">
              <i class="ti-home menu-icon"></i>
              <span class="menu-title">Home</span>
            </a>
          </li>
          <li class="nav-item {{$menu=='belipaketktg' ? 'active' : '' }}">
            <a class="nav-link _nav-link" href="#" _ceklink="belipaketktg" _link="{{url('belipaketktg')}}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Beli Paket</span>
            </a>
          </li>
          <li class="nav-item {{$menu=='pembelian' ? 'active' : '' }}">
            <a class="nav-link _nav-link" href="#" _ceklink="" _link="{{url('pembelian')}}">
              <i class="ti-bag menu-icon"></i>
              <span class="menu-title">Pembelian</span>
            </a>
          </li>
          <li class="nav-item {{$menu=='paketsayaktg' ? 'active' : '' }}">
            <a class="nav-link _nav-link" href="#" _ceklink="paketsayaktg" _link="{{url('paketsayaktg')}}">
              <i class="ti-folder menu-icon"></i>
              <span class="menu-title">Paket Saya</span>
            </a>
          </li>
          <li class="nav-item {{$menu=='tryout' ? 'active' : '' }}">
            <!-- <a class="nav-link _nav-link" href="#" _ceklink="tryout" _link="{{url('tryout')}}"> -->
            <a class="nav-link _nav-link" href="#" _ceklink="tryout" _link="{{url('tryout')}}">
              <i class="ti-desktop menu-icon"></i>
              <span class="menu-title">Try Out Akbar</span>
            </a>
          </li>
          <li class="nav-item {{$menu=='profiluser' ? 'active' : '' }}">
            <a class="nav-link _nav-link" href="#" _ceklink="profiluser" _link="{{url('profileuser')}}">
              <i class="ti-user menu-icon"></i>
              <span class="menu-title">Akun Saya</span>
            </a>
          </li>
          <!-- <li class="nav-item {{$menu=='hasilujian' ? 'active' : '' }}">
            <a class="nav-link _nav-link" href="#" _ceklink="" _link="{{url('hasilujian')}}">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Hasil Ujian</span>
            </a>
          </li> -->
       
          
        
        </ul>
      </nav>

      <div class="main-panel">
      @section('content')        

      @show
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">{{$template->copyright}}</span>
            <!-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span> -->
          </div>
          <!-- <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span> 
          </div> -->
        </footer> 
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- plugins:js -->
  <script src="{{ asset('layout/skydash/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('layout/skydash/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('layout/skydash/vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('layout/skydash/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('layout/skydash/js/dataTables.select.min.js') }}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('layout/skydash/js/off-canvas.js') }}"></script>
  <script src="{{ asset('layout/skydash/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('layout/skydash/js/template.js') }}"></script>
  <script src="{{ asset('layout/skydash/js/settings.js') }}"></script>
  <script src="{{ asset('layout/skydash/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('layout/skydash/js/dashboard.js') }}"></script>
  <script src="{{ asset('layout/skydash/js/Chart.roundedBarCharts.js') }}"></script>
  <script src="{{ asset('js/global.js') }}"></script>
  <script src="{{ asset('layout/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
  <script src='https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js'></script>
  <!-- jQuery -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      $(document).ready(function(){
        $("._nav-link").on('click', function () {
          link = $(this).attr('_link');
          ceklink = $(this).attr('_ceklink');
          if(ceklink=="paketsayaktg"){
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              $.ajax({
                  type: "POST",
                  dataType: "JSON",
                  url: "{{url('cekujian')}}",
                  data: "id=0",
                  async: false,
                  beforeSend: function () {
                      $.LoadingOverlay("show", {
                          image       : "{{asset('/image/global/loading.gif')}}"
                      });
                  },
                  success: function(response)
                  {
                    if (response.status === true) {
                        window.location.href = '{{url("paketsayaktg")}}';
                        return false;
                    }else{
                      
                      Swal.fire({
                        icon: 'warning',
                        html: response.message,
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Lanjutkan',
                        cancelButtonText: 'Batal',
                        denyButtonText: 'Selesaikan Ujian',
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                              window.location.href = '{{url("ujian")}}/'+response.idpaket;
                            }else if (result.isDenied){
                              // Selesaikan Ujian
                              idpaketmst = response.idpaket;
                              $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    type: "POST",
                                    dataType: "JSON",
                                    url: "{{url('selesaiujian')}}",
                                    async: false,
                                    data: {
                                      idpaketmst : idpaketmst
                                    },
                                    beforeSend: function () {
                                        $.LoadingOverlay("show", {
                                            image       : "{{asset('/image/global/loading.gif')}}"
                                        });
                                    },
                                    success: function(response)
                                    {
                                    
                                      if (response.status) {
                                          $('.modal').modal('hide');
                                            Swal.fire({
                                                html: response.message,
                                                icon: 'success',
                                                showConfirmButton: true
                                            }).then((result) => {
                                                $.LoadingOverlay("show", {
                                                  image       : "{{asset('/image/global/loading.gif')}}"
                                                });
                                                reload_url(1500,'{{url("paketsayaktg")}}');
                                            })
                                      }else{
                                          Swal.fire({
                                              html: response.message,
                                              icon: 'error',
                                              confirmButtonText: 'Ok'
                                          });
                                      }
                                    },
                                    error: function (xhr, status) {
                                          alert('Error!!!');
                                      },
                                      complete: function () {
                                          $.LoadingOverlay("hide");
                                      }
                                  });
                              // Akhir Selesaikan Ujian
                            }
                        });

                    }
              },
              error: function (xhr, status) {
                  alert('Error!!!');
              },
              complete: function () {
                $.LoadingOverlay("hide");
              }
            });
          }else{
            window.location.href = link;
            return false;
          }
        });
      });
  </script>
  <!-- End custom js for this page-->
  @section('footer')        

  @show
</body>

</html>

