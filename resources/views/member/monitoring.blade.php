@extends('layouts/main')

@section('title', 'Rekap Absensi')

@section('content')

<div class="card">
    <div class="card-header d-sm-flex justify-content-between align-items-center">
        <form id="form-filter" class="d-lg-flex" method="get" action="">
            <select name="month" class="form-select form-select-sm ms-2" id="">
                <option value="0">--Pilih Bulan--</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" >{{ $month[$i] }}"></option>
                @endfor
            </select>

            <select name="year" id="year" class="form-select form-select-sm ms-2">
                <option value="0">--Pilih Tahun--</option>
                @for ($i = date('Y'); $i >= 2019; $i--)
                    <option value="{{ $i }}" >{{ $i }}</option>
                @endfor
            </select>

            <select name="office" class="form-select form-select-sm ms-2" id="office">
                <option value="0">--Pilih Cabang--</option>
                @foreach ($offices as $officess)
                    <option value="{{ $officess->id }}">{{ $officess->name }}</option>
                @endforeach
            </select>
            <div class="ms-lg-2 ms-0">
                <button type="submit" class="btn btn-sm btn-info" > Filter</button>
            </div>
        </form>
    </div>
    <div class="card-body">
            <table class="table table-responsive table-bordered text-center" id="datatable">
                <thead class="bg-light">
                    <tr>
                        <th rowspan="2" width="20"></th>
                        <th rowspan="2" width="80">Tanggal</th>
                        @if(count($work_hours) > 0)
                        <th colspan="{{ count($work_hours) }}">Jam Kerja</th>
                        @endif
                    </tr>
                    @if(Request::query('office') != null && count($work_hours) > 0)
                        <tr>
                            @foreach($work_hours as $work_hour)
                            <th>{{ $work_hour->name }}</th>
                            @endforeach
                        </tr>
                    @endif
                </thead>
                <tbody>
                    @foreach($dates as $key=>$date)
                    <tr>
                        <td align="center">{{ ($key+1) }}</td>
                        <td>
                            
                            {{ $date }}
                        </td>
                        @if(count($work_hours) > 0)
                            @foreach($work_hours as $work_hour)
                                @php
                                    $attendances = \App\Models\Attendance::has('user')->where('workhour_id','=',$work_hour->id)->where('date','=',change($date))->get();
                                @endphp
                                <td>
                                    @if(count($attendances) > 0)
                                        @foreach($attendances as $key=>$attendance)
                                            {{ $attendance->user->name }}
                                            @if($key < count($attendances) - 1)
                                            <hr class="my-1">
                                            @endif
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </td>
                            @endforeach
                        @endif
                    </tr>
                @endforeach
                </tbody>
              </table>
    </div>
</div>

@endsection

@section('js')

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
    // $(document).ready(function(){
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    'url' : '{{ route('member.monitoring.index') }}'

                },
                columns: [
                    {data: 'id', name: 'id', className: 'text-center', orderable: false},
                    
                ]
            });

        })

        function reloadTable(idtable){
            var table = $(idtable).DataTable();
            table.cleanData;
            table.ajax.reload();
        } 
</script>

<script>
    // Enable tooltip everywhere
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>

<script>
    // Change month or year
   
</script>

@endsection

@section('css')

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

@endsection