@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Create Post</h2>

            <form action="{{ route('posts.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="content">content</label>
                    <textarea type="text" class="form-control" id="content" name="content" rows="5"></textarea>
                </div>
                <button type="sumbit" class="btn btn-primary mt-3">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection