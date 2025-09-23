<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {
        return view('profile.index');
    }

    public function settings() {
        return view('profile.settings');
    }

    public function history() {
        return view('profile.history');
    }
public function echoJson(Request $request)
{
    $data = $request->all();
    return response()->json([
        'status' => 'success',
        'received_data' => $data
    ]);
}
}
