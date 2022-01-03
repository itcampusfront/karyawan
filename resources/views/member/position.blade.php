@extends('layouts/main')

@section('title', 'Deskripsi Jabatan')

@section('content')

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

@endsection

@section('css')

<style type="text/css">
    a {text-decoration: none;}
    .table thead tr th {text-align: center;}
</style>

@endsection