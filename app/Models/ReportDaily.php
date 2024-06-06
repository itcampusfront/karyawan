<?php

namespace App\Models;

use App\Models\User;
use App\Models\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportDaily extends Model
{
    use HasFactory;

    protected $table = 'report_dailies';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
