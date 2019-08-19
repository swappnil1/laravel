<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top" >
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('post.index') }}">swap</a>
            </div>
        </div>
    </nav>
<div class="container">
    @yield('content')
</div>

{{--ajax for create--}}
    <script type="text/javascript">


        $("#add").click(function () {
            $.ajax({
                type:'POST',
                url:'addPost',
                data :{
                    'token': $('input[name=token]').val(),
                    'title': $('input[name=title]').val(),
                    'body': $('input[name=body]').val(),
                    _token: "{{ csrf_token() }}",
                },
                success: function (data) {
                    if((data.errors)){
                        $('.errors').removeClass('hidden');
                        $('.errors').text(data.error.title);
                        $('.errors').text(data.error.body);
                    }else {
                        $('.error').remove();
                        $('#table').append("" +
                            "<tr class='post" + data.id +"'>" +
                                "<td>"+ data.id +"</td>"+
                                "<td>"+ data.title +"</td>"+
                                "<td>"+ data.body +"</td>"+
                                "<td>"+ data.created_at +"</td>"+
                                "<td>" +
                                    "<a href='#' style='margin-right: 4px;' class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body = '" + data.body + "' >" +
                                        "<i class='fa fa-eye'></i>" +
                                    "</a>"+
                                    "<a href='#' style='margin-right: 4px;' class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body = '" + data.body + "'>" +
                                        "<i class='fa fa-pencil'></i>" +
                                    "</a>"+
                                    "<a href='#' style='margin-right: 4px;' class='show-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body = '" + data.body + "'>" +
                                        "<i class='fa fa-trash'></i>" +
                                    "</a>" +
                                "</td>"+
                            "</tr>"
                        );
                    }
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
            $('#title').val('');
            $('#body').val('');
        });

        $(document).on('click','.show-modal',function () {
            $('#show').modal('show');
            $('.modal-title').text('show-post');
            
        });


        //edit





        $(document).on('click', '.edit-modal', function() {
            $('#footer_action_button').text(" update_post");
            $('#footer_action_button').addClass('fa-check');
            $('#footer_action_button').removeClass('fa-trash');
            $('.actionBtn').addClass('btn-success');
            $('.actionBtn').removeClass('btn-danger');
            $('.actionBtn').addClass('edit');
            $('.modal-title').text('Edit');
            $('.deleteC').hide();
            $('.form-horizontal').show();
            $('#fid').val($(this).data('id'));
            $('#t').val($(this).data('title'));
            $('#b').val($(this).data('body'));
            $('#myModal').modal('show');
        });

        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'POST',
                url: 'editPost',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#fid").val(),
                    'title': $('#t').val(),
                    'body': $('#b').val()
                },
                success: function(data) {
                    $('.post' + data.id).replaceWith(" "+
                        "<tr class='post" + data.id + "'>"+
                        "<td>" + data.id + "</td>"+
                        "<td>" + data.title + "</td>"+
                        "<td>" + data.body + "</td>"+
                        "<td>" + data.created_at + "</td>"+
                        "<td><button class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='fa fa-pencil'></span></button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='fa fa-trash'></span></button></td>"+
                        "</tr>");
                }
            });
        });

        // form Delete function

        $('.modal-footer').on('click', '.delete', function(){
            $.ajax({
                type: 'POST',
                url: 'deletePost',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $('.id').text()
                },
                success: function(data){
                    $('.post' + $('.id').text()).remove();
                }
            });
        });
        {{--$('.modal-footer').on('click', '.edit', function() {--}}
        {{--    $.ajax({--}}
        {{--        type: 'get',--}}
        {{--        url: 'editPost',--}}
        {{--        data: {--}}
        {{--            _token: "{{ csrf_token() }}",--}}
        {{--            'id': $("#fid").val(),--}}
        {{--            'title': $('#t').val(),--}}
        {{--            'body': $('#b').val()--}}
        {{--        },--}}
        {{--        success: function(data) {--}}
        {{--            $('.get' + data.id).replaceWith("<tr class='post" + data.id + "'><td>" + data.id + "</td><td>" + data.title + "</td><td> " + data.body +"</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-title='" + data.title + "'  data-body ='" + data.body +"'><span class='fa fa-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-title='" + data.title + "'  data-body ='" + data.body +"' ><span class='fa fa-trash'></span> Delete</button></td></tr>");--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}




        //edit post






    </script>




</body>
</html>


{{--// $(document).on('click','.edit-modal',function () {--}}
{{--//     $('#footer_action_button').text("update_post");--}}
{{--//     $('#footer_action_button').addClass('fa-check');--}}
{{--//     $('#footer_action_button').removeClass('fa-trash');--}}
{{--//     $('.actionBtn').addClass('btn-success');--}}
{{--//     $('.actionBtn').removeClass('btn-danger');--}}
{{--//     $('.actionBtn').addClass('edit');--}}
{{--//     $('.modal-title').text('post edit');--}}
{{--//     $('.deleteContent').hide();--}}
{{--//     $('.form-horizontal').show();--}}
{{--//     $('#fid').val($(this).data('id'));--}}
{{--//     $('#t').val($(this).data('title'));--}}
{{--//     $('#b').val($(this).data('body'));--}}
{{--//     $('myModal').modal('show');--}}
{{--// });--}}


{{--$('.modal-footer').click( function () {--}}
{{--    $.ajax({--}}
{{--        type: 'POST',--}}
{{--        url: 'editPost',--}}
{{--        data: {--}}
{{--            'id': $('#fid').val(),--}}
{{--            'title': $('#t').val(),--}}
{{--            'body': $('#b').val(),--}}
{{--            _token: "{{ csrf_token() }}",--}}
{{--        },--}}
{{--        success:function (data) {--}}
{{--            $('.post' + data.id).replaceWith(""+--}}
{{--                "<tr class='post" + data.id +"'>" +--}}
{{--                "<td>"+ data.id +"</td>"+--}}
{{--                "<td>"+ data.title +"</td>"+--}}
{{--                "<td>"+ data.body +"</td>"+--}}
{{--                "<td>"+ data.created_at +"</td>"+--}}
{{--                "<td>" +--}}
{{--                "<a href='#' style='margin-right: 4px;' class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body = '" + data.body + "' >" +--}}
{{--                "<i class='fa fa-eye'></i>" +--}}
{{--                "</a>"+--}}
{{--                "<a href='#' style='margin-right: 4px;' class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body = '" + data.body + "'>" +--}}
{{--                "<i class='fa fa-pencil'></i>" +--}}
{{--                "</a>"+--}}
{{--                "<a href='#' style='margin-right: 4px;' class='show-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body = '" + data.body + "'>" +--}}
{{--                "<i class='fa fa-trash'></i>" +--}}
{{--                "</a>" +--}}
{{--                "</td>"+--}}
{{--                "</tr>");--}}
{{--        }--}}
{{--    });--}}
{{--    --}}
{{--});--}}
