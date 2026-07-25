<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'certificates' => Certificate::count(),
            'active_certificates' => Certificate::where('status', 'Active')->count(),
            'inactive_certificates' => Certificate::where('status', '!=', 'Active')->count(),
            'users' => User::count(),
        ];

        $recentCertificates = Certificate::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentCertificates'));
    }
}
