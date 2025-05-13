<?php

namespace App\Events;

use App\Models\TugasAkhir\BimbinganTugasAkhir;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadCastNow;

class ChatEvent implements ShouldBroadCastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $nama;
    public $pesan;
    public $user_id;

    /**
     * Create a new event instance.
     */
    public function __construct($user_id, $pesan, $ta)
    {
        $newMessage = new BimbinganTugasAkhir();

        $newMessage->user_id = $user_id;
        $newMessage->tugas_akhir_id = $ta;
        $newMessage->pesan = $pesan;
        $newMessage->save();

        $this->pesan = $pesan;
        $this->user_id = $user_id;
        $this->nama = User::find($user_id)->nama;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('chat-channel'),
        ];
    }
}
