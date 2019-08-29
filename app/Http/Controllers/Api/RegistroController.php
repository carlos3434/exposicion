<?php
namespace App\Http\Controllers\Api;
use App\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Persona as PersonaRequest;

use Image;
use Illuminate\Support\Facades\Storage;

class RegistroController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_REGISTRO')->only(['create','store']);
        $this->middleware('can:READ_REGISTRO')->only('index');
        $this->middleware('can:UPDATE_REGISTRO')->only(['edit','update']);
        $this->middleware('can:DETAIL_REGISTRO')->only('show');
        $this->middleware('can:DELETE_REGISTRO')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 25);
        $sortBy = $request->input('sortBy', 'id');
        $direction = $request->input('direction', 'DESC');

        $query = Persona::orderBy($sortBy,$direction);

        return $query->paginate($per_page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonaRequest $request)
    {
        $this->savePhoto($request);
        $persona = Persona::create($request->all());
        return response()->json($persona, 201);
    }
    private function savePhoto(&$request)
    {
        if ($request->has('url_foto')) {
            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '',$request->url_foto));
            //Image::make($image)->resize(300,300)->save($s3);
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
    //public function show(Persona $persona)
    public function show($id)
    {
        return Persona::find($id);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(PersonaRequest $request, Persona $persona)
    {
        $this->savePhoto($request);
        $persona->update( $request->all() );
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
