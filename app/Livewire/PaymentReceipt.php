<?php

namespace App\Livewire;

use Livewire\Component;

class PaymentReceipt extends Component
{
    public $payment;

    public function render()
    {
        return view('livewire.payment-receipt');
    }
}
