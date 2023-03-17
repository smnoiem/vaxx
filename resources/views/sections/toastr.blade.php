<script>
    $(document).ready(function() {

        @if(Session::has('toast'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }

            toastr.{{session('toast.status')}}("{{ session('toast.message') }}");
        @endif
    
    });
</script>