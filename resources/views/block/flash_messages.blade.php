@if (Session::has('caffeinated.flash.message'))
<div class="callout callout-{{ Session::get('caffeinated.flash.level') }}">
    <h4>{{ Session::get('caffeinated.flash.level') }}!</h4>
    <p>
        @if(Session::get('caffeinated.flash.level') == 'warning')
            <i class="fa fa-exclamation-circle"></i>
        @elseif(Session::get('caffeinated.flash.level') == 'error')
            <i class="fa fa-exclamation-triangle"></i>
        @elseif(Session::get('caffeinated.flash.level') == 'info')
            <i class="fa fa-info"></i>
        @elseif(Session::get('caffeinated.flash.level') == 'success')
            <i class="fa fa-thumbs-up"></i>
        @endif {{ Session::get('caffeinated.flash.message') }}
    </p>
</div>
@endif