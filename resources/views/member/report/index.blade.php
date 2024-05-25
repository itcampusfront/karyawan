@extends('layouts/main')

@section('title', 'DAP')

@section('content')

<div class="card">
    <div class="card-header"><h5 class="text-center mb-0">Daily Activity Progress</h5></div>
    <div class="card-body">
        @if(Session::get('message'))
        <div class="alert alert-warning alert-dismissible text-center fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form method="post" action="{{ route('member.reportDaily.store') }}" enctype="multipart/form-data">
            @csrf
            {{-- @for($i=0; $i<15; $i++)
                @include('member.report.komponen.formDaily', ['index' => $i])
            @endfor
            <div class="row mb-3">
                <div class="col-12">
                    <textarea style="width: 85%" name="note" id="note" rows="10"></textarea>
                </div>
            </div> --}}
            <div class="row mb-3">
                <div class="col-12">
                </div>
            </div>
            <div id="spreadsheet"></div>

            <hr>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Submit</button>
            <a href="{{ route('member.absent.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
        </form>
    </div>
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
    var data = [
        ['Jazz', 'Honda', '2019-02-12', '', true, '$ 2.000,00', '#777700'],
        ['Civic', 'Honda', '2018-07-11', '', true, '$ 4.000,01', '#007777'],
    ];

    jspreadsheet(document.getElementById('spreadsheet'), {
        data:data,
        columns: [
            { type: 'text', title:'Car', width:120 },
            { type: 'dropdown', title:'Make', width:200, source:[ "Alfa Romeo", "Audi", "Bmw" ] },
            { type: 'calendar', title:'Available', width:200 },
            { type: 'image', title:'Photo', width:120 },
            { type: 'checkbox', title:'Stock', width:80 },
            { type: 'numeric', title:'Price', width:100, mask:'$ #.##,00', decimal:',' },
            { type: 'color', width:100, render:'square', }
        ]
    });
    
    function handleChange(input) {
        if (input.value < 0) input.value = 0;
        if (input.value > 100) input.value = 100;
    }

</script>
@endsection
