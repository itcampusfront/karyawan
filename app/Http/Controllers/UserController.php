<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\RelationUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('member.profile.profile', compact('user'));
    }

    public function edit(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('member.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        
        $user = Auth::user();
        $relate_user = RelationUser::firstOrNew(['user_id' => $user->id]);

        try {
            $validatedUserData = request()->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone_number' => 'required|numeric',
                'birthdate' => 'required|date',
                'gender' => 'required',
                'address_1' => 'required|string',
                'address_2' => 'nullable|string',
                'username' => 'required|string|unique:users,username,' . $user->id,
                'password' => 'nullable|string|min:6',
            ]);

            $validatedRelationUserData = request()->validate([
                'skill' => 'nullable|string',
                'hobby' => 'nullable|string',
                'nik' => 'nullable|numeric|digits:16',
                'emergency_contact_name' => 'nullable|string',
                'emergency_contact_relationship' => 'nullable|string',
                'emergency_contact_phone' => 'nullable|numeric',
                'emergency_contact_address' => 'nullable|string',
            ]);

            $educationData = request()->validate([
                'latest_education' => 'nullable|string',
                'college' => 'nullable|string',
                'faculty' => 'nullable|string',
                'jurusan' => 'nullable|string',
                'tahun' => 'nullable|numeric',
            ]);
            $validatedUserData['birthdate'] = Carbon::createFromFormat('m/d/Y', request('birthdate'))->format('Y-m-d');
            $validatedUserData['latest_education'] = json_encode($educationData);

            if (!empty($validatedUserData['password'])) {
                $validatedUserData['password'] = bcrypt($validatedUserData['password']);
            } else {
                unset($validatedUserData['password']);
            }

            // Update data di model User
            $user->update($validatedUserData);

            // Update atau buat data di model RelationUser
            $relate_user->fill($validatedRelationUserData);
            $relate_user->user_id = $user->id;
            $relate_user->save();

            
            return redirect()->route('member.profile')->with('success', 'Data berhasil diperbarui!');
        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }


    }
}
