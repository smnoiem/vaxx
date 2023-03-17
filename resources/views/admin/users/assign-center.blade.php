@extends('admin.layouts.body', ['title' => 'Edit User', 'page'=> 'edit_user'])
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="" id="assign_center">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <p>Name: {{$user->name}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <p>Email: {{$user->email}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <p>Role: {{$user->role==1?'Admin':'Operator'}}</p>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="center_id">Center</label>
                            <select class="form-control form-control-sm select2" name="center_id" id="center_id" required>
                                <option value=""></option>
                                @foreach($centers as $center)

                                <option value="{{ $center->id }}" {{ isset($user->center_id) && $user->center_id == $center->id ? 'selected' : '' }}>{{ $center->name . ' - ' . $center->address}}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>


                    <hr>
                    <div class="col-lg-12 text-right justify-content-center d-flex">
                        <button class="btn btn-primary mr-2">Save</button>
                        <button class="btn btn-secondary" type="button" onclick="location.href = '{{route('admin.users.index')}}'">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
	<style>
		img#cimg{
			height: 15vh;
			width: 15vh;
			object-fit: cover;
			border-radius: 100% 100%;
		}
	</style>
	<script>
        
		$('#assign_center').submit(function(e){
			e.preventDefault()
			$('input').removeClass("border-danger")
			start_load()
			$('#msg').html('')

            var url = '{{route("admin.users.assign-center", ":id")}}';
            url = url.replace(':id', '{{$user->id}}');
			$.ajax({
				url:url,
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
				success:function(resp){
					if(resp == 1){
						alert_toast('Data successfully saved.',"success");
						setTimeout(function(){
							location.replace('{{route("admin.users.index")}}')
						},750)
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
		})
	</script>
@endsection