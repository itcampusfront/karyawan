<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/'.setting('icon')) }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">

    <!-- Style -->
    <style type="text/css">
        a {text-decoration: none;}
        .table thead tr th {text-align: center;}
    </style>

    <title>Deskripsi Jabatan | {{ config('app.name') }}</title>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('member.dashboard') }}">{{ config('app.name') }}</a>
            <div class="btn-group">
                <a class="btn btn-info" href="{{ route('member.dashboard') }}">
                    <i class="bi-arrow-left"></i> Kembali
                </a>
                <a class="btn btn-warning" href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                    <i class="bi-power"></i> Log Out
                </a>
            </div>
            <form class="d-none" id="form-logout" method="post" action="{{ route('member.logout') }}">
                @csrf
            </form>
        </div>
    </nav>

    @if(Auth::user()->end_date == null)
    <div class="container mt-5">
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Deskripsi Jabatan</h5></div>
            <div class="card-body">
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item d-flex justify-content-between p-1">
                        <span>Jabatan:</span>
                        <span>{{ $user->position ? $user->position->name : '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between p-1">
                        <span>Kantor:</span>
                        <span>{{ $user->office ? $user->office->name : '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between p-1">
                        <span>Perusahaan:</span>
                        <span>{{ $user->group ? $user->group->name : '-' }}</span>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="card border-0 h-100">
                            <div class="card-body p-0">
                                <table class="table table-sm table-hover table-bordered mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th width="20">No.</th>
                                            <th>Tugas dan Tanggung Jawab</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($user->position->duties_and_responsibilities) > 0)
                                            @foreach($user->position->duties_and_responsibilities as $key=>$dr)
                                                <tr>
                                                    <td align="right">{{ ($key+1) }}</td>
                                                    <td>{{ $dr->name }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="2" align="center"><span class="text-danger fst-italic">Belum ada data.</span></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 h-100">
                            <div class="card-body p-0">
                                <table class="table table-sm table-hover table-bordered mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th width="20">No.</th>
                                            <th>Wewenang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($user->position->authorities) > 0)
                                            @foreach($user->position->authorities as $key=>$authority)
                                                <tr>
                                                    <td align="right">{{ ($key+1) }}</td>
                                                    <td>{{ $authority->name }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="2" align="center"><span class="text-danger fst-italic">Belum ada data.</span></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="container mt-5">
        <!-- Welcome Text -->
        <div class="alert alert-danger text-center" role="alert">
            Selamat datang <strong>{{ Auth::user()->name }}</strong> di {{ setting('name') }}. Mohon maaf untuk memberitahukan bahwa status Anda disini sudah <strong>Tidak Aktif</strong>.
        </div>
    </div>
    @endif

    <!-- JQuery & Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        // Enable tooltip everywhere
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
</body>
</html>