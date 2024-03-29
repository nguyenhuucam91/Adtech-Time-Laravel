<?php

namespace Adtech\AdtechTimeTracker\Http\Controllers;

use Adtech\AdtechTimeTracker\Events\LogIsCreated;
use Adtech\AdtechTimeTracker\Events\LogIsUpdated;
use Adtech\AdtechTimeTracker\Http\Models\Log;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogController extends Controller
{
    public function index(Request $request, $cardId)
    {
        $logs = Log::where('card_id', $cardId)->orderBy('updated_at', 'desc')
            ->get(['id', 'username', 'avatar_url', 'time_spent', 'id', 'description', 'updated_at']);
        if ($request->wantsJson()) {
            return response()->json(['data' => $logs]);
        }
        return view('adtech-time-tracker::log.index', compact('logs', 'cardId'));
    }

    public function create()
    {
        $log = new Log();
        return view('adtech-time-tracker::log.create', compact('log'));
    }

    public function store(Request $request)
    {
        $loggedAt = ['logged_at' => Carbon::parse($request->input('logged_at'))->format('y-m-d')];

        $log = Log::create(array_merge($request->input(), $loggedAt));

        event(new LogIsCreated($log));

        if ($log) {
            return response()->json(['data' => $log]);
        } else {
            return response()->json(['message' => 'cannot store log'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        return Log::destroy($id);
    }

    public function edit($id)
    {
        $log = Log::findOrFail($id);
        if ($log) {
            return view('adtech-time-tracker::log.edit', compact('log', 'id'));
        }
    }

    public function update(Request $request, $id)
    {
        $log = Log::findOrFail($id);
        if ($log) {
            $loggedAt = ['logged_at' => Carbon::parse($request->input('logged_at'))->format('y-m-d')];

            $updatedLog = $log->update(array_merge($request->input(), $loggedAt));

            event(new LogIsUpdated($log->refresh()));

            if ($updatedLog) {
                return response()->json(['data' => $log]);
            } else {
                return response()->json(['message' => 'cannot store log'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }
}
