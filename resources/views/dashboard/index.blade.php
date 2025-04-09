@extends('layout.main')
@section('main')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold">Dashboard</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="icon-folder-alt"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Projects</p>
                                        <h4 class="card-title">{{ $projects }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="icon-share-alt"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Upcoming</p>
                                        <h4 class="card-title">{{ $upcoming }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="icon-refresh"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Ongoing</p>
                                        <h4 class="card-title">{{ $ongoing->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="icon-check"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Project Done</p>
                                        <h4 class="card-title">{{ $done }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h6 class="op-7 mb-2">Ongoing Project</h6>
                @foreach ($ongoing as $ong)
                    <div class="col-md-4">
                        <div class="card" id="dash-project">
                            <div class="card-body pb-0">
                                <div class="pull-in">
                                    <div class="card-body">
                                        @php
                                            $totalActualProgress = $ong->reports
                                                ->whereNotNull('actual_progress')
                                                ->sum('actual_progress');
                                            $progress = $totalActualProgress;

                                            $reportsWithDeviation = $ong->reports
                                                ->whereNotNull('actual_progress')
                                                ->whereNotNull('plan_progress');

                                            $lastFilledReport = $reportsWithDeviation
                                                ->sortByDesc(function ($report) {
                                                    return [
                                                        $report->report_year,
                                                        $report->report_month,
                                                        $report->report_week,
                                                    ];
                                                })
                                                ->first();

                                           
                                            if ($lastFilledReport) {
                                                $weeklydeviation = round(
                                                    $lastFilledReport->actual_progress -
                                                        $lastFilledReport->plan_progress,
                                                    2,
                                                );
                                            } else {
                                                $weeklydeviation = null;
                                            }
                                            
                                            $accumulatedDeviation = $reportsWithDeviation->reduce(function (
                                                $carry,
                                                $report,
                                            ) {
                                                return $carry + ($report->actual_progress - $report->plan_progress);
                                            }, 0);
                                            $accumulatedDeviation = round($accumulatedDeviation, 2);
                                        @endphp

                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-danger" style="width: {{ $progress }}%"
                                                role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-2">
                                            <p class="text-muted mb-0">Progress</p>
                                            <p class="text-muted mb-0">{{ $progress }}%</p>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="mb-2">
                                    <a href="/project/{{ $ong->slug }}"
                                        style="text-decoration: none; font-weight: bold;">
                                        {{ ucwords($ong->name) }}
                                    </a>
                                </h5>
                                <small>{{ \Carbon\Carbon::parse($ong->start_date)->translatedFormat('d F Y') }} -
                                    {{ \Carbon\Carbon::parse($ong->end_date)->translatedFormat('d F Y') }}</small>
                                <div class="mb-4 mt-2">
                                    <!-- Deviasi Mingguan -->
                                    <strong>
                                        @if ($weeklydeviation !== null)
                                            @if ($weeklydeviation < 0)
                                                <p>Deviasi Mingguan: <span style="color: red">{{ $weeklydeviation }} <i
                                                            class="bi bi-exclamation-circle"
                                                            style="font-weight: 500"></i></span></p>
                                            @else
                                                <p style="margin-bottom: 0.10px;">Deviasi Mingguan: <span
                                                        class="text-success">{{ $weeklydeviation }}</span></p>
                                            @endif
                                        @else
                                            <p style="margin-bottom: 0.10px;">Deviasi Mingguan: <span>-</span></p>
                                        @endif
                                    </strong>

                                    <!-- Deviasi Akumulatif -->
                                    <strong>
                                        @if ($accumulatedDeviation !== null)
                                            @if ($accumulatedDeviation < 0)
                                                <p style="margin-bottom: 0;">Deviasi Akumulatif: <span
                                                        style="color: red">{{ $accumulatedDeviation }} <i
                                                            class="bi bi-exclamation-circle"
                                                            style="font-weight: 500"></i></span></p>
                                            @else
                                                <p style="margin-bottom: 0;">Deviasi Akumulatif: <span
                                                        class="text-success">{{ $accumulatedDeviation }}</span></p>
                                            @endif
                                        @else
                                            <p style="margin-bottom: 0;">Deviasi Akumulatif: <span>-</span></p>
                                        @endif
                                    </strong>
                                </div>

                                <a href="/project/{{ $ong->slug }}" class="btn btn-primary btn-rounded btn-sm mb-4">View
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
