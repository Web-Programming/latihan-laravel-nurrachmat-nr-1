<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index(){
        $listprodi = Prodi::all();
        return view("prodi.index", ['listprodi' => $listprodi]);
    }

    public function show($id){
        $prodi = Prodi::find($id);
        return view("prodi.show", ['prodi' => $prodi]);
    }

    public function create(){
        return view("prodi.create");
    }

    public function store(Request $request) {
        //dump($request);
        $validateData = $request->validate([
            'nama' => 'required|min:5|max:20'
        ]);

        $prodi = new Prodi();
        $prodi->nama = $validateData['nama'];
        $prodi->save();

        $request->session()->flash('info', "Data prodi $prodi->nama berhasil disimpan ke database");
        return redirect()->route('prodi.create');
    }
}
