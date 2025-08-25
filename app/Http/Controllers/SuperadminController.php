<?php

// app/Http/Controllers/SuperadminController.php
namespace App\Http\Controllers;

class SuperadminController extends Controller
{
    public function dashboard()
    {
        return view('superadmin.dashboard');
    }

    public function requestIndex()
    {
        return view('superadmin.request');
    }

    public function sparepartIndex()
    {
        return view('superadmin.sparepart');
    }

    public function historyIndex()
    {
        return view('superadmin.history');
    }
}

