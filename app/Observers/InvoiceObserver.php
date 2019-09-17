<?php

namespace App\Observers;

use App\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceObserver
{
    public function saving(Invoice $invoice)
    {
        
    }
    /**
     * Handle the Invoice "created" event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function creating(Invoice $invoice)
    {
        $invoice->created_by = Auth::id();
        $invoice->updated_by = Auth::id();
    }

    /**
     * Handle the Invoice "updated" event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function updating(Invoice $invoice)
    {
        $invoice->updated_by = Auth::id();
    }
    /**
     * Handle the Invoice "deleted" event.
     *
     * @param  \App\Invoice  $translado
     * @return void
     */
    public function deleting(Invoice $invoice)
    {
        $invoice->deleted_by = Auth::id();
    }
    /**
     * Handle the proceso disciplinario "created" event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function created(Invoice $invoice)
    {

    }

    /**
     * Handle the proceso disciplinario "updated" event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function updated(Invoice $invoice)
    {

    }

    /**
     * Handle the proceso disciplinario "deleted" event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function deleted(Invoice $invoice)
    {

    }

    /**
     * Handle the proceso disciplinario "restored" event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function restored(Invoice $invoice)
    {
        //
    }

    /**
     * Handle the proceso disciplinario "force deleted" event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function forceDeleted(Invoice $invoice)
    {
        //
    }
}
