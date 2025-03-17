@extends('layouts.app')

@section('content')
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
    <!-- Menu -->

    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
      <div class="app-brand demo">
      <a href="/home" class="app-brand-link">
        <span class="app-brand-logo demo">
        </span>
        <img src="{{asset('storage/images/Adobe Express - file.png')}}" alt="" style="width: 50px;">
        <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform:uppercase">slsu</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
      </div>

      <div class="menu-inner-shadow"></div>

      <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item ">
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
          <a href="{{ route('admin.events.create') }}" class="menu-link">
          <div data-i18n="Without menu">Create Events</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('admin.events.view') }}" class="menu-link">
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
          <a href="layouts-without-menu.html" class="menu-link">
          <div data-i18n="Without menu">Appointment Calendar</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{route('admin.appointments.view')}}" class="menu-link">
          <div data-i18n="Without navbar">View Appointments</div>
          </a>
        </li>
        </ul>
      </li>

      <li class="menu-item {{$activeMenu === 'Doctors' ? 'active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon fas fa-user-md"></i>
        <div data-i18n="Layouts">Doctor</div>
        </a>

        <ul class="menu-sub">
        <li class="menu-item ">
          <a href="{{route('admin.doctors.create')}}" class="menu-link">
          <div data-i18n="Without menu">Add Doctors</div>
          </a>
        </li>
        <li class="menu-item {{ $activeSub === 'View Doctor' ? 'active' : '' }}">
          <a href="" class="menu-link">
          <div data-i18n="Without navbar">View Doctors</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('admin.doctors.list') }}" class="menu-link">
          <div data-i18n="Without navbar">List Doctors</div>
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
          <a href="{{route('admin.accounts.profile')}}" class="menu-link">
          <div data-i18n="Account">Account</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{route('settings')}}" class="menu-link">
          <div data-i18n="Notifications">Settings</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{route('maintenance')}}" class="menu-link">
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
          <a href="{{route('admin.misc.logs')}}" class="menu-link">
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
          <!-- Search Puporse -->
        </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- Place this tag where you want the button to render. -->

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
              <span class="fw-semibold d-block">{{ optional(Auth::user())->name }}</span>
              <small class="text-muted">Admin</small>
              </div>
            </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('admin.accounts.profile') }}">
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
          <li>
            <a class="dropdown-item" href="{{route('admin.misc.logs')}}">
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
        <!-- Create a table -->
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Doctors/</span>Show List Doctor</h4>
        <div class="card">
        <h5 class="card-header">Doctors</h5>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
          @if(session('success'))
        <div class="alert alert-success">
        {{ session('success') }}
        </div>
      @endif
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Doctor's Name</th>
              <th>Hospital</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Image</th>
              <th>Available</th>
              <th>Specialization</th>
              <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($doctors as $doctor)
            <tr>
              <td>{{ $doctor->name }}</td>
              <td>{{ $doctor->company }}</td>
              <td>{{ $doctor->email }}</td>
              <td>{{ $doctor->phone }}</td>
              <td>
              <img src="{{ asset('storage/' . $doctor->image) }}" alt="Doctor Image" width="100" height="100">
              </td>
              <td>
              @php
        $availability = is_string($doctor->is_available) ? json_decode($doctor->is_available, true) : $doctor->is_available;
        $availableDays = is_array($availability) ? $availability : [];
        @endphp
              @if(in_array(\Carbon\Carbon::now()->format('l'), $availableDays))
          <p>Available</p>
        @else
        <p>Unavailable
        @if(!empty($availableDays))
      (Available on: {{ implode(', ', $availableDays) }})
    @endif
        </p>
      @endif
              </td>
              <td>{{ $doctor->specialization }}</td>
              <td>
              <button class="btn btn-info" data-bs-toggle="modal"
              data-bs-target="#viewModal{{ $doctor->id }}">
              <i class="fa fa-eye"></i>
              </button>
              <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-success">
              <i class="fa fa-user-edit"></i>
              </a>
              <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST"
              style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">
              <i class="fa fa-trash"></i>
              </button>
              </form>
              </td>
            </tr>

            <!-- Modal for each doctor -->
            <div class="modal fade" id="viewModal{{ $doctor->id }}" tabindex="-1"
              aria-labelledby="viewModalLabel{{ $doctor->id }}" aria-hidden="true">
              <div class="modal-dialog">
              <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="viewModalLabel{{ $doctor->id }}">Doctor Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              <p><strong>Name:</strong> {{ $doctor->name }}</p>
              <p><strong>Hospital:</strong> {{ $doctor->company }}</p>
              <p><strong>Email:</strong> {{ $doctor->email }}</p>
              <p><strong>Phone:</strong> {{ $doctor->phone }}</p>
              <p><strong>Specialization:</strong> {{ $doctor->specialization }}</p>
              <p><strong>Availability:</strong>
                {{ !empty($availableDays) ? implode(', ', $availableDays) : 'Not Available' }}</p>
              <img src="{{ asset('storage/' . $doctor->image) }}" alt="Doctor Image" class="img-fluid">
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
              </div>
              </div>
            </div>
      @endforeach
            </tbody>
          </table>
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
        <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Jas<span class="fw-bold"
          style="color: #ff6347;">Coder</span></a>
        </div>
        <div>
        <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
        <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">Contuct Us</a>

        <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank"
          class="footer-link me-4">Documentation</a>

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