var initialTimeout;
var initialInterval;

function timeoutStart(){
    initialTimeout = setTimeout(function() {
        timeoutModal()
        timer()
    }, 900000);
}

function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    initialInterval = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            endSession()
        }
    }, 1000);
}

function timer() {
    var time = 30,
    display = document.querySelector('#time');
    startTimer(time, display);
}

function timeoutReset(){
    clearTimeout(initialTimeout)
    clearInterval(initialInterval)
    document.querySelector('#time').textContent = "00:30"
    timeoutStart()
}