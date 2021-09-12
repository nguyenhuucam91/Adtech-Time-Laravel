<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateLogController extends Controller
{
    public function showCreateLogView()
    {
        return view('create-log.create');
    }
}
