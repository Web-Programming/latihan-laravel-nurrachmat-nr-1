<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{

    public function insert()
    {
        $result = DB::insert("INSERT into mahasiswas (npm, nama_mahasiswa, tempat_lahir, tanggal_lahir, alamat, created_at)
        values (?, ?, ?, ?, ?, ?)", ['182224', 'Rachmat', 'Jakarta', '2000-01-01', 'Jakarta', now()]);
        dump($result);
    }

    public function update2()
    {
        $result = DB::insert("UPDATE mahasiswas set nama_mahasiswa = ?, updated_at = now() WHERE npm = ?", 
        ['Nur Rahmat', '182224']);
        dump($result);
    }

    public function delete(){
        $result = DB::delete("DELETE from mahasiswas WHERE npm = ?", ['182224']);
        dump($result);
    }

    public function select(){
        $result = DB::select("SELECT * FROM mahasiswas");
        dump($result);
    }


    //Query Builder
    public function insertQb()
    {
        $result = DB::table('mahasiswas')->insert(
            [
                'npm' =>  '2222222',
                'nama_mahasiswa' => 'Rachmat',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2000-01-01',
                'alamat' => 'Jakarta',
                'created_at' => now()
            ]
        );
        dump($result);
    }

    public function updateQb()
    {
        $result = DB::table('mahasiswas')
        ->where('npm', '2222222')
        ->update(
            [
                'nama_mahasiswa' => 'Nur Rachmat',
                'tempat_lahir' => 'Palembang',
                'updated_at' => now()
            ]
        );
        dump($result);
    }

    public function deleteQb(){
        $result = DB::table('mahasiswas')
            ->where('npm', '2222222')
            ->delete();
        dump($result);
    }

    public function selectQb(){
        $result = DB::table('mahasiswas')->get();
        dump($result);
    }

    //Eloquent ORM
    public function insertElq()
    {
        $mahasiswa = new Mahasiswa();
        $mahasiswa->npm = '3333333';
        $mahasiswa->nama_mahasiswa = 'Rachmat';
        $mahasiswa->tempat_lahir = 'Jakarta';
        $mahasiswa->tanggal_lahir = '2000-01-01';
        $mahasiswa->alamat = 'Jakarta';
        $mahasiswa->save();
        dump($mahasiswa);
    }

    public function updateElq()
    {
       $mahasiswa = Mahasiswa::where('npm', '3333333')->first();
       $mahasiswa->nama_mahasiswa = 'Abdullah';
       $mahasiswa->save();
       dump($mahasiswa);
    }

    public function deleteElq(){
        $mahasiswa = Mahasiswa::where('npm', '3333333')->first();
        $mahasiswa->delete();
        dump($mahasiswa);
    }

    public function selectElq(){
        $mahasiswa = Mahasiswa::all();
        dump($mahasiswa);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$result = DB::select("SELECT * FROM mahasiswas");
        //$result = DB::table('mahasiswas')->get();
        $result = Mahasiswa::all();
        return view('mahasiswa.index', ['mahasiswa' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //mass assignment
        $mahasiswa = Mahasiswa::create([
            'npm' => '55555',
            'nama_mahasiswa' => 'Budi',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2021-01-01',
            'alamat' => 'Bandung'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }
}
