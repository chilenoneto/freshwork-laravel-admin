@extends('admin::layouts.simple')

@section('content')
<div>
    <div class="form-box" id="installer-box">
        <div class="header"><i class="fa fa-database"> </i> @lang('admin::installer.user.title')</div>
        {!! Form::open(['id'=> 'db_form','route' => 'admin.installer.user.save','method' => 'post']) !!}


            <div class="body bg-gray">
                @include('admin::partials.errors.list',['class' => 'in-installer'])
                @include('admin::partials.message-box',['here' => true,'class' => 'in-installer'])


                @lang("admin::installer.user.intro")

                <div class="form-group">
                    {!! Form::label('name','Name: ') !!}
                    {!! Form::text('name',null,['class' => 'form-control','placeholder' => 'Enter your name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label($login_field,$login_field_name.':') !!}
                    {!! Form::text($login_field,null,['class' => 'form-control','placeholder' => 'Enter your '.$login_field_name]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label($password_field,$password_field_name.':') !!}
                    {!! Form::password($password_field,['class' => 'form-control','placeholder' => 'Enter your '.$password_field_name]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label($password_field.'_confirmation',$password_field_name.':') !!}
                    {!! Form::password($password_field.'_confirmation',['class' => 'form-control','placeholder' => 'Enter your '.$password_field_name]) !!}
                </div>
            </div>
            <div class="footer">
                <button type="submit" data-on-sending="@lang('admin::installer.user.submit_progress')" class="btn bg-olive btn-block">@lang('admin::installer.user.submit')</button>


            </div>
        {!! Form::close() !!}

    </div>
</div>
@stop
@section('js')
<script>
    /*$('#db_form').submit(function(e){
        var $btn = $(this).find("[type=submit]");

        $btn.data('original-text',$btn.text()).text($btn.data("on-sending")).attr("disabled",true);

        $.post(this.action,$(this).serialize(),function(resp)
        {

        })
        .fail(function(resp)
        {
            var json = resp.responseJSON;
            show_errors(json);
            $btn.text($btn.data("original-text")).attr("disabled",false);
        });
        e.preventDefault();
    });

    function show_errors(json){

        $.each(json,function(field,errors)
        {
            $.each(errors,  function(i , error)
            {

            });
        });
    }*/

    /*var formApp = angular.module("formApp",[],function($interpolateProvider){
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    });

    formApp.controller("formController",["$scope",function($scope){
        $scope.formData = {

        };
    }]);*/


</script>
@stop