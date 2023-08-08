<head>
  @php
    $template = App\Models\Template::where('id','<>','~')->first();
  @endphp
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>{{$template->nama}}</title>
  <link href="{{asset($template->logo_kecil)}}" rel="icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('layout/adminlte3/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('layout/adminlte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    

  <style>
    /* SELECT 2 */
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        margin-top: 9px !important;
    }
    .select2-container .select2-selection--single {
        border-radius:0.5rem;
        border:0px solid transparent;
        font-size: 1.25rem;
    }
    .select2 .select2-selection{
        text-align:left;
        padding-left:0.5rem;
        background:lightgray;
    }
    .select2-container .select2-selection--single {
        height: calc(1.5em + 1rem + 2px);
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 2.5;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
    margin-top:5px;
    }
    .select2-container{
    width:100%;
    }
     .select2-error .select2-container--default{
        border: 1px solid #dc3545 !important;
    }
    .select2-error .select2-container--default{
    border: 1px solid #dc3545 !important;
    border-radius: 4px !important;
    }
    .select2-error .select2-selection--single{
    border: none !important;
}
    .btn-orange{
      background:orange;
    }
    .text-orange{
      color:orange;
    }
    input{
      background: lightgray !important;
    }
    @media(max-width: 768px){
      .col-sm-6{
        padding:0px;
        /* margin:0px !important; */
      }
    }
  </style>
</head>