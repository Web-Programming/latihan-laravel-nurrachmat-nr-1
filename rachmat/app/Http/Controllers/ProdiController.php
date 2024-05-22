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
            'nama' => 'required|min:5|max:20',
            'foto' => 'required|file|image|max:5000',
        ]);

        $ext = $request->foto->getClientOriginalExtension();
        $nama_file = "foto-".time().".".$ext; //foto-515157118.jpg
        $path = $request->foto->storeAs('public', $nama_file);

        $prodi = new Prodi();
        $prodi->nama = $validateData['nama'];
        $prodi->foto = $nama_file;
        $prodi->save();

        $request->session()->flash('info', "Data prodi $prodi->nama berhasil disimpan ke database");
        return redirect()->route('prodi.create');
    }

    public function edit(Prodi $prodi){
        return view("prodi.edit", ['prodi' => $prodi]);
    }

    public function update(Prodi $prodi, Request $request) {
        //dump($request);
        $validateData = $request->validate([
            'nama' => 'required|min:5|max:20'
        ]);

        Prodi::where("id", $prodi->id)->update($validateData);
        $request->session()->flash('info', "Data prodi $prodi->nama berhasil diupdate");
        return redirect()->route('prodi.index');
    }

    public function destroy(Prodi $prodi) {
        //Prodi::where("id", $prodi->id)->delete();
        $prodi->delete();
        return redirect()->route('prodi.index')
            ->with('info', "Data prodi berhasil dihapus");
    }
}
