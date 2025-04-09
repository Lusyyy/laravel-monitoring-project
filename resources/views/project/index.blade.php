@extends('layout.main')
@section('main')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Projects</h3>
                    <h6 class="op-7 mb-2">All Projects</h6>
                </div>

                @can('admin')
                    <div class="ms-md-auto py-2 py-md-0">
                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addProjectModal">
                            <i class="fa fa-plus"></i>
                            Add Project
                        </button>
                    </div>
                @endcan
            </div>
            <!-- Modal -->
            <div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">
                                <span class="fw-mediumbold">Tambahkan Project</span>
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- modal add project --}}
                            <form action="{{ route('project.add') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Nama Project</label>
                                            <input id="addProjectName" name="name" type="text" class="form-control"
                                                placeholder="" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>Start Date</label>
                                            <input id="addStartDate" name="start_date" type="date" class="form-control"
                                                placeholder="" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>End Date</label>
                                            <input id="addEndDate" name="end_date" type="date" class="form-control"
                                                placeholder="" required />
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" class="btn btn-primary">
                                Add
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- card projects -->
            <div class="filter-buttons mb-3 d-flex justify-content-center">
                <button class="btn btn-info mx-2" onclick="filterProjects('all', this)">All</button>
                <button class="btn btn-info mx-2" onclick="filterProjects(1, this)">Upcoming</button>
                <button class="btn btn-info mx-2" onclick="filterProjects(2, this)">Ongoing</button>
                <button class="btn btn-info mx-2" onclick="filterProjects(3, this)">Complete</button>
            </div>

            <div class="row">
                @foreach ($projects as $project)
                    <div class="col-md-4">
                        <div class="card card-post card-round" data-status="{{ $project->status }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-10">
                                        <h3 class="card-title">
                                            <a href="#"> {{ $project->name }} </a>
                                        </h3>
                                    </div>
                                    <div class="col-2 ms-right">
                                        <div class="icon-status">
                                            @if ($project->status == 1)
                                                <i class="icon-share-alt" title="Upcoming Project"
                                                    style="color: #31ce36; font-weight: bolder; font-size: large">
                                                </i>
                                            @elseif ($project->status == 2)
                                                <i class="icon-refresh" title="Ongoing Project"
                                                    style="color: #6861ce; font-weight: bolder; font-size: large">
                                                </i>
                                            @else
                                                <i class="icon-check" title="Completed Project"
                                                    style="color: #1572e8; font-weight: bolder; font-size: large">
                                                </i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    <strong class="project-start-date">Start Date:
                                    </strong>{{ \Carbon\Carbon::parse($project->start_date)->translatedFormat('d F Y') }}
                                    <br>
                                    <strong class="project-end-date">End Date:</strong>
                                    {{ \Carbon\Carbon::parse($project->end_date)->translatedFormat('d F Y') }}
                                </p>
                                <a href="/project/{{ $project->slug }}" class="btn btn-primary btn-rounded btn-sm">View
                                    Detail
                                </a>
                                @can('admin')
                                    @if ($project->status == 1)
                                        <a href="#" class="btn btn-success btn-rounded btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#startConfirmationModal{{ $project->id }}">Start Project</a>
                                    @endif
                                @endcan
                            </div>
                        </div>
                    </div>
                    <!-- modal start project -->
                    <div class="modal fade" id="startConfirmationModal{{ $project->id }}" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Start Project</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to start project <strong>{{ $project->name }}</strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                    <form action="/startproject" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $project->id }}">
                                        <button type="submit" class="btn btn-primary" id="confirmStart">Start
                                            Project</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function filterProjects(status, button) {
            const cards = document.querySelectorAll('.card-post');
            const buttons = document.querySelectorAll('.filter-buttons button');

            cards.forEach(card => {
                const projectStatus = parseInt(card.getAttribute('data-status'));

                if (status === 'all' || projectStatus === status) {
                    card.closest('.col-md-4').style.display = 'block';
                } else {
                    card.closest('.col-md-4').style.display = 'none';
                }
            });

            buttons.forEach(btn => {
                btn.classList.remove('btn-success');
                btn.classList.add('btn-info');
            });

            button.classList.remove('btn-info');
            button.classList.add('btn-success');
        }
    </script>
@endsection
