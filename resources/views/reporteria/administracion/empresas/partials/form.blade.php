@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-group">
    {{ Form::label('nombre_comercial','nombre_comercial') }}
    {{ Form::text( 'nombre_comercial' , null , ['class'=> 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('razon_social','razon_social') }}
    {{ Form::text( 'razon_social' , null , ['class'=> 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('ruc','ruc') }}
    {{ Form::text( 'ruc' , null , ['class'=> 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('direccion_web','direccion_web') }}
    {{ Form::text( 'direccion_web' , null , ['class'=> 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('telefono','telefono') }}
    {{ Form::text( 'telefono' , null , ['class'=> 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('email','email') }}
    {{ Form::text( 'email' , null , ['class'=> 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('direccion','direccion') }}
    {{ Form::text( 'direccion' , null , ['class'=> 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('logo','logo') }}
    {{ Form::file('logo', ['class' => 'image','onchange'=>'loadFile(event)']) }}

    {{ Form::image($empresa->logo,'success', [ 'id' => 'output' ]) }}

</div>
<div class="form-group">
    {{ Form::label('ubigeo_id','ubigeo_id') }}
    {{ Form::text( 'ubigeo_id' , null , ['class'=> 'form-control']) }}
</div>

<hr>
<h3>Sunat</h3>
<div class="form-group">
    {{ Form::label('user_sunat','usuario') }}
    {{ Form::text( 'user_sunat' , null , ['class'=> 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('password_sunat','password') }}
    {{ Form::text('password_sunat',null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('user_sunat','certificado') }}
    {{ Form::file('certificado_digital', array('class' => 'image')) }}
</div>

<div class="form-group">
    <label>{{ Form::radio('entorno','0') }} Pruebas</label>
    <label>{{ Form::radio('entorno','1') }} Produccion</label>
</div>
<hr>

<div class="form-group">
    {{ Form::submit('Guardar',['class'=> 'btn btn-sm btn-primary']) }}
</div>

<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>