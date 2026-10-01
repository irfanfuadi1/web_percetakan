<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')
            ->latest('created_at');


        /*
        |--------------------------------------------------------------------------
        | FILTER USER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('user')) {

            $search = $request->user;

            $query->whereHas('user', function ($userQuery) use ($search) {

                $userQuery
                    ->where('username', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");

            });
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date')) {

            $query->whereDate(
                'created_at',
                $request->date
            );

        }


        $activityLogs = $query
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | DATA USER
        |--------------------------------------------------------------------------
        */

        $users = User::query()
            ->whereIn('role', [
                'admin',
                'desainer',
            ])
            ->orderBy('username')
            ->get();


        return view(
            'activity_logs.index',
            compact(
                'activityLogs',
                'users'
            )
        );
    }
}