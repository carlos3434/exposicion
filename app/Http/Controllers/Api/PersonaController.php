<?php
namespace App\Http\Controllers\Api;
use App\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Persona as PersonaRequest;

use Image;
use Illuminate\Support\Facades\Storage;

//use App\Exports\Export;
//use Maatwebsite\Excel\Facades\Excel;

use App\Http\Resources\Persona\Persona as PersonaResource;
use App\Http\Resources\Persona\PersonaCollection;
use App\Http\Resources\Persona\PersonaExcelCollection;

use App\Helpers\FileUploader;
use mikehaertl\wkhtmlto\Pdf;

class PersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_COLEGIADO')->only(['create','store']);
        $this->middleware('can:READ_COLEGIADO')->only('index');
        $this->middleware('can:UPDATE_COLEGIADO')->only(['edit','update']);
        $this->middleware('can:DETAIL_COLEGIADO')->only('show');
        $this->middleware('can:DELETE_COLEGIADO')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Persona::filter($request)
            ->with([
                'tipoDocumentoIdentidad',
                'nacionalidad',
                'estadoCivil',
                'departamento',
                'distrito',
                'provincia',
                'universidadProcedencia',
                'especialidadPosgrado',
                'areaEjercicioProfesional',
                'departamentoColegiado',
                'estadoRegistroColegiado',
                'estadoCuentaSistema'
        ]);
        if ( !empty($request->excel) || !empty($request->pdf) ){

            if ($query->count() > 0) {
                $result = new PersonaExcelCollection( $query->get() );

                return $result->downloadExcel(
                    'registros_'.date('m-d-Y_hia').'.xlsx',
                    $writerType = null,
                    $headings = true
                );
            }
        }

        return new PersonaCollection( $query->sort()->paginate() );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonaRequest $request, FileUploader $fileUploader)
    {
        $this->savePhoto($request);
        $all = $request->all();
        if ( $request->has('url_cv') ) {
            $all['url_cv'] = $fileUploader->upload( $request->file('url_cv'), 'cvs' );
        }
        /*if ( $request->has('url_foto') ) {
            $urlFoto = $this->saveFile( $request->file('url_foto'), 'photos');
            $all['url_foto'] = $urlFoto;
            $all['url_foto'] = $fileUploader->upload( $request->file('url_foto'), 'photos' );
        }*/

        $persona = Persona::create( $all );

        return response()->json($persona, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function perfil( $personaId , FileUploader $fileUploader)
    {
        $persona = Persona::find($personaId);
        if (!$persona ) {
            return response()->json('Persona no registrada', 500);
        }
        $persona = new PersonaResource($persona);

        $html = view('pdf.persona.perfil', compact('persona') )->render();
        $fileUploader->uploadStorage($html, 'files_personas', $persona->id.'.html');
        $file_path_pdf  = storage_path('app/uploads/files_personas/'.$persona->id.'.pdf');
        $file_path_html = storage_path('app/uploads/files_personas/'.$persona->id.'.html');

        $tmpFolder = base_path() . '/storage/tmpJuan/';
        $pdf = new Pdf();
        $pdf->setOptions([
            'margin-top'    => 0,
            'margin-right'  => 0,
            'margin-bottom' => 0,
            'margin-left'   => 0,

            'no-outline',
            'encoding' => 'UTF-8',
            //'orientation' => 'Landscape',
            'orientation' => 'Portrait',
            'page-width'     => '216mm',
            'page-height'     => '279mm',
            //'page-width' => '401cm',
            //'page-height' => '29.7cm',
            'user-style-sheet' => 'css/style_perfil.css',
            //'enable-javascript' => true , no permitido
        ]);
        $pdf->addPage( $file_path_html );

        if (!$pdf->saveAs( $file_path_pdf )) {
            // an error has occurred notify the user
            //echo $pdf->getError();
            //die;
            return response()->json($pdf->getError(), 500);
        } else {
            return response()->file( $file_path_pdf );
        }
    }

    /**
     * Base64
     */
    private function savePhoto(&$request)
    {
        if ($request->has('url_foto')) {
            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '',$request->url_foto));

            $profileImg= Image::make($image)->stream();

            $fileName = time().'.png';
            Storage::put('uploads/photos/'.$fileName, $profileImg, 'public');
            $request->merge(['url_foto' => $fileName]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        return new PersonaResource($persona);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(PersonaRequest $request, Persona $persona, FileUploader $fileUploader)
    {
        $this->savePhoto($request);

        $all = $request->all();
        if ( $request->has('url_cv') ) {
            $urlCV = $imageUploader->upload( $request->file('url_cv'), 'cvs');
            $all['url_cv'] = $urlCV;
        }

        $persona->update( $all );
        return response()->json($persona, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        $persona->delete();
        return response()->json(null, 204);
    }
}
