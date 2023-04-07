<div class="container-fluid">
	<div class="card card-widget widget-user shadow">
      <div class="widget-user-header bg-dark">
        <h3 class="widget-user-username">{{ ucwords($user->name)}}</h3>
        <h5 class="widget-user-desc">{{$user->email}}</h5>
      </div>
      <div class="widget-user-image">

      	@if(empty($user->avatar) || (!empty($user->avatar) && !Storage::has('/public'.$user->avatar)) )

      	<span class="brand-image img-circle elevation-2 d-flex justify-content-center align-items-center bg-primary text-white font-weight-500" style="width: 90px;height:90px"><h4>{{ strtoupper(substr($user->firstname, 0,1).substr($user->lastname, 0,1)) }}</h4></span>

      	@else
        <img class="img-circle elevation-2" src="{{url('/') . '/storage'.$user->avatar}}" alt="User Avatar"  style="width: 90px;height:90px;object-fit: cover">
      	@endif

      </div>
	</div>
</div>
<div class="modal-footer display p-0 m-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>