<?php

namespace App\Helpers;

use Midtrans\Config;
use Midtrans\Transaction;

class TransactionHelper {
  public function __construct() {
    Config::$serverKey = config('midtrans.serverKey');
    Config::$clientKey = config('midtrans.clientKey');
    Config::$isProduction = config('midtrans.isProduction');
  }
}
