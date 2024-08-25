<div>
  {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
  <nav
    class="w-full rounded-md bg-gray-100 px-3 pb-3 pt-0 font-normal text-gray-500"
  >
    <ol class="list-reset flex">
      <li>
        <a wire:navigate href="{{ route("home") }}" class="text-gray-500">
          Home
        </a>
      </li>
      <li>
        <span class="mx-2">/</span>
      </li>
      <li>
        <a class="text-gray-500">Quiz</a>
      </li>
    </ol>
  </nav>

  <div class="rounded-lg bg-white p-6 shadow-sm">
    <h1 class="font-bold text-momentum1">Quiz</h1>
    @if (count($quizzes) > 0)
      <div class="grid grid-cols-1 justify-between gap-2 py-3 md:grid-cols-3">
        @foreach ($quizzes as $quiz)
          <livewire:user.components.quiz-card :quiz="$quiz" />
        @endforeach
      </div>
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
            Belum Ada Quiz Yang Tersedia
          </p>
        </div>
      </div>
    @endif
  </div>
</div>
