<?php
namespace App\Repositories;

use App\InvoiceDetail;
use App\Http\Resources\InvoiceDetail\InvoiceDetailCollection;
use App\Http\Resources\InvoiceDetail\InvoiceDetail as InvoiceDetailResource;
use App\Http\Requests\InvoiceDetail as InvoiceDetailRequest;

use App\Repositories\Interfaces\InvoiceDetailRepositoryInterface;
/**
 * 
 */
class InvoiceDetailRepository implements InvoiceDetailRepositoryInterface
{
    public function all($request)
    {
        return new InvoiceDetailCollection(
            InvoiceDetail::filter($request)->sort()->paginate()
        );
    }
    public function getOne(InvoiceDetail $invoiceDetail)
    {
        return new InvoiceDetailResource($invoiceDetail);
    }
    public function newOne( $invoiceDetail)
    {
        //search client with dni or ruc
        $invoiceDetail = InvoiceDetail::create($invoiceDetail);
        return $invoiceDetail->id;
    }
    public function updateOne(InvoiceDetailRequest $request, InvoiceDetail $invoiceDetail)
    {
        $invoiceDetail->update( $request->all() );
        return $invoiceDetail;
    }
    public function updateById( $invoiceDetailData )
    {
        $invoiceDetailDataId = $invoiceDetailData['id'];
        unset($invoiceDetailData['id']);
        $invoiceDetail = InvoiceDetail::find( $invoiceDetailDataId );
        $invoiceDetail->update( $invoiceDetailData );
    }
    public function deleteOne(InvoiceDetail $invoiceDetail)
    {
        $invoiceDetail->delete();
    }
}