@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div>
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control"  placeholder="Search employee" id="search">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                <img src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/zeus/kratos/af2f34c3.svg" alt="">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Modify</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ( $userList['data'] as $data)
                    <tr id="{{$data['id']}}" style="line-height: 40px">
                        <th scope="row col-md-1">#{{$data['id']}}</th>
                        <td class="col-md-2 data">{{$data['name']}}</td>
                        <td class="col-md-5 data">{{$data['email']}}</td>
                        <td class="col-md-2 data">{{$data['role']}}</td>
                        <td class="col-md-2">
                            <button class="edit btn btn-sm btn-primary">Edit</button>
                            <button class="save btn btn-sm btn-success d-none">Save</button>
                            <button class="delete btn btn-sm btn-orange d-none">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="application/javascript">
    var aOriginalData = new Array;
    /**編輯留言**/
    $(document).on('click', '.edit', function() {
        $(this).parent().siblings('td.data').each(function() {
            var sContent = $(this).html();
            $(this).html('<input id="inputValue" class="inputValue" value="' + sContent + '" />');
            aOriginalData.push(sContent);
        });
        $(this).siblings('.save').removeClass("d-none");
        $(this).siblings('.delete').removeClass("d-none");
        $(this).addClass("d-none");
        $('.edit').addClass("d-none");
    });

    /**儲存留言**/
    $(document).on('click', '.save', function() {
        var aContent = new Array();
        $('input.inputValue').each(function() {
            var content = $(this).val();
            aContent.push(content);
        });
        var iId = $(this).parent().parent().closest('tr').attr('id');
        console.log(iId);
        $.ajax({
            url: "/users/"+iId,
            type: "PUT",
            data:{
                "_token":"{{ csrf_token() }}",
                name:aContent[0],
                email:aContent[1],
                role:aContent[2],
            },
            success:function(response){
                if(response){
                    var aData = new Array();
                    aData[0] = response.data.name;
                    aData[1] = response.data.email;
                    aData[2] = response.data.role;
                    var i = 0;
                    $('input.inputValue').each(function() {
                        $(this).html(aData[i]);
                        $(this).contents().unwrap();
                        i++;
                    });
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                var i = 0;
                $('input.inputValue').each(function() {
                    $(this).html(aOriginalData[i]);
                    $(this).contents().unwrap();
                    i++;
                });
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
        bConfirm = confirm('確定要刪除這條留言嗎？');
        if(bConfirm){
            var iId = $(this).parent().parent().closest('tr').attr('id');
            $.ajax({
                url: "/users/"+iId,
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
                    var i = 0;
                    $('input.inputValue').each(function() {
                        $(this).html(aOriginalData[i]);
                        $(this).contents().unwrap();
                        i++;
                    });
                    alert(XMLHttpRequest.responseJSON.UserRole_Error); 
                }  
            });
        }else{
            var i = 0;
            $('input.inputValue').each(function() {
                $(this).html(aOriginalData[i]);
                $(this).contents().unwrap();
                i++;
            });
        }
        $('.edit').removeClass("d-none");
        $(this).siblings('.edit').removeClass("d-none");
        $(this).siblings('.save').addClass("d-none");
        $(this).addClass("d-none"); 
    })
</script>
@endsection