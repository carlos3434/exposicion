@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Permisos</div>
                <div class="card-body">
                    {!! Form::open( ['route'=> 'permissions.store' ] ) !!}
                        @include('reporteria.administracion.permissions.partials.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection