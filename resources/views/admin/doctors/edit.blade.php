@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">Edit Doctor</h5>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Form fields for editing -->
                <div class="mb-3">
                    <label for="name" class="form-label">Doctor's Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="company" class="form-label">Hospital</label>
                    <input type="text" name="company" class="form-control"
                        value="{{ old('company', $doctor->company) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->email) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $doctor->phone) }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="specialization" class="form-label">Specialization</label>
                    <input type="text" name="specialization" class="form-control" value="{{ old('specialization', $doctor->specialization) }}"
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="is_available">Available Days</label>
                    <select name="is_available[]" id="is_available" class="form-control" multiple>
                        @php
                        // Check if $doctor->is_available is already an array
                        $selectedDays = is_array($doctor->is_available) ? $doctor->is_available : json_decode($doctor->is_available, true) ?? [];
                        @endphp

                        <option value="Monday" {{ in_array('Monday', $selectedDays) ? 'selected' : '' }}>Monday</option>
                        <option value="Tuesday" {{ in_array('Tuesday', $selectedDays) ? 'selected' : '' }}>Tuesday</option>
                        <option value="Wednesday" {{ in_array('Wednesday', $selectedDays) ? 'selected' : '' }}>Wednesday</option>
                        <option value="Thursday" {{ in_array('Thursday', $selectedDays) ? 'selected' : '' }}>Thursday</option>
                        <option value="Friday" {{ in_array('Friday', $selectedDays) ? 'selected' : '' }}>Friday</option>
                        <option value="Saturday" {{ in_array('Saturday', $selectedDays) ? 'selected' : '' }}>Saturday</option>
                        <option value="Sunday" {{ in_array('Sunday', $selectedDays) ? 'selected' : '' }}>Sunday</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                    @if($doctor->image)
                    <img src="{{ asset('storage/' . $doctor->image) }}" alt="Doctor Image" width="100" class="mt-2">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.doctors.view') }}" class="btn btn-secondary">Cancel</a>
            </form>

        </div>
    </div>
</div>
@endsection