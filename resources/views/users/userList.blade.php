@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div>
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
                    <tr style="line-height: 40px">
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
    /**編輯留言**/
    $(document).on('click', '.edit', function() {
        sOriginalContent = $(this).closest('#post').find('.content').text();
        $(this).parent().siblings('td.data').each(function() {
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
        $('input').each(function() {
            var content = $(this).val();
            console.log(content);
            $(this).html(content);
            $(this).contents().unwrap();
        });
        // let mInputValue = $(this).closest('#post').find('#inputValue');
        // let sContent = mInputValue.val();
        // console.log(sContent);
    })
</script>
@endsection