<?php

namespace App\Http\Livewire;

use App\Models\Slot;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class TokenGenerate extends Component {
    public $ids;
    public $token;
    public $data;

    public function render() {
        $data = Slot::find($this->ids);
        $this->token = $data->token;
        return view('livewire.token-generate');
    }

    public function regenerate() {
        $data = Slot::find($this->ids);
        $data->update([
            'token' => $this->randomString()
        ]);
    }

    public function randomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, strlen($characters) - 1);
            $string .= $characters[$randomIndex];
        }
        return $string;
    }
}
