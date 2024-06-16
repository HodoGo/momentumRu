<?php

namespace App\Livewire\User\Components;

use Carbon\Carbon;
use Livewire\Component;

class TimeRemaining extends Component
{
    public $quiz_end_time;
    public $start_time_work;
    public $duration;
    public $remaining_time;
    public function mount($quiz_end_time, $start_time_work, $duration)
    {
        // $this->quiz_end_time = $quiz_end_time;
        $this->quiz_end_time = Carbon::createFromFormat("Y-m-d H:i:s", $quiz_end_time);
        $this->start_time_work = Carbon::createFromFormat("Y-m-d H:i:s", $start_time_work);
        $this->duration = $duration * 60;
        $this->refresh_time_remaining();
    }
    public function render()
    {
        $this->refresh_time_remaining();
        return view('livewire.user.components.time-remaining');
    }
    public function count_expire_time_different()
    {
        return Carbon::now('Asia/Makassar')->diffInSeconds($this->quiz_end_time, false);
    }
    public function count_start_time_different()
    {
        $remaining_reconds = $this->start_time_work->diffInSeconds(Carbon::now("Asia/Makassar"), false);
        return $this->duration - $remaining_reconds;
    }

    public function count_remaining_time()
    {
        // $allsecond = Carbon::now('Asia/Makassar')->diffInSeconds($this->quiz_end_time, false);
        $remaining_to_expire_time = $this->count_expire_time_different();
        $remaining_start_time = $this->count_start_time_different();
        $allsecond = $remaining_to_expire_time < $remaining_start_time ? $remaining_to_expire_time : $remaining_start_time;
        // $allsecond = $remaining_to_expire_time;
        // $allsecond = $remaining_start_time;
        if ($allsecond < 0) {
            $this->dispatch("time-up");
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
        // dd($this->duration);
        // dd($this->count_start_time_different());
        $this->remaining_time = $this->count_remaining_time();
    }
}
