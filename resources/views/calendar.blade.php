@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <h1>
        Availability Calendar
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Availability Calendar</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body no-padding">
					<div class="col-md-12" style="margin-top: 20px; margin-bottom: 20px;">
						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Facility <span class="text-red">*</span></label>
								<select class="form-control" name="facility" onChange="loadCalendar(this.value)">
									<option value="" selected>All</option>
									@foreach($facilities as $f)
									<option value="{{ $f->id }}">{{ $f->group }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
                    	<div id="calender"></div>
					</div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="variable"></div>
@endsection

@section('postscript')
<script src="{{ asset('assets/bower_components/moment/moment.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.1/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar-scheduler/1.9.1/scheduler.min.js"></script>
<script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
loadCalendar = (value) => {
	$.ajax({
		type:"POST",
		url: "{{ url('ajax/calendar') }}",
		data: {
			"_token" : "{{ csrf_token() }}",
			"facility" : value
		}
	}).done(function(response){
		$("#calender").html(response)
	});
}
</script>
@endsection