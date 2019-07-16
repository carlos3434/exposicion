@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Permisos
                    @can('permmissions.create')
                        <a href="{{ route('permissions.create') }}"
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
                            @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    @can('permissions.show')
                                        <a href="{{ route('permissions.show', $permission->id) }}" 
                                            class="btn btn-sm btn-default">
                                            Ver
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('permissions.edit')
                                        <a href="{{ route('permissions.edit', $permission->id) }}" 
                                            class="btn btn-sm btn-default">
                                            Editar
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('permissions.destroy')
                                        {!! Form::open(['route' => ['permissions.destroy',$permission->id],'method'=>'DELETE']) !!}
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
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection