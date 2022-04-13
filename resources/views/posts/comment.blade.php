@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h2 class="mt-2">留言板</h2>
            <form id="comment">
                @csrf
                <div class="pt-2">
                    <img class="rounded-circle bg-cover img-host ms-4"
                        src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                        alt="">
                    <div class="ms-3 form-floating d-inline-block align-middle">
                        <textarea class="form-control" style="width: 470px;" placeholder="Leave a comment here"
                            id="content" name="content"></textarea>
                        <label for="content">留言</label>
                    </div>
                    <button type="sumbit" class="btn btn-primary ms-3 sendData">送出</button>
                </div>
            </form>
            
            @foreach ( $comments as $post)
            <div class="pt-3">
                <div class="pt-3 d-flex flex-row">
                    <img class="rounded-circle bg-cover img-host ms-4"
                        src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                        alt="">
                    <div>
                        <div class="ms-3 bg-white p-3 commentW border-card">
                            <span class="d-block pb-1">使用者{{ $post->user_id }}</span>
                            <span class="fw-light">{{ $post->content }}</span>
                        </div>
                        <span class="ms-3 ps-3 fw-light fs-6">{{ $post->created_at }}</span>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- @foreach ( $comments as $post)
            <div class="card">
                <div class="card-header">
                    {{ $post->title }} @ {{ $post->created_at }}
                    <a href="{{ route('posts.update', [$post->id]) }}">(Edit)</a>
                </div>
                <div class="card-body">
                    {{ $post->content }}
                </div>
            </div>
            @endforeach -->
            
        </div>
    </div>
</div>
<script type="application/javascript">
    $(".sendData").click(function(e){
        e.preventDefault
        let sContent = $("#content").val();
        console.log(sContent);

        $.ajax({
            url: "{{ route('posts.store') }}",
            type: "POST",
            data:{
                '_token':'{{csrf_token()}}',
                'sContent':sContent,
            },
            success:function(response){
                console.log('success');
            }
        });
    })
</script>
@endsection