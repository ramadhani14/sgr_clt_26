<!DOCTYPE html>
<html lang="en">
@include('layouts.header')
<body>
<style>
  th{
    white-space:nowrap;
  }
</style>  
<div class="container mb-5">
  <div class="row mt-5">
    <div class="col-sm-6">
     <button type="button" onclick="history.back()" class="btn btn-orange">Kembali</button>
      <div class="card mt-3">
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <h4>Info Pencarian</h4>
            </div>
            <div class="col-6" style="text-align:right">
              <!-- <a class="text-orange" href="">See Details</a> -->
            </div>
          </div>
          <p>Jumlah cell sesuai <br>Keyword="<b>{{$keyword}}</b>"<br> 
          @if($kolom)
            Kolom="<b>{{$kolom}}</b>"<br>
          @endif 

          @if($row)
            Row="<b>{{$row}}</b>"
          @endif

            <br>
            <h5 class="text-orange">{{count($data)}} Cell</h5>
          </p>
        </div>
      </div>
    <!-- <p>The columns will automatically stack on top of each other when the screen is less than 576px wide.</p> -->
    </div>
    <div class="col-sm-12 mt-5 mb-5">
    <h4>Cell ditemukan pada:</h4>
    @if(count($data)>0)
    <ul>
      @foreach($data as $key)
        <li class="mt-5">
          <div>
            <h5 class="text-danger">{{$key->nama_file}}</h5>
            <h6 class="text-warning">Sheet ke-{{$key->sheet}}</h6>
            <h6 class="text-primary">Baris ke-{{$key->baris}}</h6>
          </div>
          <div class="table-responsive">
            <table class="mt-3 table table-bordered">
              @php
                $judul = App\Models\MasterTable::find($key->is_judul);
              @endphp
              <thead>
                <tr>
                  <th>Aksi</th>
                  <th>{{$judul->c1}}</th>
                  <th>{{$judul->c2}}</th>
                  <th>{{$judul->c3}}</th>
                  <th>{{$judul->c4}}</th>
                  <th>{{$judul->c5}}</th>
                  <th>{{$judul->c6}}</th>
                  <th>{{$judul->c7}}</th>
                  <th>{{$judul->c8}}</th>
                  <th>{{$judul->c9}}</th>
                  <th>{{$judul->c10}}</th>
                  <th>{{$judul->c11}}</th>
                  <th>{{$judul->c12}}</th>
                  <th>{{$judul->c13}}</th>
                  <th>{{$judul->c14}}</th>
                  <th>{{$judul->c15}}</th>
                  <th>{{$judul->c16}}</th>
                  <th>{{$judul->c17}}</th>
                  <th>{{$judul->c18}}</th>
                  <th>{{$judul->c19}}</th>
                  <th>{{$judul->c20}}</th>
                </tr>
              </thead>
              <tbody>
               
                <tr class="{{$key->status==1 ? 'table-danger' : ''}}">
                  <td width="1%">
                    @if($key->status==1)
                    <button iddata="{{$key->id}}" status="0" style="white-space:nowrap;" class="btn_ubah_status btn btn-md btn-danger"><i class="fa fa-close" aria-hidden="true"></i> Hapus Tanda</button>
                    @else
                    <button iddata="{{$key->id}}" status="1" style="white-space:nowrap;" class="btn_ubah_status btn btn-md btn-info"><i class="fa fa-check" aria-hidden="true"></i> Tandai</button>
                    @endif
                  </td>
                  <td width="1%">{{$key->c1}}</td>
                  <td width="1%">{{$key->c2}}</td>
                  <td width="1%">{{$key->c3}}</td>
                  <td width="1%">{{$key->c4}}</td>
                  <td width="1%">{{$key->c5}}</td>
                  <td width="1%">{{$key->c6}}</td>
                  <td width="1%">{{$key->c7}}</td>
                  <td width="1%">{{$key->c8}}</td>
                  <td width="1%">{{$key->c9}}</td>
                  <td width="1%">{{$key->c10}}</td>
                  <td width="1%">{{$key->c11}}</td>
                  <td width="1%">{{$key->c12}}</td>
                  <td width="1%">{{$key->c13}}</td>
                  <td width="1%">{{$key->c14}}</td>
                  <td width="1%">{{$key->c15}}</td>
                  <td width="1%">{{$key->c16}}</td>
                  <td width="1%">{{$key->c17}}</td>
                  <td width="1%">{{$key->c18}}</td>
                  <td width="1%">{{$key->c19}}</td>
                  <td width="1%">{{$key->c20}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </li>
        @endforeach
      </ul>
      @else
      <div class="mt-5 text-danger">
        <center>Data Tidak Ditemukan</center>
      </div>
      @endif
    </div>
  </div>
</div>

@include('layouts.footer')

<script>
  $(document).ready(function(){
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

  });
</script>
</body>
</html>
