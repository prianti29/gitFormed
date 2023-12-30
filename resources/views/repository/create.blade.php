@extends('layouts.app')

@section('contents')
<div class="repo-form-container">
    <h3 class="repo-form-title">Add New Repository</h3>
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

    <form class="repo-form" action="{{ url('/addrepo') }}" method="POST" enctype="multipart/form-data">
        @csrf
      
        <div class="form-group">
            <label for="repository_name" class="form-label">Repository name:</label>
            <input type="text" class="form-control" id="repository_name" placeholder="Enter Repository Name" name="repository_name">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-create">Create Repository</button>
        </div>
    </form>
</div>
@endsection

