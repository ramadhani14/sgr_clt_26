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
<h1 class="m-0">Data LHP</h1>
@endsection

@section('contentheadermenu')
<!-- <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a class="_kembali" href="{{url('kategorisoal')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a></li>
</ol> -->
@endsection

@section('content')
  <style>
    .mbc-3{
      /* margin-bottom: -3.5rem; */
      /* z-index:9999; */
    }
    @media(max-width: 768px){
      .mbc-3{
        margin-bottom: 1rem;
        /* text-align: center; */
        justify-content: center;
        /* align-items: center; */
        display: flex;
      } 
    }
  </style>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">

              <div class="btn-group mbc-3">
                <span data-toggle="tooltip" data-placement="left" title="Tambah Data">
                  <button data-toggle="modal" data-target="#modal-tambah" type="button" class="btn btn-md btn-info">
                    <i class="fas fa-plus" aria-hidden="true"></i>
                  </button>
                </span>
                <span style="margin-left:10px" data-toggle="tooltip" data-placement="left" title="Filter Data">
                  <button data-toggle="modal" data-target="#modal-filter" type="button" class="btn btn-md btn-info">
                    <i class="fas fa-filter" aria-hidden="true"></i>
                  </button>
                </span>
                @if($filter)
                <span style="margin-left:10px" data-toggle="tooltip" data-placement="left" title="Reset Filter">
                  <a href="{{url('datalhp')}}" class="btn btn-md btn-warning">
                      <i class="fas fa-times"></i>
                  </a>
                </span>
                @endif
                <span style="margin-left:10px" data-toggle="tooltip" data-placement="left" title="Download Data">
                  <form id="form-filter" action="{{url('downloadlhp')}}" method="get">
                    <input type="hidden" class="form-control" name="f_file_status" value="{{app('request')->input('f_file_status')}}">
                    <input type="hidden" class="form-control" name="f_nama" value="{{app('request')->input('f_nama')}}">
                    <input type="hidden" class="form-control" name="f_tahun" value="{{app('request')->input('f_tahun')}}">
                    <input type="hidden" class="form-control" name="f_kelompok_temuan" value="{{app('request')->input('f_kelompok_temuan')}}">
                    <input type="hidden" class="form-control" name="f_nama_pj" value="{{app('request')->input('f_nama_pj')}}">
                    <input type="hidden" class="form-control" name="f_jenis_audit" value="{{app('request')->input('f_jenis_audit')}}">
                    <input type="hidden" class="form-control" name="f_ketua_tim" value="{{app('request')->input('f_ketua_tim')}}">
                    <input type="hidden" class="form-control" name="f_no_lhp" value="{{app('request')->input('f_no_lhp')}}">
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
                    <th>REKOMENDASI</th>
                    <th>NAMA PENANGGUNG JAWAB (PJ) PENGEMBALIAN</th>
                    <th>JABATAN PJ PENGEMBALIAN DALAM TAHUN ANGGARAN TERPERIKSA</th>
                    <th>JABATAN/DOMISILI/KONDISI PJ PENGEMBALIAN SAAT INI</th>
                    <th>CATATAN TINDAKLANJUT</th>
                    <th>NO. SKTJM</th>
                    <th>UPDATE TL/CICILAN</th>
                    <th>SISA TEMUAN</th>
                    <th>KATEGORI (TINGKAT KESULITAN PENAGIHAN)</th>
                    <th>JENIS AUDIT</th>
                    <th>KETUA TIM</th>
                    <th>NO LHP</th>
                    <th>TANGGAL LHP</th>
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
                    <td width="1%" class="_white_space"><b>{{$key->nama_file}}</b></td>
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
                    <td width="1%" class="_white_space">{{$key->jabatan_pj_terperiksa}}</td>
                    <td width="1%" class="_white_space">{{$key->jabatan_pj_saat_ini}}</td>
                    <td width="1%">{{$key->catatan}}</td>
                    <td width="1%">{{$key->no_sktjm}}</td>
                    <td width="1%" class="_align_right">{{formatRupiah($key->update_tl)}}</td>
                    <td width="1%" class="_align_right">{{formatRupiah($key->sisa_temuan)}}</td>
                    <td width="1%">{{$key->kategori}}</td>
                    <td width="1%" class="_white_space">{{$key->jenis_audit}}</td>
                    <td width="1%" class="_white_space">{{$key->ketua_tim}}</td>
                    <td width="1%" class="_white_space">{{$key->no_lhp}}</td>
                    <td width="1%" class="_white_space _align_center">{{$key->tgl_lhp}}</td>
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
                    <td class="_white_space _align_right _bold">{{formatRupiah($data->sum('sisa_temuan'))}}</td>
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
                <h5><b>JUMLAH</b></h5>
                <h6>Nilai Temuan : <b>{{formatRupiah($data->sum('nilai_temuan'))}}</b></h6>
                <h6>Sisa Temuan : <b>{{formatRupiah($data->sum('sisa_temuan'))}}</b></h6>
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
                    <label for="catatan_{{$key->id}}">CATATAN TINDAKLANJUT</label>
                    <textarea name="catatan[]" id="catatan_{{$key->id}}" rows="5" class="form-control" placeholder="CATATAN TINDAKLANJUT">{{$key->catatan}}</textarea>  
                    <!-- <textarea name="ket[]" id="ket_{{$key->id}}" rows="5" class="form-control content_" placeholder="Keterangan">{{$key->ket}}</textarea>   -->
                </div> 

                <div class="form-group">
                    <label for="no_sktjm_{{$key->id}}">NO. SKTJM</label>
                    <input type="text" class="form-control" id="no_sktjm_{{$key->id}}" name="no_sktjm[]" placeholder="NO. SKTJM" value="{{$key->no_sktjm}}">
                </div>

                <div class="form-group">
                    <label for="update_tl_{{$key->id}}">UPDATE TL/CICILAN (Rp)</label>
                    <input type="text" class="form-control dec _align_right" id="update_tl_{{$key->id}}" name="update_tl[]" placeholder="UPDATE TL/CICILAN" value="{{formatRibuan($key->update_tl)}}">
                </div>
              
                <div class="form-group">
                    <label for="sisa_temuan_{{$key->id}}">SISA TEMUAN (Rp)</label>
                    <input type="text" class="form-control dec _align_right" id="sisa_temuan_{{$key->id}}" name="sisa_temuan[]" placeholder="SISA TEMUAN" value="{{formatRibuan($key->sisa_temuan)}}">
                </div>

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
        <form id="form-filter" action="{{url('datalhp')}}" method="get">
        <div class="modal-body">
          <!-- Filter -->
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                <label for="f_file_status">FILE STATUS</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mb-3">
                <input type="text" class="form-control" name="f_file_status" placeholder="Filter Data" value="{{app('request')->input('f_file_status')}}">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                <label for="f_nama">NAMA AUDITAN/OPD/DESA</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mb-3">
                <input type="text" class="form-control" name="f_nama" placeholder="Filter Data" value="{{app('request')->input('f_nama')}}">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                <label for="f_tahun">TAHUN ANGGARAN</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mb-3">
                <input type="text" class="form-control" name="f_tahun" placeholder="Filter Data" value="{{app('request')->input('f_tahun')}}">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                <label for="f_kelompok_temuan">KELOMPOK TEMUAN</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mb-3">
                <input type="text" class="form-control" name="f_kelompok_temuan" placeholder="Filter Data" value="{{app('request')->input('f_kelompok_temuan')}}">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                <label for="f_nama_pj">NAMA PENANGGUNG JAWAB (PJ) PENGEMBALIAN</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mb-3">
                <input type="text" class="form-control" name="f_nama_pj" placeholder="Filter Data" value="{{app('request')->input('f_nama_pj')}}">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                <label for="f_jenis_audit">JENIS AUDIT</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mb-3">
                <input type="text" class="form-control" name="f_jenis_audit" placeholder="Filter Data" value="{{app('request')->input('f_jenis_audit')}}">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                <label for="f_ketua_tim">KETUA TIM</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mb-3">
                <input type="text" class="form-control" name="f_ketua_tim" placeholder="Filter Data" value="{{app('request')->input('f_ketua_tim')}}">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                <label for="f_no_lhp">NO LHP</label>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mb-3">
                <input type="text" class="form-control" name="f_no_lhp" placeholder="Filter Data" value="{{app('request')->input('f_no_lhp')}}">
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

