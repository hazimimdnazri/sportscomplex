@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">
<link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <h1>
        POS
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">POS</li>
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
									<option value="" selected>-- Facility --</option>
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
<script src="{{ asset('assets/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
showModal = (date, facility) => {
	$.ajax({
		type:"POST",
		url: "{{ url('ajax/calendar-modal') }}",
		data: {
			"_token" : "{{ csrf_token() }}",
			"date" : date,
			"facility" : facility
		}
	}).done(function(response){
		$("#variable").html(response)
		$('#activityModal').modal('show')
	});
}

userType = (value) => {
	if(value == 3){
		$("#students").show()
		$("#staffs").hide()
	} else if(value == 2){
		$("#students").hide()
		$("#staffs").show()
	} else {
		$("#students").hide()
		$("#staffs").hide()
	}
}

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

changeDuration = (value) => {
	$.ajax({
		type:"POST",
		url: "{{ url('ajax/duration') }}",
		data: {
			"_token" : "{{ csrf_token() }}",
			"facility" : value
		}
	}).done(function(response){
		$("#duration").html(response)
	});
}

changeTime = (value) => {
	$.ajax({
		type:"POST",
		url: "{{ url('ajax/endtime') }}",
		data: {
			"_token" : "{{ csrf_token() }}",
			"start_date" : $("#start_date").val(),
			"duration" : value
		}
	}).done(function(response){
		$("#end_time").val(response.time)
		$("#end_date").val(response.unixtime)
	});
}
</script>
@endsection