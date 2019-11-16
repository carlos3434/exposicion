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

use File;
use App\Helpers\FileUploader;

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
    public function store(PersonaRequest $request, FileUploader $imageUploader)
    {
        $this->savePhoto($request);
        $all = $request->all();
        if ( $request->has('url_cv') ) {
            //$urlCV = $this->saveFile( $request->file('url_cv'), 'cvs');
            //$uploadFile = new uploadFile;
            $urlCV = $imageUploader->upload( $request->file('url_cv'), 'cvs' );
            $all['url_cv'] = $urlCV;
        }
        /*if ( $request->has('url_foto') ) {
            $urlFoto = $this->saveFile( $request->file('url_foto'), 'photos');
            $all['url_foto'] = $urlFoto;
        }*/

        $persona = Persona::create( $all );

        return response()->json($persona, 201);
    }
    /**
     * File input
     */
    /*private function saveFile($file, $fileFolder)
    {
        $image_extension = $file->getClientOriginalExtension();
        $fileName = time().'.'.$image_extension;
        Storage::put('uploads/'.$fileFolder.'/'.$fileName, File::get($file), 'public');

        return $fileName;
    }*/
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
    //public function show($id)
    {
        return new PersonaResource($persona);
        //return Persona::find($id);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(PersonaRequest $request, Persona $persona, FileUploader $imageUploader)
    {
        $this->savePhoto($request);

        $all = $request->all();
        if ( $request->has('url_cv') ) {
            //$uploadFile = new uploadFile;
            $urlCV = $imageUploader->upload( $request->file('url_cv'), 'cvs');
            $all['url_cv'] = $urlCV;
        }

        $persona->update( $all );
        //$persona->update( $request->all() );
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
