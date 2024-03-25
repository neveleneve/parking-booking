<?php

namespace App\Http\Livewire;

use App\Models\Slot;
use App\Models\Transaksi;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class Controlling extends Component {
    public $transaction_id;
    public $data;

    public function render() {
        return view('livewire.controlling');
    }

    public function mount() {
        $this->data = Transaksi::with('slot')->find($this->transaction_id);
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
        $update = [];
        $notification = [];
        if ($data->slot->status_respon == '1') {
            if ($data->slot->status_pakai == '0' || $data->slot->status_pakai == '2') {
                $notification = [
                    'title' => 'Membuka Palang Pintu',
                    'message' => 'Menunggu respon dari sensor...',
                ];
            } elseif ($data->slot->status_pakai == '1' || $data->slot->status_pakai == '3') {
                $notification = [
                    'title' => 'Menutup Palang Pintu',
                    'message' => 'Menunggu respon dari sensor...',
                ];
            }
            $this->dispatchBrowserEvent('notificationEvent', [
                'title' => $notification['title'],
                'icon' => 'info',
                'message' => $notification['message']
            ]);
            $update = [
                'status_respon' => '2'
            ];
        } elseif ($data->slot->status_respon == '3') {
            switch ($data->slot->status_pakai) {
                case '0':
                    $notification = [
                        'title' => 'Gagal Membuka Palang Pintu!',
                        'message' => 'Sensor masih mendeteksi adanya objek!',
                    ];
                    break;
                case '1':
                    $notification = [
                        'title' => 'Gagal Menutup Palang Pintu!',
                        'message' => 'Sensor tidak mendeteksi adanya objek',
                    ];
                    break;
                case '2':
                    $notification = [
                        'title' => 'Gagal Membuka Palang Pintu!',
                        'message' => 'Sensor masih mendeteksi adanya objek!',
                    ];
                    break;
                case '3':
                    $notification = [
                        'title' => 'Gagal Menutup Palang Pintu!',
                        'message' => 'Sensor tidak mendeteksi adanya objek',
                    ];
                    break;
                default:
                    $notification = [
                        'title' => '',
                        'message' => '',
                    ];
                    break;
            }
            $this->dispatchBrowserEvent('notificationEvent', [
                'title' => $notification['title'],
                'icon' => 'info',
                'message' => $notification['message']
            ]);
            $update = [
                'status_respon' => '0'
            ];
        } elseif ($data->slot->status_respon == '4') {
            switch ($data->slot->status_pakai) {
                case '0':
                    $notification = [
                        'title' => 'Berhasil Membuka Palang Pintu!',
                        'message' => 'Palang segera terbuka...',
                    ];
                    $update = [
                        'status_respon' => '0',
                        'status_pakai' => '1',
                    ];
                    break;
                case '1':
                    $notification = [
                        'title' => 'Berhasil Menutup Palang Pintu!',
                        'message' => 'Palang segera tertutup...',
                    ];
                    $data->update([
                        'jam_masuk' => date('Y-m-d H:i:s')
                    ]);
                    $update = [
                        'status_respon' => '0',
                        'status_pakai' => '2',
                    ];
                    break;
                case '2':
                    $notification = [
                        'title' => 'Berhasil Membuka Palang Pintu!',
                        'message' => 'Palang segera terbuka...',
                    ];
                    $update = [
                        'status_respon' => '0',
                        'status_pakai' => '3',
                    ];
                    break;
                case '3':
                    $notification = [
                        'title' => 'Berhasil Menutup Palang Pintu!',
                        'message' => 'Palang segera tertutup...',
                    ];
                    $update = [
                        'status_respon' => '0',
                        'status_pakai' => '0',
                        'booking_date' => null,
                        'is_booked' => false,
                    ];
                    $data->update([
                        'status' => '1',
                        'jam_keluar' => date('Y-m-d H:i:s'),
                    ]);
                    break;
                default:
                    $notification = [
                        'title' => '',
                        'message' => '',
                    ];
                    $update = [];
                    break;
            }
            $this->dispatchBrowserEvent('notificationEvent', [
                'title' => $notification['title'],
                'icon' => 'info',
                'message' => $notification['message']
            ]);
        }
        if (count($update) != 0) {
            $data->slot->update($update);
        }
    }

    public function controlUpdate($id) {
        $transaksi = Transaksi::find($id);
        $slot = Slot::find($transaksi->slot_id);
        if ($slot->status_pakai == 0) {
            $slot->update([
                'status_respon' => '1'
            ]);
        } elseif ($slot->status_pakai == 1) {
            $slot->update([
                'status_respon' => '1'
            ]);
        } elseif ($slot->status_pakai == 2) {
            $slot->update([
                'status_respon' => '1'
            ]);
        } elseif ($slot->status_pakai == 3) {
            $slot->update([
                'status_respon' => '1'
            ]);
        }
    }
}
