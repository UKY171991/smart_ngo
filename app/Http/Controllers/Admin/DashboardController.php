<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Donation;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_members' => User::where('role', 'member')->count(),
            'total_donations' => Donation::where('status', 'completed')->sum('amount'),
            'pending_enquiries' => \App\Models\Enquiry::where('status', 'pending')->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}
