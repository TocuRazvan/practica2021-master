@extends('layout.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Board view</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('boards.all')}}">Boards</a></li>
                        <li class="breadcrumb-item active">Board</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$board->name}}</h3>
            </div>

            <div class="card-body">
                <select class="custom-select rounded-0" id="changeBoard">
                    @foreach($boards as $selectBoard)
                        <option @if ($selectBoard->id === $board->id) selected="selected" @endif value="{{$selectBoard->id}}">{{$selectBoard->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Assignment</th>
                <th>Status</th>
                <th>Date of Creation</th>
                <th style="width: 40px">Actions</th>

            </tr>
            </thead>
            <tbody>
            @foreach($task as $board)

                <tr>
                    <td>{{$board->id}}</td>
                    <td>{{$board->name}}</td>
                    <td>{{$board->description}}</td>
                    <td>{{$board->assignment}}</td>
                    <td>{{$board->status}}</td>
                    <td>{{$board->created_at}}</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-xs btn-primary"
                                    type="button"
                                    data-board="{{json_encode($board)}}"
                                    data-toggle="modal"
                                    data-target="#boardEditModal">
                                <i class="fas fa-edit"></i></button>
                            <button class="btn btn-xs btn-danger"
                                    type="button"
                                    data-board="{{json_encode($board)}}"
                                    data-toggle="modal"
                                    data-target="#boardDeleteModal">
                                <i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- /.card-body -->
{{--    <div class="card-footer clearfix">--}}
{{--        <ul class="pagination pagination-sm m-0 float-right">--}}
{{--            @if ($users->currentPage() > 1)--}}
{{--                <li class="page-item"><a class="page-link" href="{{$users->previousPageUrl()}}">&laquo;</a></li>--}}
{{--                <li class="page-item"><a class="page-link" href="{{$users->url(1)}}">1</a></li>--}}
{{--            @endif--}}

{{--            @if ($users->currentPage() > 3)--}}
{{--                <li class="page-item"><span class="page-link page-active">...</span></li>--}}
{{--            @endif--}}
{{--            @if ($users->currentPage() >= 3)--}}
{{--                <li class="page-item"><a class="page-link" href="{{$users->url($users->currentPage() - 1)}}">{{$users->currentPage() - 1}}</a></li>--}}
{{--            @endif--}}

{{--            <li class="page-item"><span class="page-link page-active">{{$users->currentPage()}}</span></li>--}}

{{--            @if ($users->currentPage() <= $users->lastPage() - 2)--}}
{{--                <li class="page-item"><a class="page-link" href="{{$users->url($users->currentPage() + 1)}}">{{$users->currentPage() + 1}}</a></li>--}}
{{--            @endif--}}

{{--            @if ($users->currentPage() < $users->lastPage() - 2)--}}
{{--                <li class="page-item"><span class="page-link page-active">...</span></li>--}}
{{--            @endif--}}

{{--            @if ($users->currentPage() < $users->lastPage() )--}}
{{--                <li class="page-item"><a class="page-link" href="{{$users->url($users->lastPage())}}">{{$users->lastPage()}}</a></li>--}}
{{--                <li class="page-item"><a class="page-link" href="{{$users->nextPageUrl()}}">&raquo;</a></li>--}}
{{--            @endif--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--    </div>--}}
    <!-- /.card -->

    <div class="modal fade" id="boardEditModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit board</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{--                        aici o sa vedem ce e in corp,numele bordului si useri care sunt in acest bord.--}}
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="boardEditButton">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="boardDeleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete board</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger hidden" id="boardDeleteAlert"></div>
                    <input type="hidden" id="boardDeleteId" value="" />
                    <p>Are you sure you want to delete: <span id="boardDeleteName"></span>?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="boardDeleteButton">Delete</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
