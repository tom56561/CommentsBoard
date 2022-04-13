@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ( $comments as $post)
            <div class="card">
                <div class="card-header">
                    {{ $post->title }} @ {{ $post->created_at }}
                    <a href="{{ route('posts.update', [$post->id]) }}">(Edit)</a>
                </div>
                <div class="card-body">
                    {{ $post->content }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection