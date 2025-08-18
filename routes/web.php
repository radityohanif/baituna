<?php

use Illuminate\Support\Facades\Route;
use App\Models\Payment;

Route::get('/', function () {
    return redirect('/admin');
});


Route::get('/payments', function () {
    $payment = Payment::find(2);
    return view('payments.receipt', compact('payment'));
});
