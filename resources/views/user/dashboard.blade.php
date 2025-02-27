@extends('user.layouts.app')

@section('content')
@php
$notifications = auth()->user()->unreadNotifications;
@endphp
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <!-- Menu -->

    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
      <div class="app-brand demo">
        <a href="/home" class="app-brand-link">
          <span class="app-brand-logo demo">
          </span>
          <img src="{{asset('storage/images/Adobe Express - file.png')}}" alt="" style="width: 50px;">
          <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform:uppercase">SLSU</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
          <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
      </div>

      <div class="menu-inner-shadow"></div>

      <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
          <a href="/home" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
          </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fas fa-calendar-check"></i>
            <div data-i18n="Layouts">Events</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{ route('user.events.view') }}" class="menu-link">
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

      <nav
        class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
          <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
          </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
          <!-- Search -->
          <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">

            </div>

          </div>
          <!-- /Search -->

          <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Notification Dropdown -->
            <li class="nav-item dropdown lh-1 me-3">
              <a class="nav-link position-relative dropdown-toggle" href="#" id="notificationDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i id="notification-icon" class="menu-icon 
        @if(auth()->check() && auth()->user()->unreadNotifications->count() > 0) 
            fa-solid 
        @else 
            fa-regular 
        @endif 
        fa-envelope">
                </i>

                @if(auth()->check() && auth()->user()->unreadNotifications->count() > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{ auth()->user()->unreadNotifications->count() }}
                  <span class="visually-hidden">unread notifications</span>
                </span>
                @endif
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown"
                style="min-width: 300px;">
                @if(auth()->check())
                @forelse(auth()->user()->unreadNotifications as $notification)
                <li class="dropdown-item d-flex align-items-start">
                  <div class="flex-grow-1">
                    <p class="mb-1 fw-semibold">{{ $notification->data['message'] }}</p>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                  </div>
                  <a href="{{ route('user.notifications.markRead', $notification->id) }}" class="btn btn-sm btn-link text-decoration-none">
                    <i class="fa-solid fa-check"></i>
                  </a>
                </li>
                <!-- Example notifications -->
                <li>
                  <hr class="dropdown-divider">
                </li>
                @empty
            </li>
            <li class="dropdown-item text-center text-muted py-3">No new notifications</li>
            @endforelse
            <li class="text-center">
              <a class="dropdown-item fw-bold text-primary" href="{{ route('user.notifications.markAllRead') }}">
                Mark all as read
              </a>
            </li>
            @else
            <li class="dropdown-item text-center text-muted py-3">Please log in to see notifications</li>
            @endif
          </ul>
          <!-- User Dropdown -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt
                  class="w-px-120 h-px-120 rounded-circle" />
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="#">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar avatar-online">
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt
                          class="w-px-auto h-px-auto rounded-circle" />
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                      <small class="text-muted">{{ auth()->user()->role === 'admin' ? 'Admin' : 'User' }}</small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('user.account.profile') }}">
                  <i class="bx bx-user me-2"></i>
                  <span class="align-middle">My Profile</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('user.settings') }}">
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
                  <span class="align-middle">Log Out</span>
                </a>
                <form action="{{ route('logout') }}" method="post" id="logout-form">
                  @csrf
                </form>
              </li>
            </ul>
          </li>
          </ul>
        </div>
      </nav>

      <!-- / Navbar -->

      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="container">
            <div class="row">
              <div class="col-md-4 pt-3">
                <div class="card" style="height:400px;">
                  <div class="card-body">
                    <h5 class="card-title">Welcome {{Auth::user()->name}}</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                  </div>
                </div>
              </div>
              <div class="col-md-4 pt-3">
                <div class="card" style="height: 400px;">
                  <div class="card-body">
                    <h5 class="card-title">
                      Announcements Of Appointments Status
                    </h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                    @foreach(\App\Models\Appointment::with('doctor')->get(['id', 'status', 'doctor_id', 'updated_at']) as $appointment)
                    @php
                    $clearingTime = \Carbon\Carbon::parse($appointment->updated_at)->addSeconds(50);
                    $remainingTime = now()->diffInSeconds($clearingTime, false);
                    @endphp

                    <div class="appointment-item" data-appointment-id="{{ $appointment->id }}"
                      data-clear-time="{{ $clearingTime->timestamp }}"
                      @if($remainingTime <=0) style="display:none;" @endif>

                      <p class="card-text" style="font-size:1.5em; font-weight: bold; padding-top:1.5em;">
                        {{ $appointment->doctor->name }} - Status: {{ $appointment->status }}

                        @if($appointment->status === 'Confirmed' && $remainingTime > 0)
                        <br>
                        <small class="text-muted">
                          Clears in: <span class="countdown" data-time="{{ $clearingTime->timestamp }}"></span>
                        </small>
                        @elseif($remainingTime <= 0)
                          <br>
                          <small class="text-muted text-danger">Cleared</small>
                          @endif
                      </p>
                    </div>
                    @endforeach
                  </div>
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
              <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Jas<span class="fw-bold" style="color: #ff6347;">Coder</span></a>
            </div>
            <div>
              <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
              <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">Contuct Us</a>

              <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                target="_blank" class="footer-link me-4">Documentation</a>

              <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank"
                class="footer-link me-4">Support</a>
            </div>
          </div>
        </footer>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
      </div>
      <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
  </div>

  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->
@endsection