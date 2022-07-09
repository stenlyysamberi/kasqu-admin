<?php

namespace App\Http\Controllers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\DB;



// use App\KasPemasukan;

use App\KasPemasukan as AppKasPemasukan;
use App\ModelHistory;
use App\ModelMitra;
use App\TotalSaldo;
use App\User;
use App\UserMan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception as GlobalException;
use Facade\Ignition\QueryRecorder\Query;
use FFI\Exception as FFIException;
use PhpParser\Node\Stmt\TryCatch;

class ControllerPemasukan extends Controller{

    //BLOK API
    public function bayar(Request $req){
        $simpan = $req->validate([
            'mitra_id' => 'required',
            'tanggal_masuk' => 'required',
            'jumlah_pemasukan' => 'required',
            'user_id'  => 'required'          
        ]);

       AppKasPemasukan::create($simpan);
        return response()->json([
            'result'   => 'berhasil',
            'message'  => '1'
        ]);

       
    
    }
    //END 



    public function index(){
        return view('pemasukan',[
            "menu1" => "Beranda",
            "menu2" => "Pemasukan",
            "title" => "Pemasukan",
            "sumber" => ModelMitra::all(),
            "userman"  => User::all(),
            'mitra'    => AppKasPemasukan::mitras()->get()
        ]);
    }

    public function store(Request $req){

        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions
        
        $simpan = $req->validate([
            'mitra_id' => 'required',
            'tanggal_masuk' => 'required',
            'jumlah_pemasukan' => 'required',
            'user_id' => 'required',
            'bukti_img' =>'image|file|max:2024'
        ]);

        if($req->file('bukti_img')){
            $simpan['bukti_img'] = $req->file('bukti_img')->store('image-file');
        }

        try{

            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'stenlyspps7@gmail.com';   //  sender username
            $mail->Password = 'acimfnmgdnweckwx';       // sender password
            $mail->SMTPSecure = 'ssl';                  // encryption - ssl/tls
            $mail->Port = 465;                          // port - 587/465

            $mail->setFrom('stenlyspps7@gmail.com', 'stenly spps');
            $mail->addAddress('i.connect@outlook.co.id');
            $mail->addCC('i.connect@outlook.co.id');
            $mail->addBCC('i.connect@outlook.co.id');

            $mail->addReplyTo('stenlyspps7@gmail.com', '');

            // if(isset($_FILES['bukti_img'])) {
            //     for ($i=0; $i < count($_FILES['bukti_img']['tmp_name']); $i++) {
            //         $mail->addAttachment($_FILES['bukti_img']['tmp_name'][$i], $_FILES['bukti_img']['name'][$i]);
            //     }
            // }

            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = "Donasi";
            $mail->Body    = "Memiliki kerinduan lewat donasi mendukung program kegiatan komunitas terkait listerasi digital dan teknologi informasi
            di Tanah Papua.
            
            Regard
            Team Sacode";


            if( !$mail->send() ) {
                return back()->with("masuk", "Email not sent.")->withErrors($mail->ErrorInfo);
            }
            
            else {
                AppKasPemasukan::create($simpan);
                return back()->with("masuk", "Email has been sent.");
            }

        }catch(Exception $e){
            return back()->with('masuk','Message could not be sent.'.$e);
        }

      
    //    $req->session()->flash('masuk', ',has been a created');
    //    return redirect('/masuk');
    }

    public function edit(Request $req){
         $req->validate([
            'user_id' => 'required',
            'mitra_id' => 'required',
            'jumlah_pemasukan' => 'required',
            'tanggal_masuk' => 'required'
        ]);

        AppKasPemasukan::find($req->kasmasuk_id)->update($req->all());
        return redirect('/masuk')->with('masuk','updated has been successfully!');
    }

    public function hapus(Request $req){
        AppKasPemasukan::find($req->id)->delete();
        return redirect('/masuk')->with('masuk','kasmasuk has been deleted!');
    }

    public function report_masuk(Request $req){
    
        if(request()->from || request()->to){
            $start_date = Carbon::parse(request()->from)->toDateTimeString();
            $end_date = Carbon::parse(request()->to)->toDateTimeString();
            // $data = AppKasPemasukan::whereBetween('created_at',[$start_date,$end_date])->get();
            $data = AppKasPemasukan::relation($start_date,$end_date);
        }else{
            $data = AppKasPemasukan::mitras()->get();
        }
    
        return view('report_masuk',[
            "menu1" => "Beranda",
            "menu2" => "Content",
            "menu3" => "Dana Keluar",
            "title" => "Dana Masuk",
            "dana"  => $data
        ]);
        
      }


    public function income(){
       
       
        $total = AppKasPemasukan::select(DB::raw("CAST(SUM(jumlah_pemasukan) as int) as Total"))
                 ->GroupBy(DB::raw("Month(created_at)"))
                 ->pluck('Total');
        
        $bulan = AppKasPemasukan::select(DB::raw("MONTHNAME(created_at) as Bulan"))
                 ->GroupBy(DB::raw("MONTHNAME(created_at)"))
                 ->pluck('Bulan');

        return response()->json([
           'bulan' => $bulan,
           'total' => $total
        ]);
    }

      
}
