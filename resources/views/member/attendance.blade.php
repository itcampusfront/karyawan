@extends('layouts/main')

@section('title', 'Rekap Absensi')

@section('content')

<div class="card">
    <div class="card-header d-sm-flex justify-content-between align-items-center">
        <h5 class="mb-2 mb-sm-0">Rekap Absensi</h5>
        <form action="">
            <div class="row g-2 align-items-center">
                <div class="col-auto">
                    <select name="month" class="form-select form-select-sm" data-bs-toggle="tooltip" title="Pilih Periode Bulan">
                        <option value="1" {{ request('month') == '1' ? 'selected' : '' }}>Januari</option>
                        <option value="2" {{ request('month') == '2' ? 'selected' : '' }}>Februari</option>
                        <option value="3" {{ request('month') == '3' ? 'selected' : '' }}>Maret</option>
                        <option value="4" {{ request('month') == '4' ? 'selected' : '' }}>April</option>
                        <option value="5" {{ request('month') == '5' ? 'selected' : '' }}>Mei</option>
                        <option value="6" {{ request('month') == '6' ? 'selected' : '' }}>Juni</option>
                        <option value="7" {{ request('month') == '7' ? 'selected' : '' }}>Juli</option>
                        <option value="8" {{ request('month') == '8' ? 'selected' : '' }}>Agustus</option>
                        <option value="9" {{ request('month') == '9' ? 'selected' : '' }}>September</option>
                        <option value="10" {{ request('month') == '10' ? 'selected' : '' }}>Oktober</option>
                        <option value="11" {{ request('month') == '11' ? 'selected' : '' }}>November</option>
                        <option value="12" {{ request('month') == '12' ? 'selected' : '' }}>Desember</option>
                    </select>
                </div>
                <div class="col-auto">
                    <select name="year" class="form-select form-select-sm" data-bs-toggle="tooltip" title="Pilih Periode Tahun">
                        @for($i=date('Y'); $i>= 2020; $i--)
                        <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <p class="mb-3">Absensi mulai dari {{ date('d/m/Y', strtotime($dt1)) }} sampai {{ date('d/m/Y', strtotime($dt2)) }}:</p>
        <ul class="nav nav-tabs" id="myTab" role="tablist" style="border-bottom-width: 0px;">
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $category == 1 ? 'active' : '' }}" href="{{ route('member.attendance.index', ['category' => 1, 'month' => $month, 'year' => $year]) }}" role="tab" aria-selected="true">Hadir <span class="badge bg-primary">{{ $count[1] }}</span></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $category == 2 ? 'active' : '' }}" href="{{ route('member.attendance.index', ['category' => 2, 'month' => $month, 'year' => $year]) }}" role="tab" aria-selected="false">Terlambat <span class="badge bg-primary">{{ $count[2] }}</span></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $category == 3 ? 'active' : '' }}" href="{{ route('member.attendance.index', ['category' => 3, 'month' => $month, 'year' => $year]) }}" role="tab" aria-selected="false">Sakit <span class="badge bg-primary">{{ $count[3] }}</span></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $category == 4 ? 'active' : '' }}" href="{{ route('member.attendance.index', ['category' => 4, 'month' => $month, 'year' => $year]) }}" role="tab" aria-selected="false">Izin <span class="badge bg-primary">{{ $count[4] }}</span></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $category == 5 ? 'active' : '' }}" href="{{ route('member.attendance.index', ['category' => 5, 'month' => $month, 'year' => $year]) }}" role="tab" aria-selected="false">Cuti <span class="badge bg-primary">{{ $count[5] }}</span></a>
            </li>
        </ul>
        <hr class="my-0">
        <div class="tab-content py-3" id="myTabContent">
            <div class="tab-pane fade show active" role="tabpanel">
                <div class="table-responsive">
                    @if($category == 1 || $category == 2)
                        @if($count[2] > 0)
                        <div class="alert alert-warning">
                            Anda bulan ini sudah terlambat <strong>{{ $count[2] }} kali</strong>. Yuk intropeksi diri lagi :)
                        </div>
                        @endif
                    <table class="table table-sm table-hover table-bordered" id="table">
                        <thead>
                            <tr>
                                <th width="20">No.</th>
                                <th width="120">Jam Kerja</th>
                                <th width="80">Tanggal</th>
                                <th>Absen Masuk</th>
                                <th>Absen Keluar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($attendances as $attendance)
                                <tr>
                                    <td align="right">{{ $i }}</td>
                                    <td>
                                        {{ $attendance->workhour ? $attendance->workhour->name : '-' }}
                                        <br>
                                        <small class="text-muted">{{ date('H:i', strtotime($attendance->start_at)) }} - {{ date('H:i', strtotime($attendance->end_at)) }}</small>
                                    </td>
                                    <td>
                                        <span class="d-none">{{ date('Y-m-d', strtotime($attendance->entry_at)).' '.$attendance->start_at }}</span>
                                        {{ date('d/m/Y', strtotime($attendance->date)) }}
                                    </td>
                                    <td>
                                        @php $date = $attendance->start_at <= $attendance->end_at ? $attendance->date : date('Y-m-d', strtotime('-1 day', strtotime($attendance->date))); @endphp
                                        <i class="bi-alarm me-2"></i>{{ date('H:i', strtotime($attendance->entry_at)) }} WIB
                                        <br>
                                        <small class="text-muted"><i class="bi-calendar me-2"></i>{{ date('d/m/Y', strtotime($attendance->entry_at)) }}</small>
                                        @if(strtotime($attendance->entry_at) < strtotime($date.' '.$attendance->start_at) + 60)
                                            <br>
                                            <span class="text-success"><i class="bi-check-square me-2"></i>Masuk sesuai dengan waktunya.</span>
                                        @else
                                            <br>
                                            <span class="text-danger"><i class="bi-exclamation-triangle me-2"></i>Terlambat {{ time_to_string(abs(strtotime($date.' '.$attendance->start_at) - strtotime($attendance->entry_at))) }}.</span>
                                        @endif
                                        @if($attendance->late != '')
                                        <br>
                                        <span class="text-danger"><i class="bi bi-pencil me-2"></i>Terlambat karena {{ $attendance->late }}.</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($attendance->exit_at != null)
                                            <i class="bi-alarm me-2"></i>{{ date('H:i', strtotime($attendance->exit_at)) }} WIB
                                            <br>
                                            <small class="text-muted"><i class="bi-calendar me-2"></i>{{ date('d/m/Y', strtotime($attendance->exit_at)) }}</small>
                                            @php $attendance->end_at = $attendance->end_at == '00:00:00' ? '23:59:59' : $attendance->end_at @endphp
                                            @if(strtotime($attendance->exit_at) > strtotime($attendance->date.' '.$attendance->end_at))
                                                <br>
                                                <span class="text-success"><i class="bi-check-square me-2"></i>Keluar sesuai dengan waktunya.</span>
                                            @else
                                                <br>
                                                <span class="text-danger"><i class="bi-exclamation-triangle me-2"></i>Keluar lebih awal {{ time_to_string(abs(strtotime($attendance->exit_at) - strtotime($attendance->date.' '.$attendance->end_at))) }}.</span>
                                            @endif
                                        @else
                                            <span class="text-info"><i class="bi-question-circle me-2"></i>Belum melakukan absen keluar.</span>
                                        @endif
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                    @elseif($category == 3 || $category == 4)
                    <table class="table table-sm table-hover table-bordered" id="table">
                        <thead class="bg-light">
                            <tr>
                                <th width="20">No.</th>
                                <th width="80">Tanggal</th>
                                <th>Alasan Ketidakhadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($attendances as $attendance)
                                <tr>
                                    <td align="right">{{ $i }}</td>
                                    <td>
                                        <span class="d-none">{{ date('Y-m-d', strtotime($attendance->entry_at)).' '.$attendance->start_at }}</span>
                                        {{ date('d/m/Y', strtotime($attendance->date)) }}
                                    </td>
                                    <td>{!! nl2br($attendance->note) !!}</td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                    @elseif($category == 5)
                    <table class="table table-sm table-hover table-bordered" id="table">
                        <thead class="bg-light">
                            <tr>
                                <th width="20">No.</th>
                                <th>Tanggal Cuti</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($attendances as $attendance)
                                <tr>
                                    <td align="right">{{ $i }}</td>
                                    <td>
                                        <span class="d-none">{{ date('Y-m-d', strtotime($attendance->entry_at)).' '.$attendance->start_at }}</span>
                                        {{ date('d/m/Y', strtotime($attendance->date)) }}
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
    let DataTable = (selector) => {
        let datatable = $(selector).DataTable({
            "language": {
                "lengthMenu": "Menampilkan _MENU_ data",
                "zeroRecords": "Data tidak tersedia",
                "info": "Menampilkan _START_ sampai _END_ dari total _TOTAL_ data",
                "infoEmpty": "Data tidak ditemukan",
                "infoFiltered": "(Terfilter dari total _MAX_ data)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "previous": "<",
                    "next": ">",
                },
                "processing": "Memproses data..."
            },
            // "fnDrawCallback": configFnDrawCallback,
            "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Semua"]],
            "pageLength": -1,
            columnDefs: [
                // {orderable: false, targets: 0},
                // {orderable: false, targets: -1},
            ],
            order: []
        });
        return datatable;
    }
    
    // DataTable
    DataTable("#table");
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
    $(document).on("change", "select[name=month], select[name=year]", function() {
        var month = $("select[name=month]").val();
        var year = $("select[name=year]").val();
        window.location.href = "{{ route('member.attendance.index') }}" + "?month=" + month + "&year=" + year;
    });
</script>

@endsection

@section('css')

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

@endsection