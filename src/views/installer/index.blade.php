@extends('admin::layouts.simple')

@section('content')
<div>
    <div class="form-box" id="installer-box">
        <div class="header">@lang('admin::installer.index.title')</div>

        <div class="body bg-gray">
            <h2>Install</h2>
            <p>
                We are going to configure & install your new project
            </p>
            <hr />
            <h4>Status: </h4>

            @include('admin::installer.partials.review')



        </div>

        <div class="footer">
            <a href="{{ route('admin.installer.db') }}" data-on-sending="@lang('admin::installer.index.submit_progress')" class="btn bg-olive btn-block">@lang('admin::installer.index.submit')</a>
        </div>
    </div>
</div>
@stop