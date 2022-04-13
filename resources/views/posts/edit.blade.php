@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Edit Post</h2>
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if (session('success'))
            <div class="alert alert-success">
                Edit Success!
            </div>
            @endif

            <form action="{{ route('posts.update',[$post->id])}}" method="post">
                <!-- 防範xss -->
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title">title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title',$post->title) }}"> 
                </div>
                <div class="form-group">
                    <label for="content">content</label>
                    <textarea class="form-control" id="content" name="content">{{ old('content',$post->content) }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>

            <hr>

            <form action="{{ route('posts.destroy',[$post->id]) }}" method="post" onSubmit="return confirm('Are you sure?')">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete Post</button>
            </form>

        </div>
    </div>
</div>
@endsection
