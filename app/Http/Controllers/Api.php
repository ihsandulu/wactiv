<?php

namespace App\Http\Controllers;

use App\Models\Modle;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Break_;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Api extends Controller
{
    public function index()
    {
        echo "halo";
    }
    public function aa()
    {
        // @dd($parameters);
        echo "aa";
    }
    public function bb()
    {
        echo "bb";
    }
    public function getallclientwa()
    {
        $client=DB::table('tranprod')
        ->where('tranprod_active','1')
        ->get();
        // echo $client->dd();
        return response()->json($client);
    }
    public function updateallclientwa()
    {
        $clients=DB::table('tranprod')
        ->where('tranprod_active','1')
        ->get();
        foreach ($clients as $client) {
           if(date("Y-m-d")>$client->tranprod_outdate){
            $input["tranprod_active"]=0;
            DB::table('tranprod')
            ->where('tranprod_id',$client->tranprod_id)
            ->update($input);
           }
        }        
    }    

    public function token(){
        $input["user_email"]=request()->get("email");
        $password=request()->get("password");
        $login=DB::table('user')
        ->where($input)
        ->get();
        // echo $login->count();
        if($login->count()>0){
            foreach ($login as $value) {
                if (Hash::check($password,$value->password)) {
                    $data["token"]=md5(date("d").substr($value->password,6).date("Ym"));
                    $data["status"]=Hash::check($password,$value->password);
                    return response()->json($data, 200);  
                }else{
                    $data["status"]=Hash::check($password,$value->password);
                    return response()->json($data, 401);  
                }
            }
        }else{
           echo "Data tidak ditemukan!"; 
        }
    }

    public function cektoken(){
        $akses=0;
        $input["user_email"]=request()->get("email");
        $token=request()->get("token");
        $login=DB::table('user')
        ->where($input)
        ->get();
         
        if($login->count()>0){
            foreach ($login as $value) {
                $tokenasli=md5(date("d").substr($value->password,6).date("Ym"));
                if($tokenasli==$token){
                    $data["message"]="Token Valid";
                    $data["status"]=true;  
                    return response()->json($data, 200);              
                }else{
                    $data["message"]="Token tidak Valid";
                    $data["status"]=false;
                    return response()->json($data, 401);
                }
                // echo $tokenasli."==".$token;
            }
        }else{
            $data["message"]="Email tidak Valid";
            $data["status"]=false;
            return response()->json($data, 401);
        }
    }

    public function forward(){
        $input["tranprod_no"]=request()->get("tranprod_no");
        $forward=DB::table('forward')
        ->leftJoin("tranprod","tranprod.tranprod_id","=","forward.tranprod_id")
        ->where($input)
        ->get();
         
        if($forward->count()>0){
            foreach ($forward as $value) {
                $data["forward_number"][]=$value->forward_number;
            }
            $data["status"]=true;
            return response()->json($data, 200);    
        }else{
            $data["forward_number"]="";
            $data["status"]=false;
            return response()->json($data, 401);
        }
    }
}
