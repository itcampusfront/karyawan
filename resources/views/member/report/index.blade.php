@extends('layouts/main')

@section('title', 'DAP')

@section('content')

<div class="card">
    <div class="card-header"><h5 class="text-center mb-0">Daily Activity Progress</h5></div>
    <div class="card-body">
        @if($status == 0)
        @if(Session::get('message'))
        <div class="alert alert-danger alert-dismissible text-center fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form method="post" action="{{ route('member.reportDaily.store') }}" enctype="multipart/form-data">
            @csrf
            @for($i=0; $i<15; $i++)
                @include('member.report.komponen.formDaily', ['index' => $i])
            @endfor
            <div class="row mb-3">
                <div class="col-12">
                    <label for="note" class="mb-2 mt-3">Keterangan tambahan : </label>
                    <textarea style="width: 100%" name="note" id="note" rows="10"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                </div>
            </div>
            <div id="spreadsheet"></div>

            <hr>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Submit</button>
            <a href="{{ route('member.absent.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
        </form>
        @else
        <div class="alert alert-danger alert-dismissible text-center fade show" role="alert">
            Anda Sudah Menambahkan Daily Activity Progress
            <br><br>
            <a href="{{ route('member.dashboard') }}" class="btn btn-danger btn-sm"></i> Kembali</a>
        </div>
        @endif
    </div>

    @if($status == 1)
    <div class="card-body">

        <table class="table table-hover table-bordered" id="table">
            <tbody>
                <tr>
                    <td>Nama</td>
                    <td>: {{ $data->user->name }}</td>
                </tr>
                <tr>
                    <td >Tanggal</td>
                    <td >: {{ $data->date }}</td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>: {{ $data->note }}</td>
                </tr>
                <tr>
                    <td>Report DAP</td>
                    <td>
                        @for($i=0;$i<count($reports);$i++)
                            <li>{{ $reports[$i]->report }} <span style="color: green">({{ $reports[$i]->score }} %)</span></li>
                        @endfor
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    @endif
</div>

@endsection
@section('css')

<link rel="stylesheet" href="https://jsuites.net/docs/v4/jsuites.css" type="text/css" />
<link rel="stylesheet" href="https://bossanova.uk/jspreadsheet/v4/jexcel.css" type="text/css" />

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

@section('js')
<script src="https://bossanova.uk/jspreadsheet/v4/jexcel.js"></script>
<script src="https://jsuites.net/docs/v4/jsuites.js"></script>

<script type="text/javascript">

    
    function handleChange(input) {
        if (input.value < 0) input.value = 0;
        if (input.value > 100) input.value = 100;
    }

</script>
@endsection
