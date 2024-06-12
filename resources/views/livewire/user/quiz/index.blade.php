<div>
  {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
  <nav class="bg-gray-100 px-3 pt-0 pb-3 rounded-md w-full text-gray-500 font-normal">
    <ol class="list-reset flex">
      <li>
        <a href="{{ route('home') }}" class="text-gray-500">Home</a>
      </li>
      <li>
        <span class="mx-2">/</span>
      </li>
      <li>
        <a class="text-gray-500">Quiz</a>
      </li>
    </ol>
  </nav>

  <div class="bg-white shadow-sm rounded-lg p-6">
    <h1 class="text-momentum1 font-bold">Quiz</h1>
    @if (count($quizzes) > 0)
      <div class="grid grid-cols-1 md:grid-cols-3 justify-between gap-2 py-3">
        @foreach ($quizzes as $quiz)
          <livewire:user.components.quiz-card :quiz="$quiz" />
        @endforeach
      </div>
    @else
      <div class="grid grid-cols-1 place-items-center gap-2 py-5">
        <div class="grid place-items-center">
          <img src="{{ asset('images/icons/out-of-stock.webp') }}" class="h-16" alt="" srcset="">
          <p class="font-medium text-gray-400 mt-2">Belum Ada Quiz Yang Tersedia</p>
        </div>
      </div>
    @endif
  </div>

</div>
