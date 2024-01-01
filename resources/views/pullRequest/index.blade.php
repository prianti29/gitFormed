@extends('layouts.app')

@section('contents')
<div class="repo-list-container">
    <a href="{{ url('/add-pull-req/create') }}" class="btn btn-success add-repo-btn">Add Pull Request</a>
    <hr class="divider">
    <table class="table table-content">
        <tr>
            <th style="text-align: center;">Pull ID</th> 
            <th style="text-align: center;">Title</th>
            <th style="text-align: center;">Repository name</th>
            <th style="text-align: center;">Created at</th>
            <th style="text-align: center;">Action</th>
        </tr>
        @foreach($pull_list as $item)
        <tr style="text-align: center;">
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
