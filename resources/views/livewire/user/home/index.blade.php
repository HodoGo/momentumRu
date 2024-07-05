<div class="flex flex-col gap-y-5">
  <div class="bg-white shadow-sm rounded-lg p-4 p-6">
    <div class="flex gap-x-2 md:gap-x-6">
      <img src="{{ asset('images/man2.webp') }}" alt="" srcset="" class="h-20 md:h-36 bg-momentum1 rounded-lg">
      <div class="flex flex-col justify-around md:py-0">
        <div class="">
          <h6 class="text-momentum1 text-xl font-medium">{{ $auth['name'] }}</h6>
          <p class="text-gray-400 font-medium text-xs">{{ $auth['school'] }}</p>
        </div>
        <div class="flex gap-x-2 md:gap-x-8">
          <div class="flex gap-3">
            <div class="shadow px-3 py-2 rounded grid place-items-center hidden md:block">
              <i class="fa-solid fa-flag text-momentum1 text-lg"></i>
            </div>
            <div class="flex md:flex-col gap-x-1 items-center md:items-start">
              <h6 class="text-gray-400 text-xs md:text-lg font-bold">{{ $auth['quiz_count'] }}</h6>
              <p class="text-gray-400 text-xs">Quiz Diselesaikan</p>
            </div>
          </div>
          <div class="flex gap-3">
            <div class="shadow px-3 py-2 rounded grid place-items-center hidden md:block">
              <i class="fa-solid fa-circle-check text-momentum1 text-lg"></i>
            </div>
            <div class="flex md:flex-col gap-x-1 items-center md:items-start">
              <h6 class="text-gray-400 text-xs md:text-lg font-bold">{{ $auth['answer_count'] }}</h6>
              <p class="text-gray-400 text-xs">Soal Dijawab</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="bg-white shadow-sm rounded-lg p-6">
    <h1 class="text-momentum1 font-bold">Quiz Tersedia</h1>
    @if (count($quizzes) > 0)
      <div class="grid grid-cols-1 md:grid-cols-3 justify-between gap-2 py-3">
        @foreach ($quizzes as $quiz)
          <livewire:user.components.quiz-card :quiz="$quiz" />
        @endforeach
      </div>
      <a wire:navigate href="{{ route('quiz.index') }}" class="block text-end text-momentum1 font-medium">Lihat
        Lainnya</a>
    @else
      <div class="grid grid-cols-1 place-items-center gap-2 py-5">
        <div class="grid place-items-center">
          <img src="{{ asset('images/icons/out-of-stock.webp') }}" class="h-16" alt="" srcset="">
          <p class="font-medium text-gray-400 mt-2">Belum Ada Quiz Yang Tersedia</p>
        </div>
      </div>
    @endif
  </div>

  <div class="bg-white shadow-sm rounded-lg p-6">
    <h1 class="text-momentum1 font-bold">History Quiz</h1>
    @if (count($student_quizzes) > 0)
      <div class="mt-5">
        @foreach ($student_quizzes as $student_quiz)
          <livewire:user.components.quiz-history-row :student_quiz="$student_quiz" />
        @endforeach
      </div>
      <a wire:navigate href="{{ route('quiz.index') }}" class="block text-end text-momentum1 font-medium">Lihat
        Lainnya</a>
    @else
      <div class="grid grid-cols-1 place-items-center gap-2 py-5">
        <div class="grid place-items-center">
          <img src="{{ asset('images/icons/out-of-stock.webp') }}" class="h-16" alt="" srcset="">
          <p class="font-medium text-gray-400 mt-2">Belum Ada Quiz Yang Dikerjakan</p>
        </div>
      </div>
    @endif
  </div>
</div>
