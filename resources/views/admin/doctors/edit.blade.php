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