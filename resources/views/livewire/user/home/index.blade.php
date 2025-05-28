<div class="flex flex-col gap-y-5">
  <div class="rounded-lg bg-white p-6 shadow-sm">
    <div class="flex gap-x-2 md:gap-x-6">
      <img src="{{ asset('images/man2.webp') }}" alt="{{ $auth['name'] }}" srcset=""
        class="h-20 rounded-lg bg-momentum1 md:h-36" />
      <div class="flex flex-col justify-around md:py-0">
        <div class="">
          <h6 class="text-xl font-medium text-momentum1">
            {{ $auth['name'] }}
          </h6>
          <p class="text-xs font-medium text-gray-400">
            {{ $auth['school'] }}
          </p>
        </div>
        <div class="flex gap-x-2 md:gap-x-8">
          <div class="flex gap-3">
            <div class="hidden place-items-center rounded px-3 py-2 shadow md:block">
              <i class="fa-solid fa-flag text-lg text-momentum1"></i>
            </div>
            <div class="flex items-center gap-x-1 md:flex-col md:items-start">
              <h6 class="text-xs font-bold text-gray-400 md:text-lg">
                {{ $auth['quiz_count'] }}
              </h6>
              <p class="text-xs text-gray-400">Тестов завершено</p>
            </div>
          </div>
          <div class="flex gap-3">
            <div class="hidden place-items-center rounded px-3 py-2 shadow md:block">
              <i class="fa-solid fa-circle-check text-lg text-momentum1"></i>
            </div>
            <div class="flex items-center gap-x-1 md:flex-col md:items-start">
              <h6 class="text-xs font-bold text-gray-400 md:text-lg">
                {{ $auth['answer_count'] }}
              </h6>
              <p class="text-xs text-gray-400">Вопросов отвечено</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="rounded-lg bg-white p-6 shadow-sm">
    <h1 class="font-bold text-momentum1">Доступные тесты</h1>
    @if (count($quizzes) > 0)
      <div class="grid grid-cols-1 justify-between gap-2 py-3 md:grid-cols-3">
        @foreach ($quizzes as $quiz)
          <livewire:user.components.quiz-card :quiz="$quiz" />
        @endforeach
      </div>
      <a wire:navigate href="{{ route('quiz.index') }}" class="block text-end font-medium text-momentum1">
        Подробнее
      </a>
    @else
      <div class="grid grid-cols-1 place-items-center gap-2 py-5">
        <div class="grid place-items-center">
          <img src="{{ asset('images/icons/out-of-stock.webp') }}" class="h-16" alt="" srcset="" />
          <p class="mt-2 font-medium text-gray-400">
            Тест еще не доступен
          </p>
        </div>
      </div>
    @endif
  </div>

  <div class="rounded-lg bg-white p-6 shadow-sm">
    <h1 class="font-bold text-momentum1">История тестирования</h1>
    @if (count($student_quizzes) > 0)
      <div class="mt-5">
        @foreach ($student_quizzes as $student_quiz)
          <livewire:user.components.quiz-history-row :student_quiz="$student_quiz" />
        @endforeach
      </div>
      <a wire:navigate href="{{ route('quiz.index') }}" class="block text-end font-medium text-momentum1">
        Подробнее
      </a>
    @else
      <div class="grid grid-cols-1 place-items-center gap-2 py-5">
        <div class="grid place-items-center">
          <img src="{{ asset('images/icons/out-of-stock.webp') }}" class="h-16" alt="" srcset="" />
          <p class="mt-2 font-medium text-gray-400">
            Тест еще не проводился
          </p>
        </div>
      </div>
    @endif
  </div>
</div>
