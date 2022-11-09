<?php

namespace App\Http\Controllers;

use App\Models\Modle;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Break_;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

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
            if (Auth::attempt($lempar)) {
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
                if (Schema::hasTable($phalaman)) {
                    $modd = $Modle->semua($item);
                } else {
                    $modd = $Modle->index($phalaman); 
                }
                break;
        }
        //return halaman
        $guest = array("login", "about", "product", "search");
        if ($halaman == 'logout') {
            $this->logout();
            return redirect()->intended('login')->with(['message' => 'Anda berhasil logout!', 'tipe' => 'info']);
        } elseif (!Auth::check() && !in_array($halaman, $guest)) {
            // dd(auth()->user()->user_name);
            return view(
                'login',
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
            }else{
                return view(
                    $halaman,
                    ["posts" => $modd]
                );
            }
        }
    }
}
