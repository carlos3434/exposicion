@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Permisos</div>
                <div class="card-body">
                    <p><strong>Nombre: </strong>{{ $permission->name }}</p>
                    <p><strong>Descripcion: </strong>{{ $permission->description }}</p>
                    <p><strong>Slug: </strong>{{ $permission->slug }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection