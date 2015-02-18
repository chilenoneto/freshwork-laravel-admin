@if(Session::has('message'))
    <div class="alert alert-{{ Session::get('message')['status'] }} alert-dismissable">
        
        @if(Session::get('message')['status'] == 'success')
            <i class="fa fa-check"></i>
        @endif
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

        {{ Session::get('message')['message'] }}
    </div>
@endif