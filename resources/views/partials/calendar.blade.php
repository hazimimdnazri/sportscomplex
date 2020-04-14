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
                console.log(view.id)

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
        
        events    : [
            @foreach($reservations as $r)
                @if($r->r_application->status == 5)
                    @for($i = 0; $i < count(json_decode($r->r_sport->facility)); $i++)
                    {
                        resourceId	  	: "{{ json_decode($r->r_sport->facility)[$i] }}",
                        title          	: '{{ $r->r_application->event }} - {{ $r->r_sport->sport }}',
                        start          	: "{{ $r->start_date }}",
                        end            	: "{{ $r->end_date }}",
                        color           : "{{ $r->r_sport->colour }}"
                    },
                    @endfor
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
</script>