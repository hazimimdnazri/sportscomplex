<div id="calendar"></div>
<script>
$(() => {
    var date = new Date()
    $('#calendar').fullCalendar({
        defaultDate: "{{$date}}",
        header    : {
            left  : '',
            center: 'title',
            right : ''
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
        defaultView : 'agendaDay',
		schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
        allDaySlot : false,
        slotDuration : '00:30',
        minTime: '07:00',
        contentHeight: 350
    })
})
</script>