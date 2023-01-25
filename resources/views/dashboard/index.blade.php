@extends('layouts.master')
@section('title') @lang('translation.dashboard') @endsection
@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Dashboards @endslot
        @slot('title') Dashboards @endslot
    @endcomponent
            <div class="row">
                <div class="col-xl-3">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span
                                        class="avatar-title bg-soft-primary text-primary rounded-2 fs-2">
                                        <i class="ri-team-fill text-primary"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                        Total Members</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                data-target="{{ $members }}">0</span></h4>
                                        <span class="badge badge-soft-danger fs-12"><i
                                                class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>5.02
                                            %</span>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Totale member Active</p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->

                <div class="col-xl-3">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span
                                        class="avatar-title bg-soft-success text-success rounded-2 fs-2">
                                        <i class="ri-user-add-fill text-success"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-medium text-muted mb-3">Monthly Joinings</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                data-target="7522">0</span></h4>
                                        <span class="badge badge-soft-success fs-12"><i
                                                class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>3.58
                                            %</span>
                                    </div>
                                    <p class="text-muted mb-0">Members joines per month</p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->

                <div class="col-xl-3">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-info text-info rounded-2 fs-2">
                                        <i class="ri-coin-line text-info"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                        Pending Payments</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                            data-target="777">0</span></h4>
                                        <span class="badge badge-soft-danger fs-12"><i
                                                class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>10.35
                                            %</span>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Member Pending Payments</p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->

                <div class="col-xl-3">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-danger text-danger rounded-2 fs-2">
                                        <i data-feather="clock" class="text-danger"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                        Expired</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                            data-target="777">0</span></h4>
                                        <span class="badge badge-soft-danger fs-12"><i
                                                class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>10.35
                                            %</span>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Subscription Expire</p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->

    <div class="row">
        <!-- start col -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title flex-grow-1 mb-0">MONTHLY JOININGS</h4>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="btn btn-soft-info btn-sm">Export</a>
                    </div>
                </div><!-- end cardheader -->
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-centered align-middle table-success">
                            <thead class="bg-light text-muted">
                                <tr>
                                    <th scope="col">Project Name</th>
                                    <th scope="col">Project Lead</th>
                                    <th scope="col">Progress</th>
                                    <th scope="col">Assignee</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" style="width: 10%;">Due Date</th>
                                </tr><!-- end tr -->
                            </thead><!-- thead -->

                            <tbody>
                                <tr>
                                    <td class="fw-medium">Brand Logo Design</td>
                                    <td>
                                        <img src="{{ URL::asset('assets/images/users/avatar-1.jpg') }}"
                                            class="avatar-xxs rounded-circle me-1" alt="">
                                        <a href="javascript: void(0);" class="text-reset">Donald
                                            Risher</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-1 text-muted fs-13">53%</div>
                                            <div class="progress progress-sm  flex-grow-1"
                                                style="width: 68%;">
                                                <div class="progress-bar bg-primary rounded"
                                                    role="progressbar" style="width: 53%"
                                                    aria-valuenow="53" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group flex-nowrap">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-1.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-2.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-3.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-warning">Inprogress</span></td>
                                    <td class="text-muted">06 Sep 2021</td>
                                </tr><!-- end tr -->
                                <tr>
                                    <td class="fw-medium">Redesign - Landing Page</td>
                                    <td>
                                        <img src="{{ URL::asset('assets/images/users/avatar-2.jpg') }}"
                                            class="avatar-xxs rounded-circle me-1" alt="">
                                        <a href="javascript: void(0);" class="text-reset">Prezy
                                            William</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 text-muted me-1">0%</div>
                                            <div class="progress progress-sm flex-grow-1"
                                                style="width: 68%;">
                                                <div class="progress-bar bg-primary rounded"
                                                    role="progressbar" style="width: 0%"
                                                    aria-valuenow="0" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-5.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-6.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-danger">Pending</span></td>
                                    <td class="text-muted">13 Nov 2021</td>
                                </tr><!-- end tr -->
                                <tr>
                                    <td class="fw-medium">Multipurpose Landing Template</td>
                                    <td>
                                        <img src="{{ URL::asset('assets/images/users/avatar-3.jpg') }}"
                                            class="avatar-xxs rounded-circle me-1" alt="">
                                        <a href="javascript: void(0);" class="text-reset">Boonie
                                            Hoynas</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 text-muted me-1">100%</div>
                                            <div class="progress progress-sm flex-grow-1"
                                                style="width: 68%;">
                                                <div class="progress-bar bg-primary rounded"
                                                    role="progressbar" style="width: 100%"
                                                    aria-valuenow="100" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-7.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-8.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-success">Completed</span></td>
                                    <td class="text-muted">26 Nov 2021</td>
                                </tr><!-- end tr -->
                                <tr>
                                    <td class="fw-medium">Chat Application</td>
                                    <td>
                                        <img src="{{ URL::asset('assets/images/users/avatar-5.jpg') }}"
                                            class="avatar-xxs rounded-circle me-1" alt="">
                                        <a href="javascript: void(0);" class="text-reset">Pauline
                                            Moll</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 text-muted me-1">64%</div>
                                            <div class="progress flex-grow-1 progress-sm"
                                                style="width: 68%;">
                                                <div class="progress-bar bg-primary rounded"
                                                    role="progressbar" style="width: 64%"
                                                    aria-valuenow="64" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-2.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-warning">Progress</span></td>
                                    <td class="text-muted">15 Dec 2021</td>
                                </tr><!-- end tr -->
                                <tr>
                                    <td class="fw-medium">Create Wireframe</td>
                                    <td>
                                        <img src="{{ URL::asset('assets/images/users/avatar-6.jpg') }}"
                                            class="avatar-xxs rounded-circle me-1" alt="">
                                        <a href="javascript: void(0);" class="text-reset">James
                                            Bangs</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 text-muted me-1">77%</div>
                                            <div class="progress flex-grow-1 progress-sm"
                                                style="width: 68%;">
                                                <div class="progress-bar bg-primary rounded"
                                                    role="progressbar" style="width: 77%"
                                                    aria-valuenow="77" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-1.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-6.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-4.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-warning">Progress</span></td>
                                    <td class="text-muted">21 Dec 2021</td>
                                </tr><!-- end tr -->
                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
                    </div>

                    <div class="align-items-center mt-xl-3 mt-4 justify-content-between d-flex">
                        <div class="flex-shrink-0">
                            <div class="text-muted">Showing <span class="fw-semibold">5</span> of <span
                                    class="fw-semibold">25</span> Results
                            </div>
                        </div>
                        <ul class="pagination pagination-separated pagination-sm mb-0">
                            <li class="page-item disabled">
                                <a href="#" class="page-link">←</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li class="page-item active">
                                <a href="#" class="page-link">2</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">3</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">→</a>
                            </li>
                        </ul>
                    </div>

                </div><!-- end card body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->

        <!-- start col -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title flex-grow-1 mb-0">Expired Members</h4>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="btn btn-soft-info btn-sm">Export</a>
                    </div>
                </div><!-- end cardheader -->
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-centered align-middle table-danger">
                            <thead class="bg-light text-muted">
                                <tr>
                                    <th scope="col">Project Name</th>
                                    <th scope="col">Project Lead</th>
                                    <th scope="col">Progress</th>
                                    <th scope="col">Assignee</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" style="width: 10%;">Due Date</th>
                                </tr><!-- end tr -->
                            </thead><!-- thead -->

                            <tbody>
                                <tr>
                                    <td class="fw-medium">Brand Logo Design</td>
                                    <td>
                                        <img src="{{ URL::asset('assets/images/users/avatar-1.jpg') }}"
                                            class="avatar-xxs rounded-circle me-1" alt="">
                                        <a href="javascript: void(0);" class="text-reset">Donald
                                            Risher</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-1 text-muted fs-13">53%</div>
                                            <div class="progress progress-sm  flex-grow-1"
                                                style="width: 68%;">
                                                <div class="progress-bar bg-primary rounded"
                                                    role="progressbar" style="width: 53%"
                                                    aria-valuenow="53" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group flex-nowrap">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-1.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-2.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-3.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-warning">Inprogress</span></td>
                                    <td class="text-muted">06 Sep 2021</td>
                                </tr><!-- end tr -->
                                <tr>
                                    <td class="fw-medium">Redesign - Landing Page</td>
                                    <td>
                                        <img src="{{ URL::asset('assets/images/users/avatar-2.jpg') }}"
                                            class="avatar-xxs rounded-circle me-1" alt="">
                                        <a href="javascript: void(0);" class="text-reset">Prezy
                                            William</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 text-muted me-1">0%</div>
                                            <div class="progress progress-sm flex-grow-1"
                                                style="width: 68%;">
                                                <div class="progress-bar bg-primary rounded"
                                                    role="progressbar" style="width: 0%"
                                                    aria-valuenow="0" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-5.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-6.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-danger">Pending</span></td>
                                    <td class="text-muted">13 Nov 2021</td>
                                </tr><!-- end tr -->
                                <tr>
                                    <td class="fw-medium">Multipurpose Landing Template</td>
                                    <td>
                                        <img src="{{ URL::asset('assets/images/users/avatar-3.jpg') }}"
                                            class="avatar-xxs rounded-circle me-1" alt="">
                                        <a href="javascript: void(0);" class="text-reset">Boonie
                                            Hoynas</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 text-muted me-1">100%</div>
                                            <div class="progress progress-sm flex-grow-1"
                                                style="width: 68%;">
                                                <div class="progress-bar bg-primary rounded"
                                                    role="progressbar" style="width: 100%"
                                                    aria-valuenow="100" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-7.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-8.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-success">Completed</span></td>
                                    <td class="text-muted">26 Nov 2021</td>
                                </tr><!-- end tr -->
                                <tr>
                                    <td class="fw-medium">Chat Application</td>
                                    <td>
                                        <img src="{{ URL::asset('assets/images/users/avatar-5.jpg') }}"
                                            class="avatar-xxs rounded-circle me-1" alt="">
                                        <a href="javascript: void(0);" class="text-reset">Pauline
                                            Moll</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 text-muted me-1">64%</div>
                                            <div class="progress flex-grow-1 progress-sm"
                                                style="width: 68%;">
                                                <div class="progress-bar bg-primary rounded"
                                                    role="progressbar" style="width: 64%"
                                                    aria-valuenow="64" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-2.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-warning">Progress</span></td>
                                    <td class="text-muted">15 Dec 2021</td>
                                </tr><!-- end tr -->
                                <tr>
                                    <td class="fw-medium">Create Wireframe</td>
                                    <td>
                                        <img src="{{ URL::asset('assets/images/users/avatar-6.jpg') }}"
                                            class="avatar-xxs rounded-circle me-1" alt="">
                                        <a href="javascript: void(0);" class="text-reset">James
                                            Bangs</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 text-muted me-1">77%</div>
                                            <div class="progress flex-grow-1 progress-sm"
                                                style="width: 68%;">
                                                <div class="progress-bar bg-primary rounded"
                                                    role="progressbar" style="width: 77%"
                                                    aria-valuenow="77" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-1.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-6.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-4.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-warning">Progress</span></td>
                                    <td class="text-muted">21 Dec 2021</td>
                                </tr><!-- end tr -->
                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
                    </div>

                    <div class="align-items-center mt-xl-3 mt-4 justify-content-between d-flex">
                        <div class="flex-shrink-0">
                            <div class="text-muted">Showing <span class="fw-semibold">5</span> of <span
                                    class="fw-semibold">25</span> Results
                            </div>
                        </div>
                        <ul class="pagination pagination-separated pagination-sm mb-0">
                            <li class="page-item disabled">
                                <a href="#" class="page-link">←</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li class="page-item active">
                                <a href="#" class="page-link">2</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">3</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">→</a>
                            </li>
                        </ul>
                    </div>

                </div><!-- end card body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->

        
    </div><!-- end row -->

@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/dashboard-projects.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
