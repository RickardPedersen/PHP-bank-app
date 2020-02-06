<?php

namespace Classes;

interface PaymentInterface
{
    public function findAccountID($fromPhone, $toPhone);
    public function checkBalance();
    public function checkReceiver();
    public function transfer();
    //public function saveTransaction($fromID, $toID, $fromAmount);
}
