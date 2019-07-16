<div class="form-group">
    {{ Form::label('name','nombre del permiso') }}
    {{ Form::text( 'name' , null , ['class'=> 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('description','description del permiso') }}
    {{ Form::text( 'description' , null , ['class'=> 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('slug','slug del permiso') }}
    {{ Form::text( 'slug' , null , ['class'=> 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::submit('Guardar',['class'=> 'btn btn-sm btn-primary']) }}
</div>