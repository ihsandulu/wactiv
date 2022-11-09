<?php

namespace App\Http\Controllers;

use App\Models\Modle;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Break_;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

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
}
