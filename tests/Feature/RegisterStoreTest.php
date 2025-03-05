<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use App\Models\RelationUser;

class RegisterStoreTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_registers_a_new_user_successfully()
    {
        $response = $this->post(route('auth.register.store'), [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone_number' => '081234567890',
            'birthdate' => '01/01/2000',
            'gender' => 'L',
            'username' => 'johndoe',
            'password' => 'password123',
            'latest_education' => 'Bachelor',
            'college' => 'XYZ University',
            'faculty' => 'Computer Science',
            'jurusan' => 'Software Engineering',
            'tahun' => '2020',
            'nik' => '3374060303000001',
            'emergency_contact_name' => 'Jane Doe',
            'emergency_contact_relationship' => 'Sister',
            'emergency_contact_phone' => '081234567891',
            'emergency_contact_address' => '123 Street, City',
            'skill' => 'Programming',
            'hobby' => 'Reading',
            'address_1' => '123 Main St',
            'address_2' => 'Apt 4B',
        ]);

        $response->assertRedirect(route('auth.login'));

        $user = User::where('email', 'johndoe@example.com')->first();
        $this->assertNotNull($user, 'User was not created');

        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com',
            'username' => 'johndoe',
            'latest_education' => json_encode([
                'latest_education' => 'Bachelor',
                'college' => 'XYZ University',
                'faculty' => 'Computer Science',
                'jurusan' => 'Software Engineering',
                'tahun' => '2020',
            ], JSON_THROW_ON_ERROR),
        ]);

        $this->assertDatabaseHas('relation_users', [
            'user_id' => $user->id,
            'nik' => '3374060303000001',
            'emergency_contact_name' => 'Jane Doe',
            'emergency_contact_relationship' => 'Sister',
            'emergency_contact_phone' => '081234567891',
            'emergency_contact_address' => '123 Street, City',
            'skill' => 'Programming',
            'hobby' => 'Reading',
        ]);
    }

    /** @test */
    public function it_fails_when_required_fields_are_missing()
    {
        $response = $this->post(route('auth.register.store'), []);

        $response->assertSessionHasErrors([
            // Validasi User
            'name', 'email', 'phone_number', 'birthdate', 'gender', 'username', 'password',
            // Validasi Relation Users
            'nik', 'emergency_contact_name', 'emergency_contact_relationship', 
            'emergency_contact_phone', 'emergency_contact_address', 'skill', 'hobby',
            // Validasi Address
            'address_1', 'address_2',
            // Validasi Education
            'latest_education', 'college', 'faculty', 'jurusan', 'tahun',
        ]);
    }
}
