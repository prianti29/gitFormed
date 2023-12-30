@extends('layouts.app')

@section('contents')
<div class="edit-repo-container">
    <h3 class="edit-repo-title">Edit Pull request</h3>
    <hr class="divider">

    <form action="{{ url("/add-pull-req/$pull->id") }}" method="POST" enctype="multipart/form-data" class="edit-form">
        @method("put")
        @csrf
        <div class="form-group">
            <label for="repository_id" class="form-label">Repository:</label>
            <select name="repository_id" id="repository_id" class="form-control">
                <option value="">-- Select a Repository --</option>
                @foreach ($repo_list as $id => $name)
                    <option value="{{ $id }}" {{ old('repository_id', $pull->repository_id) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" placeholder="Enter Title"   value="{{ $pull->title }}" 
                name="title">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-update">Update Pull Request</button>
        </div>
    </form>
</div>
@endsection
