<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\PaketMst;
use App\Models\Transaksi;
use App\Models\KodePotongan;
use App\Models\Keranjang;
use App\Models\MasterRekening;
use App\Models\User;
use App\Models\UserAlamat;
use Carbon\Carbon;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Auth;

class PaymentController extends Controller
{
    private $apiKey;
    private $merchantId;
    private $linkcallback;
    private $sandboxmode;

    public function __construct()
    {
        $this->apiKey = env('DUITKU_APIKEY');
        $this->merchantId = env('DUITKU_MERCHANTID');
        $this->linkcallback = env('DUITKU_CALLBACK');
        $this->sandboxmode = env('DUITKU_SANDBOX_MODE');
    }
    // public function createorder(Request $request)
    // {
    //     $mastermemberid = Crypt::decrypt($request->mastermemberid);
    //     $mastermember = MasterMember::find($mastermemberid);
    //     $merchantOrderId    = time();

    //     $responcreate['merchant_order_id'] = $merchantOrderId;
    //     $responcreate['fk_user_id'] = Auth::id();
    //     $responcreate['fk_master_member_id'] = $mastermember->id;
    //     $responcreate['harga'] = $mastermember->harga;
    //     $responcreate['status'] = 0;
    //     $responcreate['expired'] = Carbon::now()->addMinutes(180)->toDateTimeString();
    //     $responcreate['created_by'] = Auth::id();
    //     $responcreate['created_at'] = Carbon::now()->toDateTimeString();
    //     $responcreate['updated_by'] = Auth::id();
    //     $responcreate['updated_at'] = Carbon::now()->toDateTimeString();
    //     $createdata = Transaksi::create($responcreate);
    //     if($createdata){
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Halaman akan diarahakan otomatis. Mohon Tunggu...',
    //             'id' => Crypt::encrypt($createdata->id)
    //         ]);
    //     }else{
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Gagal, mohon coba kembali !'
    //         ]);
    //     }

