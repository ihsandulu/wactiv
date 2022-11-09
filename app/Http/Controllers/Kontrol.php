<?php

namespace App\Http\Controllers;

use App\Models\Modle;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Break_;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class Kontrol extends Controller
{
    public function index()
    {
        // echo Auth::check();
        // die;
        if (Auth::check()) {
            return view('home');
        } else {
            return view('halo');
        }
    }
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        // return redirect(url("/"));
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:8'
        ]);
        if ($credentials) {
            $lempar = array(
                'user_email' => $request->email,
                'password' => $request->password
            );
            // @dd($lempar);   
            $ingat = $request->remember?true:false;        
            if (Auth::attempt($lempar,$ingat)) {
                // Authentication passed...
                $identitys=DB::table("identity")->limit(1)->get();
                foreach ($identitys as $identity) {
                    $request->session()->put('number', $identity->identity_wa);
                }
                return redirect()->intended('home')->with(['message' => 'Selamat Datang ' . auth()->user()->user_name, 'tipe' => 'success']);
            } else {
                return redirect()->intended('login')->with(['message' => 'Email atau Password tidak benar!', 'tipe' => 'error']);
            }
        }
    }
    public function daftar(Request $request)
    {
        $Modle = new Modle;
        $modd = $Modle->daftar($request); 
        // dd($modd);
        if($modd['success']==0){
            $request->session()->put('message', $modd['message']);
            $request->session()->put('tipe', 'warning');
            return view(
                'register',
                ["posts" => $modd]
            );
        }else{        
            return redirect()->intended('login')->with(['message' => 'Silahkan Login!', 'tipe' => 'success']);
        }
         
    }
    public function halaman($halaman)
    {
        $Modle = new Modle;
        $tipe = "";
        //cek nama halaman match tidak dengan nama table?
        switch ($halaman) {
            case "about":
                $phalaman = 'identity';
            break;
            default:
                $phalaman = $halaman;
            break;
        }

        //cek ada request cari tidak?
        if (request("cari")) {
            $tipe = "cari";
        } 

        //cek tipe halaman
        switch ($tipe) {
            case "cari":
                $item = request("item");
                $cari = request("cari");
                $modd = $Modle->cari(request("item"), request("cari"))->appends(['item' => $item, 'cari' => $cari]);
                break;
            default:
                $item = strtolower($phalaman);
                if(request()->get("default")){
                    $modd = $Modle->defaultnya($phalaman); 
                }elseif (Schema::hasTable($phalaman)) {
                    $modd = $Modle->semua($item);
                } else {
                    $modd = $Modle->index($phalaman); 
                }
                break;
        }
        //return halaman
        $guest = array("login", "about", "product", "search");
        if ($halaman == 'logout'){
            $this->logout();
            return redirect()->intended('login')->with(['message' => 'Anda berhasil logout!', 'tipe' => 'info']);
        // } elseif (!Auth::check() && !in_array($halaman, $guest)) {
        }elseif(!Auth::check()){
            // dd(auth()->user()->user_name);
           return view(
                $halaman,
                ["posts" => $modd]
            );
        } else {         
            if(isset($modd["view0"])){
                $explode=explode("&",$modd["view1"]);
                foreach ($explode as $key => $value) {
                    $explode1=explode("=",$value); 
                    $explode2[$explode1[0]]=$explode1[1]; 
                }
                return view(
                    $modd["view0"],
                    $explode2
                );
            }elseif(isset($modd["redirect"])){
                return redirect()->away($modd["redirect"]);
            }else{
                return view(
                    $halaman,
                    ["posts" => $modd]
                );
            }
        }
    }

    public function redirectToProvider(Request $request)
    {
        // print_r($request->all());
        // exit();
        return Socialite::driver('google')->redirect();
    }
      
      
    //tambahkan script di bawah ini 
    public function handleProviderCallback(\Request $request)
    {
        $user_google    = Socialite::driver('google')->user();
        if($user_google){
            DB::enableQueryLog();
            $users=DB::table("user")
            ->where("user_email",$user_google->getEmail())
            ->get();
            if($users->count()>0){
                foreach ($users as $user) { 
                    $user_email=$user->user_email;
                    $password=$user->password;   
                    $lempar=array(
                        'user_email'=> $user_email,
                        'user_name'=> $user->user_name,
                        'password'=> $password,
                        'user_email_verified_at'=> $user->user_email_verified_at
                    ); 
                } 
                
                $identitys=DB::table("identity")->limit(1)->get();
                foreach ($identitys as $identity) {
                    request()->session()->put('number', $identity->identity_wa);
                }  
            }else{
                $user_email=$user_google->getEmail();
                $password=uniqid('user_');
                $lempar=array(
                    'user_email'=> $user_email,
                    'user_name'=> $user_google->getName(),
                    'password'=> $password,
                    'user_email_verified_at'=> now()
                );  
                DB::table("user")
                ->insert($lempar); 
            }  
            // dd($lempar);   
            $lempar = array(
                'user_email' => $user_email,
                'password' => $password
            );  
            $finduser = User::where('user_email', $user_email)->first();
    
        if($finduser){
    
            Auth::login($finduser);
                return redirect()->intended('home')->with(['message' => 'Selamat Datang ' . auth()->user()->user_name, 'tipe' => 'success']);
        }
            
                
            //jika user ada maka langsung di redirect ke halaman home
            //jika user tidak ada maka simpan ke database
            //$user_google menyimpan data google account seperti email, foto, dsb  

        }else{
            return redirect()->intended('login')->with(['message' => 'Email atau Password tidak benar!', 'tipe' => 'error']);
        }


    }
}
