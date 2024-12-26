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
        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon fas fa-calendar-check"></i>
            <div data-i18n="Layouts">Appointments</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item">
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
        <li class="menu-item {{$ACTIVEPROFILE === 'ACCOUNT' ? 'active' : ''}}">
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
            <li class="menu-item {{$ACTIVEPROFILESUB === 'SETTINGS' ? 'active' : ''}}">
              <a href="" class="menu-link">
                <div data-i18n="Notifications">Update Profile</div>
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
      <div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                </ul>

                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <hr class="my-0" />

                    <!-- Display Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <!-- Display validation errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Profile Update Form -->
                        <form action="{{ route('user.account.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')  <!-- Overriding the method to PUT -->
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>

                            
                            <div class="mb-3">
    <label for="avatar" class="form-label">Profile Picture</label>
    <input type="file" id="avatarInput" name="avatar" class="form-control mt-2" accept="image/*">
    <img id="uploadedAvatar" 
         src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/img/avatars/1.png') }}"
         alt="avatar" class="d-block rounded mt-2" width="100" height="100" />
</div>
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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