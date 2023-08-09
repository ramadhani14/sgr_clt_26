<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PaketMst;
use App\Models\Informasi;
use App\Models\Transaksi;
use App\Models\MasterKolom;
use App\Models\KodePotongan;
use Carbon\Carbon;
use Auth;
use Hash;
use File;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $userlevel = auth()->user()->user_level;
        $menu = "home";
        $submenu="";
        
        if($userlevel==1){
            $user = User::where('user_level','<>',1)->get();
            $data_param = [
                'submenu','menu','user'
            ];
            return view('home/admin')->with(compact($data_param));
        }elseif($userlevel==2){
            $data_param = [
                'submenu','menu'
            ];
            return view('home/user')->with(compact($data_param));
        }
        
    }

    public function dashboard()
    {

        $userlevel = auth()->user()->user_level;
        $menu = "home";
        $submenu="";
        
        $member = PaketMst::orderBy('harga','asc')->where('status',1)->get();
        $data_param = [
            'submenu','menu','member'
        ];
        return view('home/user')->with(compact($data_param));
        
    }

    public function profil()
    {
        $menu = "";
        $submenu="";
        $menubar="";
        $data_param = [
            'submenu','menu','menubar'
        ];

        return view('profil/UserProfil')->with(compact($data_param));
    }

    public function updateakun(Request $request)
    {
        $iduser=Auth::user()->id;
      
        $data['name'] = $request->input('name');

        User::find($iduser)->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function updateprofil(Request $request)
    {
        $iduser=Auth::user()->id;
        $nameuser=Auth::user()->username;

        $data['jenis_kelamin'] = $request->input('jenis_kelamin');
        // $data['email'] = $request->input('email');
        // $data['name'] = $request->input('name');
        $data['pendidikan'] = $request->input('pendidikan');
        $data['jurusan'] = $request->input('jurusan');
        if($request->input('ttl')){
            $data['ttl'] = Carbon::createFromFormat('d-m-Y',$request->input('ttl'))->isoFormat('YYYY-MM-DD');
        }
        if($request->input('no_wa')){
            $data['no_wa'] = $request->input('no_wa');
        }
        if($request->input('provinsi')){
            $data['provinsi'] = $request->input('provinsi');
        }
        if($request->input('kabupaten')){
            $data['kabupaten'] = $request->input('kabupaten');
        }
        if($request->input('kecamatan')){
            $data['kecamatan'] = $request->input('kecamatan');
        }

        if ($files = $request->file("photo")) {
            $dataUser = User::find($iduser);
            File::delete($dataUser->photo);
            
            $destinationPath = 'image/upload/user/'.$nameuser.'/';
            $file = 'Photo_Profil_'.Carbon::now()->timestamp. "." .$files->getClientOriginalExtension();
            $files->move($destinationPath, $file);
            $namafile = $destinationPath.$file;
            $data['photo'] = $destinationPath.$file;
        }

        User::find($iduser)->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diubah'
        ]);
    }

    public function updatepassword(Request $request)
    {
        $oldPassword = $request->input('password');
        $newPassword = bcrypt($request->input('passwordbaru'));
        $hashedPassword = Auth::user()->password;
        $iduser = Auth::user()->id;
        if($hashedPassword==""){
            $data['password'] = $newPassword;
            User::find($iduser)->update($data);
            return response()->json([
                'status' => true,
                'message' => 'Password berhasil diubah'
            ]);
        }else{
            if (Hash::check($oldPassword, $hashedPassword)) 
            {
                $data['password'] = $newPassword;
                User::find($iduser)->update($data);
                return response()->json([
                    'status' => true,
                    'message' => 'Password berhasil diubah'
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Passord sekarang tidak sesuai!'
                ]);
            }
        }
    }
}
