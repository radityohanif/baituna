<?php

namespace App\Http\Controllers;

use App\Models\Payment;

class DocumentPrintController extends Controller
{
    public function show($id)
    {
        $payment = Payment::find($id);
        return view('livewire.payment-receipt', ['payment' => $payment]);
    }
}
