@extends('layouts/main')

@section('title', 'Report List')

@section('content')

<div class="card">
    <div class="card-header"><h5 class="text-center mb-0">Report List</h5></div>
    <div class="card-body">
        <table class="table table-responsive table-bordered text-center" id="datatable">
            <thead class="bg-light">
                <tr>
                    <th width="20">No</th>
                    <th width="80">Tanggal</th>    
                    <th width="80">Catatan Tugas</th>    
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $report->date }}</td>
                    <td>{{ $report->note }}</td>
                </tr>
            @endforeach
            </tbody>
          </table>
    </div>
</div>

@endsection
@section('css')


<style type="text/css">
   
</style>

@endsection

@section('js')

<script type="text/javascript">



</script>
@endsection