    // }
    public function createorder(Request $request)
    {
        $idpaket = Crypt::decrypt($request->idpaket); 
        // $ceksudahbeli = Transaksi::where('fk_paket_mst',$idpaket)->where('status',1)->where('fk_user_id',Auth::id())->first();
        // if($ceksudahbeli){
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Paket sudah dibeli'
        //     ]);
        //     dd('Error');
        // }
        if($request->idpromo){
            $idpromo = Crypt::decrypt($request->idpromo);
            $cekkode = KodePotongan::find($idpromo);
        }else{
            $cekkode = null;
        }
        $paket = PaketMst::findOrFail($idpaket);
        $total = $paket->harga;
        if($cekkode){
            $fkpromo = $cekkode->id;
            if($cekkode->tipe==2){
                $potongan = $paket->harga * $cekkode->jumlah / 100; 
            }else{
                $potongan = $cekkode->jumlah;
            }
            $total = $paket->harga - $potongan; 
            if($total<20000){
                $total = 20000;
            }else{
                $total = $total;
            }
        }else{
            $fkpromo = null;
        }
        // $jumlah = $request->jumlah; 
        // $ongkir = $request->ongkir; 
        // $id_alamat = $request->id_alamat;
        // $id_paket = $request->id_paket;
        // $id_keranjang = $request->id_keranjang;
        // $data_alamat = UserAlamat::find($id_alamat);
      
                  
            $user = User::find(Auth::id());

            

            $duitkuConfig = new \Duitku\Config($this->apiKey, $this->merchantId);
            $duitkuConfig->setSandboxMode($this->sandboxmode);
            $paymentAmount      = $total; // Amount
            $hargaNormal      = $paket->harga; // Amount
            $email              = Auth::user()->email; // your customer email
            $phoneNumber        = Auth::user()->no_wa; // your customer phone number (optional)
            $productDetails     = "Pembelian Paket ".$paket->subkategori_r->judul ;
            $merchantOrderId    = time(); // from merchant, unique   
            $additionalParam    = ''; // optional
            $merchantUserInfo   = ''; // optional
            $customerVaName     = Auth::user()->name; // display name on bank confirmation display
            $callbackUrl        = $this->linkcallback; // url for callback
            $returnUrl          = url('transaksi'); // url for redirect
            $expiryPeriod       = 180; // set the expired time in minutes
    
            // Customer Detail
            $firstName          = Auth::user()->name;
            $lastName           = "";
    
            // Address
            $alamat             = Auth::user()->kabupaten_r->nama;
            // $daftarKota = RajaOngkir::kota()->find($data_alamat->fk_kabupaten);
            $city               = Auth::user()->kabupaten_r->nama;
            $postalCode         = '12345';
            $countryCode        = "ID";
    
            $address = array(
                'firstName'     => $firstName,
                'lastName'      => $lastName,
                'address'       => $alamat,
                'city'          => $city,
                'postalCode'    => $postalCode,
                'phone'         => $phoneNumber,
                'countryCode'   => $countryCode
            );
    
            $customerDetail = array(
                'firstName'         => $firstName,
                'lastName'          => $lastName,
                'email'             => $email,
                'phoneNumber'       => $phoneNumber
                // 'billingAddress'    => $address,
                // 'shippingAddress'   => $address
            );
    
          

            // Item Details
            $item1 = array(
                'name'      => $paket->judul,
                'price'     => $total,
                'quantity'  => 1
            );
    
            $itemDetails = array(
                $item1
            );
            // $item2 = array(
            //     'name'      => $productDetails,
            //     'price'     => 400000,
            //     'quantity'  => 1
            // );
    
            // $itemDetails = array(
            //     $item1,$item2
            // );
    
            $params = array(
                'paymentAmount'     => $paymentAmount,
                'merchantOrderId'   => $merchantOrderId,
                'productDetails'    => $productDetails,
                'additionalParam'   => $additionalParam,
                'merchantUserInfo'  => $merchantUserInfo,
                'customerVaName'    => $customerVaName,
                'email'             => $email,
                'phoneNumber'       => $phoneNumber,
                'itemDetails'       => $itemDetails,
                'customerDetail'    => $customerDetail,
                'callbackUrl'       => $callbackUrl,
                'returnUrl'         => $returnUrl,
                'expiryPeriod'      => $expiryPeriod
            );
    
            try {
                // createInvoice Request
                $responseDuitkuPop = \Duitku\Pop::createInvoice($params, $duitkuConfig);
                $datarespon = json_decode($responseDuitkuPop);
                $responcreate['payment_url'] = $datarespon->paymentUrl;
                $responcreate['reference'] = $datarespon->reference;
                $responcreate['merchant_order_id'] = $merchantOrderId;
                $responcreate['fk_user_id'] = Auth::id();
                $responcreate['fk_promo_id'] = $fkpromo;
                $responcreate['fk_user_alamat'] = $alamat;
                $responcreate['fk_paket_mst'] = $paket->id;
                $responcreate['fk_paket_kategori'] = $paket->fk_paket_kategori;
                $responcreate['fk_paket_subkategori'] = $paket->fk_paket_subkategori;
                $responcreate['harga_normal'] = $hargaNormal;
                $responcreate['harga'] = $paymentAmount;
                $responcreate['status'] = 0;
                $responcreate['expired'] = Carbon::now()->addMinutes(180)->toDateTimeString();
                $responcreate['aktif_sampai'] = Carbon::now()->addYears(1)->toDateTimeString();
                $responcreate['created_by'] = Auth::id();
                $responcreate['created_at'] = Carbon::now()->toDateTimeString();
                $responcreate['updated_by'] = Auth::id();
                $responcreate['updated_at'] = Carbon::now()->toDateTimeString();
                $createdata = Transaksi::create($responcreate);

                // foreach($id_keranjang as $updatekeranjang){
                //     $id_kerjng = Crypt::decrypt($updatekeranjang);
                //     $updatedataker['status'] = 1;
                //     Keranjang::find($id_kerjng)->update($updatedataker);
                // }
                header('Content-Type: application/json');
                echo $responseDuitkuPop;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        
       

    }
    public function detailbayar($id)
    {
        $menu = 'transaksi';
        $submenu='';
        $rek = MasterRekening::all();
        $id = Crypt::decrypt($id);
        $transaksi = Transaksi::find($id);
        $membermst = PaketMst::find($transaksi->fk_master_member_id); 

        $data_param = [
            'menu','submenu','transaksi','membermst','rek'
        ];  
        return view('user/detailbayar')->with(compact($data_param));
    }
    public function createorderduitku(Request $request)
    {
        $mastermemberid = Crypt::decrypt($request->mastermemberid);
        $mastermember = MasterMember::find($mastermemberid);
        
        if ($mastermember) {               
                $duitkuConfig = new \Duitku\Config($this->apiKey, $this->merchantId);
                $duitkuConfig->setSandboxMode($this->sandboxmode);
                $paymentAmount      = $mastermember->harga; // Amount
                $email              = Auth::user()->email; // your customer email
                $phoneNumber        = ""; // your customer phone number (optional)
                $productDetails     = "Member ".$mastermember->judul;
                $merchantOrderId    = time(); // from merchant, unique   
                $additionalParam    = ''; // optional
                $merchantUserInfo   = ''; // optional
                $customerVaName     = Auth::user()->name; // display name on bank confirmation display
                $callbackUrl        = $this->linkcallback; // url for callback
                $returnUrl          = url('transaksi'); // url for redirect
                $expiryPeriod       = 180; // set the expired time in minutes
        
                // Customer Detail
                $firstName          = Auth::user()->name;
                $lastName           = "";
        
                // Address
                $alamat             = "Jl. Kembangan Raya";
                $city               = "Jakarta";
                $postalCode         = "11530";
                $countryCode        = "ID";
        
                $address = array(
                    'firstName'     => $firstName,
                    'lastName'      => $lastName,
                    'address'       => $alamat,
                    'city'          => $city,
                    'postalCode'    => $postalCode,
                    'phone'         => $phoneNumber,
                    'countryCode'   => $countryCode
                );
        
                $customerDetail = array(
                    'firstName'         => $firstName,
                    'lastName'          => $lastName,
                    'email'             => $email,
                    'phoneNumber'       => $phoneNumber
                    // 'billingAddress'    => $address,
                    // 'shippingAddress'   => $address
                );
        
                // Item Details
                $item1 = array(
                    'name'      => $productDetails,
                    'price'     => $paymentAmount,
                    'quantity'  => 1
                );
        
                $itemDetails = array(
                    $item1
                );
        
                $params = array(
                    'paymentAmount'     => $paymentAmount,
                    'merchantOrderId'   => $merchantOrderId,
                    'productDetails'    => $productDetails,
                    'additionalParam'   => $additionalParam,
                    'merchantUserInfo'  => $merchantUserInfo,
                    'customerVaName'    => $customerVaName,
                    'email'             => $email,
                    'phoneNumber'       => $phoneNumber,
                    'itemDetails'       => $itemDetails,
                    'customerDetail'    => $customerDetail,
                    'callbackUrl'       => $callbackUrl,
                    'returnUrl'         => $returnUrl,
                    'expiryPeriod'      => $expiryPeriod
                );
        
                try {
                    // createInvoice Request
                    $responseDuitkuPop = \Duitku\Pop::createInvoice($params, $duitkuConfig);
                    $datarespon = json_decode($responseDuitkuPop);
                    $responcreate['payment_url'] = $datarespon->paymentUrl;
                    $responcreate['reference'] = $datarespon->reference;
                    $responcreate['merchant_order_id'] = $merchantOrderId;
                    $responcreate['fk_user_id'] = Auth::id();
                    $responcreate['fk_master_member_id'] = $mastermember->id;
                    $responcreate['harga'] = $mastermember->harga;
                    $responcreate['status'] = 0;
                    $responcreate['expired'] = Carbon::now()->addMinutes(180)->toDateTimeString();
                    $responcreate['created_by'] = Auth::id();
                    $responcreate['created_at'] = Carbon::now()->toDateTimeString();
                    $responcreate['updated_by'] = Auth::id();
                    $responcreate['updated_at'] = Carbon::now()->toDateTimeString();
                    Transaksi::create($responcreate);

                    header('Content-Type: application/json');
                    echo $responseDuitkuPop;
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            
        }
    }

    public function callbackduitku(Request $request)
    {
        // $data['nik'] = rand(15,35);
        // $data['name'] = 'fffff';
        // $data['username'] = 'ggggg';
        // $data['email'] = 'hhhh';
        // $data['gender'] = "s";
        // $data['user_level'] = "1";
        // $data['is_active'] = "1";
        // $data['password'] = "2";
        // User::create($data);
        // return 'Berhasil';

        try {
            $duitkuConfig = new \Duitku\Config($this->apiKey, $this->merchantId);
            $duitkuConfig->setSandboxMode($this->sandboxmode);

            $callback = \Duitku\Pop::callback($duitkuConfig);
        
            header('Content-Type: application/json');
            $notif = json_decode($callback);
            
            $merchantOrderId = $notif->merchantOrderId;
        
            if ($notif->resultCode == "00") {
                $data['status'] = 1;
                $data['updated_at'] = Carbon::now()->toDateTimeString();
            } else if ($notif->resultCode == "01") {
                $data['status'] = 2;
                $data['updated_at'] = Carbon::now()->toDateTimeString();
            }
            Transaksi::where('merchant_order_id',$merchantOrderId)->update($data);
            
        } catch (Exception $e) {
            http_response_code(400);
            echo $e->getMessage();
        }
    }

    public function callbackordertest(Request $request)
    {
        $merchantOrderId = $notif->merchantOrderId;
        $data['status'] = 1;
        $updatecallback = Transaksi::where('merchant_order_id',$merchantOrderId)->update($data);
    }
}
