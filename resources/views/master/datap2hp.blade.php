@extends('layouts.Adminlte3')

@section('header')
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('layout/adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('layout/adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('layout/adminlte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('layout/adminlte3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('layout/adminlte3/dist/css/adminlte.min.css') }}">
  
@endsection

@section('contentheader')
<h1 class="m-0">Data P2HP</h1>
@endsection

@section('contentheadermenu')
<!-- <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a class="_kembali" href="{{url('kategorisoal')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a></li>
</ol> -->
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
              <div class="btn-group">
                <span data-toggle="tooltip" data-placement="left" title="Filter Data">
                  <button data-toggle="modal" data-target="#modal-filter" type="button" class="btn btn-md btn-info">
                    <i class="fas fa-filter" aria-hidden="true"></i>
                  </button>
                </span>
                @if($filter)
                <span style="margin-left:10px" data-toggle="tooltip" data-placement="left" title="Reset Filter">
                  <a href="{{url('datap2hp')}}" class="btn btn-md btn-warning">
                      <i class="fas fa-times"></i>
                  </a>
                </span>
                @endif
                <span style="margin-left:10px" data-toggle="tooltip" data-placement="left" title="Download Data">
                  <form id="form-filter" action="{{url('downloadp2hp')}}" method="get">
                    <input type="hidden" class="form-control" name="f_file_status" value="{{app('request')->input('f_file_status')}}">
                    <input type="hidden" class="form-control" name="f_nama" value="{{app('request')->input('f_nama')}}">
                    <input type="hidden" class="form-control" name="f_tahun" value="{{app('request')->input('f_tahun')}}">
                    <input type="hidden" class="form-control" name="f_kelompok_temuan" value="{{app('request')->input('f_kelompok_temuan')}}">
                    <input type="hidden" class="form-control" name="f_nama_pj" value="{{app('request')->input('f_nama_pj')}}">
                    <input type="hidden" class="form-control" name="f_jenis_audit" value="{{app('request')->input('f_jenis_audit')}}">
                    <input type="hidden" class="form-control" name="f_ketua_tim" value="{{app('request')->input('f_ketua_tim')}}">
                    <button type="submit" class="btn btn-md btn-success">
                        <i class="fas fa-download"></i>
                    </button>
                  </form>
                </span>
                <span style="margin-left:10px" data-toggle="tooltip" data-placement="left" title="Import Data">
                  <button data-toggle="modal" data-target="#modal-import" type="button" class="btn btn-md btn-success">
                      <i class="fas fa-file-excel"></i>
                  </button>
                </span>
                <span style="margin-left:10px" data-toggle="tooltip" data-placement="left" title="Hapus Data">
                  <button type="button" class="btn-delete-all btn btn-md btn-danger">
                      <i class="fas fa-trash"></i>
                  </button>
                </span>
              </div>

              <!-- <button data-toggle="modal" data-target="#modal-tambah" type="button" class="btn btn-md btn-primary btn-absolute">Tambah</button> -->
                <table id="tabledata" class="table  table-bordered">
                  <thead>
                  <tr>
                  <th style="text-align:left"><input type="checkbox" id="checkAll" class="checkAll"> CEKLIS</th>
                    <th>UBAH</th>
                    <!-- <th>NO</th> -->
                    <th>NAMA FILE</th>
                    <th>FILE STATUS</th>
                    <th>NAMA AUDITAN/OPD/DESA</th>
                    <th>TAHUN ANGGARAN</th>
                    <th>PAGU ANGGARAN YANG DIAWASI</th>
                    <th>KONDISI (TEMUAN)</th>
                    <th>KELOMPOK TEMUAN</th>
                    <th>NILAI TEMUAN</th>
                    <th>(CALON/RENCANA) REKOMENDASI</th>
                    <th>NAMA PENANGGUNG JAWAB (PJ) PENGEMBALIAN</th>
                    <th>JABATAN PJ PENGEMBALIAN DALAM TAHUN ANGGARAN TERPERIKSA</th>
                    <th>JENIS AUDIT/REVIU/EVALUASI</th>
                    <th>No. PKP</th>
                    <th>KETUA TIM</th>
                    <th>TANGGAL P2HP</th>
                    <th>NOMOR SURAT TUGAS</th>
                    <th>KETERANGAN LAIN DAN LINK FILE PENDUKUNG</th>
                    <th>CREATED_AT</th>
                    <th>CREATED_BY</th>
                    <th>UPDATED_AT</th>
                    <th>UPDATED_BY</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $key)
                  <tr>
                    <td width="1%" class="">
                        <input type="checkbox" name="id_master_soal" class="checkbox" value="{{$key->id}}">
                    </td>
                    <td width="1%" class="_align_center">
                      <div class="btn-group">
                        <span data-toggle="tooltip" data-placement="left" title="Ubah Data">
                          <button data-toggle="modal" data-target="#modal-edit-{{$key->id}}" type="button" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></button>
                        </span>
                      </div>
                    </td>
                    <!-- <td width="1%">{{$loop->iteration}}</td> -->
                    <td width="1%">{{$key->nama_file}}</td>
                      <!-- <td width="1%">
                        @if($key->status==1)
                        <button iddata="{{$key->id}}" status="0" style="white-space:nowrap;" class="btn_ubah_status btn btn-md btn-danger"><i class="fa fa-close" aria-hidden="true"></i> Hapus Tanda</button>
                        @else
                        <button iddata="{{$key->id}}" status="1" style="white-space:nowrap;" class="btn_ubah_status btn btn-md btn-info"><i class="fa fa-check" aria-hidden="true"></i> Tandai</button>
                        @endif
                      </td> -->
                    <td width="1%" class="_white_space _align_center">{{$key->file_status}}</td>
                    <td width="1%" class="_white_space">{{$key->nama}}</td>
                    <td width="1%" class="_white_space _align_center">{{$key->tahun}}</td>
                    <td width="1%" class="_align_right">{{formatRupiah($key->pagu_anggaran)}}</td>
                    <td width="1%">{{$key->kondisi_temuan}}</td>
                    <td width="1%">{{$key->kelompok_temuan}}</td>
                    <td width="1%" class="_align_right">{{formatRupiah($key->nilai_temuan)}}</td>
                    <td width="1%">{{$key->rekomendasi}}</td>
                    <td width="1%" class="_white_space">{{$key->nama_pj}}</td>
                    <td width="1%">{{$key->jabatan_pj_terperiksa}}</td>
                    <td width="1%" class="_white_space _align_center">{{$key->jenis_audit}}</td>
                    <td width="1%">{{$key->no_pkp}}</td>
                    <td width="1%" class="_white_space _align_center">{{$key->ketua_tim}}</td>
                    <td width="1%" class="_white_space _align_center">{{$key->tgl_p2hp}}</td>
                    <td width="1%" class="_white_space _align_center">{{$key->no_surat}}</td>
                    <td width="1%">{{$key->ket}}</td>
                    <td width="1%" class="_white_space _align_center">{{waktuIndo($key->created_at)}}</td>
                    <td width="1%" class="_white_space _align_center">{{$key->c_by_r ? $key->c_by_r->name : ""}}</td>
                    <td width="1%" class="_white_space _align_center">{{$key->updated_at==$key->created_at ? "" : waktuIndo($key->updated_at)}}</td>
                    <td width="1%" class="_white_space _align_center">{{$key->u_by_r ? $key->u_by_r->name : ""}}</td>
                  </tr>
                  @endforeach
                  @if(count($data)>0)
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="_white_space _align_right _bold">{{formatRupiah($data->sum('nilai_temuan'))}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  @endif
                  </tbody>
                  
                  <!-- <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </tfoot> -->
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5><b>SUM</b></h5>
                <h6>Nilai Temuan : <b>{{formatRupiah($data->sum('nilai_temuan'))}}</b></h6>
              </div>
            </div>
          </div>

        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @foreach($data as $key)                   
    <!-- Modal Edit -->
    <div class="modal fade" id="modal-edit-{{$key->id}}">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Ubah Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" id="formData_{{$key->id}}" class="form-horizontal">
            @csrf
            <input type="hidden" value="{{$key->id}}" name="iddata[]">
            <div class="modal-body">
              <!-- <div class="card-body"> -->
                 <div class="form-group">
                    <label for="ket_{{$key->id}}">KETERANGAN LAIN DAN LINK FILE PENDUKUNG</label>
                    <textarea name="ket[]" id="ket_{{$key->id}}" rows="5" class="form-control" placeholder="KETERANGAN LAIN DAN LINK FILE PENDUKUNG">{{$key->ket}}</textarea>  
                    <!-- <textarea name="ket[]" id="ket_{{$key->id}}" rows="5" class="form-control content_" placeholder="Keterangan">{{$key->ket}}</textarea>   -->
                </div> 
                <!-- /.form-group -->
              <!-- </div> -->
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <label class="ket-bintang">Bertanda <span class="bintang">*</span> Wajib diisi</label>
                <button type="submit" class="btn btn-danger btn-ubah-data" idform="{{$key->id}}">Simpan</button>
            </div>
          </form>
        </div>
      <!-- /.modal-content -->
      </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal edit -->
    @endforeach

    <!-- Modal Filter -->
<div class="modal fade" id="modal-filter">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Filter Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-filter" action="{{url('datap2hp')}}" method="get">
        <div class="modal-body">
          <!-- Filter -->
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                <label for="f_file_status">FILE STATUS</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mb-3">
                <input type="text" class="form-control" id="f_file_status" name="f_file_status" placeholder="Filter Data" value="{{app('request')->input('f_file_status')}}">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                <label for="f_nama">NAMA AUDITAN/OPD/DESA</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mb-3">
                <input type="text" class="form-control" id="f_nama" name="f_nama" placeholder="Filter Data" value="{{app('request')->input('f_nama')}}">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                <label for="f_tahun">TAHUN ANGGARAN</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mb-3">
                <input type="text" class="form-control" id="f_tahun" name="f_tahun" placeholder="Filter Data" value="{{app('request')->input('f_tahun')}}">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                <label for="f_kelompok_temuan">KELOMPOK TEMUAN</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mb-3">
                <input type="text" class="form-control" id="f_kelompok_temuan" name="f_kelompok_temuan" placeholder="Filter Data" value="{{app('request')->input('f_kelompok_temuan')}}">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                <label for="f_nama_pj">NAMA PENANGGUNG JAWAB (PJ) PENGEMBALIAN</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mb-3">
                <input type="text" class="form-control" id="f_nama_pj" name="f_nama_pj" placeholder="Filter Data" value="{{app('request')->input('f_nama_pj')}}">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                <label for="f_jenis_audit">JENIS AUDIT/REVIU/EVALUASI</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mb-3">
                <input type="text" class="form-control" id="f_jenis_audit" name="f_jenis_audit" placeholder="Filter Data" value="{{app('request')->input('f_jenis_audit')}}">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                <label for="f_ketua_tim">KETUA TIM</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mb-3">
                <input type="text" class="form-control" id="f_ketua_tim" name="f_ketua_tim" placeholder="Filter Data" value="{{app('request')->input('f_ketua_tim')}}">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="_align_right">
              <div class="btn-group">
                <button class="btn btn-md btn-primary" type="submit"><i class="fas fa-filter" aria-hidden="true"></i> Filter Sekarang</button>
              </div>
              
            </div>
          </div>
          </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal filter -->

<!-- Modal Import -->
<div class="modal fade" id="modal-import">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Import Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" id="_formDataImport" class="form-horizontal" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
              <!-- <div class="card-body"> -->
              <div class="form-group">
                <label>Download Template Excel <a href="{{asset('document/P2HP.xlsx')}}">disini</a></label>
              </div>
              <!-- <input type="hidden" name="idkategori" value=""> -->
              <div class="form-group row">
                <label class="col-sm-12 col-form-label">File Excel <span class="input-keterangan">(.xlsx/.xls)</span></label>
                <div class="col-sm-12">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="input-file" id="fileexcel" name="fileexcel" idlabel="label-fileexcel">
                      <label id="label-fileexcel" class="custom-file-label" style="border-radius: .25rem;" for="fileexcel">Choose file</label>
                    </div>
                  </div> 
                </div>
              </div>
              <!-- <div class="card-body"> -->
              <!-- /.form-group -->
            <!-- </div> -->
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <label class="ket-bintang">Bertanda <span class="bintang">*</span> Wajib diisi</label>
              <button type="submit" class="btn btn-danger">Import</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal import -->

<!-- Modal Hapus All-->
    <div class="modal fade" id="modal-hapus-all">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Konfirmasi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" id="formHapusAll" class="form-horizontal">
            @csrf
            <div class="modal-body">
                <h6> Apakah anda yakin ingin menghapus data terpilih?</h6>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger btn-hapus-all">Hapus</button>
            </div>
          </form>
        </div>
      <!-- /.modal-content -->
      </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.Modal Hapus -->

@endsection

@section('footer')
<!-- Custom Input File -->
<script src="{{ asset('layout/adminlte3/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- jQuery -->
<script src="{{ asset('layout/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('layout/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('layout/adminlte3/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('layout/adminlte3/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('layout/adminlte3/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('layout/adminlte3/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('layout/adminlte3/dist/js/demo.js') }}"></script>
<!-- Page specific script -->
<!-- DatePicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/themes/dark.css">
<!--  Flatpickr  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
<!-- Tinymce -->
<script src="https://cdn.tiny.cloud/1/6yq8fapml30gqjogz5ilm4dlea09zn9rmxh9mr8fe907tqkj/tinymce/4/tinymce.min.js"></script>
<script>
  $(document).ready(function(){
    $(".btn-delete-all").on('click',function(){
      if ($('.checkbox:checked').length <= 0) {
        Swal.fire({
          html: 'Belum ada data terpilih',
          icon: 'warning',
          showConfirmButton: true
        });
      }else{        
        $("#modal-hapus-all").modal('show');
      }
    });

    $(".checkAll").on('change',function(){
      $(".checkbox").prop('checked',$(this).is(":checked"));
    });

    $(".checkbox").on('change',function(){
      if ($('.checkbox:checked').length == $('.checkbox').length) {
        document.getElementById('checkAll').checked = true;
      }else{
        document.getElementById('checkAll').checked = false;
      }
    });

    bsCustomFileInput.init();
    $(document).on('change', '.input-file', function (e) {
        var idphoto = $(this).attr('id');
        onlyExcel(idphoto);
    });
    tinymce.init({
        selector: ".content_", theme: "modern",
        plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor"
        ],
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
        toolbar2: " | link unlink anchor | image media | forecolor backcolor  | print preview code ",
        image_advtab: true,
        height : "250",
        file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        /*
          Note: In modern browsers input[type="file"] is functional without
          even adding it to the DOM, but that might not be the case in some older
          or quirky browsers like IE, so you might want to add it to the DOM
          just in case, and visually hide it. And do not forget do remove it
          once you do not need it anymore.
        */

        input.onchange = function () {
          var file = this.files[0];

          var reader = new FileReader();
          reader.onload = function () {
            /*
              Note: Now we need to register the blob in TinyMCEs image blob
              registry. In the next release this part hopefully won't be
              necessary, as we are looking to handle it internally.
            */
            var id = 'blobid' + (new Date()).getTime();
            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);

            /* call the callback and populate the Title field with the file name */
            cb(blobInfo.blobUri(), { title: file.name });
          };
          reader.readAsDataURL(file);
        };

        input.click();
      }
    });

    $(".int").on('input paste', function () {
      hanyaAngkaAndMinus(this);
    });

    // bsCustomFileInput.init();
    datatablemastersoalpil("tabledata");

    //Initialize Select2 Elements
    // $('.select2bs4').select2({
    //   placeholder: "Jenis",
    //   allowClear: true,
    //   theme: 'bootstrap4'
    // })

    // $(document).on('change', '.input-photo', function (e) {
    //     var idphoto = $(this).attr('id');
    //     onlyPhoto(idphoto);
    // });

      //Fungsi Hapus Data
   $(document).on('click', '.btn_ubah_status', function (e) {
        status = $(this).attr('status');
        iddata = $(this).attr('iddata');

        var url = "{{ url('/ubahstatus') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: "POST",
              data:{
                iddata: iddata,
                status: status
              },
              dataType: "json",
              cache: false,
            beforeSend: function () {
                $.LoadingOverlay("show");
            },
            success: function (response) {
                    if (response.status == true) {
                      Swal.fire({
                          html: response.message,
                          icon: 'success',
                          showConfirmButton: false
                        });
                        reload(1000);
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
    });

    //Fungsi Hapus Data All
      $(document).on('click', '.btn-hapus-all', function (e) {
        var iddata = [];
        $("input:checkbox[name=id_master_soal]:checked").each(function() {
          iddata.push($(this).val());
        });
        var url = "{{ url('/hapusdatap2hpall') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'POST',
            dataType: "JSON",
            data: {"iddata":iddata},
            beforeSend: function () {
                $.LoadingOverlay("show");
            },
            success: function (response) {
                    if (response.status == true) {
                      Swal.fire({
                          html: response.message,
                          icon: 'success',
                          showConfirmButton: false
                        });
                        reload(1000);
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
    });

    //Fungsi Hapus Data
    // $(document).on('click', '.btn-hapus', function (e) {
    //     idform = $(this).attr('idform');
    //     var formData = new FormData($('#formHapus_' + idform)[0]);

    //     var url = "{{ url('/hapusmastersoal') }}/"+idform;
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         url: url,
    //         type: 'POST',
    //         dataType: "JSON",
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         beforeSend: function () {
    //             $.LoadingOverlay("show");
    //         },
    //         success: function (response) {
    //                 if (response.status == true) {
    //                   Swal.fire({
    //                       html: response.message,
    //                       icon: 'success',
    //                       showConfirmButton: false
    //                     });
    //                     reload(1000);
    //                 }else{
    //                   Swal.fire({
    //                       html: response.message,
    //                       icon: 'error',
    //                       confirmButtonText: 'Ok'
    //                   });
    //                 }
    //         },
    //         error: function (xhr, status) {
    //             alert('Error!!!');
    //         },
    //         complete: function () {
    //             $.LoadingOverlay("hide");
    //         }
    //     });
    // });
    

     // Fungsi Ubah Data
     $(document).on('click', '.btn-ubah-data', function (e) {
        idform = $(this).attr('idform');
        $('#formData_'+idform).validate({
          ignore: ".ignore",
          rules: {
            'soal[]': {
              required: true
            }
          },
          messages: {
            'soal[]': {
              required: "Soal tidak boleh kosong"
            }
          },
          errorElement: 'span',
          errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
            Swal.fire({
              html: "Harap isi kolom dengan bertanda *",
              icon: 'warning',
              showConfirmButton: true
            });
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
          },

          submitHandler: function () {
          
            var formData = new FormData($('#formData_'+idform)[0]);

            var url = "{{ url('/updatep2hp') }}";
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
                    $.LoadingOverlay("show");
                },
                success: function (response) {
                    if (response.status == true) {
                        Swal.fire({
                          html: response.message,
                          icon: 'success',
                          showConfirmButton: false
                        });
                        reload(1000);
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
          }
        });
    });

    // Fungsi Add Data
    $('#_formData').validate({
          ignore: ".ignore",
          rules: {
            tingkat_add:{
              required: true
            },
            soal_add: {
              required: true
            },
            a_add: {
              required: true
            },
            b_add: {
              required: true
            },
            c_add: {
              required: true
            },
            d_add: {
              required: true
            },
            e_add: {
              required: true
            },
            jawaban_add: {
              required: true
            },
            pembahasan_add: {
              required: true
            },
            point_a_add: {
              required: true
            },
            point_b_add: {
              required: true
            },
            point_c_add: {
              required: true
            },
            point_d_add: {
              required: true
            },
            point_e_add: {
              required: true
            }
          },
          messages: {
            tingkat_add: {
              required: "Tingkat kesulitan tidak boleh kosong"
            },
            soal_add: {
              required: "Soal tidak boleh kosong"
            },
            a_add: {
              required: "Pilihan A tidak boleh kosong"
            },
            b_add: {
              required: "Pilihan B tidak boleh kosong"
            },
            c_add: {
              required: "Pilihan C tidak boleh kosong"
            },
            d_add: {
              required: "Pilihan D tidak boleh kosong"
            },
            e_add: {
              required: "Pilihan E tidak boleh kosong"
            },
            jawaban_add: {
              required: "Jawaban tidak boleh kosong"
            },
            pembahasan_add: {
              required: "Pembahasan tidak boleh kosong"
            },
            point_a_add: {
              required: "Point Pilihan A tidak boleh kosong"
            },
            point_b_add: {
              required: "Point Pilihan A tidak boleh kosong"
            },
            point_c_add: {
              required: "Point Pilihan A tidak boleh kosong"
            },
            point_d_add: {
              required: "Point Pilihan A tidak boleh kosong"
            },
            point_e_add: {
              required: "Point Pilihan A tidak boleh kosong"
            }
          },
          errorElement: 'span',
          errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
            Swal.fire({
              html: "Harap isi kolom dengan bertanda *",
              icon: 'warning',
              showConfirmButton: true
            });
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
          },

          submitHandler: function () {
          
            var formData = new FormData($('#_formData')[0]);

            var url = "{{ url('storemastersoal') }}";
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
                    $.LoadingOverlay("show");
                },
                success: function (response) {
                    if (response.status == true) {
                        Swal.fire({
                          html: response.message,
                          icon: 'success',
                          showConfirmButton: false
                        });
                        reload(1000);
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
          }
      });

    // Fungsi Add Data Excel
    $('#_formDataImport').validate({
          rules: {
            fileexcel: {
              required: true
            }
          },
          messages: {
            fileexcel: {
              required: "File excel tidak boleh kosong"
            }
          },
          errorElement: 'span',
          errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.input-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
          },

          submitHandler: function () {
          
            var formData = new FormData($('#_formDataImport')[0]);

            var url = "{{ url('/importp2hp') }}";
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
                    $.LoadingOverlay("show");
                },
                success: function (response) {
                    if (response.status == true) {
                        Swal.fire({
                          html: response.message,
                          icon: 'success',
                          showConfirmButton: false
                        });
                        reload(1000);
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
          }
      });

  });
</script>

@endsection