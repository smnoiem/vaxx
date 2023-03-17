<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-primary navbar-dark ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <?php if(auth()): ?>
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
      </li>
    <?php endif; ?>
      <li>
        <a class="nav-link text-white"  href="./" role="button"> <large><b> Vaxx</b></large></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
     
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
     <li class="nav-item dropdown">
            <a class="nav-link"  data-toggle="dropdown" aria-expanded="true" href="javascript:void(0)">
              <span>
                <div class="d-felx badge-pill">
                  <span class=""><img src="{{asset('storage'.auth()->user()->avatar)}}" alt="" class="user-img border "></span>
                  <span><b>{{ ucwords(auth()->user()->name) }}</b></span>
                  <span class="fa fa-angle-down ml-2"></span>
                </div>
              </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
              <a class="dropdown-item" href="javascript:void(0)" id="manage_account"><i class="fa fa-cog"></i> Manage Account</a>
              <a class="dropdown-item" id="logout-button"><i class="fa fa-power-off"></i> Logout</a>
            </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
@push('styles')
  <style>
  </style>
@endpush

@push('footer-script')
<script>
    
</script>
@endpush
