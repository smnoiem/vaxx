@extends('admin.layouts.body', ['title' => 'Center List', 'page'=> 'center_list'])
@section('content')
    <div class="col-lg-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <div class="card-tools">
                    <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="{{route('admin.centers.create')}}"><i class="fa fa-plus"></i> Add New Center</a>
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
                        @foreach($centers as $center)
                        <tr>
                            <th class="text-center">{{$loop->iteration}}</th>
                            <td><b>{{ ucwords($center->name) }}</b></td>
                            <td><b>{{ $center->email }}</b></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                Action
                                </button>
                                <div class="dropdown-menu" style="">
                                <a class="dropdown-item view_center" href="javascript:void(0)" data-id="{{$center->id}}">View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('admin.centers.edit', $center->id)}}">Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item assign_user" href="{{route('admin.centers.update-vial-count', $center->id)}}" data-id="{{$center->id}}">Update vial count</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_center" href="javascript:void(0)" data-id="{{$center->id}}">Delete</a>
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
            $('.view_center').click(function(){
                var url = '{{route("admin.centers.show", ":id")}}';
                url = url.replace(':id', $(this).attr('data-id'));
                uni_modal("<i class='fa fa-id-card'></i> center Details", url)
            })
            $('.delete_center').click(function(){
                _conf("Are you sure to delete this center?","delete_center",[$(this).attr('data-id')])
            })
        })
        function delete_center($id){
            var url = '{{route("admin.centers.destroy", ":id")}}'
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