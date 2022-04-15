@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h2 class="mt-2">留言板</h2>
            <form id="submitForm">
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
                    <button type="sumbit" class="btn btn-main ms-3 sendData">送出</button>
                </div>
            </form>

            <div id="allComments">
                @foreach ( $comments['data'] as $data)
                <div class="pt-3">
                    <div class="pt-3 d-flex flex-row">
                        <img class="rounded-circle bg-cover img-host ms-4"
                            src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                            alt="">
                        <div>
                            <div class="ms-3 bg-white p-3 commentW border-card">
                                <span class="d-block pb-1">使用者{{ $data['user_id'] }}</span>
                                <span class="fw-light">{{ $data['content'] }}</span>
                            </div>
                            <span class="ms-3 ps-3 fw-light fs-6">{{ $data['created_at'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
        </div>
    </div>
</div>
<script type="application/javascript">
    $("#submitForm").on('submit',function(e){
        e.preventDefault();

        let content = $("#content").val();
        console.log(content);

        $.ajax({
            url: "/posts",
            type: "POST",
            data:{
                "_token":"{{ csrf_token() }}",
                content:content,
            },
            success:function(response){
                if(response){
                    console.log(response);
                    $('#allComments').prepend(
                        // '<div class="pt-5">'+response.user_id+'</div>'
                        '<div class="pt-3">'+
                            '<div class="pt-3 d-flex flex-row">'+
                                '<img class="rounded-circle bg-cover img-host ms-4" src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80">'+
                                '<div>'+
                                    '<div class="ms-3 bg-white p-3 commentW border-card">'+
                                        '<span class="d-block pb-1">'+'使用者'+response.user_id+'</span>'+
                                        '<span class="fw-light">'+response.content+'</span>'+
                                    '</div>'+
                                    '<span class="ms-3 ps-3 fw-light fs-6">'+response.created_at+'</span>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    )
                }
            }
        });
    })
</script>
@endsection