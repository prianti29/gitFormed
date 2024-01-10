<!-- resources/views/notifications/index.blade.php -->

@extends('layouts.app')
@section('contents')
    <div class="container">
        <h2>Your Notifications</h2>
        @if ($notifications->count() > 0)
            <ul class="list-group">
                @foreach ($notifications as $notification)
                    <li class="list-group-item">
                        {{ $notification->generateMessage() }}
                        <span class="pull-right">{{ $notification->created_at->diffForHumans() }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No notifications to display.</p>
        @endif
    </div>
@endsection
@section('styles')
