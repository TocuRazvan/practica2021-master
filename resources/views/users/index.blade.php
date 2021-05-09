@extends('layout.main')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{'/dashboard'}}">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                <h3 class="card-title">Bordered Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Is Verified</th>
                            <th style="width: 100px">Role</th>
                            <th style="width: 40px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if ($user->email_verified_at)
                                        <span class="badge bg-primary">Verified</span>
                                    @else
                                        <span class="badge bg-warning">Unverified</span>
                                    @endif
                                </td>
                                <td>{{$user->role === \App\Models\User::ROLE_ADMIN ? 'Admin' : 'User'}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-primary" type="button" data-user="{{json_encode($user)}}" data-toggle="modal" data-target="#edit-modal">
                                            <i class="fas fa-edit"></i></button>
                                        <button class="btn btn-xs btn-danger" type="button" data-user="{{json_encode($user)}}" data-toggle="modal" data-target="#delete-modal">
                                            <i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    @if ($users->currentPage() > 1)
                        <li class="page-item"><a class="page-link" href="{{$users->previousPageUrl()}}">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="{{$users->url(1)}}">1</a></li>
                    @endif

                    @if ($users->currentPage() < $users->lastPage() )
                        <li class="page-item"><a class="page-link" href="{{$users->url($users->lastPage())}}">{{$users->lastPage()}}</a></li>
                        <li class="page-item"><a class="page-link" href="{{$users->nextPageUrl()}}">&raquo;</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- /.card -->

        <div class="modal fade" id="edit-modal">
            <div class="modal-dialog">
                <form action="{{'route(AdminController)'}}" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit user</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="editName"></div>
                            <input type="hidden" name="editId" value="" />
                            <div class="form-group">
                                <label for="editRole">Role</label>
                                <select class="custom-select rounded-0" id="editRole">
                                    <option value="{{\App\Models\User::ROLE_USER}}">User</option>
                                    <option value="{{\App\Models\User::ROLE_ADMIN}}">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="delete-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete user</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to remove this user?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button"name="ok_button" id="ok_button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Delete user</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <script>
            var user_id;
            $(document).on('click','.delete',function (){
                user_id=$(this).attr('id');
                $('#delete-modal').modal('show');
            });
            $('#ok_button').click(function (){
                $.ajax({
                    url:"users/destroy/"+user_id,
                    beforeSend:function (){
                        $('#ok_button').text('Deleting..');
                    },
                    success:function (data){
                        setTimeout(function(){
                            $('#delete-modal').modal('show');
                            $('#users_table').DataTable().ajax.reload();
                        },2000);
                    }
                });

            })
        </script>
    </section>
    <!-- /.content -->
@endsection
@push('users')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="/js/custom.js"></script>

@endpush
