<div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (Session::has('caffeinated.flash.message'))
                <div class="alert alert-{{ Session::get('caffeinated.flash.level') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    @if(Session::get('caffeinated.flash.level') == 'warning')
                        <i class="fa fa-exclamation-circle"></i>
                    @elseif(Session::get('caffeinated.flash.level') == 'error')
                        <i class="fa fa-exclamation-triangle"></i>
                    @elseif(Session::get('caffeinated.flash.level') == 'info')
                        <i class="fa fa-info"></i>
                    @elseif(Session::get('caffeinated.flash.level') == 'success')
                        <i class="fa fa-thumbs-up"></i>
                    @endif {{ Session::get('caffeinated.flash.message') }}
                </div>
            @endif

        </div>
    </div>
</div>