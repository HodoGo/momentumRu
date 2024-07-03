<?php

namespace App\Livewire\User\Components;

use App\Events\UserOnline;
use App\Models\Quiz;
use Carbon\Carbon;
use Livewire\Component;

class UserOnlineComponent extends Component
{
    public Quiz $quiz;
    public $answeredCount;
    public $start_time_work;

    public function mount()
    {
        $this->start_time_work = Carbon::parse($this->start_time_work);
    }
    public function render()
    {
        // $this->sendOnlineEvent();
        return view('livewire.user.components.user-online-component');
    }

    public function sendOnlineEvent()
    {
        UserOnline::dispatch(
            $this->quiz->id,
            auth("student")->user()->id,
            "online",
            $this->answeredCount,
            $this->count_remaining_time(),
        );
    }
    public function count_remaining_time()
    {
        $remaining_to_expire_time = $this->count_expire_time_different();
        $remaining_start_time = $this->count_start_time_different();
        $allsecond = $remaining_to_expire_time < $remaining_start_time ? $remaining_to_expire_time : $remaining_start_time;
        return $allsecond;
    }
    public function count_expire_time_different()
    {
        return Carbon::now('Asia/Makassar')->diffInSeconds($this->quiz->end_time, false);
    }
    public function count_start_time_different()
    {
        $remaining_reconds = $this->start_time_work->diffInSeconds(Carbon::now("Asia/Makassar"), false);
        return $this->quiz->duration - $remaining_reconds;
    }

}
