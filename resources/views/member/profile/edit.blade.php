@extends('layouts/main')

@section('title', 'Profil Karyawan')

@section('content')
    <div class="container">
        {{-- <div class="d-sm-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 mb-0">Edit {{ role($user->role_id) }}</h1>
        </div> --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('member.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <input type="hidden" name="role_id" value="{{ $user->role_id }}">

                            <hr>
                            <h3>Informasi Pribadi</h3>
                            <hr>
                            <x-form.input label="Nama" name="name" value="{{ $user->name }}" :isRequired="true" :disabled="true" />

                            <x-form.input label="Nomor Induk Keluarga" name="nik"
                                :isRequired="true" value="{{ $user->relationUser[0]->nik ?? null }}" :disabled="true" />

                            <x-form.input label="Email" type="email" name="email" value="{{ $user->email }}"
                                :isRequired="true" />

                            <x-form.input label="No. HP" type="number" name="phone_number"
                                value="{{ $user->phone_number }}" :isRequired="true" />
                            <x-form.input label="Tanggal Lahir" name="birthdate"
                                value="{{ date('d/m/Y', strtotime($user->birthdate)) }}" :isRequired="true"
                                :isDate="true" />
                            <div class="row mb-3">
                                <label class="col-lg-2 col-md-3 col-form-label">Jenis Kelamin <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-10 col-md-9">
                                    @foreach (gender() as $gender)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender"
                                                id="gender-{{ $gender['key'] }}" value="{{ $gender['key'] }}"
                                                {{ $user->gender == $gender['key'] ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gender-{{ $gender['key'] }}">
                                                {{ $gender['name'] }}
                                            </label>
                                        </div>
                                    @endforeach
                                    @if ($errors->has('gender'))
                                        <div class="small text-danger">{{ $errors->first('gender') }}</div>
                                    @endif
                                </div>
                            </div>

                            @php
                                $decoded = json_decode($user->address);
                                $address =
                                    json_last_error() === JSON_ERROR_NONE
                                        ? $decoded
                                        : (object) ['address_1' => $user->address, 'address_2' => null];
                            @endphp
                            {{-- @dd($address) --}}
                            <x-form.input label="Alamat Sesuai KTP" name="address_1"
                                value="{{ $address->address_1 ?? null }}" :isRequired="true" :textarea="true" />
                            <x-form.input label="Alamat Sesuai Domisili" name="address_2"
                                value="{{ $address->address_2 ?? null }}" :isRequired="true" :textarea="true" />
                            <x-form.input label="Keahlian Yang Dikuasai" name="skill"
                                value="{{ $user->relationUser[0]->skill ?? null }}" :textarea="true" :isRequired="true"/>
                            <x-form.input label="Hobby" name="hobby" value="{{ $user->relationUser[0]->hobby ?? null }}"
                                :textarea="true" :isRequired="true"/>
                            <hr>
                            <h3>Pendidikan</h3>
                            <hr>
                            @php $education = json_decode($user->latest_education) @endphp
                            <x-form.input label="Ijasah Terakhir" name="latest_education"
                                value="{{ $education->latest_education ?? null }}" :textarea="true" :isRequired="true"/>
                            <x-form.input label="Perguruan Tinggi" name="college"
                                value="{{ $education->college ?? null }}" :isRequired="true"/>
                            <x-form.input label="Fakultas" name="faculty" value="{{ $education->faculty ?? null }}" :isRequired="true"/>
                            <x-form.input label="Jurusan" name="jurusan" value="{{ $education->jurusan ?? null }}" :isRequired="true"/>
                            <x-form.input label="Tahun Masuk" type="number" name="tahun"
                                value="{{ $education->tahun ?? null }}" :isRequired="true"/>

                            <hr>
                            <h3>Hubungan Relasi</h3>
                            <hr>

                            <x-form.input label="Nama Kontak Darurat" name="emergency_contact_name"
                                value="{{ $user->relationUser[0]->emergency_contact_name ?? null }}" :isRequired="true"/>
                            <div class="row mb-3">
                                <label for="emergency_contact_relationship" class="col-lg-2 col-md-3 col-form-label">Status
                                    hubungan<span class="text-danger">*</span></label>
                                <div class="col-lg-10 col-md-9">
                                    <select name="emergency_contact_relationship" id="emergency_contact_relationship"
                                        class="form-control form-select-sm">
                                        <option value="">-- Pilih Hubungan --</option>
                                        @foreach (relationships() as $index => $relationship)
                                            <option value="{{ $index }}"
                                                {{ old('emergency_contact_relationship', $user->relationUser[0]->emergency_contact_relationship ?? '') == $index ? 'selected' : '' }}>
                                                {{ $relationship }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('emergency_contact_relationship'))
                                        <div class="small text-danger">
                                            {{ $errors->first('emergency_contact_relationship') }}</div>
                                    @endif
                                </div>
                            </div>


                            <x-form.input label="No. Kontak Darurat" type="number" name="emergency_contact_phone"
                                value="{{ $user->relationUser[0]->emergency_contact_phone ?? null }}" :isRequired="true" />

                            <x-form.input label="Alamat Kontak Darurat" name="emergency_contact_address"
                                value="{{ $user->relationUser[0]->emergency_contact_address ?? null }}"
                                :textarea="true" :isRequired="true" />
                            <hr>
                            <h3>Akun Login</h3>
                            <hr>
                            <x-form.input label="Username" name="username" value="{{ $user->username }}"
                                :isRequired="true" />
                            <x-form.input label="Password" type="password" name="password" />
                            <hr>

                            <div class="row mb-3">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3"></div>
                                    <div class="col-lg-10 col-md-9">
                                        <button type="submit" class="btn btn-sm btn-primary"><i
                                                class="bi-save me-1"></i>
                                            Submit</button>
                                        <a href="{{ route('member.profile') }}" class="btn btn-sm btn-secondary"><i
                                                class="bi-arrow-left me-1"></i> Kembali</a>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script>
        // Datepicker
        datepick("input[name=birthdate]");
        datepick("input[name=start_date]");
        datepick("input[name=end_date]");
        datepick("input[name=start_date_kontrak]");

        function datepick(input) {
            $(document).ready(function() {
                $(input).datepicker({
                    dateFormat: "yy-mm-dd", // Format tanggal
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "1900:2025" // Batas tahun (sesuaikan sesuai kebutuhan)
                }).focus(function() {
                    $(this).datepicker("show");
                });
            });
        }
    </script>

@endsection

@section('css')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

@endsection
