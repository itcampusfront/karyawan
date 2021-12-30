<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\User;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get the user
        $user = User::findOrFail(Auth::user()->id);

        // View
        return view('member/position', [
            'user' => $user,
        ]);
    }
}