<!-- Modal Tambah -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="_formDataAdd" method="get">
        <div class="modal-body">
          <!-- Tambah -->
            
          <div class="form-group">
              <label for="file_status_add">FILE STATUS <span class="bintang">*</span></label>
              <input type="text" class="form-control" id="file_status_add" name="file_status_add" placeholder="Masukkan Data">
          </div>

          <div class="form-group">
              <label for="nama_add">NAMA AUDITAN/OPD/DESA</label>
              <input type="text" class="form-control" id="nama_add" name="nama_add" placeholder="Masukkan Data">
          </div>

          <div class="form-group">
              <label for="tahun_add">TAHUN ANGGARAN</label>
              <input type="text" class="form-control" id="tahun_add" name="tahun_add" placeholder="Masukkan Data">
          </div>

          <div class="form-group">
              <label for="pagu_anggaran_add">PAGU ANGGARAN YANG DIAWASI</label>
              <input type="text" class="form-control dec _align_right" id="pagu_anggaran_add" name="pagu_anggaran_add" placeholder="Masukkan Data">
          </div>

          <div class="form-group">
              <label for="kondisi_temuan_add">KONDISI (TEMUAN)</label>
              <textarea name="kondisi_temuan_add" id="kondisi_temuan_add" rows="5" class="form-control" placeholder="Masukkan Data"></textarea>  
          </div> 

          <div class="form-group">
              <label for="kelompok_temuan_add">KELOMPOK TEMUAN</label>
              <textarea name="kelompok_temuan_add" id="kelompok_temuan_add" rows="5" class="form-control" placeholder="Masukkan Data"></textarea>  
          </div> 

          <div class="form-group">
              <label for="nilai_temuan_add">NILAI TEMUAN</label>
              <input type="text" class="form-control dec _align_right" id="nilai_temuan_add" name="nilai_temuan_add" placeholder="Masukkan Data">
          </div>

          <div class="form-group">
              <label for="rekomendasi_add">REKOMENDASI</label>
              <textarea name="rekomendasi_add" id="rekomendasi_add" rows="5" class="form-control" placeholder="Masukkan Data"></textarea>  
          </div>
          
          <div class="form-group">
              <label for="nama_pj_add">NAMA PENANGGUNG JAWAB (PJ) PENGEMBALIAN</label>
              <input type="text" class="form-control" id="nama_pj_add" name="nama_pj_add" placeholder="Masukkan Data">
          </div>

          <div class="form-group">
              <label for="jabatan_pj_terperiksa_add">JABATAN PJ PENGEMBALIAN DALAM TAHUN ANGGARAN TERPERIKSA</label>
              <input type="text" class="form-control" id="jabatan_pj_terperiksa_add" name="jabatan_pj_terperiksa_add" placeholder="Masukkan Data">
          </div>

          <div class="form-group">
              <label for="jabatan_pj_saat_ini">JABATAN/DOMISILI/KONDISI PJ PENGEMBALIAN SAAT INI</label>
              <input type="text" class="form-control" id="jabatan_pj_saat_ini" name="jabatan_pj_saat_ini" placeholder="Masukkan Data">
          </div>

          <div class="form-group">
              <label for="catatan_add">CATATAN TINDAKLANJUT</label>
              <textarea name="catatan_add" id="catatan_add" rows="5" class="form-control" placeholder="Masukkan Data"></textarea>  
          </div> 

          <div class="form-group">
              <label for="no_sktjm_add">NO. SKTJM</label>
              <input type="text" class="form-control" id="no_sktjm_add" name="no_sktjm_add" placeholder="Masukkan Data">
          </div>

          <div class="form-group">
              <label for="update_tl_add">UPDATE TL/CICILAN (Rp)</label>
              <input type="text" class="form-control dec _align_right" id="update_tl_add" name="update_tl_add" placeholder="Masukkan Data">
          </div>
        
          <div class="form-group">
              <label for="sisa_temuan_add">SISA TEMUAN (Rp)</label>
              <input type="text" class="form-control dec _align_right" id="sisa_temuan_add" name="sisa_temuan_add" placeholder="Masukkan Data">
          </div>

          <div class="form-group">
              <label for="kategori_add">KATEGORI (TINGKAT KESULITAN PENAGIHAN)</label>
              <input type="text" class="form-control" id="kategori_add" name="kategori_add" placeholder="Masukkan Data">
          </div>

          <div class="form-group">
              <label for="jenis_audit_add">JENIS AUDIT</label>
              <input type="text" class="form-control" id="jenis_audit_add" name="jenis_audit_add" placeholder="Masukkan Data">
          </div>

          <div class="form-group">
              <label for="ketua_tim_add">KETUA TIM</label>
              <input type="text" class="form-control" id="ketua_tim_add" name="ketua_tim_add" placeholder="Masukkan Data">
          </div>

          <div class="form-group">
              <label for="no_lhp_add">NO LHP</label>
              <input type="text" class="form-control" id="no_lhp_add" name="no_lhp_add" placeholder="Masukkan Data">
          </div>

          <div class="form-group">
              <label for="tgl_lhp_add">TANGGAL LHP</label>
              <input type="text" class="form-control" id="tgl_lhp_add" name="tgl_lhp_add" placeholder="Masukkan Data">
          </div>

          <div class="form-group">
              <label for="ket_add">KETERANGAN LAIN DAN LINK FILE PENDUKUNG</label>
              <textarea name="ket_add" id="ket_add" rows="5" class="form-control" placeholder="Masukkan Data"></textarea>
          </div> 

          </div>
          <div class="modal-footer">
            <div class="_align_right">
              <div class="btn-group">
                <button class="btn btn-md btn-primary" type="submit">Simpan</button>
              </div>
            </div>
          </div>
          </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal tambah -->

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
                <label>Download Template Excel <a href="{{asset('document/LHP.xlsx')}}">disini</a></label>
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

    $(".dec").on('keyup input paste', function () {
      // value = inputRupiah($(this).val());
      $(this).val(inputRupiah($(this).val(),''));
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
        var url = "{{ url('/hapusdatalhpall') }}";
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

            var url = "{{ url('/updatelhp') }}";
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
    $('#_formDataAdd').validate({
          ignore: ".ignore",
          rules: {
            file_status_add:{
              required: true
            }
          },
          messages: {
            file_status_add: {
              required: "File status tidak boleh kosong"
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
          
            var formData = new FormData($('#_formDataAdd')[0]);

            var url = "{{ url('storedatalhp') }}";
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

            var url = "{{ url('/importlhp') }}";
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