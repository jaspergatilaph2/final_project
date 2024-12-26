@extends('user.layouts.app')

@section('content')
@section('content')
@if (session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
@endif
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <!-- Menu -->

    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
      <div class="app-brand demo">
        <a href="/home" class="app-brand-link">
          <span class="app-brand-logo demo">
          </span>
          <img src="{{asset('storage/images/doctor-80.png')}}" alt="" style="width: 50px;">
          <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform:uppercase">AMHS</span>
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
          <span class="menu-header-text">Acoounts</span>
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
            <!-- <li class="menu-item">
              <a href="pages-account-settings-notifications.html" class="menu-link">
                <div data-i18n="Notifications">Notifications</div>
              </a>
            </li> -->
            <li class="menu-item">
              <a href="{{route('settings')}}" class="menu-link">
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
        <!-- <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
            <div data-i18n="Authentications">Authentications</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="auth-login-basic.html" class="menu-link" target="_blank">
                <div data-i18n="Basic">Login</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="auth-register-basic.html" class="menu-link" target="_blank">
                <div data-i18n="Basic">Register</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="auth-forgot-password-basic.html" class="menu-link" target="_blank">
                <div data-i18n="Basic">Forgot Password</div>
              </a>
            </li>
          </ul>
        </li> -->
        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-cube-alt"></i>
            <div data-i18n="Misc">Misc</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{route('maintenance')}}" class="menu-link">
                <div data-i18n="Under Maintenance">Under Maintenance</div>
              </a>
            </li>
          </ul>
        </li>
        <!-- Components -->
        <!-- Misc -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
        <li class="menu-item">
          <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank"
            class="menu-link">
            <i class="menu-icon tf-icons bx bx-support"></i>
            <div data-i18n="Support">Support</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank"
            class="menu-link">
            <i class="menu-icon tf-icons bx bx-file"></i>
            <div data-i18n="Documentation">Documentation</div>
          </a>
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
              <!-- <i class="bx bx-search fs-4 lh-0"></i>
              <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                aria-label="Search..." /> -->
            </div>

          </div>
          <!-- /Search -->

          <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Notification Dropdown -->
            <li class="nav-item dropdown lh-1 me-3">
              <a class="nav-link position-relative dropdown-toggle" href="#" id="notificationDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-bell fs-3"></i>
                <!-- Notification Badge -->
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  <!-- Example notification count -->
                  <span class="visually-hidden">unread notifications</span>
                </span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown"
                style="min-width: 300px;">
                <li class="dropdown-item text-center text-muted">No new notifications</li>
                <!-- Example notifications -->
                <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item text-center" href="#">
                <strong>Mark all as read</strong>
              </a>
            </li>
          </ul>
          </li>

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
                <a class="dropdown-item" href="{{ route('settings') }}">
                  <i class="bx bx-cog me-2"></i>
                  <span class="align-middle">Settings</span>
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
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                  </div>
                </div>
              </div>
              <div class="col-md-4 pt-3">
                <div class="card" style="height: 400px;">
                  <div class="card-body">
                    <h5 class="card-title">
                      Appointments
                    </h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <canvas id="lineGraph" width="400" height="200"></canvas>
                  </div>
                </div>
              </div>

              <div class="col-md-4 pt-3">
                <!-- New Card -->
                <div class="card" style="height: 400px;">
                  <div class="card-body">
                    <h5 class="card-title">
                      Appointments
                    </h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <canvas id="lineGraph" width="400" height="200"></canvas>
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
              <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">John Jasper Gatila</a>
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