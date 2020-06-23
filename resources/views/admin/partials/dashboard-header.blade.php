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

<script>
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
		if (i < 10) {i = "0" + i};
		return i;
	}
</script>