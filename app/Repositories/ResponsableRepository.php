<?php
namespace App\Repositories;

use App\Responsable;
use App\Http\Resources\Responsable\ResponsableCollection;
use App\Http\Resources\Responsable\Responsable as ResponsableResource;
use App\Http\Requests\Responsable as ResponsableRequest;

use App\Repositories\Interfaces\ResponsableRepositoryInterface;
/**
 * 
 */
class ResponsableRepository implements ResponsableRepositoryInterface
{
    public function all($request)
    {
        return new ResponsableCollection(
            Responsable::filter($request)->sort()->paginate()
        );
    }
    public function getOne(Responsable $responsable)
    {
        return new ResponsableResource($responsable);
    }
    public function getByFullName( $responsable)
    {
        return Responsable::firstOrCreate($responsable);
    }
    public function newOne( $responsable)
    {
        //search client with dni or ruc
        $responsable = Responsable::create($responsable);
        return $responsable->id;
    }
    public function updateOne(ResponsableRequest $request, Responsable $responsable)
    {
        $responsable->update( $request->all() );
        return $responsable;
    }
    public function deleteOne(Responsable $responsable)
    {
        $responsable->delete();
    }
}