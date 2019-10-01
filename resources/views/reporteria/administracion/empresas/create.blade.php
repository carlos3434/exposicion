@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Empresas</div>
                <div class="card-body">
                    {!! Form::open( ['route'=> 'empresas.store' ] ) !!}
                        @include('reporteria.administracion.empresas.partials.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection