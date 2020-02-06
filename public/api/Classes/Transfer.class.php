<?php

namespace Classes;

class Transfer
{
    public $payment;
    public function __construct(PaymentInterface $payment)
    {
        $this->payment = $payment;
    }
}
