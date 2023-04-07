@extends('operator.layouts.body', ['title' => 'Vaccine Dose List', 'page'=> 'registration_dose_list'])
@section('content')
    <div class="col-lg-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <div class="card-tools">
                    <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="{{route('operator.registrations.doses.create', $registration->nid)}}"><i class="fa fa-plus"></i> Add Another Dose</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table tabe-hover table-bordered" id="list">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Dose Type</th>
                            <th>Dose Name</th>
                            <th>Given By</th>
                            <th>Appointment Date</th>
                            <th>Vaccination Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registration->doses as $dose)
                        <tr>
                            <th class="text-center">{{$loop->iteration}}</th>
                            <td><b>{{ ucwords($dose->dose_type) }}</b></td>
                            <td><b>{{ ucwords($dose->vaccine->name) }}</b></td>
                            <td><b>{{ ucwords($dose->givenBy?->name) }}</b></td>
                            <td><b>{{ ucwords($dose->scheduled_date) }}</b></td>
                            <td><b>{{ ucwords($dose->taken_date) }}</b></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                Action
                                </button>
                                <div class="dropdown-menu" style="">
                                    <a class="dropdown-item mark-as-taken" href="{{route('operator.registrations.doses.mark-as-taken',[$registration->nid, $dose->id])}}" data-registration-nid="{{$registration->nid}}">Mark as taken</a>
                                    <div class="dropdown-divider"></div>
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
            $('.view_registration').click(function(){
                var url = '{{route("operator.registrations.show", ":id")}}';
                url = url.replace(':id', $(this).attr('data-id'));
                uni_modal("<i class='fa fa-id-card'></i> Registration Details", url)
            })
            $('.delete_registration').click(function(){
                _conf("Are you sure to delete this registration?","delete_registration",[$(this).attr('data-id')])
            })
        })
        function delete_registration($id){
            var url = '{{route("operator.registrations.destroy", ":id")}}'
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