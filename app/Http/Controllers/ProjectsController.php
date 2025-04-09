<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Projects;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log; 

class ProjectsController extends Controller
{
    public function index()
    {
        $start = Projects::where('status', 1)->where('start_date', '<', Carbon::now())->get();
        if ($start) {
            foreach ($start as $sta) {
                $update["status"] = 2;
                $sta->update($update);
            }
        }

        $end = Projects::where('status', 2)->where('end_date', '<', Carbon::now())->get();
        if ($end) {
            foreach ($end as $en) {
                $update["status"] = 3;
                $en->update($update);
            }
        }

        $projects = Projects::where('name', 'like', '%' . request('search') .  '%')->get();
        return view('project.index', ['projects' => ($projects)]);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        $validatedData['slug'] = Str::random(30);

        $project = Projects::create($validatedData);
        $start = Carbon::parse($project->start_date);
        $end = Carbon::parse($project->end_date);

        for ($date = $start->copy(); $date->lessThanOrEqualTo($end); $date->addDay()) {
            $reportYear = $date->format('Y');
            $reportMonth = $date->format('n');
            $dayOfMonth = $date->day;
        
            if ($dayOfMonth >= 1 && $dayOfMonth <= 7) {
                $week = 1;
            } elseif ($dayOfMonth >= 8 && $dayOfMonth <= 14) {
                $week = 2;
            } elseif ($dayOfMonth >= 15 && $dayOfMonth <= 21) {
                $week = 3;
            } else {
                $week = 4;
            }
        
            Report::firstOrCreate([
                'project_id' => $project->id,
                'report_year' => $reportYear,
                'report_month' => $reportMonth,
                'report_week' => $week,
            ]);
        }
        

        return redirect('/projects');
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:projects,id',
            'name' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
    
        $project = Projects::findOrFail($request->id);
   
        $oldStart = Carbon::parse($project->start_date);
        $oldEnd = Carbon::parse($project->end_date);
        $newStart = Carbon::parse($validatedData['start_date']);
        $newEnd = Carbon::parse($validatedData['end_date']);
    
        $isStartDateChanged = $oldStart->ne($newStart);
        $isEndDateChanged = $oldEnd->ne($newEnd);
    
        $project->update([
            'name' => $validatedData['name'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
        ]);
    
       
        if ($isStartDateChanged || $isEndDateChanged) {  
            if ($newStart->lessThan($oldStart)) {
                for ($date = $newStart->copy(); $date->lessThan($oldStart); $date->addDay()) {
                    $this->createReport($project->id, $date);
                }
            }
            if ($newEnd->greaterThan($oldEnd)) {
                for ($date = $oldEnd->copy()->addDay(); $date->lessThanOrEqualTo($newEnd); $date->addDay()) {
                    $this->createReport($project->id, $date);
                }
            }
 
            Report::where('project_id', $project->id)
                ->where(function ($query) use ($newStart, $newEnd) {
                    $query->where('report_year', '<', $newStart->year)
                        ->orWhere('report_year', '>', $newEnd->year)
                        ->orWhere(function ($subQuery) use ($newStart) {    
                            $subQuery->where('report_year', $newStart->year)
                                ->where('report_month', '<', $newStart->month);
                        })
                        ->orWhere(function ($subQuery) use ($newEnd) {
                            $subQuery->where('report_year', $newEnd->year)
                                ->where('report_month', '>', $newEnd->month);
                        });
                })
                ->delete();
        }
    
        return back();
    }
    
    private function createReport($projectId, $date)
    {
        $reportYear = $date->format('Y');
        $reportMonth = $date->format('n');
        $dayOfMonth = $date->day;
        $week = $date->weekOfMonth;
    
        // Tentukan minggu berdasarkan hari dalam bulan
        if ($dayOfMonth >= 1 && $dayOfMonth <= 7) {
            $week = 1;
        } elseif ($dayOfMonth >= 8 && $dayOfMonth <= 14) {
            $week = 2;
        } elseif ($dayOfMonth >= 15 && $dayOfMonth <= 21) {
            $week = 3;
        } else {
            $week = 4;
        }

        Report::firstOrCreate([
            'project_id' => $projectId,
            'report_year' => $reportYear,
            'report_month' => $reportMonth,
            'report_week' => $week,
        ]);
    }
    
    

    public function detail($slug)
    {
        $project = Projects::where('slug', $slug)->first();
        $reports = Report::where('project_id', $project->id)
        ->get();

        return view('project.detail', [
            "project" => $project,
            "reports" => $reports
        ]);
    }

    public function startproject(Request $request)
    {
        $project = Projects::findOrFail($request->id);
        $validatedData["status"] = 2;
        $validatedData["start_date"] = now();
        $project->update($validatedData);

        Report::where('project_id', $project->id)->delete();

        $start = Carbon::parse($project->start_date);
        $end = Carbon::parse($project->end_date);

        for ($date = $start->copy(); $date->lessThanOrEqualTo($end); $date->addDay()) {
            $reportYear = $date->format('Y');
            $reportMonth = $date->format('n');
            $dayOfMonth = $date->day;
        
            if ($dayOfMonth >= 1 && $dayOfMonth <= 7) {
                $week = 1;
            } elseif ($dayOfMonth >= 8 && $dayOfMonth <= 14) {
                $week = 2;
            } elseif ($dayOfMonth >= 15 && $dayOfMonth <= 21) {
                $week = 3;
            } else {
                $week = 4;
            }
        
            Report::firstOrCreate([
                'project_id' => $project->id,
                'report_year' => $reportYear,
                'report_month' => $reportMonth,
                'report_week' => $week,
            ]);
        }
        

        return redirect("/project/" . $project->slug);
    }

    public function endproject(Request $request)
    {
        $project = Projects::where('id', $request->id)->first();
        $validatedData["end_date"] = now();
        $validatedData["status"] = 3;
        $project->update($validatedData);
        return back();
    }

    public function deleteproject(Request $request)
    {
        Projects::destroy($request->id);
        return redirect('/projects');
    }

    public function fileproject(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);
        $file = $request->file('file');

        $filename = time() . '-' . $file->getClientOriginalName();
        $destinationPath = public_path('fileprojects');
        $file->move($destinationPath, $filename);

        $project = Projects::where('id', $request->id)->first();
        $validatedData["file"] = $filename;
        $project->update($validatedData);

        return back();
    }
}