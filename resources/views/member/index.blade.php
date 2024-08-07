@extends('layouts/main')

@section('title', 'Beranda')

@section('content')

<!-- Welcome Text -->
<div class="alert alert-info text-center" role="alert">
    Selamat datang <strong>{{ Auth::user()->name }}</strong> di {{ config('app.name') }}. Anda login sebagai Karyawan <strong>({{ Auth::user()->position ? Auth::user()->position->name : '-' }})</strong>.
    @if(Auth::user()->identity_number != '')
        <br>
        NIK: <strong>{{ Auth::user()->identity_number }}</strong>.
    @endif
</div>

<div class="card">
    <div class="card-header"><h5 class="text-center mb-0">Menu</h5></div>
    <div class="card-body">
        @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible text-center fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row justify-content-center">
            @include('member.komponen.card', ['title' => 'Deskripsi Jabatan', 'icon' => 'bi-person-workspace', 'route' => route('member.position.index')])
            @include('member.komponen.card', ['title' => 'Rekap Absensi', 'icon' => 'bi-table', 'route' => route('member.attendance.index')])
            @include('member.komponen.card', ['title' => 'Izin Tidak Hadir', 'icon' => 'bi-envelope-open', 'route' => route('member.absent.index')])
            @include('member.komponen.card', ['title' => 'Laporan Harian', 'icon' => 'bi bi-tv', 'route' => route('member.reportDaily.index')])
            @include('member.komponen.card', ['title' => 'Monitoring Absensi', 'icon' => 'bi bi-tv', 'route' => route('member.monitoring.index')])
            @include('member.komponen.card', ['title' => 'Riwayat DAP', 'icon' => 'bi bi-list-check', 'route' => route('member.reportDaily.reportlist')])

            <a href="#" class="col-md-4 col-sm-6 mb-3 mb-md-0 card-menu d-none">
                <div class="card h-100 card-hover text-center">
                    <div class="card-body p-3">
                        <p class="h2"><i class="bi-credit-card"></i></p>
                        <h5 class="card-title mb-0">Rekap Gaji</h5>
                        <p class="small text-muted mt-1 mb-0">(Menu ini belum tersedia)</p>
                    </div>
                </div>
            </a>

        </div>
    </div>
</div>

@endsection