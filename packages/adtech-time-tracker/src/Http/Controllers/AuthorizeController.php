<?php

namespace Adtech\AdtechTimeTracker\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorizeController extends Controller
{
    public function index()
    {
        return view('adtech-time-tracker::authorize.index');
    }

    public function success()
    {
        return view('adtech-time-tracker::authorize.success');
    }
}
