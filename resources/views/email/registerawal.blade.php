<style>
    .tombol{
        background: #028618;
        padding: 5px 15px;
        text-decoration: none;
        color: white;
        border-radius: 4px;
    }
    .footer{
        text-align:center;padding:25px;background:lightgray;
    }
</style>
<h3>Hi, {{ $nama }} !</h3>
<p>Kamu telah mendaftar pada Divya Prestasi. Semua informasi terbaru tryoutku akan dikirimkan melalui email ini.</p>
<br>
<p>Terima Kasih</p>
<p>{{$namaweb}}</p>

<div class="footer">
    <p>Email ini adalah layanan yang disediakan oleh {{$namaweb}}</p>
    <p>©{{date("Y")}} {{$namaweb}} - {{$_SERVER['SERVER_NAME']}}</p>
</div>