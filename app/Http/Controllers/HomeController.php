<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProblemTicket;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    // Graph: Count tickets by hotel + department
    $ticketStats = ProblemTicket::with('hotel', 'department')
        ->selectRaw('hotel_id, department_id, COUNT(*) as total')
        ->groupBy('hotel_id', 'department_id')
        ->get();

    // Prepare chart labels
    $labels = [];
    $values = [];

    foreach ($ticketStats as $stat) {
        $hotel = $stat->hotel->name ?? 'Unknown Hotel';
        $dept = $stat->department->name ?? 'Unknown Department';

        $labels[] = $hotel . ' - ' . $dept;
        $values[] = $stat->total;
    }

    return view('home', compact('labels', 'values'));
}
    // public function index()
    // {
    //     return view('home');
    // }
}
