<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // INDEX
    public function index(Request $request)
    {
        $filterableColumns = ['name'];
        $searchableColumns = ['name', 'email'];

        $data['dataUser'] = User::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10);

        return view('admin.user.index', $data);
    }

    // CREATE
    public function create()
    {
        return view('admin.user.create');
    }

    // STORE
    public function store(Request $request)
    {
        $data['name']     = $request->name;
        $data['email']    = $request->email;
        $data['password'] = Hash::make($request->password);

        // Upload Foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-user');
        }

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
    }

    // EDIT
    public function edit(string $id)
    {
        $data['datauser'] = User::findOrFail($id);
        return view('admin.user.edit', $data);
    }

    // UPDATE
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->name  = $request->name;
        $user->email = $request->email;

        // Jika password diisi baru
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Update Foto
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($user->foto && Storage::exists($user->foto)) {
                Storage::delete($user->foto);
            }

            // Simpan foto baru
            $user->foto = $request->file('foto')->store('foto-user');
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'Update Data Berhasil!');
    }

    // DELETE
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Hapus foto jika ada
        if ($user->foto && Storage::exists($user->foto)) {
            Storage::delete($user->foto);
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
