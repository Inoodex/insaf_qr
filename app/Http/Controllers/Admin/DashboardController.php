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
        $totalVerifications = AccountVerification::count();
        $recentVerifications = AccountVerification::latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'totalVerifications',
            'recentVerifications'
        ));
    }
}
