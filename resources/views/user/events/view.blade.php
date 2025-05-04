@extends('user.layouts.app')

@php
use App\Models\logs;
@endphp

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="/home" class="app-brand-link">
                    <span class="app-brand-logo demo"></span>
                    <img src="{{asset('storage/images/Adobe Express - file.png')}}" alt="" style="width: 50px;">
                    <span class="app-brand-text demo menu-text fw-bolder ms-2"
                        style="text-transform:uppercase">SLSU</span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <!-- Dashboard -->
                <li class="menu-item">
                    <a href="/home" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">Dashboard</div>
                    </a>
                </li>

                <!-- Layouts -->
                <li class="menu-item {{  $ActiveMenu === 'Events' ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon fas fa-calendar-check"></i>
                        <div data-i18n="Layouts">Events</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item {{ $ActiveSubMenu === 'View' ? 'active' : '' }}">
                            <a href="" class="menu-link">
                                <div data-i18n="Without navbar">View Events</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon fa-regular fa-calendar"></i>
                        <div data-i18n="Layouts">Appointments</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{route('user.appointments.calendar')}}" class="menu-link">
                                <div data-i18n="Without menu">Appointment Calendar</div>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="{{route('user.appointments.create')}}" class="menu-link">
                                <div data-i18n="Container">Book Appointments</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('user.appointments.view')}}" class="menu-link">
                                <div data-i18n="Container">View Appointments</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Accounts</span>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-dock-top"></i>
                        <div data-i18n="Account Settings">Account Settings</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('user.account.profile') }}" class="menu-link">
                                <div data-i18n="Account">Account</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('user.settings')}}" class="menu-link">
                                <div data-i18n="Notifications">Settings</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('user.account.profile.edit') }}" class="menu-link">
                                <div data-i18n="Notifications">Update Account</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Mics</span>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-file"></i>
                        <div data-i18n="Misc">Misc</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('user.misc.logs') }}" class="menu-link">
                                <div data-i18n="Under Maintenance">Logs</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                id="layout-navbar">
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="bx bx-menu bx-sm"></i>
                    </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <!-- Place this tag where you want the button to render. -->
                        <!--  -->
                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('sneat/img/avatars/1.png') }}" alt
                                        class="w-px-120 h-px-120 rounded-circle" />
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('sneat/img/avatars/1.png') }}" alt
                                                        class="w-px-120 h-px-120 rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                                <small class="text-muted">
                                                    {{ auth()->user()->role === 'admin' ? 'Admin' : 'User' }}</small>
                                            </div>

                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">
                                        <i class="bx bx-user me-2"></i>
                                        <span class="align-middle">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">
                                        <i class="bx bx-cog me-2"></i>
                                        <span class="align-middle">Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.misc.logs') }}">
                                        <i class="menu-icon tf-icons bx bx-file"></i>
                                        <span class="align-middle">Logs</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bx bx-power-off me-2"></i>
                                        <span class="align-middle" style="color:#ff6347;">Log Out</span>
                                    </a>
                                    <form action="{{route('logout')}}" method="post" id="logout-form">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <!--/ User -->
                    </ul>
                </div>
            </nav>

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Events /</span>History</h4>
                    <ul class="nav nav-pills flex-column flex-md-row mb-4">
                        <li class="nav-item">
                            <a class="nav-link bg-primary text-white" href="javascript:void(0);">
                                <i class="fa-solid fa-calendar-days"></i> Events
                            </a>
                        </li>
                    </ul>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Events History</h5>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Event Name</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>End Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = ($events->currentPage() - 1) * $events->perPage() + 1; @endphp
                                        @foreach($events as $event)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>{{ $event->eventsName }}</td>
                                            <td>{{ \Carbon\Carbon::parse($event->date)->setTimezone(config('app.timezone'))->format('Y-m-d') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($event->time)->setTimezone(config('app.timezone'))->format('h:i A') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($event->endtime)->setTimezone(config('app.timezone'))->format('h:i A') }}
                                            </td>
                                            <td>
                                                <button class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#viewModal{{ $event->id }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        {{-- Modal for Event Details --}}
                                        <div class="modal fade" id="viewModal{{ $event->id }}" tabindex="-1"
                                            aria-labelledby="viewModalLabel{{ $event->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="viewModalLabel{{ $event->id }}">
                                                            --Event Full Details--</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                                        <p><strong>Event Name:</strong></p>
                                                        <div class="event-message-box p-2 border rounded"
                                                            style="max-height: 200px; overflow-y: auto; word-wrap: break-word; white-space: normal;">
                                                            {{ $event->eventsName }}
                                                        </div>
                                                        <br>
                                                        <p><strong>Date:</strong></p>
                                                        <div class="event-message-box p-2 border rounded"
                                                            style="max-height: 200px; overflow-y: auto; word-wrap: break-word; white-space: normal;">
                                                            {{ \Carbon\Carbon::parse($event->date)->setTimezone(config('app.timezone'))->format('Y-m-d') }}
                                                        </div>
                                                        <br>
                                                        <p><strong>Time:</strong></p>
                                                        <div class="event-message-box p-2 border rounded"
                                                            style="max-height: 200px; overflow-y: auto; word-wrap: break-word; white-space: normal;">
                                                            {{ \Carbon\Carbon::parse($event->time)->setTimezone(config('app.timezone'))->format('h:i A') }}
                                                        </div>
                                                        <br>
                                                        <p><strong>End Time:</strong></p>
                                                        <div class="event-message-box p-2 border rounded"
                                                            style="max-height: 200px; overflow-y: auto; word-wrap: break-word; white-space: normal;">
                                                            {{ \Carbon\Carbon::parse($event->endtime)->setTimezone(config('app.timezone'))->format('h:i A') }}
                                                        </div>
                                                        <br>
                                                        <p><strong>Description:</strong></p>
                                                        <div class="event-message-box p-2 border rounded"
                                                            style="max-height: 200px; overflow-y: auto; word-wrap: break-word; white-space: normal;">
                                                            {{ $event->description ?? 'No description available.' }}
                                                        </div>
                                                        <br>
                                                        <p><strong>Event Message:</strong></p>
                                                        <div class="event-message-box p-2 border rounded"
                                                            style="max-height: 200px; overflow-y: auto; word-wrap: break-word; white-space: normal;">
                                                            {{ $event->eventsText ?? 'No message available.' }}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                        @if($events->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">No events found.</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>


                            <!-- Pagination Links -->
                            <div class="d-flex justify-content-center mt-3">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-m"> <!-- Added pagination-sm to make it smaller -->
                                        {{-- Previous Page Link --}}
                                        @if ($events->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">Previous</span>
                                        </li>
                                        @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $events->previousPageUrl() }}">Previous</a>
                                        </li>
                                        @endif

                                        {{-- Page Number Links --}}
                                        @foreach ($events->links()->elements[0] as $page => $url)
                                        <li class="page-item {{ $events->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($events->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $events->nextPageUrl() }}">Next</a>
                                        </li>
                                        @else
                                        <li class="page-item disabled">
                                            <span class="page-link">Next</span>
                                        </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
                <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                    <div class="mb-2 mb-md-0">
                        ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        , made with ❤️ by
                        <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Jas<span
                                class="fw-bold" style="color: #ff6347;">Coder</span></a>
                    </div>
                    <div>
                        <a href="https://themeselection.com/license/" class="footer-link me-4"
                            target="_blank">License</a>
                        <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">Contuct Us</a>

                        <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                            target="_blank" class="footer-link me-4">Documentation</a>

                        <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                            target="_blank" class="footer-link me-4">Support</a>
                    </div>
                </div>
            </footer>
            <!-- / Footer -->
        </div>
        <!-- / Content wrapper -->
    </div>
    <!-- / Layout container -->
</div>
</div>
@endsection