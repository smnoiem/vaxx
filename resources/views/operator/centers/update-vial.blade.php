@extends('admin.layouts.body', ['title' => 'Update Vial', 'page'=> 'update_vial'])
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="" id="update_vial">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="center_id" value="{{ $center->id }}">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <p>Name: {{$center->name}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <p>Address: {{$center->email}}</p>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="new_count"> New Count</label>
                            <input type="number" name="new_count" value="{{$center->daily_limit}}">
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
        
		$('#update_vial').submit(function(e){
			e.preventDefault()
			$('input').removeClass("border-danger")
			start_load()
			$('#msg').html('')

            var url = '{{route("admin.centers.update-vial-count-store", ":id")}}';
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