@extends('panel::layouts.default')

@section('page-title','Tips')
@section('page-subtitle','Lista de todos los datos registrados')

@section('content')



<div class="box">
    <div class="box-header">
        <h3 class="box-title">Datos</h3>
    </div><!-- /.box-header -->
    <div class="box-body table-responsive">
        <table id="tips" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Lugar</th>
                    <th>Imagen</th>
                    <th>Fecha</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tips as $tip)
                    <tr class="error">
                        <td>{{ $tip->name }}</td>
                        <td>{{ $tip->place_name }}</td>
                        <td><img width="100" src='{{ $tip->image() }}' alt="" /></td>
                        <td>{{ $tip->created_at->format('Y-m-d') }}</td>
                        <td>
                            {!! Form::open(['route' => ['panel.tips.destroy',$tip->id], 'method' => 'DELETE' ]) !!}

                            <div class="btn-group">

                                    @if($tip->active)
                                        <a class="btn btn-default" title="Desctivar" href="{{ route('panel.tips.deactivate',$tip->id) }}">
                                            <i class="fa fa-circle"></i>
                                        </a>
                                    @else
                                        <a class="btn btn-default"  title="Activar" href="{{ route('panel.tips.activate',$tip->id) }}">
                                            <i class="fa fa-circle-thin"></i>
                                        </a>
                                    @endif

                                    <a class="btn btn-default" href="{{ route('tip.edit',$tip->id) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                            </div>
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <th>Nombre</th>
                    <th>Lugar</th>
                    <th>Imagen</th>
                    <th>Fecha</th>
                    <th>Opciones</th>
                </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
@stop

@section('js')
<script type="text/javascript">
    var table;
    $(function() {
        table = $('#tips').DataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });

        $("#search-table").on('keyup',function(){
            table.search(this.value).draw();
            console.log(this.value);
        });
    });
</script>
@stop

