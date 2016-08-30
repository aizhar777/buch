<form id="logout-form" action="{{ url('/auth/signout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>