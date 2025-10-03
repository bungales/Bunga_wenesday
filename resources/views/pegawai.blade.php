<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3>Profil Pegawai</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover table-bordered align-middle">
                <tr>
                    <th>Nama</th>
                    <td>{{ $pegawai['name'] }}</td>
                </tr>
                <tr>
                    <th>Umur</th>
                    <td>{{ $pegawai['my_age'] }} tahun</td>
                </tr>
                <tr>
                    <th>Hobi</th>
                    <td>
                        <ul>
                            @foreach($pegawai['hobbies'] as $hobi)
                                <li>{{ $hobi }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Harus Wisuda</th>
                    <td>{{ $pegawai['tgl_harus_wisuda'] }}</td>
                </tr>
                <tr>
                    <th>Sisa Waktu Belajar</th>
                    <td>{{ $pegawai['time_to_study_left'] }} hari</td>
                </tr>
                <tr>
                    <th>Semester Saat Ini</th>
                    <td>{{ $pegawai['current_semester'] }}</td>
                </tr>
                <tr>
                    <th>Info Semester</th>
                    <td>{{ $pegawai['semester_info'] }}</td>
                </tr>
                <tr>
                    <th>Cita-cita</th>
                    <td>{{ $pegawai['future_goal'] }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

</body>
</html>
