@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center"> 

        <div class="col-md-8">
            @foreach (App\Models\Post::orderBy('created_at', 'DESC')->get() as $post)
            <div class="card">
                <div class="card-header">
                    #{{ $post->id }} &nbsp&nbsp&nbsp
                    {{ $post->title }}  &nbsp&nbsp   time:  {{ $post->created_at }}     &nbsp&nbsp
                    

                    <!-- 用＠Auth 包著驗證是否為登入狀態下才顯示 -->
                    @auth
                    <a href="{{ route('posts.edit', [$post->id]) }} ">(編輯)</a>
                    @endauth
                </div>
                <div class="card-body">
                    {{ $post->content}}
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
@endsection
