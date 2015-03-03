@extends('admin::layouts.simple')

@section('content')
<div>
    <div class="form-box" id="installer-box">
        <div class="header">@lang('admin::installer.review.title')</div>

        <div class="body bg-gray">
            <h2>Review</h2>
            <p>
                Checkout the status of your project installation to check everything it's ok.
            </p>
            <hr />
            <h4>Status: </h4>

            @include('admin::installer.partials.review')



        </div>

        <div class="footer">
            <a href="{{ route('admin.installer.review.confirm') }}" data-on-sending="@lang('admin::installer.review.submit_progress')" class="btn bg-olive btn-block">@lang('admin::installer.review.submit')</a>
        </div>
    </div>
</div>
@stop