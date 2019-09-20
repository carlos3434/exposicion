<div class="form-group">
    {{ Form::label('name','nombre del usuario') }}
    {{ Form::text( 'name' , null , ['class'=> 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('email','email del usuario') }}
    {{ Form::text( 'email' , null , ['class'=> 'form-control']) }}
</div>
<hr>
<h3>Lista de Roles</h3>
<dic class="form-group">
    <ul class="list-unstyled">
        @foreach($roles as $role)
        <li>
            <label>
                {{ Form::checkbox('roles[]', $role->id, null) }}
                {{ $role->name }}
                <em>({{ $role->description?:'' }})</em>
            </label>
        </li>
        @endforeach
    </ul>
</dic>
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