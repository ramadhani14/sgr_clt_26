<!DOCTYPE html>
<html lang="en">
@include('layouts.header')
<body>
  
<div class="container-fluid">

  <div class="row" style="align-items:center">
    <div class="col-sm-6">
      <div class="p-5">
        <center><h1 class="mb-3" style="color:#28429f">Pencarian Data</h1></center>
        <form method="get" action="{{url('caridata')}}" id="formData" class="form-horizontal">
            @csrf
            <h5 for="">Keyword Utama</h5>
            <input type="text" class="mb-4 form-control form-control-lg" placeholder="Keyword Utama" name="keyword" required>
            <h5 for="">Keyword Kolom</h5>
            <input type="text" class="mb-4 form-control form-control-lg" placeholder="Keyword Kolom" name="kolom">
            <h5 for="">Keyword Row</h5>
            <input type="text" class="mb-4 form-control form-control-lg" placeholder="Keyword Row" name="row">
            <button type="submit" style="width:100%" class="mt-3 btn btn-primary btn-lg btn-block">Cari</button>
         </form>  
        
    </div>
    <!-- <p>The columns will automatically stack on top of each other when the screen is less than 576px wide.</p> -->
    </div>
    <div class="col-sm-6"><img src="{{ asset('image/global/cari.png') }}" alt="" width="100%"></div>
  </div>
</div>

@include('layouts.footer')

<script>
  $(document).ready(function(){
    $('.kolom').select2({
      placeholder: "Pilih Kolom"
    });
  });
  </script>

</body>
</html>
