@extends('layouts.main')

@section('prescript')
<link rel="stylesheet" href="{{ asset('assets/bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bower_components/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
@endsection

@section('content')
<section class="content">
	<div class="row">

		<div class="col-md-12">
			<div class="box box-info box-solid">
				<div class="box-header text-center">
					<h3 class="box-title text-black ">EduCity Sports Complex Dashboard</h3>
				</div>
				<div class="box-body">
					<b>News & Announcements:</b>
					<p><marquee>No current news or announcements.</marquee></p>

				</div>
				<div class="box-footer bg-navy">
					<table width="100%">
						<tr>
							<td width="25%" class="border-right text-center"><strong>Current Date</strong></td>
							<td width="25%" class="border-right text-center"><strong>Current Time</strong></td>
							<td width="25%" class="border-right text-center"><strong>Current Weather</strong></td>
							<td width="25%" class="text-center"><strong>Empty Slot</strong></td>
						</tr>
						<tr>
							<td class="border-right text-center">
								<span class="h3">{{ date('d M Y') }}</span>
							</td>
							<td class="border-right text-center">
								<span class="h3" id="clock"></span>
							</td>
							<td class="border-right text-center">
								<img id="weather_img" src="" alt="">
								<p id="main_weather">Loading...</p>

							</td>
							<td class="text-center">
								<span class="h3">Coming Soon</span>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="box box-danger box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Admin on Duty</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box-body text-center">
					<span class="h4 text-center">{{ Auth::user()->name }}</span>
				</div>
			</div>

			<div class="box box-danger box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Collections</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div>
						<h4><strong>Live Daily Collections</strong></h4>
						<p>RM {{ number_format($collections->where('date', date('Y-m-d'))->sum('total'), 2) }}</p>
					</div>
					<hr>
					<div>
						<h4><strong>Live Weekly Collections</strong></h4>
						<p>RM {{ number_format($collections->where('week', date('W'))->sum('total'), 2) }}</p>
					</div>
					<hr>
					<div>
						<h4><strong>Live Monthly Collections</strong></h4>
						<p>RM {{ number_format($collections->where('month', date('m'))->sum('total'), 2) }}</p>
					</div>
				</div>
			</div>

			<div class="box box-danger box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Live Activities</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box-body">
					@if($facilities->isEmpty() && $activities->isEmpty())
						<h4 class="text-center">No activities</h4>
					@endif

					@foreach($facilities as $f)
						<h4><strong>{{ $f->r_venue->venue }}</strong></h4>
						<table class="table table-bordered">
						<tr>
							<th width="50%" class="text-center bg-gray">Sport</th>
							<th width="50%" class="text-center bg-gray">Facility</th>
						</tr>
						@foreach(App\LiveFacility::where('venue', $f->venue)->get() as $s)
						<tr>
							<td class="text-center">{{ $s->r_sport->sport }}</td>
							<td class="text-center">
								@foreach(json_decode($s->facility) as $c)
									{{ App\LFacility::find($c)->facility }}
								@endforeach
							</td>
						</tr>
						@endforeach
						</table>
					@endforeach

					@foreach($activities as $a)
						<h4><strong>{{ $a->r_venue->venue }}</strong></h4>
						<table class="table table-bordered">
						<tr>
							<th width="50%" class="text-center bg-gray">Activity</th>
							<th width="50%" class="text-center bg-gray">People</th>
						</tr>
						@foreach(App\LiveActivity::where('venue', $a->venue)->groupBy('activity_id')->get() as $s)
						<tr>
							<td class="text-center">{{ $s->r_activity->activity }}</td>
							<td class="text-center">{{ $s->count() }} people</td>
						</tr>
						@endforeach
						</table>
					@endforeach
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="box box-primary box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Usage Report</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<div class="btn-group">
							<button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<p class="text-center">
								<strong>Facility Usage</strong>
							</p>
							<canvas id="canvas"></canvas>
						</div>
					</div>
				</div>

				<!-- <div class="box-footer">
					<div class="row">
						<div class="col-sm-3 col-xs-6">
							<div class="description-block border-right">
								<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
								<h5 class="description-header">$35,210.43</h5>
								<span class="description-text">TOTAL REVENUE</span>
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">
							<div class="description-block border-right">
								<span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
								<h5 class="description-header">$10,390.90</h5>
								<span class="description-text">TOTAL COST</span>
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">
							<div class="description-block border-right">
								<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
								<h5 class="description-header">$24,813.53</h5>
								<span class="description-text">TOTAL PROFIT</span>
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">
							<div class="description-block">
								<span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
								<h5 class="description-header">1200</h5>
								<span class="description-text">GOAL COMPLETIONS</span>
							</div>
						</div>
					</div>
				</div> -->
			</div>

			<div class="box box-primary box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Venues Report</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<div class="btn-group">
							<button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box-body">
					<table class="table table-bordered">
						<tr class="bg-gray">
							<th class="text-center" style="vertical-align:middle; border-color:black; " rowspan="2" >Venue</th>
							<th class="text-center" style="border-color:black;" colspan="2" >Collections</th>
							<th class="text-center" style="border-color:black;" colspan="2" >Frequency</th>
						</tr>
						<tr class="bg-gray">
							<th class="text-center" style="border-color:black;" >This Month</th>
							<th class="text-center" style="border-color:black;" >Today</th>
							<th class="text-center" style="border-color:black;" >This Month</th>
							<th class="text-center" style="border-color:black;" >Today</th>
						</tr>
						@foreach($venues as $v)
						<tr>
							<td style="border-color:black;">{{$v->venue}}</td>
							<td class="text-center" style="border-color:black;">RM 0</td>
							<td class="text-center" style="border-color:black;">RM 0</td>
							<td class="text-center" style="border-color:black;">0</td>
							<td class="text-center" style="border-color:black;">0</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="box box-success box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Hire Collections</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div>
						<div>
							<h4><strong>Facilities Hire</strong></h4>
							<p>No Data Found</p>
						</div>
						<hr>
						<div>
							<h4><strong>Venue Hire</strong></h4>
							<p>No Data Found</p>
						</div>
					</div>
				</div>
			</div>
			
			<div class="box box-success box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">User Statistics</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div>
						<table class="table table-bordered">
							<tr>
								<td class="text-center"><strong>Male</strong></td>
								<td class="text-center">0</td>
							</tr>
							<tr>
								<td class="text-center"><strong>Female</strong></td>
								<td class="text-center">0</td>
							</tr>
							<tr>
								<td class="text-center"><strong>Group</strong></td>
								<td class="text-center">0</td>
							</tr>
							<tr>
								<td class="text-center bg-gray"><strong>Total</strong></td>
								<td class="text-center bg-gray">0</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="box box-success box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Membership Status</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box-body">
					<table class="table table-bordered">
						<tr>
							<td width="50%" class="text-center"><strong><span class="label bg-green">Active</span></strong></td>
							<td class="text-center">0</td>
						</tr>
						<tr>
							<td class="text-center"><strong><span class="label label-warning">Expiring Soon</span></strong></td>
							<td class="text-center">0</td>
						</tr>
					</table>
				</div>
			</div>

			<div class="box box-success box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Rating</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div class="text-center">
						<h4>Coming Sooon</h4>
					</div>
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
	})

	startTime = () => {
		var today = new Date();
		var h = today.getHours();
		var m = today.getMinutes();
		var s = today.getSeconds();
		m = checkTime(m);
		s = checkTime(s);
		document.getElementById('clock').innerHTML = h + ":" + m + ":" + s;
		var t = setTimeout(startTime, 500);
	}
	checkTime = (i) => {
		if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
		return i;
	}

	var color = Chart.helpers.color;
	var barChartData = {
		labels: ['Indoor Arena', 'Stadium', 'Aquatic Centre', 'Outdoor Arena'],
		datasets: [{
			label: 'Week 1',
			backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
			borderColor: window.chartColors.red,
			borderWidth: 1,
			data: [
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
			]
		}, {
			label: 'Week 2',
			backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
			borderColor: window.chartColors.blue,
			borderWidth: 1,
			data: [
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
			]
		}, {
			label: 'Week 3',
			backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
			borderColor: window.chartColors.blue,
			borderWidth: 1,
			data: [
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
			]
		}, {
			label: 'Week 4',
			backgroundColor: color(window.chartColors.black).alpha(0.5).rgbString(),
			borderColor: window.chartColors.blue,
			borderWidth: 1,
			data: [
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
			]
		}]

	};

	window.onload = function() {
		var ctx = document.getElementById('canvas').getContext('2d');
		window.myBar = new Chart(ctx, {
			type: 'bar',
			data: barChartData,
			options: {
				responsive: true,
				legend: {
					position: 'top',
				}
			}
		});

	};
</script>
@endsection