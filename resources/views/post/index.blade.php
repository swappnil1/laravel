@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Laravel ajax crud</h1>

        </div>
    </div>
    <div class="row">
        <div class="table table-responsive">
            <table class="table table-responsive" id="table">
                <tr>
                    <th width="150px">no</th>
                    <th>Title</th>
                    <th>body</th>
                    <th>create</th>
                    <th class="text-center" width="150px">
                        <a href="#" data-toggle="modal" data-target="#create" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>
                        </a>
                    </th>
                </tr>
                @csrf
                <?php $no=1; ?>
                @foreach($post as $key => $value)
                    <tr class="post{{ $value->id }}">
                        <td>{{ $no++ }}</td>
                        <td> {{ $value->title }}</td>
                        <td>{{ $value->body }}</td>
                        <td>{{ $value->created_at }}</td>
                        <td>
                            <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{ $value->id }}" data-title="{{ $value->title }}" data-body="{{ $value->body }}">
                                <i class="fa fa-eye "></i>
                            </a>
                            <a href="#" class="edit-modal btn btn-warning btn-sm" data-id="{{ $value->id }}" data-title="{{ $value->title }}" data-body="{{ $value->body }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{ $value->id }}" data-title="{{ $value->title }}" data-body="{{ $value->body }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
{{--form for create post --}}

    <div id="create" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">hey</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        @csrf
                        <div class="form-group row add">
                            <label class="control-label col-sm-2" for="title">Title:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" placeholder="title"
                                       required>
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="body">Body:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="body" name="body" placeholder="body" required>
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" type="submit" id="add">
                        <span class="fa fa-plus">Save!!!</span>
                    </button>
                    <button class="btn btn-warning" type="button" data-dismiss="modal">
                        <span class="fa fa-remove">Close!!</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

{{--  Form show post  --}}
    <div id="show" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">

{{--                    <p>Title: {{ $post->title }}</p>--}}
{{--                    <p>Body: {{ $post->body }}</p>--}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-earning" data-dismiss="modal">
                        <span class="fa fa-remove"></span> close
                    </button>
                </div>
            </div>
        </div>
    </div>



    {{-- Modal Form Edit and Delete Post --}}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="modal">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fid" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Title</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="t">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="body">Body</label>
                            <div class="col-sm-10">
                                <textarea type="name" class="form-control" id="b"></textarea>
                            </div>
                        </div>
                    </form>
{{--         DELETE POST           --}}
                    <div class="deleteC">
                        Are bhai pakka?????<span class="title"></span>????
                        <span class="hidden id"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-earning" data-dismiss="modal">
                        <span id="footer_action_button" class=""></span>
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class="fa fa"></span>remove
                    </button>
                </div>
            </div>
        </div>
    </div>


@endsection