@extends('user.layouts.app')

@section('content')
<div class="container">
    <h1>Your Notifications</h1>
    <ul class="list-group">
        @foreach ($notifications as $notification)
            <li class="list-group-item">
                {{ $notification->data['message'] }}
                <a href="{{ url('/appointments/' . $notification->data['appointment_id']) }}" class="btn btn-primary btn-sm">View</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
