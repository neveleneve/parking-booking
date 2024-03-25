<?php

namespace App\Http\Livewire;

use App\Models\Transaksi;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function notification($id) {
        $data = Transaksi::with('slot')->find($id);
        $update = '0';
        if ($data->slot->status_respon == '1') {
            $title = '';
            if ($data->slot->status_pakai == '0' || $data->slot->status_pakai == '2') {
                $title = 'Membuka Palang Pintu';
            } elseif ($data->slot->status_pakai == '1' || $data->slot->status_pakai == '3') {
                $title = 'Menutup Palang Pintu';
            }
            $this->dispatchBrowserEvent('notificationEvent', [
                'title' => $title,
                'icon' => 'info',
                'message' => 'Menunggu respon dari sensor...'
            ]);
            // harusnya values 2. 0 untuk test
            $update = '0';
        } elseif ($data->slot->status_respon == '3') {
            $title = '';
            $this->dispatchBrowserEvent('notificationEvent', [
                'title' => $title,
                'icon' => 'info',
                'message' => 'Menunggu respon dari sensor...'
            ]);
            $update = '0';
        } elseif ($data->slot->status_respon == '4') {
            $title = '';
            $this->dispatchBrowserEvent('notificationEvent', [
                'title' => $title,
                'icon' => 'info',
                'message' => 'Menunggu respon dari sensor...'
            ]);
            $update = '0';
        }
        sleep(3);
        $data->slot->update([
            'status_respon' => $update
        ]);
    }

    public function controlUpdate($id) {
        // 
    }
}
