
@extends('layouts.welcome_app')
@section('contents')

  {{-- Sort the list --}}
  <div class="sorting-menu">
    <span>Sort by:</span>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link {{ request('sort') == 'alphabetical' ? 'active' : '' }}" href="{{ url('/allrepo?sort=alphabetical') }}">Alphabetical |</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('sort') == 'latest' ? 'active' : '' }}" href="{{ url('/allrepo?sort=latest') }}">Latest |</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('sort') == 'watchers' ? 'active' : '' }}" href="{{ url('/allrepo?sort=watchers') }}">Number of Watchers |</a>
        </li>
    </ul>
</div>
        <table class="table table-content" style="text-align: center;">
            <tr>
                <th style="text-align: center;">User name</th>
                <th style="text-align: center;">Repository Name</th>
                <th style="text-align: center;">watch</th>
                <th style="text-align: center;">Number of watcher</th>
                <th style="text-align: center;">Created at</th>
            </tr>
    
            @foreach($repository_list as $item) 
            <tr>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->repository_name }}</td>
                <td style="width:10px;">
                    <!-- Add a checkbox -->
                    <input type="checkbox" name="watcher_checkbox[]" value="{{ $item->id }}">
                </td>
                <td>{{ $item->number_of_watcher }}</td>
                <td>{{ $item->created_at }}</td>
            </tr> 
             @endforeach 
        </table>

@endsection
@section('styles')