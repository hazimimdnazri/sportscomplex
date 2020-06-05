<div class="modal" id="timeoutModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="equiptmentForm" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Session Timeout Warning</h4>
                </div>
                <div class="modal-body text-center">
                    <p>You have been idle for 15 minutes, this session will be terminated in:</p>
                    <p><h2 id="time">00:30</h2></p>
                    <p>Press Continue to carry on with your session or else you will be logged out.</p>
                </div>
                <div class="modal-footer">
                    <input type="button" onClick="resetTimer()" class="btn btn-primary" value="Continue"/>
                </div>
            </form>
        </div>
    </div>
</div>