@extends('admin::layouts.simple')

@section('content')

    <div class="form-box" id="login-box">
        <div class="header">@lang('admin::pages.login.title')</div>
        {!! Form::open(['id'=> 'db_form','route' => 'admin.auth.login.process','method' => 'post','ng-submit' => 'processForm()']) !!}

            <div class="body bg-gray">
                @include('admin::partials.errors.list',['class' => 'in-installer'])

                <div class="form-group">
                    {!! Form::label('user_credential','Email') !!}
                    {!! Form::text('user_credential',null,['class' => 'form-control','placeholder' => 'Email','ng-model' => 'formData.db_host']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('user_password','Password') !!}
                    {!! Form::password('user_password',['class' => 'form-control','placeholder' => 'Password']) !!}
                </div>
            </div>
            <div class="footer">

                <button type="submit" data-on-sending="@lang('admin::messages.login.submit_progress')" class="btn bg-olive btn-block">@lang('admin::messages.login.submit')</button>

                <p><a href="#">I forgot my password</a></p>

                <a href="{{ route('admin.auth.register') }}" class="text-center">Register a new membership</a>

            </div>
        {!! Form::close() !!}

    </div>
@stop