<div id="calendar"></div>
<script>
$(() => {
    var date = new Date()
    $('#calendar').fullCalendar({
        dayClick: function(date, allDay, jsEvent, view) {
            if(jsEvent.name == 'month'){
                $('#calendar').fullCalendar('gotoDate',date);
                $('#calendar').fullCalendar('changeView', 'agendaDay')
            } else {

            }
        },
        header    : {
            left  : 'prev,next today',
            center: 'title',
            right : 'month,agendaDay'
        },
		schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
        buttonText: {
            today: 'today',
            month: 'month',
            day  : 'day'
        },
		resources: [
			@foreach($facilities as $f)
			{ id: "{{ $f->id }}", title: "{{ $f->facility }}" },
			@endforeach
		],
        //Random default events
        events    : [
            @foreach($reservations as $r)
                @if($r->r_application->status == 3)
                {
					resourceId	  	: "{{ $r->facility_id }}",
                    title          	: '{{ $r->r_application->event }} - {{ $r->r_asset->facility }}',
                    start          	: "{{ $r->start_date }}",
                    end            	: "{{ $r->end_date }}",
                    backgroundColor	: '{{ $r->r_asset->colour }}',
                    borderColor    	: '{{ $r->r_asset->colour }}' 
                },
                @endif
            @endforeach
        ],
		// events : [
		// 	{
		// 		"resourceId": "a",
		// 		"title": "All Day Event",
		// 		"start": "2020-02-01"
		// 	},
		// 	{
		// 		"resourceId": "b",
		// 		"title": "Long Event",
		// 		"start": "2020-02-16T16:00:00+00:00"
		// 	},
		// ],
        editable  : false,
        droppable : false,
        allDaySlot : false,
        slotDuration : '00:30',
        minTime: '07:00',
        aspectRatio: 2.3,
        timeZone: 'local'
    })
})
</script>