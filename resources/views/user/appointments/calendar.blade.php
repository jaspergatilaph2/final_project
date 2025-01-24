@extends('user.layouts.app')

@section('content')
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
        <li class="menu-item">
          <a href="/home" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
          </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item {{$ACTIVEPROFILE === 'ACCOUNT' ? 'active' : ''}}">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fas fa-calendar-check"></i>
            <div data-i18n="Layouts">Appointments</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item {{$ACTIVEPROFILESUB === 'CALENDAR' ? 'active' : ''}}">
              <a href="layouts-without-menu.html" class="menu-link">
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
        <li class="menu-item ">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-dock-top"></i>
            <div data-i18n="Account Settings">Account Settings</div>
          </a>
          <ul class="menu-sub ">
            <li class="menu-item">
              <a href="{{route('user.account.profile')}}" class="menu-link">
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
            <li class="menu-item ">
              <a href="" class="menu-link">
                <div data-i18n="Notifications">Update Profile</div>
              </a>
            </li>
          </ul>
        </li>
        <li class="menu-item">
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
        </li>
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
            <!-- Place this tag where you want the button to render. -->
            <!--  -->
            <!-- User -->
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
                            class="w-px-120 h-px-120 rounded-circle" />
                        </div>

                      </div>
                      <div class="flex-grow-1">
                        <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                        <small class="text-muted"> {{ auth()->user()->role === 'admin' ? 'Admin' : 'User' }}</small>
                      </div>

                    </div>
                  </a>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                </li>
                <li>
                  <a class="dropdown-item" href="#">
                    <i class="bx bx-user me-2"></i>
                    <span class="align-middle">My Profile</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{route('settings')}}">
                    <i class="bx bx-cog me-2"></i>
                    <span class="align-middle">Settings</span>
                  </a>
                </li>
                <!-- <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li> -->
                <li>
                  <div class="dropdown-divider"></div>
                </li>
                <li>
                  <a class="dropdown-item" href="javascript:void(0);"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bx bx-power-off me-2"></i>
                    <span class="align-middle">Log Out</span>
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
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Appointment/</span> Calendar</h4>

        <!-- Basic Layout -->
        <div class="row">

          <!-- Create New Event Section -->
          <div class="col-xl-4">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create New Event</h5>
                <small class="text-muted float-end">Fill in the details to create an event</small>
              </div>
              <div class="card-body">

                <!-- Create Event Button -->
                <div class="d-grid">
                  <button class="btn font-size-16 btn-primary" id="btn-new-event">
                    <i class="mdi mdi-plus-circle-outline"></i> Create New Event
                  </button>
                </div>

                <!-- External Events Section -->
                <div id="external-events" class="mt-3">
                  <p class="text-muted">Drag and drop your event or click in the calendar</p>
                  <div class="external-event fc-event bg-success" data-class="bg-success">
                    <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>New Event Planning
                  </div>
                  <div class="external-event fc-event bg-info" data-class="bg-info">
                    <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Meeting
                  </div>
                  <div class="external-event fc-event bg-warning" data-class="bg-warning">
                    <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Generating Reports
                  </div>
                  <div class="external-event fc-event bg-danger" data-class="bg-danger">
                    <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Create New Theme
                  </div>
                </div>

              </div>

            </div>

            <div class="col-xl">
              <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Activity Feed</h5>
                  <small class="text-muted float-end">Latest activity updates</small>
                </div>
                <div class="card-body">
                  <ol class="activity-feed mb-0 ps-2 ms-1">
                    <li class="feed-item">
                      <p class="mb-0">Andrei Coman magna sed porta finibus, risus posted a new article: Forget UX
                        Rowland
                      </p>
                    </li>
                    <li class="feed-item">
                      <p class="mb-0">Zack Wetass, sed porta finibus, risus Chris Wallace commented on Developer Moreno
                      </p>
                    </li>
                    <li class="feed-item">
                      <p class="mb-0">Zack Wetass, Chris combined commented on UX Murphy</p>
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>


          <!-- Calendar Section -->
          <div class="col-xl">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Calendar</h5>
                <small class="text-muted float-end">Manage your events</small>
              </div>
              <div class="card-body">
                <div id="calendar"></div>
              </div>
            </div>
          </div>

        </div>

      </div>
      <div class="row">
        <div class="card-body">

        </div>
      </div>

    </div>



    <!-- Clear both sides after the row -->
    <div style="clear:both"></div>

    <div class="modal fade" id="event-modal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header py-3 px-4">
            <h5 class="modal-title">Event</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            <form class="needs-validation" name="event-form" id="form-event" novalidate>
              <div class="row">
                <div class="col-12">
                  <div class="mb-3">
                    <label class="form-label">Event Name</label>
                    <input class="form-control" placeholder="Insert Event Name" type="text" name="title"
                      id="event-title" required value="" />
                    <div class="invalid-feedback">Please provide a valid event name</div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select class="form-select" name="category" id="event-category">
                      <option selected> --Select-- </option>
                      <option value="bg-danger">Danger</option>
                      <option value="bg-success">Success</option>
                      <option value="bg-primary">Primary</option>
                      <option value="bg-info">Info</option>
                      <option value="bg-dark">Dark</option>
                      <option value="bg-warning">Warning</option>
                    </select>
                    <div class="invalid-feedback">Please select a valid event category</div>
                  </div>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-6">
                  <button type="button" class="btn btn-danger" id="btn-delete-event">Delete</button>
                </div>
                <div class="col-6 text-end">
                  <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" id="btn-save-event">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div> <!-- end modal-content-->
      </div> <!-- end modal dialog-->
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