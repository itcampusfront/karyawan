@extends('layouts/main')

@section('title', 'Izin Tidak Hadir')

@section('content')

<div class="card">
    <div class="card-header"><h5 class="text-center mb-0">Hari ini tidak hadir kenapa?</h5></div>
    <div class="card-body">
        @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible text-center fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row justify-content-center">
            <a href="{{ route('member.absent.create', ['id' => 1]) }}" class="col-md-4 col-sm-6 mb-3 mb-md-0 card-menu" data-bs-toggle="tooltip" title="Klik untuk melakukan izin">
                <div class="card h-100 card-hover text-center">
                    <div class="card-body p-3">
                        <p class="h2"><i class="bi-thermometer-half"></i></p>
                        <h5 class="card-title mb-0">Sakit</h5>
                    </div>
                </div>
            </a>
            <a href="{{ route('member.absent.create', ['id' => 2]) }}" class="col-md-4 col-sm-6 mb-3 mb-md-0 card-menu" data-bs-toggle="tooltip" title="Klik untuk melakukan izin">
                <div class="card h-100 card-hover text-center">
                    <div class="card-body p-3">
                        <p class="h2"><i class="bi-tornado"></i></p>
                        <h5 class="card-title mb-0">Izin</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection