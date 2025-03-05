<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metas -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://ajifatur.github.io/assets/spandiv.css">

    <title>Register</title>
    <style>
        body,
        body main {
            min-height: 100vh;
        }
        .login-box {
            text-align: center;
            width: 75%;
            margin: auto;
        }
    </style>
</head>

<body>
    <main class="d-flex align-items-center bg-light">
        <div class="container">
            <div class="row justify-content-center mt-5 mb-5">
                <div class="col-12 col-lg-10 rounded shadow-sm">
                    <h2 class="mb-3 text-center">Selamat Datang, Pendaftar Baru</h2>
                    <form class="form-control" method="post" action="{{ route('auth.register.store') }}">
                        @csrf
                        <div class="row d-flex">
                            <div class="col-6">
                                <h3>Informasi Pribadi</h3>
                                <hr>
                                <x-form.input label="Nama" name="name" value="{{ old('name') }}" :isRequired="true" />
                                <x-form.input label="Nomor Induk Keluarga" type="number" name="nik" :isRequired="true"
                                    value="{{ old('nik') }}" />
                                <x-form.input label="Email" type="email" name="email" value="{{ old('email') }}"
                                    :isRequired="true" />
                                <x-form.input label="No. HP" type="number" name="phone_number"
                                    value="{{ old('phone_number') }}" :isRequired="true" />
                                <x-form.input label="Tanggal Lahir" type="date" name="birthdate" value="{{ old('birthdate') }}"
                                    :isRequired="true" :isDate="true" />
                                <div class="row mb-3">
                                    <label class="col-lg-2 col-md-3 col-form-label py-0">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <div class="col-lg-10 col-md-9">
                                        <div class="gender" >
                                            @foreach (gender() as $gender)
                                                <div class="form-check ">
                                                    <input class="form-check-input " type="radio" name="gender"
                                                        id="gender-{{ $gender['key'] }}" value="{{ $gender['key'] }}" {{ old('gender') == $gender['key'] ? 'checked' : '' }}>
                                                    <label class="form-check-label " for="gender-{{ $gender['key'] }}">
                                                        {{ $gender['name'] }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ($errors->has('gender'))
                                            <div class="small text-danger">{{ $errors->first('gender') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <x-form.input label="Alamat Sesuai KTP" name="address_1" value="{{ old('address_1') }}"
                                    :isRequired="true" :textarea="true" />
                                <x-form.input label="Alamat Sesuai Domisili" name="address_2" value="{{ old('address_2') }}"
                                    :isRequired="true" :textarea="true" />
                                <x-form.input label="Keahlian Yang Dikuasai" name="skill" value="{{ old('skill') }}"
                                    :textarea="true" :isRequired="true" />
                                <x-form.input label="Hobby" name="hobby" value="{{ old('hobby') }}" :textarea="true"
                                    :isRequired="true" />
                            </div>
                            <div class="col-6">
                                <div class="col-12">
                                    <h3>Pendidikan</h3>
                                    <hr>
                                    <x-form.input label="Ijasah Terakhir" name="latest_education"
                                        value="{{ old('latest_education') }}" :textarea="true" :isRequired="true" />
                                    <x-form.input label="Perguruan Tinggi" name="college" value="{{ old('college') }}"
                                        :isRequired="true" />
                                    <x-form.input label="Fakultas" name="faculty" value="{{ old('faculty') }}"
                                        :isRequired="true" />
                                    <x-form.input label="Jurusan" name="jurusan" value="{{ old('jurusan') }}" :isRequired="true" />
                                    <x-form.input label="Tahun Masuk" type="number" name="tahun" value="{{ old('tahun') }}"
                                        :isRequired="true" />
                                </div>
                               <div class="col-12">
                                <h3>Hubungan Relasi</h3>
                                <hr>
        
                                <x-form.input label="Nama Kontak Darurat" name="emergency_contact_name"
                                    value="{{ old('emergency_contact_name') }}" :isRequired="true" />
                                <div class="row mb-3">
                                    <label for="emergency_contact_relationship" class="col-lg-2 col-md-3 col-form-label py-0">Status
                                        hubungan<span class="text-danger">*</span></label>
                                    <div class="col-lg-10 col-md-9">
                                        <select name="emergency_contact_relationship" id="emergency_contact_relationship"
                                            class="form-control form-select-sm">
                                            <option value="">-- Pilih Hubungan --</option>
                                            @foreach (relationships() as $index => $relationship)
                                                <option value="{{ $index }}" {{ old('emergency_contact_relationship') == $index ? 'selected' : '' }}>
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
                                    value="{{ old('emergency_contact_phone') }}" :isRequired="true" />
        
                                <x-form.input label="Alamat Kontak Darurat" name="emergency_contact_address"
                                    value="{{ old('emergency_contact_address') }}" :textarea="true" :isRequired="true" />
                               </div>
                               
                            </div>
                            <hr>
                            <div class="col-12">
                                <h3>Akun Login</h3>
                                {{-- <hr> --}}
                                <x-form.input label="Username" name="username" value="{{ old('username') }}"
                                    :isRequired="true" />
                                <x-form.input label="Password" type="password" name="password" />
                               </div>
                            <hr>
                        </div>                     
                        <button class="w-100 btn btn-primary mb-3" type="submit">Daftar</button>
                        <div class="text-center">
                            <h5>Sudah Punya Akun? Masuk <a href="{{ route('auth.login') }}">disini</a> </h5>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://ajifatur.github.io/assets/spandiv.min.js"></script>
    <script>
        // Enable Everywhere
        Spandiv.EnableEverywhere();
    </script>
</body>

</html>
