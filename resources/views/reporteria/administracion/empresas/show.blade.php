@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Empresa</div>
                <div class="card-body">
                    <p><strong>Nombre: </strong>{{ $empresa->nombre_comercial }}</p>
                    <p><strong>Razon social: </strong>{{ $empresa->razon_social }}</p>
                    <p><strong>direccion web: </strong>{{ $empresa->direccion_web }}</p>
                    <p><strong>telefono: </strong>{{ $empresa->telefono }}</p>
                    <p><strong>email: </strong>{{ $empresa->email }}</p>
                    <p><strong>Direccion: </strong>{{ $empresa->direccion }}</p>
                    <p><strong>Logo: </strong>{{ $empresa->logo }}</p>
                    <p><strong>Ubigeo: </strong>{{ $empresa->ubigeo_id }}</p>
                    <p><strong>User Sunat: </strong>{{ $empresa->user_sunat }}</p>
                    <p><strong>Passowrd Sunat: </strong>{{ $empresa->password_sunat }}</p>
                    <p><strong>Entorno: </strong>{{ $empresa->entorno }}</p>
                    <p><strong>Actualizado: </strong>{{ $empresa->updated_at }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection