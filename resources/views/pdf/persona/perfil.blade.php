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
                    <img class="current"  alt="">
                </td>
                <td width="80%" colspan="3" style="padding-left: 20px;">
                    <div>
                        <div>
                            <h3>Carhuaz Arenas Luis Alberto
                                <span class="active">Habilitado</span>
                                <!-- <span class="inactive">No habilitado</span> -->
                            </h3>
                        </div>
                        <div class="grid grid-3">
                            <div>
                                <label>Fecha de Inscripción:</label>
                                <p><b>12/10/2019</b></p>
                            </div>
                            <div>
                                <label>Fecha de colegiatura:</label>
                                <p><b>29/10/2019</b></p>
                            </div>
                            <div>
                                <label>Fecha de aprobación del consejo:</label>
                                <p><b>30/10/2019</b></p>
                            </div>
                        </div>
                        <div class="grid grid-3">
                            <div>
                                <label>Último mes pagado:</label>
                                <p><b>Enero 2019</b></p>
                            </div>
                            <div>
                                <label>Número de incidencias:</label>
                                <p><b>10</b></p>
                            </div>
                            <div>
                                <label>Número de procesos disciplinarios:</label>
                                <p><b>0</b></p>
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
                                    <div><b>DNI</b></div>
                                </div>
                                <div>
                                    <label>Documento:</label>
                                    <div><b>46009090</b></div>
                                </div>
                                <div>
                                    <label>Fecha de nacimiento:</label>
                                    <div><b>12/10/1990</b></div>
                                </div>
                                <div>
                                    <label>Apellidos:</label>
                                    <div><b>Carhuaz Arenas</b></div>
                                </div>
                                <div>
                                    <label>Nombres:</label>
                                    <div><b>Luis Alberto</b></div>
                                </div>
                                <div>
                                    <label>Nacionalidad:</label>
                                    <div><b>Peruano</b></div>
                                </div>
                                <div nz-col class="gutter-row" nzSpan="8">
                                    <label>Estado civil:</label>
                                    <div><b>Soltero</b></div>
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
                                    <div><b>Av. Risoto 23, SBJ</b></div>
                                </div>
                                <div>
                                    <label>Ubigeo:</label>
                                    <div><b>Miraflores, Lima, Lima
                                        </b></div>
                                </div>
                                <div>
                                    <label>Email:</label>
                                    <div><b>personal@email.com</b></div>
                                </div>
                                <div>
                                    <label>Email secundario:</label>
                                    <div><b>secundario@email.com</b></div>
                                </div>
                                <div>
                                    <label>Teléfono fijo:</label>
                                    <div><b>01 099090</b></div>
                                </div>
                                <div>
                                    <label>Celular:</label>
                                    <div><b>98787878</b></div>
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
                                    <div><b>Apurimac</b></div>
                                </div>
                                <div>
                                    <label>Universidad de procedencia:</label>
                                    <div><b>Universidad Nacional del Centro del Perú</b></div>
                                </div>
                            </div>
                            <div class="grid grid-2">
                                <div>
                                    <label>Fecha bachiller:</label>
                                    <div><b>12/02/2017</b></div>
                                </div>
                                <div>
                                    <label>Fecha titulación:</label>
                                    <div><b>12/02/2018</b></div>
                                </div>
                            </div>
                            <div class="grid grid-2">
                                <div>
                                    <label>Especialidad/Post grado:</label>
                                    <div>
                                        <b>Animales menores</b>
                                    </div>
                                </div>
                                <div>
                                    <label>Area ejercicio profesional:</label>
                                    <div>
                                        <b>Odontolgía canina</b>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-2">
                                <div>
                                    <label>Centro laboral:</label>
                                    <div><b>Centro Veterinaria SA</b></div>
                                </div>
                                <div>
                                    <label>Dirección centro laboral:</label>
                                    <div><b>Av. Flores S/N, Lima, Lima</b></div>
                                </div>
                            </div>
                            <div class="grid grid-2">
                                <div>
                                    <label>Teléfono centro laboral:</label>
                                    <div><b>01899020</b></div>
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
                                    <div><b>NO</b></div>
                                </div>
                                <div>
                                    <label>Grupo sanguíneo:</label>
                                    <div><b>O+</b></div>
                                </div>
                            </div>
                            <div class="grid grid-2">
                                <div>
                                    <label>Fecha de registro:</label>
                                    <div><b>12/10/2019</b></div>
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