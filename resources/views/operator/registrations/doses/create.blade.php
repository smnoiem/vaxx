@extends('operator.layouts.body', ['title' => 'Add Dose', 'page'=> 'add_dose'])
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <form action="" id="dose_form">
                @csrf
                <div class="row">
                    <div class="col-md-6 border-right">
                        <div class="form-group">
                            <label for="" class="control-label">Recipient's Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" value="{{$registration->citizen->name}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Center</label>
                            <input type="text" name="center" class="form-control form-control-sm" value="{{$registration->center->name . ' - ' .  $registration->center->address}}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Phone</label>
                            <input type="text" class="form-control form-control-sm" name="phone" value="{{$registration->phone}}" readonly>
                            <small id="#msg"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Dose Type</label>
                            <select class="form-select" aria-label="User role options" name="type" required>
                                <option value="first">First Dose</option>
                                <option value="second">Second Dose</option>
                                <option value="booster">Booster Dose</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Select Vaccine</label>
                            <select class="form-select" aria-label="User role options" name="vaccine" required>
                                @foreach ($vaccines as $vaccine)
                                    <option value="{{$vaccine->id}}">{{$vaccine->vendor . ' - ' . $vaccine->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Appointment Date</label>
                            <input type="date" name="date" value="{{$registration->center->current_available_date}}" readonly>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-lg-12 text-right justify-content-center d-flex">
                    <button class="btn btn-primary mr-2">Save</button>
                    <button class="btn btn-secondary" type="button" onclick="location.href = '{{route('operator.registrations.doses', $registration->nid)}}'">Cancel</button>
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
		$('#dose_form').submit(function(e){
			e.preventDefault()
			$.ajax({
				url:'{{route("operator.registrations.doses.store", $registration->nid)}}',
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
				success:function(resp){
					if(resp == 1){
						alert_toast('Data successfully saved.',"success");
						setTimeout(function(){
							location.replace('{{route('operator.registrations.doses', $registration->nid)}}')
						},750)
					}
					else if(resp == 2){
						alert_toast('Choose a different Dose Type.',"danger");
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