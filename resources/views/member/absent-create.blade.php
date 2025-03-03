@extends('layouts/main')

@section('title', 'Izin Tidak Hadir')

@section('content')
<a href="/member/absent" class="btn btn-warning mt-2 mb-2" data-bs-toggle="tooltip" title="Edit"> <i class="bi-arrow-left"></i> Kembali</a>
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
            @if($id == 3)
                <div class="row mb-3">
                    <label class="col-lg-2 col-md-3 col-form-label">Tanggal <span class="text-danger">*</span></label>
                    <div class="col-lg-10 col-md-9">
                        <div class="input-group input-group-sm">
                            <input type="date" name="date" class="form-control form-control-sm {{ $errors->has('date') ? 'border-danger' : '' }}" value="{{ old('date') }}" autocomplete="off">
                            <span class="input-group-text"><i class="bi-calendar2"></i></span>
                        </div>
                        @if($errors->has('date'))
                        <div class="small text-danger">{{ $errors->first('date') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-12 col-sm-2 col-md-3 col-lg-2  col-form-label">Mulai<span class="text-danger">*</span></label>
                    <div class="col-12 col-sm-4 col-md-3 col-lg-4 ">
                            <div class="input-group input-group-sm">
                                <input type="time" name="start_time" class="form-control form-control-sm {{ $errors->has('start_time') ? 'border-danger' : '' }}" value="{{ old('start_time') }}" autocomplete="off">
                                <span class="input-group-text"><i class="bi bi-clock"></i></span>
                            </div>
                            @if($errors->has('start_time'))
                                <div class="small text-danger">{{ $errors->first('start_time') }}</div>
                            @endif
                    </div>
                    <label class="col-12 col-sm-2 col-md-3 col-lg-2  col-form-label">Akhir<span class="text-danger">*</span></label>
                    <div class="col-12 col-sm-4 col-md-3 col-lg-4 ">
                            <div class="input-group input-group-sm">
                                <input type="time" name="end_time" class="form-control form-control-sm {{ $errors->has('end_time') ? 'border-danger' : '' }}" value="{{ old('end_time') }}" autocomplete="off">
                                <span class="input-group-text"><i class="bi bi-clock"></i></span>
                            </div>
                            @if($errors->has('end_time'))
                                <div class="small text-danger">{{ $errors->first('end_time') }}</div>
                            @endif
                    </div>
                </div>
            @endif
            <div class="mb-3">
                <label class="form-label">Penjelasan/Keterangan: <span class="text-danger">*</span></label>
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
@section('css')
<style type="text/css">
    input[type="time"]::-webkit-calendar-picker-indicator {
        background: transparent;
        bottom: 0;
        color: transparent;
        cursor: pointer;
        height: auto;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        width:auto
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        background: transparent;
        bottom: 0;
        color: transparent;
        cursor: pointer;
        height: auto;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: auto;
    }
</style>

@endsection
