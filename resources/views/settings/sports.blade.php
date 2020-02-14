@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <h1>
        Sports
        <small>Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Settings</li>
        <li class="active">Facilities</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <button type="button" class="btn btn-primary" id="grade" onClick="showModal()">New Sport</button>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No. </th>
                                <th class="text-center">Sport</th>
                                <th class="text-center">Venue</th>
                                <th class="text-center">Facility Used</th>
                                <th class="text-center">Price (RM)</th>
                                <th class="text-center">Min. Hour</th>
                                <th class="text-center">Colour</th>
                                <th class="text-center">Remarks</th>
                                <th width="15%" class="text-center" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $n = 1 @endphp
                        @foreach($sports as $s)
                        @php $facilities = json_decode($s->facility) @endphp
                            <tr>
                                <td class="text-center">{{ $n++ }}</td>
                                <td class="text-center">{{ $s->sport }}</td>
                                <td class="text-center">{{ $s->r_venue->venue }}</td>
                                <td class="text-center">
                                    <ul>
                                    @for($i = 0; $i < count($facilities); $i++)
                                        <li>{{ $s->getFacilityName($facilities[$i]) }}</li>
                                    @endfor
                                    </ul>
                                </td>
                                <td class="text-center">{{ number_format($s->price, 2) }}</td>
                                <td class="text-center">{{ $s->min_hour }}</td>
                                <td class="text-center">
                                    <p style="background-color:{{ $s->colour }};">&nbsp;</p>
                                </td>
                                <td class="text-center">{{ $s->remark }}</td>
                                <td class="text-center">
                                    <a onClick="editModal({{ $s->id }})" class="btn btn-info">Edit</a>
                                    <a onClick="deleteFx({{ $s->id }})" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="variable"></div>
@endsection

@section('postscript')
<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(() => {
        $('#example1').DataTable()
        $('.select2').select2()
    })

    showModal = () => {
        $.ajax({
            type:"POST",
            url: "{{ url('settings/ajax/sports-modal') }}",
            data: {
                "_token" : "{{ csrf_token() }}",
            }
        }).done(function(response){
            $("#variable").html(response)
            $('#sportsModal').modal('show')
            $('.color-picker').colorpicker()
        });
    }

    editModal = (id) => {
        $.ajax({
            type:"POST",
            url: "{{ url('settings/ajax/sports-modal') }}",
            data: {
                "_token" : "{{ csrf_token() }}",
                "id" : id
            }
        }).done(function(response){
            $("#variable").html(response)
            $('#sportsModal').modal('show')
            $('.color-picker').colorpicker()
        });
    }

    selectVenue = (value) => {
        $.ajax({
            type:"POST",
            url: "{{ url('settings/ajax/select-facilities') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "venue_id" : value
            }
        }).done(function(response){
            $("#variable_2").html(response)
        });
    }

    deleteFx = (id) => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#47bd9a",
            cancelButtonColor: "#e74c5e",
            confirmButtonText: "Yes, delete it!"
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type:"POST",
                    url: "{{ url('settings/ajax/facilities-modal') }}",
                    data: {
                        "_token" : "{{ csrf_token() }}",
                        "id" : id,
                        "action" : "delete"
                    }
                }).done(function(response){
                    if(response == 'success'){
                        Swal.fire("Deleted!", "Your file has been deleted.", "success")
                        .then((result) => {
                            if(result.value){
                                location.reload();
                            }
                        })
                    }
                });
            }
        });
    }
</script>
@endsection