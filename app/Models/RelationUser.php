<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RelationUser extends Model
{
    use HasFactory;
    protected $table = 'relation_users'; // Nama tabel yang digunakan

    protected $fillable = [
        'user_id', // Pastikan kolom ini ada dalam database
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_address',
        'emergency_contact_phone',
        'skill',
        'hobby',
        'nik'
    ];

    /**
     * Mendefinisikan relasi dengan model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
