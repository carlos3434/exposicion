@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Empresa</div>
                <div class="card-body">
                    {!! Form::model($empresa, ['enctype'=>'multipart/form-data','route'=> ['empresas.update',$empresa->id],'method'=> 'PUT']) !!}
                        @include('reporteria.administracion.empresas.partials.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection