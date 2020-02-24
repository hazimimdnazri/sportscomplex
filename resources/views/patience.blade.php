Be patience, this module has not been activated yet.
<br>
<a href="#" onClick="logoutBtn()">Click here</a> to logout.

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

<script>
logoutBtn = () => {
    event.preventDefault
    document.getElementById("logout-form").submit()
}
</script>