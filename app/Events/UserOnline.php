<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserOnline implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $quizId;
    public $studentId;
    public $answerCount;
    public $timeRemaining;
    /**
     * Create a new event instance.
     */
    public function __construct($quizId, $studentId, $answerCount, $timeRemaining)
    {
        $this->quizId = $quizId;
        $this->studentId = $studentId;
        $this->answerCount = $answerCount;
        $this->timeRemaining = $timeRemaining;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // return new Channel("Message");
        return [
            new Channel("quiz." . $this->quizId),
            // new PrivateChannel('channel-name'),
        ];
    }
}
