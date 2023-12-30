@extends('layouts.app')

@section('contents')
<div class="edit-repo-container">
    <h3 class="edit-repo-title">Edit Repository</h3>
    <hr class="divider">

    <form action="{{ url("/addrepo/$repo->id") }}" method="POST" enctype="multipart/form-data" class="edit-form">
        @method("put")
        @csrf
   
        <div class="form-group">
            <label for="repository_name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="repository_name" 
                value="{{ $repo->repository_name }}" name="repository_name">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-update">Update Repository</button>
        </div>
    </form>
</div>
@endsection

