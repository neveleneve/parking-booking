<?php

namespace App\Helpers;

use App\Models\Pembayaran;
use Midtrans\Config;
use Midtrans\Transaction;

class TransactionHelper {
  private $order_id;
  private $id;
  private $trxMidtrans;
  private $trxDatabase;

  public function __construct($order_id) {
    Config::$serverKey = config('midtrans.serverKey');
    Config::$clientKey = config('midtrans.clientKey');
    Config::$isProduction = config('midtrans.isProduction');
    $this->order_id = $order_id;
    $this->getDataID($this->order_id);
    $this->checkDatabaseTransaction();
    $this->checkMidtransTransaction();
  }

  private function getDataID($order_id) {
    $data = Pembayaran::where('order_id', $order_id)->first();
    $this->id = $data->id;
  }

  private function checkDatabaseTransaction() {
    $data = Pembayaran::find($this->id);
    $this->trxDatabase = $data->transaction_status;
  }

  private function checkMidtransTransaction() {
    $data = Transaction::status($this->order_id);
    $this->trxMidtrans = $data->transaction_status;
  }

  private function isDataChange() {
    if ($this->trxDatabase == $this->trxMidtrans) {
      return false;
    } else {
      return true;
    }
  }

  private function changePossibility() {
    if ($this->trxDatabase == 'initiate') {
      return true;
    } elseif ($this->trxDatabase == 'authorize') {
      if ($this->trxMidtrans == 'pending' || $this->trxMidtrans == 'deny' || $this->trxMidtrans == 'expire') {
        return false;
      } else {
        return true;
      }
    } elseif ($this->trxDatabase == 'pending') {
      if ($this->trxMidtrans == 'authorize' || $this->trxMidtrans == 'capture') {
        return false;
      } else {
        return true;
      }
    } elseif ($this->trxDatabase == 'capture') {
      if ($this->trxMidtrans == 'authorize' || $this->trxMidtrans == 'pending' || $this->trxMidtrans == 'deny' || $this->trxMidtrans == 'expire') {
        return false;
      } else {
        return true;
      }
    } elseif ($this->trxDatabase == 'settlement') {
      if ($this->trxMidtrans == 'refund' || $this->trxMidtrans == 'chargeback' || $this->trxMidtrans == 'partial_refund' || $this->trxMidtrans == 'partial_chargeback') {
        return true;
      } else {
        return false;
      }
    } elseif ($this->trxDatabase == 'cancel') {
      return false;
    } elseif ($this->trxDatabase == 'deny') {
      return false;
    } elseif ($this->trxDatabase == 'expire') {
      return false;
    } elseif ($this->trxDatabase == 'refund') {
      return false;
    } elseif ($this->trxDatabase == 'chargeback') {
      return false;
    } elseif ($this->trxDatabase == 'partial_refund') {
      return false;
    } elseif ($this->trxDatabase == 'partial_chargeback') {
      return false;
    } elseif ($this->trxDatabase == 'failure') {
      return false;
    }
  }

  public function isCreditIncrease() {
    if ($this->trxDatabase != 'settlement' && $this->trxMidtrans == 'settlement') {
      return true;
    } else {
      return false;
    }
  }

  public function isDataShouldUpdate() {
    $checkDataChange = $this->isDataChange();
    $checkPossibility = $this->changePossibility();
    $status = false;
    if ($checkDataChange) {
      $status = $checkPossibility;
    } else {
      $status = false;
    }
    return $status;
  }

  public function statusUpdate() {
    $status = $this->trxMidtrans;
    if ($status == 'initiate') {
      return '0';
    } elseif ($status == 'pending') {
      return '1';
    } elseif ($status == 'authorize') {
      return '2';
    } elseif ($status == 'capture') {
      return '2';
    } elseif ($status == 'failure') {
      return '2';
    } elseif ($status == 'settlement') {
      return '3';
    } elseif ($status == 'cancel') {
      return '3';
    } elseif ($status == 'deny') {
      return '3';
    } elseif ($status == 'expire') {
      return '3';
    } elseif ($status == 'refund') {
      return '3';
    } elseif ($status == 'chargeback') {
      return '3';
    } elseif ($status == 'partial_refund') {
      return '3';
    } elseif ($status == 'partial_chargeback') {
      return '3';
    }
  }
}
