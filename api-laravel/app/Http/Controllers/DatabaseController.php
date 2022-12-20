<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DatabaseController extends Controller{
    public function riwayat(){
        $riwayat = DB::select("SELECT * FROM tbl_his 
        LEFT JOIN tbl_hum ON tbl_his.id_data = tbl_hum.id_data 
        LEFT JOIN tbl_suhu ON tbl_his.id_data = tbl_suhu.id_data 
        LEFT JOIN tbl_quality ON tbl_his.id_data = tbl_quality.id_data");

        $json=json_encode($riwayat);
        print_r($json);
    }


    public function store(Request $request)
    {

        $req = $request;

        print_r($req);
        // $nama = $req->nama;
        // $kecamatan  = $req->kecamatan;

        // DB::insert("insert into koperasi set cif='$cif',
        //                                     nama='$nama',
        //                                     kecamatan ='$kecamatan'", []);


    }

    public function update(Request $request, $cif)
    {

        $messages = [
            'min'    => 'Minimal diisi :min karakter!',
            'required'    => ':attribute wajib diisi!'
        ];

        $rules = [
            'nama' => 'required|min:8',
            'kecamatan' => 'required|min:5'
        ];

        $this->validate($request, $rules, $messages);
      
        $req = $request;
        $cif = $req->cif;
        $nama = $req->nama;
        $kecamatan  = $req->kecamatan;

        DB::insert("update koperasi set 
                                            nama='$nama',
                                            kecamatan ='$kecamatan' where cif='$cif'", []);

        return redirect('/koperasi')->with('status','Berhasil diubah'); //redirect ke halaman koperasi lagi dengan diberi session bernama status

    }


    
    public function destroy($cif)
    {
        DB::delete("delete from koperasi where cif='$cif'");
        return redirect('/koperasi')->with('status','Berhasil dihapus'); //redirect ke halaman koperasi lagi dengan diberi session bernama status

    }
}