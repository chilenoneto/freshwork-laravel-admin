@extends('admin::layouts.simple')

@section('content')
<div>
    <div class="form-box" id="installer-box">
        <div class="header">@lang('admin::installer.tables.title')</div>

        <div class="body bg-gray">
            <h2>Install Tables</h2>
            <p>
                We are going to install the base tables in your database.
            </p>
            <div class="aler alter-danger">This action will migrate your database.</div>


        </div>

        <div class="footer">
            {!! Form::open(['route' => 'admin.installer.tables.save']) !!}
                <input type="submit" value="@lang('admin::installer.tables.submit')" data-on-sending="@lang('admin::installer.tables.submit_progress')" class="btn bg-olive btn-block" />
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop