<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {

        $query = Karyawan::query();
        $query->select('karyawan.*','nama_dept');
        $query->join('departemen','karyawan.kode_dept','=','departemen.kode_dept');
        $query->orderBy('nama_lengkap');
        if(!empty($request->nama_karyawan)){
            $query->where('nama_lengkap','like','%'.$request->nama_karyawan.'%');
        }

        if(!empty($request->kode_dept)){
            $query->where('karyawan.kode_dept', $request->kode_dept);
        }
        $karyawan = $query->paginate(10);

        $departemen = DB::table('departemen')->get();
        return view('karyawan.index',compact('karyawan','departemen'));
    }

    public function store(Request $request){


        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dept = $request->kode_dept;
        $password = Hash::make('12345');
        if ($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension(); 
        } else {
            $foto = null;
        }

        try {
            $data = [
                'nik'=>$nik,
                'nama_lengkap'=>$nama_lengkap,
                'no_hp'=>$no_hp,
                'jabatan'=>$jabatan,
                'kode_dept'=>$kode_dept,
                'foto'=>$foto,
                'password'=>$password
            ];
            $simpan = DB::table('karyawan')->insert($data);
            if($simpan){
                if ($request->hasFile('foto')) {
                    $folderPath = "uploads/karyawan/";          
                    Storage::disk('public')->putFileAs($folderPath, $request->file('foto'), $foto);
                }

                return Redirect::back()->with(['success'=>'Data successfully saved']);
            }
        } catch (\Exception $e) {           
            if($e->getCode()==23000){
                $message="This ID number " .$nik. " is already in use.";
            } 
            return Redirect::back()->with(['warning'=>'Failed to save data, '.$message]);
            

        }
    }

    public function edit(Request $request){
        $nik = $request->nik;
        $departemen = DB::table('departemen')->get();
        $karyawan = DB::table('karyawan')->where('nik',$nik)->first();
        return view('karyawan.edit',compact('departemen','karyawan'));
    }

    public function update($nik, Request $request){
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dept = $request->kode_dept;
        $password = Hash::make('12345');
        $old_foto = $request->old_foto;
        if ($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension(); 
        } else {
            $foto = $old_foto;
        }

        try {
            $data = [
                'nama_lengkap'=>$nama_lengkap,
                'no_hp'=>$no_hp,
                'jabatan'=>$jabatan,
                'kode_dept'=>$kode_dept,
                'foto'=>$foto,
                'password'=>$password
            ];
            $update = DB::table('karyawan')->where('nik',$nik)->update($data);
            if($update){
                if ($request->hasFile('foto')) {
                    $folderPath = "uploads/karyawan/";          
                    $folderPathOld = "uploads/karyawan/".$old_foto;          
                    Storage::disk('public')->delete($folderPathOld);
                    Storage::disk('public')->putFileAs($folderPath, $request->file('foto'), $foto);
                }

                return Redirect::back()->with(['success'=>'Data successfully updated']);
            }
        } catch (\Exception $e) {
            //dd($e->getMessage());
            
            return Redirect::back()->with(['warning'=>'Failed to update the data']);
            

        }
    }

    public function delete($nik){
        $delete = DB::table('karyawan')->where('nik',$nik)->delete();
        if($delete){
            return Redirect::back()->with(['success'=>'Data successfully deleted']);
        }else{
            return Redirect::back()->with(['warning'=>'Data failed to delete']);
        }
    }
}
