<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterProvinsi;
use App\Models\MasterKabupaten;
use App\Models\MasterKecamatan;
use App\Models\PaketSubkategori;
use App\Models\UserAlamat;
use App\Models\User;
use App\Models\Template;
use Carbon\Carbon;
use Auth;
use App\Mail\RegisterEmailAwal;
use App\Mail\RegisterEmail;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use DB;

class CampurController extends Controller
{
    public function index()
    {
        return view('utama/Home');
    }
    public function storeregister(Request $request)
    {
        $template = Template::where('id','<>','~')->first();
        $cekemail = User::where('username',$request->email)->get();
        // $ceknowa = User::where('no_wa',$request->no_wa)->get();
        if (count($cekemail)>0) {
            return response()->json([
                'status' => false,
                'message' => 'Email sudah digunakan'
            ]);
            dd('Error');
        }

        $dataemailawal = [
            'nama' => $request->name,
            'email' => $request->email,
            'namaweb' => $template->nama,
            'emailweb' => $template->email
        ];
        $mail = new RegisterEmailAwal($dataemailawal);
        Mail::to($request->email)->send($mail);

        $data['username'] = $request->email;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['no_wa'] = $request->no_wa;
        // $data['jenis_kelamin'] = $request->jenis_kelamin;
        // $data['alamat'] = $request->alamat;
        $data['provinsi'] = $request->provinsi;
        $data['kabupaten'] = $request->kabupaten;
        // $data['kecamatan'] = $request->kecamatan;
        $data['referrer'] = $request->referrer;
        // $data['jenjang'] = $request->jenjang;
        $data['user_level'] = 2;
        $data['is_active'] = 0;
        
        // if ($files = $request->file("photo")) {
        //     $destinationPath = 'upload/user/scan/';
        //     $file = 'Scan_'.Carbon::now()->timestamp. "." .$files->getClientOriginalExtension();
        //     $files->move($destinationPath, $file);
        //     $namafile = $destinationPath.$file;
        //     $data['scan'] = $destinationPath.$file;
        // }
        $data['password'] = bcrypt($request->password);
        $data['created_at'] = Carbon::now()->toDateTimeString();
        $data['updated_at'] = Carbon::now()->toDateTimeString();
        $createdata = User::create($data);
        if($createdata){
            $dataemail = [
                'id'=> Crypt::encrypt($createdata->id),
                'name' => $request->name,
                'email' => $request->email,
                'namaweb' => $template->nama,
                'emailweb' => $template->email
            ];
            $mail = new RegisterEmail($dataemail);
            Mail::to($request->email)->send($mail);

            return response()->json([
                'status' => true,
                // 'message' => 'Berhasil daftar. Silahkan masuk untuk melanjutkan'
                'message' => 'Berhasil daftar. Silahkan cek email inbox/spam untuk aktivasi akun'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Gagal. Mohon coba kembali!'
            ]);
        }
    }
    public function lupapassword()
    {
        $user = "";
        $data_param = [
            'user'
        ];  
        return view('auth/lupapassword')->with(compact($data_param));
    }
    public function aktivasi($id)
    {
        $iduser = Crypt::decrypt($id);
        $data['is_active'] = 1;
        $data['email_verified_at'] = Carbon::now()->toDateTimeString();
        $data['updated_by'] = $iduser;
        $data['updated_at'] = Carbon::now()->toDateTimeString();

        User::find($iduser)->update($data);

        return view('utama/Aktivasi');
    }
    
    public function getsubkategori(Request $request)
    {
        $datasub = PaketSubkategori::where('fk_paket_kategori',$request->val)->get(['id AS id', 'judul as text'])->toArray();
        return response()->json([
            'status' => true,
            'datasub' => $datasub
        ]);
    }

    public function getKabupaten(Request $request)
    {
        $kabupaten = MasterKabupaten::where('id_prov',$request->valProvinsi)->get(['id_kab AS id', 'nama as text'])->toArray();

        return response()->json([
            'status' => true,
            'kabupaten' => $kabupaten
        ]);
    }
    public function getKecamatan(Request $request)
    {
        $kecamatan = MasterKecamatan::where('id_kab',$request->valKab)->get(['id_kec AS id', 'nama as text'])->toArray();

        return response()->json([
            'status' => true,
            'kecamatan' => $kecamatan
        ]);
    }
    public function cekusername(Request $request)
    { 
        $cekUsername = User::where('username','=',$request->username)->get();
        $jumlah = count($cekUsername); 
        if ($jumlah>0) {
            return response()->json([
                'status' => false
            ]);
        }else{
            return response()->json([
                'status' => true
            ]);
        }
    }
    public function resetpassword(Request $request)
    {
        $template = Template::where('id','<>','~')->first();
        $random = Str::random(6);
        $user = User::where('username',$request->username)->first();
        if ($user) {
            if($user->is_active!=1){
                return response()->json([
                    'status' => false,
                    'message' => 'User belum aktif!'
                ]);
                dd('Error');
            }
            $data['password'] = bcrypt($random);
            $data['updated_by'] = Auth::id();
            $data['updated_at'] = Carbon::now()->toDateTimeString();
            $updatedata = User::find($user->id)->update($data);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan!'
            ]);
            dd('Error');
        }
        
        if($updatedata){
            $dataemail = [
                'nama'=> $user->name,
                'email'=> $request->username,
                'password' => $random,
                'namaweb' => $template->nama,
                'emailweb' => $template->email
            ];
            $mail = new ResetPassword($dataemail);
            Mail::to($request->username)->send($mail);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil reset password. Silahkan cek email inbox/spam'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Gagal. Mohon coba kembali!'
            ]);
        }
    }

    public function getalamat(Request $request)
    {
        $search = $request->search;

        if($search == ''){
            $data = UserAlamat::select('id', DB::raw('CONCAT(alamat_lengkap, " [", nama_penerima,"-",no_hp_penerima,"]") AS text'))->where('fk_user_id',Auth::id())->where('status',1)->orderBy('created_at','desc')->get()->toArray();
        }else{
            $data = UserAlamat::where('fk_user_id',Auth::id())->where('status',1)->where('alamat_lengkap', 'like', '%' .$search . '%')->orderBy('alamat_lengkap','asc')->get(['id AS id', 'alamat_lengkap as text'])->toArray();
        }
        
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function getprovinsiro(Request $request)
    {
        $search = $request->search;

        if($search == ''){
            $provinsi = RajaOngkir::provinsi()->all();
        }else{
            $provinsi = RajaOngkir::provinsi()->search($search)->get();
        }
  
        return response()->json([
            'status' => true,
            'data' => $provinsi
        ]);
    }

    public function getkabupatenro(Request $request)
    {
        if($request->provid){

            $search = $request->search;

            if($search == ''){
                $kabupaten = RajaOngkir::kota()->dariProvinsi($request->provid)->get();
            }else{
                $kabupaten = RajaOngkir::kota()->dariProvinsi($request->provid)->search($search)->get();
            }

        }else{
            $kabupaten = "";
        }

        return response()->json([
            'status' => true,
            'data' => $kabupaten
        ]);
    }
    
}
