<?php

namespace App\Livewire\User\Components;

use Carbon\Carbon;
use Livewire\Component;

class TimeRemaining extends Component
{
    public $end_time;
    public $remaining_time;
    public function mount($end_time)
    {
        // $this->end_time = $end_time;
        $this->end_time = Carbon::createFromFormat("Y-m-d H:i:s", $end_time);
        $this->refresh_time_remaining();
    }
    public function render()
    {
        $this->refresh_time_remaining();
        return view('livewire.user.components.time-remaining');
    }

    public function count_remaining_time()
    {
        $allsecond = Carbon::now('Asia/Makassar')->diffInSeconds($this->end_time, false);
        if ($allsecond < 0) {
            return "Waktu Habis";
        }
        $minutes = floor($allsecond / 60);
        $seconds = $allsecond % 60;
        if ($minutes < 10) {
            $minutes = "0$minutes";
        }
        if ($seconds < 10) {
            $seconds = "0$seconds";
        }

        return "$minutes:$seconds";
    }
    public function refresh_time_remaining()
    {
        $this->remaining_time = $this->count_remaining_time();
    }
}
