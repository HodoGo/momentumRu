<div>
  {{-- The best athlete wants his opponent at his best. --}}
  <nav class="bg-gray-100 px-3 pt-0 pb-3 rounded-md w-full text-gray-500 font-normal">
    <ol class="list-reset flex">
      <li>
        <a wire:navigate href="{{ route('home') }}" class="text-gray-500 text-nowrap">
          Home
        </a>
      </li>
      <li>
        <span class="mx-2">/</span>
      </li>
      <li>
        <a class="text-gray-500 text-nowrap">
          Quiz History
        </a>
      </li>
    </ol>
  </nav>

  <div class="bg-white shadow-sm rounded-lg py-5 px-4">
    <h1 class="text-momentum1 font-bold">Quiz yang telah dikerjakan</h1>
    <div class="mt-5">
      @if (count($student_quizzes) > 0)
        @foreach ($student_quizzes as $student_quiz)
          <livewire:user.components.quiz-history-row :student_quiz="$student_quiz" />
        @endforeach
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
</div>
