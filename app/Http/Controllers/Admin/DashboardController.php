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
            'users' => User::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}
