<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Modle extends Model
{
    public  function index($fungsi)
    {    
        $role=method_exists($this, $fungsi);
        if($role){
            $role = $this->$fungsi();
        }else{
            $role = array();
        } 
       
        return $role;
    }
    public  function semua($item)
    {
        $datathrow = DB::table($item)->orderBy($item . '_name')->paginate(5);
        return $datathrow;
    }
    public  function cari($item, $search)
    {
        switch ($item) {
            case "product":
                $datathrow = DB::table($item)->where('product_name', 'like', '%' . $search . '%')->orderBy('product_name')->paginate(50);
            break;
            case "layanandetail":
                $datathrow = DB::table($item)->where('product_name', 'like', '%' . $search . '%')->orderBy('product_name')->paginate(50);
            break;
            default:
                $datathrow = DB::table($item)->where($item . '_name', 'like', '%' . $search . '%')->orderBy($item . '_name')->paginate(50);
            break;
        }
        // @dd($datathrow);
        return $datathrow;
    }
    public function posisi($user_id)
    {
        $posisis = db::table('user')->where('user_id', $user_id)->get();
        $posisinya = 0;
        foreach ($posisis as $posisi) {
            $posisinya = $posisi->position_id;
        }
        return $posisinya;
    }
    public function layanandetail()
    {
        return array();
    }
    public function perpanjangan()
    {
        if(isset($_POST["submit"])){
            foreach (request()->all() as $e => $f) {
                if ($e != 'id' && $e != 'product_name' && $e != 'submit') {
                    $input[$e] = request()->get($e);
                }
            }
            //penomoran
            $nom = DB::table("transaction")
            ->where("transaction_date", date("Y-m-d"))
            ->orderBy("transaction_id", "DESC")
            ->limit("1")
            ->get();
            if ($nom->count() > 0) {
                $noakhir = $nom->first()->transaction_no;
                $noakh = explode(".", $noakhir);
                if ($noakh[2] > 9999) {
                    $noak = 1;
                } else {
                    $noak = $noakh[2] + 1;
                }
                $noa = str_pad($noak, 4, "0", STR_PAD_LEFT);
            } else {
                $noa = str_pad(1, 4, "0", STR_PAD_LEFT);
            }
            $nomor = array();
            $nomor[1] = "QTH";
            $nomor[2] = date("Ymd");
            $nomor[3] = $noa;
            $nomoran = implode(".", $nomor);
            $input["transaction_no"]=$nomoran;
            $input["transaction_status"]=2;
            $input["transaction_message"]=1;
            $input["transaction_date"]=date("Y-m-d");
            $input["updated_at"]=date("Y-m-d H:i:s");
            DB::table('transaction')->insert($input);
            $input["view0"]="kirimwa";
            $input["view1"]='number=owner&title=Konfirmasi Pembayaran&pesan=Insyaallah kami akan memverikasi pembayaran anda secepat mungkin.&message='.$input["updated_at"].'-- Konfirmasi pembayaran dari '.Auth()->user()->user_name.',  Pembayaran : '.request()->get("product_name").',  Dari Bank : '.$input['transaction_bankpengirim'].',  Ke Bank : '.$input['transaction_bankpenerima'].',  Atas Nama : '.$input['transaction_an'].',  Sejumlah : '.$input['transaction_pay'];
            $data=$input;
        }else{
            $data=array();
        }
        return $data;
    }
    
    public function layanans()
    {
        if(isset($_POST["submit"])){

            //cek apakah baru langganan atau perpanjangan
            $inputss["tranprod_id"]=request()->post("tranprod_id");
            $tranprodp=DB::table("tranprodp")
            ->where($inputss)
            ->get()
            ->count();

            $inputs["tranprod_id"]=request()->post("tranprod_id");
            $tranprods=DB::table("tranprod")
            ->leftJoin("product","product.product_id","=","tranprod.product_id")
            ->where($inputs)
            ->get();
            foreach($tranprods as $tranprod){
                $sekarang=date("Y-m-d");
                if($tranprodp==0){
                    $input["tranprod_activedate"]=date("Y-m-d");
                    $input["tranprod_date"]=date("Y-m-d");
                }elseif($sekarang>$tranprod->tranprod_outdate){
                    $input["tranprod_activedate"]=date("Y-m-d");
                    $input["tranprod_date"]=date("Y-m-d");
                }else{
                    $input["tranprod_activedate"]=$tranprod->tranprod_outdate;
                    $input["tranprod_date"]=$tranprod->tranprod_outdate;
                }

                //waktu perpanjangan
                $perpanjangan=$tranprod->product_waktu." ".$tranprod->product_masa;
                $input["tranprod_outdate"] = date('Y-m-d', strtotime($input["tranprod_activedate"]. ' + '.$perpanjangan));
                // $input["tranprod_outdate"]=date("Y-m-d",strtotime("+".$perpanjangan,strtotime($input["tranprod_activedate"])));
                $input["tranprod_active"]=1;
                $input["updated_at"]=date("Y-m-d H:i:s");
                $where["tranprod_id"]=$tranprod->tranprod_id;
                DB::table('tranprod')
                ->where($where)
                ->update($input);

                //insert history
                $inputp["tranprod_id"]=$tranprod->tranprod_id;
                $inputp["tranprodp_awal"]=$input["tranprod_activedate"];
                $inputp["tranprodp_akhir"]=$input["tranprod_outdate"];
                $inputp["tranprodp_nominal"]=$tranprod->product_sell;
                $where["tranprod_id"]=$tranprod->tranprod_id;
                DB::table('tranprodp')
                ->insert($inputp);
            }
            
            $data=$input;
        }else{
            $data=array();
        }
        return $data;
    }
}
