@extends('admin.layouts.body', ['title' => 'User List', 'page'=> 'user_list'])
@section('content')
    <div class="col-lg-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <div class="card-tools">
                    <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="{{route('admin.users.create')}}"><i class="fa fa-plus"></i> Add New User</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table tabe-hover table-bordered" id="list">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <th class="text-center">{{$loop->iteration}}</th>
                            <td><b>{{ ucwords($user->name) }}</b></td>
                            <td><b>{{ $user->email }}</b></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                Action
                                </button>
                                <div class="dropdown-menu" style="">
                                <a class="dropdown-item view_user" href="javascript:void(0)" data-id="{{$user->id}}">View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('admin.users.edit', $user->id)}}">Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item assign_user" href="{{route('admin.users.assign-center', $user->id)}}" data-id="{{$user->id}}">Appoint To A Center</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_user" href="javascript:void(0)" data-id="{{$user->id}}">Delete</a>
                                </div>
                            </td>
                        </tr>	
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#list').dataTable()
            $('.view_user').click(function(){
                var url = '{{route("admin.users.show", ":id")}}';
                url = url.replace(':id', $(this).attr('data-id'));
                uni_modal("<i class='fa fa-id-card'></i> User Details", url)
            })
            $('.delete_user').click(function(){
                _conf("Are you sure to delete this user?","delete_user",[$(this).attr('data-id')])
            })
        })
        function delete_user($id){
            var url = '{{route("admin.users.destroy", ":id")}}'
            url = url.replace(':id', $id);
            start_load()
            $.ajax({
                url:url,
                type:'DELETE',
                data:{_token: '{{csrf_token()}}', id:$id},
                success:function(resp){
                    if(resp==1){
                        alert_toast("Data successfully deleted",'success')
                        setTimeout(function(){
                            location.reload()
                        },1500)

                    }
                    else {
					    alert_toast("something went wrong", "danger");
					    end_load()
                    }
                },
                error:function(err) {
                    console.log(err.responseJSON.message);
					alert_toast(err.responseJSON.message, "danger");
					end_load()
                }
            })
        }
    </script>
@endsection