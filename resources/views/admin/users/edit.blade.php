@extends('admin.layouts.body', ['title' => 'Edit User', 'page'=> 'edit_user'])
@section('content')
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<form action="" id="manage_user">
                    @csrf
                    @method('PUT')
					<input type="hidden" name="id" value="{{$user->id}}">
					<div class="row">
						<div class="col-md-6 border-right">
							<div class="form-group">
								<label for="" class="control-label">Name</label>
								<input type="text" name="name" class="form-control form-control-sm" required value="{{$user->name}}">
							</div>
							<div class="form-group">
								<label class="control-label">Email</label>
								<input type="email" class="form-control form-control-sm" name="email" required value="{{$user->email}}">
								<small id="#msg"></small>
							</div>
							<div class="form-group">
								<label class="control-label">Role</label>
								<select class="form-select" aria-label="User role options" name="role" required>
                                    <option value="">Select Role</option>
                                    <option value="1" {{$user->role == 1 ? 'selected' : ''}}>Admin</option>
                                    <option value="2" {{$user->role == 2 ? 'selected' : ''}}>Operator</option>
                                </select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Password</label>
                                <br>
								<small>Keep these blank if you don't wish to change password.</small>
								<input type="password" class="form-control form-control-sm" name="password">
								<small id="pass_note" data-status=''></small>
							</div>
							<div class="form-group">
								<label class="label control-label">Confirm Password</label>
								<input type="password" class="form-control form-control-sm" name="password_confirmation">
								<small id="pass_match" data-status=''></small>
							</div>
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
		$('[name="password"],[name="password_confirmation"]').keyup(function(){
			var pass = $('[name="password"]').val()
			var password_confirmation = $('[name="password_confirmation"]').val()
			if(password_confirmation != '' && pass == ''){
				$('#pass_note').attr('data-status','2').html('');
				$('#pass_match').attr('data-status','1').html('');
			}
			else if(password_confirmation == '' && pass == ''){
				$('#pass_note').attr('data-status','1').html('');
				$('#pass_match').attr('data-status','1').html('');
			}else{
				if(password_confirmation == pass){
					$('#pass_match').attr('data-status','1').html('');
					$('#pass_note').attr('data-status','1').html('');
				}else{
					$('#pass_match').attr('data-status','2').html('');
					$('#pass_note').attr('data-status','1').html('');
				}
			}
		})
		$('#manage_user').submit(function(e){
			e.preventDefault()
			$('input').removeClass("border-danger")
			start_load()
			$('#msg').html('')
			if($('[name="password"]').val() != '' || $('[name="password_confirmation"]').val() != ''){
				if($('#pass_match').attr('data-status') != 1 || $('#pass_note').attr('data-status') != 1){
					if($('#pass_match').attr('data-status') != 1){
                        if($('[name="password_confirmation"]').val() == '') {
                            console.log($('#pass_match').val());
                            $('#pass_match').html('<i class="text-danger">Required</i>');
                        }
                        else {
                            console.log($('#pass_match').val());
                            $('#pass_match').html('<i class="text-danger">Password does not match.</i>');
                        }
						$('[name="password"],[name="password_confirmation"]').addClass("border-danger")
					}
					if($('#pass_note').attr('data-status') != 1){
                        $('#pass_note').html('<i class="text-danger">Required</i>');
						$('[name="password"]').addClass("border-danger")
					}
					end_load();
					return false;
				}
			}
            var url = '{{route("admin.users.update", ":id")}}';
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
					}else if(resp == 2){
						$('#msg').html("<div class='alert alert-danger'>Email already exist.</div>");
						$('[name="email"]').addClass("border-danger")
						end_load()
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