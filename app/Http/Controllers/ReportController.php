<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Report;
use Illuminate\Http\Request;;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;

class ReportController extends Controller
{
    public function update(Request $request)
    {
        $report = Report::where('id', $request->id)->first();
        $validatedData = [
            "plan_progress" => $request->plan_progress,
            "actual_progress" => $request->actual_progress,
            "kendala" => $request->kendala
        ];
        $report->update($validatedData);
        return back();
    }
}
