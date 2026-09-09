<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountVerification;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the Admin Dashboard Overview.
     */
    public function index()
    {
        $userId = auth()->id();
        $totalVerifications = AccountVerification::where('user_id', $userId)->count();
        $recentVerifications = AccountVerification::where('user_id', $userId)->latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'totalVerifications',
            'recentVerifications'
        ));
    }
}
