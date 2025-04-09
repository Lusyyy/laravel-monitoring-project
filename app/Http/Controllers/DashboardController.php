<?php

namespace App\Http\Controllers;
use App\Models\Projects;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Projects::count();
        $upcoming = Projects::where('status', 1)->count();
        $ongoing = Projects::where('status', 2)->get();
        $done = Projects::where('status', 3)->count();
        return view('dashboard.index', [
            "projects" => $projects,
            "upcoming" => $upcoming,
            "ongoing" => $ongoing,
            "done" => $done
        ]);
    }
}
