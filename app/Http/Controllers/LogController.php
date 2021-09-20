<?php

namespace App\Http\Controllers;

use App\Events\LogIsCreated;
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
        return view('log.show', compact('logs', 'cardId'));
    }

    public function create()
    {
        return view('log.create');
    }

    public function store(Request $request)
    {
        $updated = ['logged_at' => Carbon::parse($request->input('logged_at'))->format('y-m-d')];

        $log = Log::create(array_merge($request->input(), $updated));

        event(new LogIsCreated($log));

        if ($log) {
            return response()->json(['data' => $log]);
        } else {
            return response()->json(['message' => 'cannot store value'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        return Log::destroy($id);
    }
}
