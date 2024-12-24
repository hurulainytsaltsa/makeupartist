<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalBookings = Booking::count();
        $totalUsers = User::count();
        $recentActivities = Booking::with('user')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Menghitung pendapatan hanya untuk booking dengan status 'completed' pada bulan ini
        $monthlyRevenue = Booking::whereMonth('created_at', now()->month)
            ->where('status', 'completed')
            ->sum('price');

        $monthlyRevenueData = [
            'labels' => [],
            'data' => []
        ];
        $monthlyOrdersData = [
            'labels' => [],
            'data' => []
        ];

        foreach (range(1, 12) as $month) {
            $monthlyRevenueData['labels'][] = date('F', mktime(0, 0, 0, $month, 1));
            $monthlyRevenueData['data'][] = Booking::whereMonth('created_at', $month)
                ->whereYear('created_at', now()->year)
                ->where('status', 'completed')
                ->sum('price');

            $monthlyOrdersData['data'][] = Booking::whereMonth('created_at', $month)
                ->whereYear('created_at', now()->year)
                ->count();
        }



        return view('admin.layouts.home', [
            'totalBookings' => $totalBookings,
            'totalUsers' => $totalUsers,
            'monthlyRevenue' => $monthlyRevenue,
            'monthlyRevenueData' => $monthlyRevenueData,
            'monthlyOrdersData' => $monthlyOrdersData,
            'recentActivities' => $recentActivities,
        ]);
    }
}
