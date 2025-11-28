<?php

namespace App\Http\Controllers;

use App\Models\Multipleuploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MultipleuploadsController extends Controller
{
    public function index()
    {
        return view('multipleuploads');
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'filename' => 'required',
            'filename.*' => 'mimes:doc,docx,pdf,jpg,jpeg,png|max:2048',
            'ref_table' => 'required',
            'ref_id' => 'required|integer'
        ]);

        // Cek apakah ada file
        if ($request->hasfile('filename')) {
            $files = [];

            foreach ($request->file('filename') as $file) {
                if ($file->isValid()) {
                    // Generate nama file unik
                    $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Pindahkan file ke folder public/images
                    $file->move(public_path('images'), $filename);

                    // Simpan data file
                    $files[] = [
                        'filename' => $filename,
                        'ref_table' => $request->ref_table,
                        'ref_id' => $request->ref_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            // Insert ke database
            if (!empty($files)) {
                Multipleuploads::insert($files);
                return back()->with('success', 'File berhasil diupload!');
            }
        }

        return back()->with('error', 'Tidak ada file yang dipilih atau file tidak valid!');
    }

    public function destroy($id)
    {
        try {
            $file = Multipleuploads::findOrFail($id);

            // Hapus file dari storage
            $filePath = public_path('images/' . $file->filename);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Hapus dari database
            $file->delete();

            return back()->with('success', 'File berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus file: ' . $e->getMessage());
        }
    }
}
