@extends('layouts.app')
@section('contents')
<div class="repo-form-container">
    <h3 class="repo-form-title">Add New Pull Request</h3>
    <hr class="divider">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form class="repo-form" action="{{ url('/add-pull-req') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="repository_id" class="form-label">Repository:</label>
            <select name="repository_id" id="repository_id" class="form-control">
                <option value="">-- Select a Repository --</option>
                @foreach ($repo_list as $id => $name)
                    <option value="{{ $id }}" {{ old('repository_id') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" placeholder="Enter Title"
                name="title">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-create">Create Pull Request</button>
        </div>
    </form>
</div>
@endsection
