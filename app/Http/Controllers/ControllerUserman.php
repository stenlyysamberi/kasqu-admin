<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ControllerUserman extends Controller{


    public function index(){
        return view('userman',[
            "menu1" => "Beranda",
            "menu2" => "User Management",
            "title" => "Management User",
            "userman" => User::all()
        ]);
    }

    public function store(Request $request){

        $simpan = $request->validate(
            [
                'nama' => 'required',
                'phone' => 'required',
                'alamat' => 'required',
                'nip' => 'required',
                'jenis_kelamin' => 'required',
                'password' => 'required',
                'gambar' => 'image|file|max:2024',
                'level' => 'required'
            ]);

        
            if($request->file('gambar')){
                $simpan['gambar'] = $request->file('gambar')->store('image-file');
            }

        $simpan['password'] = Hash::make($simpan['password']);
        User::create($simpan);
        $request->session()->flash('user','userman Created successfully!');
            return redirect('/user');
        
    }

    public function edit(Request $request){

        $rule = [
            'user_id' => 'required',
            'nama' => 'required',
            'phone' => 'required',
            'alamat' => 'required',
            'nip' => 'required',
            'gambar' => 'required|file|max:2024',
            'jenis_kelamin' => 'required',
            'level' => 'required'
        ];

        $validate = $request->validate($rule);

        if($request->file('gambar')){
            if($request->imageOld){
                Storage::delete($request->imageOld);
            }
            $validate['gambar'] = $request->file('gambar')->store('image-file');
        }

      User::where('user_id',$request->user_id)->update($validate);
      $request->session()->flash("user","update has been created!");
      return redirect('/user');
    }

    public function login(Request $request){

        $credentials = $request->validate([
            'phone'  => 'required',
            'password'   => 'required'
        ]);

        if(Auth::attempt(['phone' => $request->phone, 'password' => $request->password,'level'=>'stafadmin'])){
            $request->session()->regenerate();
            return redirect()->intended('/beranda');
        }

        return back()->with('masuk', 'Data yang dimasukan tidak sesuai dengan records.');
    }

    public function keluar(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function hapus(Request $request){
        Storage::delete($request->oldimage);
        User::find($request->id)->delete();
        return redirect('/user')->with('user','userman has been deleted!');
    }


    //blok API
    public function login_api(Request $request){
        $cre = $request->validate([
            'phone' => 'required',
            'password' =>'required'
       ]);

       if(Auth::attempt(['phone' => $request->phone, 'password' => $request->password,'level'=>'owner'])){
            // $request->session()->regenerate();
            return response()->json([
                'result'   => 'berhasil',
                'id'       => auth()->user()->user_id,
                'nama'     => auth()->user()->nama
            ]);
        }else{
            return response()->json([
                'result'  => 'gagal',
                'message' => '0'
            ]);
        }

    }

    public function fect_user(Request $request){
        $user = User::where('user_id', $request->user_id)->first();
        return response()->json(
                $user
        );
    }

    public function edit_user(Request $request){
       
            $req = [
                'nama'    => 'required',
                'alamat'  => 'required',
                'phone'   => 'required'
                // 'gambar'  => 'required|file|max:2024'
            ];

            $validate = $request->validate($req);

            // if($request->file('gambar')!=null){
            //     if($request->imageOld){
            //         Storage::delete($request->imageOld);
            //     }
            //     $validate['gambar'] = $request->file('gambar')->store('image-file');
            // }

            User::where('user_id',$request->user_id)->update($validate);
                return response()->json([
                    'result'   => 'berhasil',
                    'message'  => '0'
                ]);
    }
}


