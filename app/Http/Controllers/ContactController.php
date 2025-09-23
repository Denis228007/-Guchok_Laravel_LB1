<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index() {
        return view('contact.index');
    }

    public function feedback() {
        return view('contact.feedback');
    }

    public function support() {
        return view('contact.support');
    }
}
