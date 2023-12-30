
@extends('layouts.welcome_app')
@section('contents')

  {{-- Sort the list --}}
  <div class="sorting-menu">
    <span>Sort by:</span>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link {{ request('sort') == 'alphabetical' ? 'active' : '' }}" href="{{ url('/allrepo?sort=alphabetical') }}">Alphabetical</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('sort') == 'latest' ? 'active' : '' }}" href="{{ url('/allrepo?sort=latest') }}">Latest</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('sort') == 'watchers' ? 'active' : '' }}" href="{{ url('/allrepo?sort=watchers') }}">Number of Watchers</a>
        </li>
    </ul>
</div>

        <table class="table table-content">
            <tr>
                <th>User name</th>
                <th>Repository Name</th>
                <th>Number of watcher</th>
                <th>Created at</th>
            </tr>
    
            @foreach($repository_list as $item) 
            <tr>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->repository_name }}</td>
                <td>{{ $item->number_of_watcher }}</td>
                <td>{{ $item->created_at }}</td>
            </tr> 
             @endforeach 
        </table>

@endsection
@section('styles')