<?php

namespace App\Livewire\User\Components;

use App\Events\UserOnline;
use App\Models\Quiz;
use Carbon\Carbon;
use Livewire\Component;

class UserOnlineComponent extends Component
{
    public Quiz $quiz;
    public $answered_count;
    public $start_time_work;
    public $end_time_quiz;
    public $remaining_time;

    public function mount($quiz, $answered_count, $start_time_work)
    {
        $this->quiz = $quiz;
        $this->answered_count = $answered_count;
        $this->start_time_work = Carbon::createFromFormat("Y-m-d H:i:s", $this->start_time_work);
        $this->end_time_quiz = Carbon::createFromFormat("Y-m-d H:i:s", $this->quiz->end_time);
    }
    public function render()
    {
        $this->remaining_time = $this->count_remaining_time();
        $this->sendOnlineEvent();
        return view('livewire.user.components.user-online-component');
    }

    public function sendOnlineEvent()
    {
        UserOnline::dispatch(
            $this->quiz->id,
            auth("student")->user()->id,
            "online",
            $this->answered_count,
            $this->remaining_time,
        );
    }
    public function count_remaining_time()
    {
        $remaining_to_expire_time = $this->count_expire_time_different();
        $remaining_start_time = $this->count_start_time_different();
        $allsecond = $remaining_to_expire_time < $remaining_start_time ? $remaining_to_expire_time : $remaining_start_time;
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
    public function count_expire_time_different()
    {
        return Carbon::now('Asia/Makassar')->diffInSeconds($this->end_time_quiz, false);
    }
    public function count_start_time_different()
    {
        $remaining_reconds = $this->start_time_work->diffInSeconds(Carbon::now("Asia/Makassar"), false);
        return ($this->quiz->duration*60) - $remaining_reconds;
    }

}
