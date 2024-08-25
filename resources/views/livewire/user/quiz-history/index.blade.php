<div>
  {{-- The best athlete wants his opponent at his best. --}}
  <nav
    class="w-full rounded-md bg-gray-100 px-3 pb-3 pt-0 font-normal text-gray-500"
  >
    <ol class="list-reset flex">
      <li>
        <a
          wire:navigate
          href="{{ route("home") }}"
          class="text-nowrap text-gray-500"
        >
          Home
        </a>
      </li>
      <li>
        <span class="mx-2">/</span>
      </li>
      <li>
        <a class="text-nowrap text-gray-500">Quiz History</a>
      </li>
    </ol>
  </nav>

  <div class="rounded-lg bg-white px-4 py-5 shadow-sm">
    <h1 class="font-bold text-momentum1">Quiz yang telah dikerjakan</h1>
    <div class="mt-5">
      @if (count($student_quizzes) > 0)
        @foreach ($student_quizzes as $student_quiz)
          <livewire:user.components.quiz-history-row
            :student_quiz="$student_quiz"
          />
        @endforeach
      @else
        <div class="grid grid-cols-1 place-items-center gap-2 py-5">
          <div class="grid place-items-center">
            <img
              src="{{ asset("images/icons/out-of-stock.webp") }}"
              class="h-16"
              alt=""
              srcset=""
            />
            <p class="mt-2 font-medium text-gray-400">
              Belum Ada Quiz Yang Dikerjakan
            </p>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
