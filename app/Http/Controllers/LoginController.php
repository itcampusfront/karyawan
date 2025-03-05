<?php

namespace App\Http\Controllers;

use Auth;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\RelationUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // View
        return view('auth/login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        // Validator
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:6',
            'password' => 'required|string|min:6',
        ]);

        // Check login type
        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Set credentials
        $credentials = [
			$loginType => $request->username,
			'password' => $request->password,
            'role_id' => role('member')
		];

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('member.dashboard');
        }

        return back()->withErrors([
            'message' => 'Username atau password yang dimasukkan tidak tersedia.',
        ]);
    }
    
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('auth.login');
    }


    public function register(Request $request)
    {
        return view('auth.register');
    }

    public function registerStore(Request $request)
    {
        try {
            // Gabungkan semua aturan validasi dalam satu pemanggilan
            $validatedData = $request->validate([
                // Validasi User
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone_number' => 'required|numeric',
                'birthdate' => 'required|date_format:d/m/Y',
                'gender' => 'required|in:L,P',
                'username' => 'required|string|unique:users,username',
                'password' => 'required|string|min:8',
        
                // Validasi Relation Users
                'nik' => 'required|numeric|digits:16|unique:relation_users,nik',
                'emergency_contact_name' => 'required|string',
                'emergency_contact_relationship' => 'required|string',
                'emergency_contact_phone' => 'required|numeric',
                'emergency_contact_address' => 'required|string',
                'skill' => 'required|string',
                'hobby' => 'required|string',
        
                // Validasi Address
                'address_1' => 'required|string',
                'address_2' => 'required|string',
        
                // Validasi Education
                'latest_education' => 'required|string',
                'college' => 'required|string',
                'faculty' => 'required|string',
                'jurusan' => 'required|string',
                'tahun' => 'required|numeric',
            ]);
        
            // Konversi format birthdate
            $validatedData['birthdate'] = Carbon::createFromFormat('d/m/Y', $validatedData['birthdate'])->format('Y-m-d');
        
            // Simpan data ke tabel users
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone_number'],
                'birthdate' => $validatedData['birthdate'],
                'gender' => $validatedData['gender'],
                'username' => $validatedData['username'],
                'password' => bcrypt($validatedData['password']),
                'role_id' => 3,
                'group_id' => 1,
                'office_id' => 0,
                'position_id' => 0,
                'address' => json_encode([
                    'address_1' => $validatedData['address_1'],
                    'address_2' => $validatedData['address_2'],
                ]),
                'latest_education' => json_encode([
                    'latest_education' => $validatedData['latest_education'],
                    'college' => $validatedData['college'],
                    'faculty' => $validatedData['faculty'],
                    'jurusan' => $validatedData['jurusan'],
                    'tahun' => $validatedData['tahun'],
                ]),
                'status' => 0,
            ]);
        
            // Simpan data ke tabel relation_users
            $user->relationUser()->create([
                'nik' => $validatedData['nik'],
                'emergency_contact_name' => $validatedData['emergency_contact_name'],
                'emergency_contact_relationship' => $validatedData['emergency_contact_relationship'],
                'emergency_contact_phone' => $validatedData['emergency_contact_phone'],
                'emergency_contact_address' => $validatedData['emergency_contact_address'],
                'skill' => $validatedData['skill'],
                'hobby' => $validatedData['hobby'],
            ]);

            
        
            return redirect()->route('auth.login')->with('success', 'Registrasi Berhasil.');
        
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
        
    }
}