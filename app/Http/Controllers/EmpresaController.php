<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;

use App\Http\Requests\Empresa as EmpresaRequest;
use Illuminate\Support\Facades\Storage;
use File;
class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:CREATE_EMPRESA')->only(['create','store']);
        $this->middleware('can:READ_EMPRESA')->only('index');
        $this->middleware('can:UPDATE_EMPRESA')->only(['edit','update']);
        $this->middleware('can:DETAIL_EMPRESA')->only('show');
        $this->middleware('can:DELETE_EMPRESA')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::paginate(10);
        return view('reporteria.administracion.empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('reporteria.administracion.empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpresaRequest $request)
    {
        $all = $request->all();
        $certificado_digital = $this->saveImage( $request->file('certificado_digital'),'certificados');
        $logo = $this->saveImage( $request->file('logo'), 'logos');

        $all['certificado_digital'] = $certificado_digital;
        $all['logo'] = $logo;

        $empresa = Empresa::create( $all );

        return redirect()
                    ->route('empresas.edit', $empresa->id )
                    ->with('info','Empresa guardado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        return view('reporteria.administracion.empresas.show', compact('empresa') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        
        return view('reporteria.administracion.empresas.edit', compact('empresa') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update( EmpresaRequest $request, Empresa $empresa)
    {
        $all = $request->all();
        $certificado_digital = $this->saveImage( $request->file('certificado_digital'),'certificados');
        $logo = $this->saveImage( $request->file('logo'), 'logos');

        $all['certificado_digital'] = $certificado_digital;
        $all['logo'] = $logo;

        $empresa->update( $all );

        return redirect()
                ->route('empresas.edit', $empresa->id )
                ->with('info','Usuario actualizado con exito');
    }
    private function saveImage($file, $fileFolder)
    {
        $image_extension = $file->getClientOriginalExtension();
        $fileName = $fileFolder.'/'.time().'.'.$image_extension;
        Storage::put('uploads/'.$fileName, File::get($file));

        return $fileName;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();

        return back()->with('info','Eliminado Correctamente');
    }
}
