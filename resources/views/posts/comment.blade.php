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
                <div id="{{$data['id']}}" class="pt-3">
                    <div class="pt-3 d-flex flex-row">
                        <img class="rounded-circle bg-cover img-host ms-4"
                            src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                            alt="">
                        <div id="post">
                            <div class="ms-3 bg-white p-3 commentW border-card">
                                <div class="d-flex justify-content-between">
                                    <span class="pb-1">使用者{{ $data['user_id'] }}</span>
                                    <span>
                                        @if( Auth::user()->role == 'admin' or Auth::user()->id == $data['user_id'] )
                                        <button class="edit btn btn-sm btn-primary">Edit</button>
                                        <button class="save btn btn-sm btn-success d-none">Save</button>
                                        @if( Auth::user()->role == 'admin')
                                        <button class="delete btn btn-sm btn-orange d-none">Delete</button>
                                        @endif
                                        @endif
                                    </span>
                                </div>
                                <span class="id d-none">{{ $data['id'] }}</span>
                                <span class="fw-light content">{{ $data['content'] }}</span>
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
    var sOriginalContent;
    /**新增留言**/
    $("#submitForm").on('submit',function(e){
        e.preventDefault();
        let content = $("#content").val();
        $("#content").val('');
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
                        '<div id='+response.data.id+' class="pt-3">'+
                            '<div class="pt-3 d-flex flex-row">'+
                            '<img class="rounded-circle bg-cover img-host ms-4" src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80">'+
                                '<div id="post">'+
                                    '<div class="ms-3 bg-white p-3 commentW border-card">'+
                                        '<div class="d-flex justify-content-between">'+
                                            '<span class="pb-1">'+'使用者'+response.data.user_id+'</span>'+
                                            '<span>'+
                                                '<button class="edit btn btn-sm btn-primary">Edit</button>'+
                                                '<button class="save btn btn-sm btn-success d-none">Save</button>'+
                                                '@if( Auth::user()->role == "admin")'+
                                                '<button class="delete btn btn-sm btn-orange d-none">Delete</button>'+
                                                '@endif'+
                                            '</span>'+
                                        '</div>'+
                                        '<span class="id d-none">'+response.data.id+'</span>'+
                                        '<span class="fw-light content">'+response.data.content+'</span>'+
                                    '</div>'+
                                    '<span class="ms-3 ps-3 fw-light fs-6">'+response.data.created_at+'</span>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    )
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Error: " + errorThrown+'\n'+ XMLHttpRequest.responseJSON.UserRole_Error); 
            }   
        });
    })

    /**編輯留言**/
    $(document).on('click', '.edit', function() {
        sOriginalContent = $(this).closest('#post').find('.content').text();
        $(this).closest('#post').find('.content').each(function() {
            var sContent = $(this).html();
            $(this).html('<input id="inputValue" class="inputValue" value="' + sContent + '" />');
        });
        $(this).siblings('.save').removeClass("d-none");
        $(this).siblings('.delete').removeClass("d-none");
        $(this).addClass("d-none");
        $('.edit').addClass("d-none");
    });

    /**儲存留言**/
    $(document).on('click', '.save', function() {
        let mInputValue = $(this).closest('#post').find('#inputValue');
        let sContent = mInputValue.val();
        console.log(sContent);
        var iId = $(this).closest('#post').find('.id').text();
        $.ajax({
            url: "/posts/"+iId,
            type: "PUT",
            data:{
                "_token":"{{ csrf_token() }}",
                content:sContent,
                id:iId,
            },
            success:function(response){
                if(response){
                    var sContent = response.data.content;
                    mInputValue.html(sContent);
                    mInputValue.contents().unwrap();
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                mInputValue.html(sOriginalContent);
                mInputValue.contents().unwrap();
                alert(XMLHttpRequest.responseJSON.UserRole_Error); 
            }   

        });
        $('.edit').removeClass("d-none");
        $(this).siblings('.edit').removeClass("d-none");
        $(this).siblings('.delete').addClass("d-none");
        $(this).addClass("d-none"); 
    })

    /**刪除留言**/
    $(document).on('click', '.delete', function() {
        let mInputValue = $(this).closest('#post').find('#inputValue');
        bConfirm = confirm('確定要刪除這條留言嗎？');
        if(bConfirm){
            var iId = $(this).closest('#post').find('.id').text();
            $.ajax({
                url: "/posts/"+iId,
                type: "DELETE",
                data:{
                    "_token":"{{ csrf_token() }}",
                    id:iId,
                },
                success:function(response){
                    if(response){
                        $('#'+iId).remove();
                        console.log('remove');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    mInputValue.html(sOriginalContent);
                    mInputValue.contents().unwrap();
                    alert(XMLHttpRequest.responseJSON.UserRole_Error); 
                }  
            });
        }else{
            mInputValue.html(sOriginalContent);
            mInputValue.contents().unwrap();
        }
        $('.edit').removeClass("d-none");
        $(this).siblings('.edit').removeClass("d-none");
        $(this).siblings('.save').addClass("d-none");
        $(this).addClass("d-none"); 
    })

</script>
@endsection