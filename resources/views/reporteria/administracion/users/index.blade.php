@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Usuarios
                    @can('CREATE_USER')
                        <a href="{{ route('users.create') }}"
                        class="btn btn-sm btn-primary float-right">Crear</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width= "10px">ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @can('DETAIL_USER')
                                        <a href="{{ route('users.show', $user->id) }}" 
                                            class="btn btn-sm btn-default">
                                            Ver
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('UPDATE_USER')
                                        <a href="{{ route('users.edit', $user->id) }}" 
                                            class="btn btn-sm btn-default">
                                            Editar
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('DELETE_USER')
                                        {!! Form::open(['route' => ['users.destroy',$user->id],'method'=>'DELETE']) !!}
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
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection