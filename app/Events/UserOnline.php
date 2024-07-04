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

    public $quiz_id;
    public $student_id;
    public $status;
    public $answer_count;
    public $time_remaining;
    /**
     * Create a new event instance.
     */
    public function __construct($quizId, $studentId, $status, $answerCount, $timeRemaining)
    {
        $this->quiz_id = $quizId;
        $this->student_id = $studentId;
        $this->status = $status;
        $this->answer_count = $answerCount;
        $this->time_remaining = $timeRemaining;
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
            new Channel("quiz." . $this->quiz_id),
            // new PrivateChannel('channel-name'),
        ];
    }
}
