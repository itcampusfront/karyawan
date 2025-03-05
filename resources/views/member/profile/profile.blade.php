@extends('layouts/main')

@section('title', 'Profil Karyawan')

@section('content')
    <div class="container mb-5">
        
        <div class="d-sm-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 mb-0">Detail {{ role($user->role_id) }}</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between p-1">
                                <span class="font-weight-bold">Role:</span>
                                <span>{{ role($user->role_id) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between p-1">
                                <span class="font-weight-bold">Perusahaan:</span>
                                <span>{{ $user->group ? $user->group->name : '-' }}</span>
                            </li>
                            @if ($user->role_id == role('member'))
                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">Kantor:</span>
                                    <span>{{ $user->office ? $user->office->name : '-' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">Jabatan:</span>
                                    <span>{{ $user->position ? $user->position->name : '-' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">Status:</span>
                                    <span
                                        class="badge {{ $user->end_date == null ? 'bg-success' : 'bg-danger' }}">{{ $user->end_date == null ? 'Aktif' : 'Tidak Aktif' }}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <a href="/member" class="btn btn-warning mt-2" data-bs-toggle="tooltip" title="Edit"> <i class="bi-arrow-left"></i> Kembali</a>
                <a href="{{ route('member.profile.edit') }}" class="btn btn-info mt-2" data-bs-toggle="tooltip" title="Edit"><i class="bi-pencil"></i> Edit Profile</a>
            </div>
            <div class="col-lg-9 col-md-6 mt-3 mt-lg-0">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <h3>
                                Informasi Pribadi Karyawan
                            </h3>
                            <li class="list-group-item d-flex justify-content-between p-1">
                                <span class="font-weight-bold">Nama:</span>
                                <span>{{ $user->name }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between p-1">
                                <span class="font-weight-bold">Email:</span>
                                <span>{{ $user->email }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between p-1">
                                <span class="font-weight-bold">Nomor Induk Karyawan</span>
                                <span>{{ $user->identity_number ?? '-' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between p-1">
                                <span class="font-weight-bold">Nomor Induk Keluarga</span>
                                <span>{{ isset($user->relationUser[0]) ? $user->relationUser[0]->nik : '-' }}</span>
                            </li>
                            @if ($user->role_id == role('member'))
                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">Tanggal Lahir:</span>
                                    <span>{{ date('d/m/Y', strtotime($user->birthdate)) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">Jenis Kelamin:</span>
                                    <span>{{ $user->gender == 'L' ? 'Laki-Laki' : 'Perempuan' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">Nomor HP:</span>
                                    <span>{{ $user->phone_number }}</span>
                                </li>
                                @php
                                    $decoded_address = json_decode($user->address, true);
                                    
                                    if (json_last_error() === JSON_ERROR_NONE) {
                                        $address_1 = !empty($decoded_address['address_1'])
                                            ? $decoded_address['address_1']
                                            : '-';
                                        $address_2 = !empty($decoded_address['address_2'])
                                            ? $decoded_address['address_2']
                                            : '-';
                                    } else {
                                        $address_1 = $user->address;
                                        $address_2 = '-';
                                    }
                                @endphp
                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">Alamat Sesuai KTP:</span>
                                    <span>{{ $address_1 }}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">Alamat Sesuai Domisili:</span>
                                    <span>{{ $address_2 }}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">Keahlian Yang Dikuasai:</span>
                                    <span>{{ isset($user->relationUser[0]) ? $user->relationUser[0]->skill : '-' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">Hobby:</span>
                                    <span>{{ isset($user->relationUser[0]) ? $user->relationUser[0]->hobby : '-' }}</span>
                                </li>
                                <br>
                                <h3>Pendidikan</h3>
                                @php $education = json_decode($user->latest_education) @endphp
                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">Ijasah Terakhir:</span>
                                    <span>{{ isset($education->latest_education) != '' ? $education->latest_education : '-' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">Perguruan Tinggi:</span>
                                    <span>{{ isset($education->college) != '' ? $education->college : '-' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">Fakultas:</span>
                                    <span>{{ isset($education->faculty) != '' ? $education->faculty : '-' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">Jurusan:</span>
                                    <span>{{ isset($education->jurusan) != '' ? $education->jurusan : '-' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">Tahun Masuk:</span>
                                    <span>{{ isset($education->tahun) != '' ? $education->tahun : '-' }}</span>
                                </li>

                                <br>
                                <h3>Relasi Kontak Darurat</h3>
                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">Nama Kontak Darurat:</span>
                                    <span>{{ isset($user->relationUser[0]) ? $user->relationUser[0]->emergency_contact_name : '-' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">Hubungan dengan Kontak Darurat:</span>
                                    <span>{{ isset($user->relationUser[0]) ? convGender($user->relationUser[0]->emergency_contact_relationship) : '-' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">No. Kontak Darurat:</span>
                                    <span>{{ isset($user->relationUser[0]) ? $user->relationUser[0]->emergency_contact_phone : '-' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between p-1">
                                    <span class="font-weight-bold">Alamat Kontak Darurat:</span>
                                    <span>{{ isset($user->relationUser[0]) ? $user->relationUser[0]->emergency_contact_address : '-' }}</span>
                                </li>
                            @endif

                            <br>
    
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            @endif
    
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>



@endsection

@section('css')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

@endsection
