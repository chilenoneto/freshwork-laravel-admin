@extends('admin::layouts.simple')

@section('content')
<div >
    <div class="form-box" id="installer-box">
        <div class="header"><i class="fa fa-database"> </i> @lang('admin::installer.db.title')</div>
        {!! Form::open(['id'=> 'db_form','route' => 'admin.installer.db.save','method' => 'post','ng-submit' => 'processForm()']) !!}


            <div class="body bg-gray">
                @include('admin::partials.errors.list',['class' => 'in-installer'])
                @include('admin::partials.message-box',['here' => true,'class' => 'in-installer'])


                @lang("admin::installer.db.config_location",['location' => '<code>config/database.php</code>'])

                <div class="form-group">
                    <label>Default Driver: </label>
                    {{ $default_driver }}
                </div>
                <div class="form-group">
                    {!! Form::text('db_host',env('DB_HOST'),['class' => 'form-control','placeholder' => 'Database Hostname','ng-model' => 'formData.db_host']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('db_database',env('DB_DATABASE'),['class' => 'form-control','placeholder' => 'Database Name','ng-model' => 'formData.db_database']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('db_username',env('DB_USERNAME'),['class' => 'form-control','placeholder' => 'Database User','ng-model' => 'formData.db_username']) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('db_password',['class' => 'form-control','placeholder' => 'Database Password']) !!}
                </div>
            </div>
            <div class="footer">
                <button type="submit" data-on-sending="@lang('admin::installer.db.submit_progress')" class="btn bg-olive btn-block">@lang('admin::installer.db.submit')</button>


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