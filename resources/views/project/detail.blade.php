@extends('layout.main')
@section('main')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="/dashboard">
                                <i class="icon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="/projects">Projects</a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Detail Project</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row" style="display: flex; align-items: center">
                        <div class="col-md-10">
                            <img src="{{ asset('assets/img/pdficon.svg') }}" alt="" class="img-fluid"
                                style="height: 55px; width: 55px">
                            @if ($project->file)
                                @php
                                    $fileExtension = pathinfo($project->file, PATHINFO_EXTENSION);
                                @endphp
                                <strong class="ms-3" style="color: rgb(6, 159, 215)">
                                    <a href="{{ asset('fileprojects/' . $project->file) }}"
                                        @if ($fileExtension != 'pdf') download @endif
                                        target="_blank">{{ $project->file }}</a>
                                </strong>
                            @else
                                <strong>File tidak ditemukan</strong>
                            @endif
                        </div>
                        <div class="col-md-2">
                            @can('admin')
                                <button class="btn btn-md btn-info" data-bs-toggle="modal" data-bs-target="#addfileproject">
                                    @if ($project->file)
                                        Change File
                                    @else
                                        Add File
                                    @endif
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="row">
                            <h4 class="card-title mb-0">{{ ucwords($project->name) }}</h4>
                            <small>({{ \Carbon\Carbon::parse($project->start_date)->translatedFormat('d F Y') }} -
                                {{ \Carbon\Carbon::parse($project->end_date)->translatedFormat('d F Y') }})</small>
                        </div>
                        @can('admin')
                            @if ($project->status == 2)
                            <div class="d-flex">
                                <button class="btn btn-success btn-round me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $project->id }}">
                                    Edit
                                </button>

                                <button class="btn btn-danger btn-round me-2" data-bs-toggle="modal"
                                    data-bs-target="#endProjectModal">
                                    {{-- <i class="fa fa-check"></i> --}}
                                    End
                                </button>
                            </div>
                            @elseif ($project->status == 3)
                                <button class="btn btn-danger btn-round me-2" data-bs-toggle="modal"
                                    data-bs-target="#deleteProjectModal">
                                    Delete
                                </button>
                            @endif
                        @endcan
                        <div class="modal fade" id="deleteProjectModal" tabindex="-1"
                            aria-labelledby="endProjectModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="endProjectModalLabel">Confirm Delete Project</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this project?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel
                                        </button>
                                        <form action="/deleteproject" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $project->id }}">
                                            <button type="submit" class="btn btn-danger">Delete Project</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- modal edit project  -->
                        <div class="modal fade" id="editModal{{ $project->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $project->id }}" aria-hidden="true" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title" id="editModalLabel{{ $project->id }}">Edit Project</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('projects.update') }}" method="POST">
                                        <div class="row">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $project->id }}">

                                            <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label for="project-name-{{ $project->id }}" class="form-label">Nama Project</label>
                                                <input type="text" class="form-control" id="project-name-{{ $project->id }}" name="name" value="{{ $project->name }}" required>
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group form-group-default">
                                                <label for="project-start-{{ $project->id }}" class="form-label">Start Date</label>
                                                <input type="date" class="form-control" id="project-start-{{ $project->id }}" name="start_date" value="{{ $project->start_date }}" required>
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group form-group-default">
                                                <label for="project-end-{{ $project->id }}" class="form-label">End Date</label>
                                                <input type="date" class="form-control" id="project-end-{{ $project->id }}" name="end_date" value="{{ $project->end_date }}" required>
                                            </div>
                                            </div>
                                            </div>
                                            <div class="modal-footer border-0">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                           
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal end project -->
                        <div class="modal fade" id="endProjectModal" tabindex="-1" aria-labelledby="endProjectModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="endProjectModalLabel">Confirm End Project</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to end this project?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel
                                        </button>
                                        <form action="/endproject" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $project->id }}">
                                            <button type="submit" class="btn btn-danger">End Project</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- modal add file -->
                        <div class="modal fade" id="addfileproject" tabindex="-1" aria-labelledby="endProjectModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="endProjectModalLabel">
                                            @if ($project->file)
                                                Change File
                                            @else
                                                Add File
                                            @endif
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                        </button>
                                    </div>
                                    <form action="/fileproject" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group mt-3">
                                                <label for="defaultInput" class="form-label">File Project (Max 5MB)</label>
                                                <div class="d-flex flex-column">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <input type="file" class="form-control" name="file"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="id" value="{{ $project->id }}">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Minggu ke</th>
                                    <th>Rencana Progress (%)</th>
                                    <th>Akumulatif Rencana (%)</th>
                                    <th>Realisasi Progress (%)</th>
                                    <th>Akumulatif Realisasi (%)</th>
                                    <th>Deviasi Mingguan (%)</th>
                                    <th>Deviasi Kumulatif (%)</th>
                                    <th>Kendala</th>
                                    @can('admin')
                                        @if ($project->status == 2 || $project->status == 3)
                                            <th style="width: 10%">Action</th>
                                        @endif
                                    @endcan
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Minggu ke</th>
                                    <th>Rencana Progress (%)</th>
                                    <th>Akumulatif Rencana (%)</th>
                                    <th>Realisasi Progress (%)</th>
                                    <th>Akumulatif Realisasi (%)</th>
                                    <th>Deviasi Mingguan (%)</th>
                                    <th>Deviasi Kumulatif (%)</th>
                                    <th>Kendala</th>
                                    @can('admin')
                                        @if ($project->status == 2 || $project->status == 3)
                                            <th>Action</th>
                                        @endif
                                    @endcan
                                </tr>
                            </tfoot>
                            <tbody>
                                @php
                                    $accumulatedPlan = 0;
                                    $accumulatedActual = 0;
                                    $accumulatedDeviation = 0;
                                    $weekreport = 1;
                                    $currentMonth = null;
                                    $currentYear = null;
                                    $monthRowspan = 0;
                                @endphp

                                @foreach ($reports as $report)
                                    @if ($report->report_month !== $currentMonth || $report->report_year !== $currentYear)
                                        @if ($currentMonth !== null)  
                                            </tr>
                                        @endif
                                        <tr>
                                            <td rowspan="{{ $reports->where('report_month', $report->report_month)->where('report_year', $report->report_year)->count() }}">
                                                {{ date('F', mktime(0, 0, 0, $report->report_month, 10)) }} {{ $report->report_year }}
                                            </td>
                                        @php
                                            $currentMonth = $report->report_month;
                                            $currentYear = $report->report_year;
                                        @endphp
                                    @else
                                        <tr>
                                    @endif

                                    <td>W{{ $weekreport++ }}</td>
                                    <td>{{ $report->plan_progress }}</td>

                                    @if ($report->plan_progress !== null)
                                        @php
                                            $accumulatedPlan += $report->plan_progress;
                                        @endphp
                                        <td>{{ round($accumulatedPlan, 2) }}</td>
                                    @else
                                        <td></td>
                                    @endif

                                    <td>{{ $report->actual_progress }}</td>

                                    @if ($report->actual_progress !== null)
                                        @php
                                            $accumulatedActual += $report->actual_progress;
                                        @endphp
                                        <td>{{ round($accumulatedActual, 2) }}</td>
                                    @else
                                        <td></td>
                                    @endif

                                    @if ($report->actual_progress != null && $report->plan_progress != null)
                                        @php
                                            $weeklyDeviation = round($report->actual_progress - $report->plan_progress, 2);
                                        @endphp
                                        <td>{{ $weeklyDeviation }}</td>
                                    @else
                                        <td></td>
                                    @endif

                                    @if ($report->actual_progress != null && $report->plan_progress != null)
                                        @php
                                            $accumulatedDeviation += $weeklyDeviation;
                                        @endphp
                                        <td>{{ round($accumulatedDeviation, 2) }}</td>
                                    @else
                                        <td></td>
                                    @endif

                                    <td>
                                        @if ($report->kendala)
                                            {{ $report->kendala }}
                                        @else
                                            @if ($report->created_at != $report->updated_at)
                                                -
                                            @endif
                                        @endif
                                    </td>

                                    @can('admin')
                                        @if ($project->status == 2 || $project->status == 3)
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-bs-toggle="modal" title="Edit Report"
                                                        data-bs-target="#EditRowModal{{ $report->id }}"
                                                        class="btn btn-link btn-primary btn-lg">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        @endif
                                    @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- tambahan style tabel -->
                <html lang="en">
                <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Table with Sticky Header</title>
                <style>
                    .table-responsive {
                        max-height: 500px; 
                        overflow-y: auto;
                    }

                    thead tr {
                        background-color: #ffffff; 
                    }

                  
                    th {
                        position: sticky;
                        top: 0;
                        background-color: #ffffff !important;
                        color: #333;
                        z-index: 1; /* Atur z-index lebih rendah untuk tetap di atas konten */
                        border-bottom: 2px solid #ddd;
                        padding: 8px;
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                    }


                    table{
                        border-collapse: collapse;
                        width: 100%;
                    }

                    th, td {
                        border: 1px solid #ddd;
                        text-align: center;
                        padding: 8px;
                    }
                </style>
            </head>

                <!-- modal -->
                @foreach ($reports as $report)
                    <div class="modal fade" id="EditRowModal{{ $report->id }}" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold"> Edit Row</span>
                                    </h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/updatereport" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $report->id }}">
                                    <div class="modal-body">
                                        <p class="small">Edit Data Project</p>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-3">
                                                    <label for="defaultInput" class="form-label">Rencana Progress</label>
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <span class="me-2">W{{ $report->report_week }}:</span>
                                                            <input type="number" class="form-control" id="defaultInput1"
                                                                name="plan_progress" value="{{ $report->plan_progress }}"
                                                                placeholder="Minggu {{ $report->report_week }}"
                                                                style="max-width: 150px;" step="0.01" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-3">
                                                    <label for="defaultInput" class="form-label">Realisasi
                                                        Progress</label>
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <span class="me-2">W{{ $report->report_week }}:</span>
                                                            <input type="number" class="form-control" id="defaultInput1"
                                                                name="actual_progress"
                                                                value="{{ $report->actual_progress }}"
                                                                placeholder="Minggu {{ $report->report_week }}"
                                                                style="max-width: 150px;" step="0.01" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mt-3">
                                                    <label for="defaultInput" class="form-label">Kendala</label>
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <textarea name="kendala" class="form-control" cols="30" rows="3"
                                                                placeholder="Kendala report W{{ $report->report_week }}">{{ $report->kendala }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="submit" id="addRowButton" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
