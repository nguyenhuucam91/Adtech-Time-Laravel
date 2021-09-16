<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogController extends Controller
{
    public function show(Request $request, $cardId)
    {
        $logs = Log::where('card_id', $cardId)->orderBy('updated_at', 'desc')->get();
        if ($request->wantsJson()) {
            return response()->json(['data' => $logs]);
        }
        return view('log.show', compact('logs'));
    }

    public function index($cardId)
    {
        return response()->json(['data' => Log::where('card_id', $cardId)->get()]);
    }

    public function store(Request $request)
    {
        $updated = ['logged_at' => Carbon::parse($request->input('logged_at'))->format('y-m-d')];
        $logStored = Log::create(array_merge($request->input(), $updated));
        if ($logStored) {
            return response()->json();
        } else {
            return response()->json(['message' => 'cannot store value'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
