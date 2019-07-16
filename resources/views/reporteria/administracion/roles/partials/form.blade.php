<div class="form-group">
    {{ Form::label('name','nombre del role') }}
    {{ Form::text( 'name' , null , ['class'=> 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('description','description del role') }}
    {{ Form::text( 'description' , null , ['class'=> 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('slug','URL amigable') }}
    {{ Form::text( 'slug' , null , ['class'=> 'form-control']) }}
</div>

<hr>
<h3>Permiso Especial</h3>
<div class="form-group">
    <label>{{ Form::radio('special','all-access') }} Acceso total</label>
    <label>{{ Form::radio('special','no-access') }} Ningun acceso</label>
</div>
<hr>

<h3>Lista de Permisos</h3>
<dic class="form-group">
    <ul class="list-unstyled">
        @foreach($permissions as $permission)
        <li>
            <label>
                {{ Form::checkbox('permissions[]', $permission->id, null) }}
                {{ $permission->name }}
                <em>({{ $permission->description?:'' }})</em>
            </label>
        </li>
        @endforeach
    </ul>
</dic>

<div class="form-group">
    {{ Form::submit('Guardar',['class'=> 'btn btn-sm btn-primary']) }}
</div>