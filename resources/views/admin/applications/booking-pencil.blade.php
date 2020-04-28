@extends('layouts.main')

@section('prescript')
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('postscript')
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script>
    $(() => {
        Swal.fire({
            title: "Create new reservation?",
            text: "New application will be created as draft, you can delete it later.",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#47bd9a",
            cancelButtonColor: "#e74c5e",
            confirmButtonText: "Yes, apply!"
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type:"POST",
                    url: "{{ url('admin/application/pencil-booking') }}",
                    data: {
                        "_token" : "{{ csrf_token() }}"
                    }
                }).done(function(response){
                    if(response.status == 'success'){
                        window.location.replace("{{ url('admin/application') }}/"+response.data);
                    }
                });
            } else {
                window.location.replace("{{ url('admin/application') }}");
            }
        });
    })
</script>
@endsection