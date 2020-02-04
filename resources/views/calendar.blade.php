@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">
<link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <h1>
        Calendar
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Calendar</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body no-padding">
                    <div id="calendar"></div>
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
$(() => {

    var date = new Date()
    $('#calendar').fullCalendar({
		dayClick: function(date, allDay, jsEvent, view) {
			if(jsEvent.name == 'month'){
				$('#calendar').fullCalendar('gotoDate',date);
				$('#calendar').fullCalendar('changeView', 'agendaDay')
			} else {
				showModal(date._d.getTime())
			}
		},
		header    : {
			left  : 'prev,next today',
			center: 'title',
			right : 'month,agendaDay'
		},
		buttonText: {
			today: 'today',
			month: 'month',
			day  : 'day'
		},
		//Random default events
		events    : [
			@foreach($reservations as $r)
				@if($r->r_application->status == 3)
				{
					title          : '{{ $r->application_id }}',
					start          : "{{ $r->start_date }}",
					end            : "{{ $r->end_date }}",
					backgroundColor: '#f39c12', //yellow
					borderColor    : '#f39c12' //yellow
				},
				@endif
			@endforeach
		],
		editable  : false,
		droppable : false,
		allDaySlot : false,
		slotDuration : '00:30',
		minTime: '07:00',
		aspectRatio: 2.3,
		timeZone: 'local'
    })
})

showModal = (tarikh) => {
	$.ajax({
		type:"POST",
		url: "{{ url('ajax/calendar-modal') }}",
		data: {
			"_token" : "{{ csrf_token() }}",
			"date" : tarikh
		}
	}).done(function(response){
		$("#variable").html(response)
		$('#activityModal').modal('show')
	});
}

userType = (value) => {
	if(value == 3){
		$("#students").slideDown()
		$("#staffs").slideUp()
	} else if(value == 2){
		$("#students").slideUp()
		$("#staffs").slideDown()
	} else {
		$("#students").slideUp()
		$("#staffs").slideUp()
	}
}
</script>
@endsection