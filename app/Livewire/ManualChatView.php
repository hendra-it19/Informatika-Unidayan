<?php

namespace App\Livewire;

use App\Models\TugasAkhir\BimbinganTugasAkhir;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Carbon\Carbon;

class ManualChatView extends Component
{

    public $pesan = [];
    public $pesanBaru;
    public $taId;
    public $userId;

    public function mount(int $ta)
    {
        $this->taId = $ta;
        $this->userId = Auth::user()->id;

        $this->pesan = BimbinganTugasAkhir::with('user')
            ->where('tugas_akhir_id', $this->taId)->get();
    }

    public function render()
    {
        $key = 'manual_chat_' . $this->userId;
        $event = Cache::get($key);
        if ($event) {
            Cache::forget($key);
            $this->dispatch('manual_chat', $event);
        }
        return view('livewire.manual-chat-view');
    }

    public function kirimPesan()
    {
        BimbinganTugasAkhir::create([
            'user_id' => $this->userId,
            'tugas_akhir_id' => $this->taId,
            'pesan' => $this->pesanBaru,
        ]);
        $this->pesanBaru = '';
        $this->pesan = BimbinganTugasAkhir::with('user')
            ->where('tugas_akhir_id', $this->taId)->get();
    }

    public function refreshData()
    {
        $this->pesan = BimbinganTugasAkhir::with('user')
            ->where('tugas_akhir_id', $this->taId)->get();
    }
}
