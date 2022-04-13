@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-8">
          <h1> Edit post</h1>

          @if ($errors->any()) 
          <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li> {{ $error}}</li>
                    @endforeach
                </ul>
          </div>
          @endif 


          @if (session('success'))
          <div class="alert alert-success">
              Updated Success!!!
          </div>  

          @endif
        <form action="{{ route('posts.update' , [$post->id]) }}" method="post">
            @csrf  
            @method('put')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title )}}">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
               <textarea class="form-control" name="content" id="content" cols="30" rows="5" > {{ old('content', $post->content )}} </textarea>
            </div><br>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        
        <hr>

        <form action="{{ route('posts.destroy', [$post->id]) }}" method="post" onSubmit="return confirm('確認是否刪除此筆資料')">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Delete this Data</button>
        </form>

        </div>
    </div>
</div>
@endsection
