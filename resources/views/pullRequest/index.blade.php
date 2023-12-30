@extends('layouts.app')

@section('contents')
<div class="repo-list-container">
    <a href="{{ url('/add-pull-req/create') }}" class="btn btn-success add-repo-btn">Add Pull Request</a>
    <hr class="divider">

    {{-- <form action="{{ url('/pull-requests/filter') }}" method="GET">
    <div class="sort-container">
        <label for="repository_id">Filter by Repository:</label>
        <select name="repository_id" id="repository_id" class="form-control" style="width:20%"
            onchange="this.form.submit()">
            <option value="">-- Select a Repository --</option>
            @foreach ($repo_list as $id => $name)
            <option value="{{ $id }}" {{ request('repository_id') == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
            @endforeach
        </select>
    </div>
    </form>
    <br>--}}

    <table class="table table-content">
        <tr>
            <th>Pull ID</th> 
            <th>Title</th>
            <th>Repository name</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
        @foreach($pull_list as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->repository->repository_name }}</td>
            <td>{{ $item->created_at }}</td>
            <td class="action-container">
                <a href="{{ url("/add-pull-req/$item->id/edit") }}" class="btn btn-success btn-sm action-btn">Update</a>
                <form action="{{ url("/add-pull-req/$item->id") }}" method="POST"
                    onsubmit="return confirm('Do you really want to delete this post?');" class="action-form">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete" class="btn btn-danger btn-sm action-btn">
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $pull_list->links() }}
</div>
@endsection
