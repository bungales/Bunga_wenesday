<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PegawaiController extends Controller
{
    public function index()
    {
        // Data contoh
        $name              = "Bunga";
        $tanggal_lahir     = "2006-05-10";   
        $tgl_harus_wisuda  = "2026-09-30";
        $current_semester  = 4;
        $future_goal       = "Menjadi Software Engineer";

        // Hitung umur
        $my_age = Carbon::parse($tanggal_lahir)->age;

        // Hobi minimal 5
        $hobbies = [
            "Membaca Buku",
            "Menulis",
            "Badminton",
            "Coding",
            "Traveling"
        ];

        // Hitung sisa hari menuju tanggal wisuda
        $time_to_study_left = Carbon::now()->diffInDays(Carbon::parse($tgl_harus_wisuda), false);

        // Tentukan pesan sesuai semester
        $semester_info = $current_semester < 3
            ? "Masih Awal, Kejar TAK"
            : "Jangan main-main, kurang-kurangi main game!";

        // Kembalikan data dalam JSON
        return response()->json([
            "name"              => $name,
            "my_age"            => $my_age,
            "hobbies"           => $hobbies,
            "tgl_harus_wisuda"  => $tgl_harus_wisuda,
            "time_to_study_left"=> $time_to_study_left,
            "current_semester"  => $current_semester,
            "semester_info"     => $semester_info,
            "future_goal"       => $future_goal
        ]);
    }
}

