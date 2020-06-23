@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
@endsection

@section('content')
<section class="content">
	<div class="row">
		@include('admin.partials.dashboard-header')
		<div class="col-md-12">
			<div class="box box-success box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Venue Financial Report</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box-body">
					<canvas id="canvas1"></canvas>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@section('postscript')
<script src="{{ asset('assets/bower_components/moment/moment.js') }}"></script>
<script src="{{ asset('assets/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="https://www.chartjs.org/samples/latest/utils.js"></script>

<script>
	$(() => {
		$('body').addClass("sidebar-collapse");
		startTime()

		$.ajax({
            type:"GET",
            url: "https://api.openweathermap.org/data/2.5/weather?q=Iskandar+Puteri&appid=3ac830c71bee7a1e9a48bbf9d303be41"
        }).done((response) => {
			$("#main_weather").text(response.weather[0].main)
			$("#weather_img").attr("src","https://openweathermap.org/img/wn/"+response.weather[0].icon+".png");
        });

		var ctx = document.getElementById('canvas1').getContext('2d');

		window.myBar = new Chart(ctx, {
			type: 'bar',
			data: barChartData,
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Monthly Revenue (2020)'
				},
				legend: {
					position: 'top',
				}
			}
		});
	})

	var months = [
		'January',
		'February',
		'March',
		'April',
		'May',
		'June',
		'July',
		'August',
		'September',
		'October',
		'November',
		'December'
	];

	var colors = [
		'rgb(255, 99, 132)',
		'rgb(255, 159, 64)',
		'rgb(255, 205, 86)',
		'rgb(75, 192, 192)',
		'rgb(54, 162, 235)',
		'rgb(153, 102, 255)',
		'rgb(201, 203, 207)'
	];

	var barData = [];
	var color = Chart.helpers.color;
	var i = 0;
	var dataArr = []
	
	@foreach($venues as $v)
	i += 1
	dataArr.push({
		label: '{{ $v->venue }}',
		backgroundColor: color(colors[i]).alpha(0.5).rgbString(),
		borderColor: colors[i],
		borderWidth: 1,
		data: [
			{{ isset($financials->where('venue', $v->id)->first()->january) ? $financials->where('venue', $v->id)->first()->january : 0 }},
			{{ isset($financials->where('venue', $v->id)->first()->february) ? $financials->where('venue', $v->id)->first()->february : 0 }},
			{{ isset($financials->where('venue', $v->id)->first()->march) ? $financials->where('venue', $v->id)->first()->march : 0 }},
			{{ isset($financials->where('venue', $v->id)->first()->april) ? $financials->where('venue', $v->id)->first()->april : 0 }},
			{{ isset($financials->where('venue', $v->id)->first()->may) ? $financials->where('venue', $v->id)->first()->may : 0 }},
			{{ isset($financials->where('venue', $v->id)->first()->june) ? $financials->where('venue', $v->id)->first()->june : 0 }},
			{{ isset($financials->where('venue', $v->id)->first()->july) ? $financials->where('venue', $v->id)->first()->july : 0 }},
			{{ isset($financials->where('venue', $v->id)->first()->august) ? $financials->where('venue', $v->id)->first()->august : 0 }},
			{{ isset($financials->where('venue', $v->id)->first()->september) ? $financials->where('venue', $v->id)->first()->september : 0 }},
			{{ isset($financials->where('venue', $v->id)->first()->october) ? $financials->where('venue', $v->id)->first()->october : 0 }},
			{{ isset($financials->where('venue', $v->id)->first()->november) ? $financials->where('venue', $v->id)->first()->november : 0 }},
			{{ isset($financials->where('venue', $v->id)->first()->december) ? $financials->where('venue', $v->id)->first()->december : 0 }}
		]
	})
	@endforeach

	var barChartData = {
		labels : months,
		datasets: dataArr

	};
</script>
@endsection