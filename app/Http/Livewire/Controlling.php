<?php

namespace App\Http\Livewire;

use App\Models\Transaksi;
use Livewire\Component;

class Controlling extends Component {
    public $transaction_id;
    public $data;

    public function render() {
        $this->data = Transaksi::with('slot')->find($this->transaction_id);
        return view('livewire.controlling');
    }

    public function getStatusAttributesProperty() {
        $status = $this->data->slot->status_pakai;
        $attributes = [
            0 => [
                'label' => 'Tertutup',
                'button' => 'Buka Palang',
                'class' => 'bg-danger'
            ],
            1 => [
                'label' => 'Terbuka',
                'button' => 'Tutup Palang',
                'class' => 'bg-success'
            ],
            2 => [
                'label' => 'Tertutup',
                'button' => 'Buka Palang',
                'class' => 'bg-danger'
            ],
            3 => [
                'label' => 'Terbuka',
                'button' => 'Tutup Palang',
                'class' => 'bg-success'
            ],
        ];
        return $attributes[$status] ?? [
            'label' => 'Kesalahan',
            'button' => 'Kesalahan',
            'class' => 'bg-danger'
        ];
    }
}
