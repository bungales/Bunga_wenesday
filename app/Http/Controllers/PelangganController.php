<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Multipleuploads;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['gender'];
        $searchableColumns = ['first_name', 'last_name', 'email', 'phone'];

        $data['dataPelanggan'] = Pelanggan::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10);
        return view('admin.pelanggan.index', $data);
    }

    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $data['first_name'] = $request->first_name;
        $data['last_name']  = $request->last_name;
        $data['birthday']   = $request->birthday;
        $data['gender']     = $request->gender;
        $data['email']      = $request->email;
        $data['phone']      = $request->phone;

        Pelanggan::create($data);

        return redirect()->route('pelanggan.index')->with('success', 'Penambahan Data Berhasil!');
    }

    // TAMBAHKAN METHOD SHOW UNTUK DETAIL PELANGGAN
    public function show(string $id)
    {
        $data['dataPelanggan'] = Pelanggan::with('files')->findOrFail($id);
        return view('admin.pelanggan.show', $data);
    }

    public function edit(string $id)
    {
        $data['dataPelanggan'] = Pelanggan::with('files')->findOrFail($id);
        return view('admin.pelanggan.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $pelanggan_id = $id;
        $pelanggan = Pelanggan::findOrFail($pelanggan_id);

        $pelanggan->first_name = $request->first_name;
        $pelanggan->last_name  = $request->last_name;
        $pelanggan->birthday   = $request->birthday;
        $pelanggan->gender     = $request->gender;
        $pelanggan->email      = $request->email;
        $pelanggan->phone      = $request->phone;

        $pelanggan->save();
        return redirect()->route('pelanggan.index')->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        // Hapus semua file terkait
        foreach ($pelanggan->files as $file) {
            if (file_exists(public_path('images/' . $file->filename))) {
                unlink(public_path('images/' . $file->filename));
            }
            $file->delete();
        }

        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
