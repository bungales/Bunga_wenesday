<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PegawaiController extends Controller
{
    public function index()
    {
        // Data dummy
        $name = "Bunga Lestari";
        $tanggalLahir = Carbon::create(2006, 5, 15);
        $hobbies = ["Membaca", "Coding", "Olahraga", "menari","Traveling"];
        $tglHarusWisuda = Carbon::create(2026, 10, 10);
        $currentSemester = 3;
        $futureGoal = "Masih Awal, Kejar TAK";

        // Hitung umur
        $my_age = $tanggalLahir->diffInYears(Carbon::now());

        // Hitung sisa waktu kuliah
        $time_to_study_left = Carbon::now()->diffInDays($tglHarusWisuda);

        // Data dikirim ke view
        $pegawai = [
            "name" => $name,
            "my_age" => $my_age,
            "hobbies" => $hobbies,
            "tgl_harus_wisuda" => $tglHarusWisuda->toDateString(),
            "time_to_study_left" => $time_to_study_left,
            "current_semester" => $currentSemester,
            "semester_info" => "Jangan main-main, kurangi menunda tugas!",
            "future_goal" => $futureGoal
        ];

        return view('pegawai', compact('pegawai'));
    }
}
