@extends('layouts.app')

@section('contents')
<div class="repo-list-container">
    <a href="{{ url('/add-pull-req/create') }}" class="btn btn-success add-repo-btn">Add Pull Request</a>
    <hr class="divider">
   
    <table class="table table-content">
        {{-- <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link {{ request('sort') == 'latest' ? 'active' : '' }}" href="{{ url('/addrepo?sort=latest') }}">Latest</a>
            </li>
        </ul> --}}
        <tr>
            <th>Pull ID</th>
            <th>Title</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
        @foreach($pull_list as $item) 
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->created_at }}</td>
            <td class="action-container" >
                <a href="{{ url("/add-pull-req/$item->id/edit") }}" class="btn btn-success btn-sm action-btn" >Update</a>
                <form action="{{ url("/add-pull-req/$item->id") }}" method="POST"
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
    {{-- {{ $repository_list->links() }} --}}
</div>
@endsection


