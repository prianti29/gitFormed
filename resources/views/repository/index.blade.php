@extends('layouts.app')

@section('contents')
<div class="repo-list-container">
    <a href="{{ url('/addrepo/create') }}" class="btn btn-success add-repo-btn">Add Repository</a>
    <hr class="divider">
    {{-- Sort the list --}}
    <div class="sorting-menu">
        <span>Sort by:</span>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link {{ request('sort') == 'alphabetical' ? 'active' : '' }}" href="{{ url('/addrepo?sort=alphabetical') }}">Alphabetical</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('sort') == 'latest' ? 'active' : '' }}" href="{{ url('/addrepo?sort=latest') }}">Latest</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('sort') == 'watchers' ? 'active' : '' }}" href="{{ url('/addrepo?sort=watchers') }}">Number of Watchers</a>
            </li>
        </ul>
    </div>
    <table class="table table-content">
        <tr>
            <th>User Name</th>
            <th>Repository Name</th>
            <th>Number of Watcher</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
        @foreach($repository_list as $item) 
        <tr>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->repository_name }}</td>
            <td>{{ $item->number_of_watcher }}</td>
            <td>{{ $item->created_at }}</td>
            <td class="action-container" >
                <a href="{{ url("/addrepo/$item->id/edit") }}" class="btn btn-success btn-sm action-btn" >Update</a>
                <form action="{{ url("/addrepo/$item->id") }}" method="POST"
                    onsubmit="return confirm('Do you really want to delete this post?');"
                    class="action-form">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete" class="btn btn-danger btn-sm action-btn" >
                </form>
            </td>
        </tr>
        @endforeach 
    </table>
    {{ $repository_list->links() }}
</div>
@endsection


