@extends('layouts/main')

@section('title', 'Izin Tidak Hadir')

@section('content')

<div class="card">
    <div class="card-header"><h5 class="text-center mb-0">Izin Tidak Hadir</h5></div>
    <div class="card-body">
        @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible text-center fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form method="post" action="{{ route('member.absent.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <div class="mb-3">
                <label class="form-label">Alasan: <span class="text-danger">*</span></label>
                <input class="form-control" value="{{ $name }}" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Penjelasan karena tidak hadir: <span class="text-danger">*</span></label>
                <textarea name="note" class="form-control {{ $errors->has('note') ? 'border-danger' : '' }}" rows="3" placeholder="Tulis sesuatu...">{!! old('note') !!}</textarea>
                @if($errors->has('note'))
                    <div class="text-danger">{{ ucfirst($errors->first('note')) }}</div>
                @endif
            </div>
            @if($id == 1)
            <div class="mb-3">
                <label class="form-label">Bukti:</label>
                <br>
                <input type="file" name="attachment" accept="image/*">
            </div>
            @endif
            <hr>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Submit</button>
            <a href="{{ route('member.absent.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
        </form>
    </div>
</div>

@endsection