<?php

namespace App\Livewire;

use App\Events\ChatEvent;
use App\Models\TugasAkhir\BimbinganTugasAkhir;
use App\Models\TugasAkhir\TugasAkhir;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class ChatComponent extends Component
{

    public $taId;
    public $user_id;
    public $pesan;
    public $daftarPesan = [];

    public function mount(int $ta)
    {
        $this->taId = $ta;
        $this->user_id = Auth::user()->id;
        $pesan = BimbinganTugasAkhir::with('user')
            ->where('tugas_akhir_id', $ta)->get();
        foreach ($pesan as $d) {
            $this->daftarPesan[] = [
                'user_id' => $d->user_id,
                'nama' => $d->user->nama,
                'pesan' => $d->pesan,
            ];
        }
        $this->dispatch('pesanTerkirim', $this->taId);
    }

    public function sendMessage()
    {
        // dispatch event
        ChatEvent::dispatch($this->user_id,  $this->pesan, $this->taId);
        // dump($this->pesan);
        $this->pesan = "";
        $this->dispatch('pesanTerkirim', $this->taId);
    }

    #[On('echo:chat-channel,ChatEvent')]
    public function listenForMessage($data)
    {
        $this->daftarPesan[] = [
            'user_id' => $data['user_id'],
            'nama' => $data['nama'],
            'pesan' => $data['pesan'],
        ];
        $this->dispatch('pesanTerkirim', $this->taId);
    }

    public function render()
    {
        return view('livewire.chat-component');
    }
}
