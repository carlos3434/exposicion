<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfil</title>
    <style>
        *, html { margin: 0; padding: 0; box-sizing: content-box; font-family: Arial, serif; font-size: 13px; line-height: 1.6rem; }
        img { max-width: 100%; height: auto; }
        h2 { font-size: 1.6rem; padding: 2rem 0; }
        h3 { font-size: 1.2rem; }
        label { color: #666; margin-top: 10px; display: block; }
        span.active { background: #34a864; color: #fff; margin-left: 10px; padding: 6px 12px; border-radius: 4px; }
        span.inactive { background: #e94343; color: #fff; margin-left: 10px; padding: 6px 12px; border-radius: 4px; }
        .wrapper { margin: 0 auto; padding: 0 20px; max-width: 920px; }
        table { width: 100%; }
        .grid > div { display: inline-block; vertical-align: top; padding: 0 1%; }
        .grid-2 > div { width: 47%; }
        .grid-3 > div { width: 30%; }
        .box { border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px; }
        .box .box__title { border-bottom: 1px solid #ddd; background: #eee; padding: 10px 20px; font-size: 14px; font-weight: 600; }
        .box .box__body { padding: 10px 20px; }
    </style>
</head>

<body>
    <div class="wrapper">
        <table style="margin-bottom: 10px;">
            <tr>
                <td colspan="4">
                    <h2>Perfil de usuario</h2>
                </td>
            </tr>
            <tr>
                <td width="18%">
                    <img class="current" src="{{URL::to('/photos/'.$persona->url_foto)}}" alt="">
                </td>
                <td width="80%" colspan="3" style="padding-left: 20px;">
                    <div>
                        <div>
                            <h3>{{$persona->fullName}}
                                @if ( $persona->is_habilitado )
                                    <span class="active">Habilitado</span>
                                @else
                                    <span class="inactive">No habilitado</span>
                                @endif
                            </h3>
                        </div>
                        <div class="grid grid-3">
                            <div>
                                <label>Fecha de Inscripción:</label>
                                <p><b>{{$persona->fecha_inscripcion}}</b></p>
                            </div>
                            <div>
                                <label>Fecha de colegiatura:</label>
                                <p><b>{{$persona->fecha_colegiatura}}</b></p>
                            </div>
                            <div>
                                <label>Fecha de aprobación del consejo:</label>
                                <p><b>{{$persona->fecha_aprobacion_consejo}}</b></p>
                            </div>
                        </div>
                        <div class="grid grid-3">
                            <div>
                                <label>Último mes pagado:</label>
                                <p><b>{{$persona->ultimo_mes_pago}}</b></p>
                            </div>
                            <div>
                                <label>Número de incidencias:</label>
                                <p><b>{{$persona->numero_incidencias}}</b></p>
                            </div>
                            <div>
                                <label>Número de procesos disciplinarios:</label>
                                <p><b>{{$persona->numero_procesos_disciplinarios}}</b></p>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td width="50%" style="padding-right: 10px; vertical-align: baseline;">
                    <!-- Start informacion personal -->
                    <div class="box">
                        <div class="box__title">Información personal</div>
                        <div class="box__body">
                            <div class="grid grid-2">
                                <div>
                                    <label>Tipo documento:</label>
                                    <div><b>{{$persona->tipoDocumentoIdentidad->alias}}</b></div>
                                </div>
                                <div>
                                    <label>Documento:</label>
                                    <div><b>{{$persona->numero_documento_identidad}}</b></div>
                                </div>
                                <div>
                                    <label>Fecha de nacimiento:</label>
                                    <div><b>{{$persona->fecha_nacimiento}}</b></div>
                                </div>
                                <div>
                                    <label>Apellidos:</label>
                                    <div><b>{{$persona->apellido_paterno . ' ' . $persona->apellido_materno }}</b></div>
                                </div>
                                <div>
                                    <label>Nombres:</label>
                                    <div><b>{{$persona->nombres}}</b></div>
                                </div>
                                <div>
                                    <label>Nacionalidad:</label>
                                    <div><b>{{$persona->nacionalidad->name}}</b></div>
                                </div>
                                <div nz-col class="gutter-row" nzSpan="8">
                                    <label>Estado civil:</label>
                                    <div><b>{{$persona->estadoCivil->name}}</b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End informacion personal -->
                </td>
                <td width="50%" style="padding-left: 10px; vertical-align: baseline;">
                    <!-- Start informacion de contacto -->
                    <div class="box">
                        <div class="box__title">Información de contacto</div>
                        <div class="box__body">
                            <div class="grid grid-2">
                                <div>
                                    <label>Dirección:</label>
                                    <div><b>{{$persona->direccion}}</b></div>
                                </div>
                                <div>
                                    <label>Ubigeo:</label>
                                    <div>
                                        <b>
                                        {{$persona->departamento->name . ', ' . $persona->distrito->name . ', ' . $persona->provincia->name }}
                                        </b>
                                    </div>
                                </div>
                                <div>
                                    <label>Email:</label>
                                    <div><b>{{$persona->email_uno}}</b></div>
                                </div>
                                <div>
                                    <label>Email secundario:</label>
                                    <div><b>{{$persona->email_dos}}</b></div>
                                </div>
                                <div>
                                    <label>Teléfono fijo:</label>
                                    <div><b>{{$persona->telefono_fijo}}</b></div>
                                </div>
                                <div>
                                    <label>Celular:</label>
                                    <div><b>{{$persona->celular_uno}}</b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End informacion de contacto -->
                </td>
            </tr>
            <tr>
                <td width="50%" style="padding-right: 10px; vertical-align: baseline;">
                    <!-- Start informacion academico -->
                    <div class="box">
                        <div class="box__title">Datos académicos y laborales</div>
                        <div class="box__body">
                            <div class="grid grid-2">
                                <div>
                                    <label>Departamento colegiado:</label>
                                    <div><b>{{$persona->departamentoColegiado->name}}</b></div>
                                </div>
                                <div>
                                    <label>Universidad de procedencia:</label>
                                    <div><b>
                                    @if ( $persona->universidadProcedencia )
                                        {{$persona->universidadProcedencia->name}}
                                    @endif
                                    </b></div>
                                </div>
                            </div>
                            <div class="grid grid-2">
                                <div>
                                    <label>Fecha bachiller:</label>
                                    <div><b>{{$persona->fecha_bachiller}}</b></div>
                                </div>
                                <div>
                                    <label>Fecha titulación:</label>
                                    <div><b>{{$persona->fecha_titulacion}}</b></div>
                                </div>
                            </div>
                            <div class="grid grid-2">
                                <div>
                                    <label>Especialidad/Post grado:</label>
                                    <div>
                                        <b>
                                            @if ( $persona->especialidadPosgrado )
                                                {{$persona->especialidadPosgrado->name}}
                                            @endif
                                        </b>
                                    </div>
                                </div>
                                <div>
                                    <label>Area ejercicio profesional:</label>
                                    <div>
                                        <b>
                                            @if ( $persona->areaEjercicioProfesional )
                                                {{$persona->areaEjercicioProfesional->name}}
                                            @endif
                                        </b>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-2">
                                <div>
                                    <label>Centro laboral:</label>
                                    <div><b>
                                        {{$persona->nombre_centro_laboral}}
                                    </b></div>
                                </div>
                                <div>
                                    <label>Dirección centro laboral:</label>
                                    <div><b>{{$persona->direccion_centro_laboral}}</b></div>
                                </div>
                            </div>
                            <div class="grid grid-2">
                                <div>
                                    <label>Teléfono centro laboral:</label>
                                    <div><b>{{$persona->telefono_centro_laboral}}</b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End informacion academico -->
                </td>
                <td width="50%" style="padding-left: 10px; vertical-align: baseline;">
                    <!-- Start informacion adicional -->
                    <div class="box">
                        <div class="box__title">Información adicional</div>
                        <div class="box__body">
                            <div class="grid grid-2">
                                <div>
                                    <label>Voluntario:</label>
                                    <div><b>
                                        @if ( $persona->is_voluntario )
                                            Si
                                        @else
                                            No
                                        @endif
                                    </b></div>
                                </div>
                                <div>
                                    <label>Grupo sanguíneo:</label>
                                    <div><b>{{$persona->grupo_sanguineo}}</b></div>
                                </div>
                            </div>
                            <div class="grid grid-2">
                                <div>
                                    <label>Fecha de registro:</label>
                                    <div><b>{{$persona->fecha_registro}}</b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End informacion adicional -->
                </td>
            </tr>
        </table>

    </div>
</body>

</html>