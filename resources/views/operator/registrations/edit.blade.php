@extends('operator.layouts.body', ['title' => 'Edit registration', 'page'=> 'edit_registration'])
@section('content')
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<form action="" id="manage_registration">
                    @csrf
                    @method('PUT')
					<input type="hidden" name="id" value="{{$registration->nid}}">
					<div class="row">
						<div class="col-md-6 border-right">
							<div class="form-group">
								<label for="" class="control-label">Name</label>
								<input type="text" name="name" class="form-control form-control-sm" required value="{{$registration->citizen->name}}" readonly>
							</div>
							<div class="form-group">
								<label class="control-label">Phone</label>
								<input type="text" class="form-control form-control-sm" name="phone" required value="{{$registration->phone}}">
								<small id="#msg"></small>
							</div>
						</div>
						<div class="col-md-6">
						</div>
					</div>
					<hr>
					<div class="col-lg-12 text-right justify-content-center d-flex">
						<button class="btn btn-primary mr-2">Save</button>
						<button class="btn btn-secondary" type="button" onclick="location.href = '{{route('operator.registrations.index')}}'">Cancel</button>
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
		$('#manage_registration').submit(function(e){
			e.preventDefault()
			$('input').removeClass("border-danger")
			start_load()
			$('#msg').html('')
            
            var url = '{{route("operator.registrations.update", ":id")}}';
            url = url.replace(':id', '{{$registration->nid}}');
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
							location.replace('{{route("operator.registrations.index")}}')
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