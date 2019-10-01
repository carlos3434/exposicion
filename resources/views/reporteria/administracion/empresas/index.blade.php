@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Empresa
                    @can('CREATE_EMPRESA')
                        <a href="{{ route('empresas.create') }}"
                        class="btn btn-sm btn-primary float-right">Crear</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width= "10px">ID</th>
                                <th>Nombre</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($empresas as $empresa)
                            <tr>
                                <td>{{ $empresa->id }}</td>
                                <td>{{ $empresa->name }}</td>
                                <td>
                                    @can('DETAIL_EMPRESA')
                                        <a href="{{ route('empresas.show', $empresa->id) }}" 
                                            class="btn btn-sm btn-default">
                                            Ver
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('UPDATE_EMPRESA')
                                        <a href="{{ route('empresas.edit', $empresa->id) }}" 
                                            class="btn btn-sm btn-default">
                                            Editar
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('DELETE_EMPRESA')
                                        {!! Form::open(['route' => ['empresas.destroy',$empresa->id],'method'=>'DELETE']) !!}
                                            <button class="btn btn-sm btn-danger">
                                                Eliminar
                                            </button>
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $empresas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection