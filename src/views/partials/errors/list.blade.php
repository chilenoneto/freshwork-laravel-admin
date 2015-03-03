@if($errors->has())
    <div class="alert alert-danger alert-dismissable {{ $class or ''}}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="fa fa-ban"></i>

        <span>@choice('admin::messages.errors.list_title',$errors->count())</span>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif