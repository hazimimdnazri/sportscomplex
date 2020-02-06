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
                    title          : '{{ $r->r_application->event }} - {{ $r->r_asset->facility }}',
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
</script>