<?php

namespace Classes;

interface PaymentInterface
{
    public function checkBalance();
    public function checkReceiver();
    public function transfer();
}
