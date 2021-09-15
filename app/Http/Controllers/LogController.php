<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function show($cardId)
    {
        $logs = Log::where('card_id', $cardId)->get();
        return view('log.show', compact('logs'));
    }

    public function index($userId)
    {
        return response()->json(['data' => Log::where('user_id', $userId)->get()]);
    }

    public function store(Request $request)
    {
        Log::create($request->input());
    }
}
