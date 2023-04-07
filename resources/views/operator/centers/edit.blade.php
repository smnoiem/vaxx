@extends('admin.layouts.body', ['title' => 'Edit Center', 'page'=> 'edit_center'])
@section('content')
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<form action="" id="manage_center">
                    @csrf
                    @method('PUT')
					<input type="hidden" name="id" value="{{$center->id}}">
					<div class="row">
						<div class="col-md-6 border-right">
							<div class="form-group">
								<label for="" class="control-label">Name</label>
								<input type="text" name="name" class="form-control form-control-sm" required value="{{$center->name}}">
							</div>
                            <div class="form-group">
                                <label for="" class="control-label">Vaccine Daily Limit</label>
                                <input type="number" name="daily_limit" class="form-control form-control-sm" required value="{{$center->daily_limit}}">
                            </div>
						</div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label for="address" class="control-label">Address</label>
                                <textarea name="address" id="address" cols="30" rows="6" class="form-control form-control-sm">{{$center->address}}</textarea>
                            </div>
						</div>
					</div>
					<hr>
					<div class="col-lg-12 text-right justify-content-center d-flex">
						<button class="btn btn-primary mr-2">Save</button>
						<button class="btn btn-secondary" type="button" onclick="location.href = '{{route('admin.centers.index')}}'">Cancel</button>
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
		$('#manage_center').submit(function(e){
			e.preventDefault()
			$('input').removeClass("border-danger")
			start_load()
			$('#msg').html('')
            var url = '{{route("admin.centers.update", ":id")}}';
            url = url.replace(':id', '{{$center->id}}');
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
							location.replace('{{route("admin.centers.index")}}')
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