<a wire:navigate href="{{ route('quiz.show', ['quiz' => $quiz->id]) }}"
  class="h-52 bg-no-repeat bg-cover bg-center rounded-md relative bg-gray-300"
  style="background-image: url('{{ asset('images/quizzes/quiz-' . $rand_img . '.webp') }}')">
  <div class="absolute bottom-4 w-full">
    <div class="flex justify-end">
      <span class="text-[12px] bg-white mx-4 px-1 rounded text-momentum1 font-medium">
        {{ $quiz->quiz_type->description }}
      </span>
    </div>
    <p class="text-sm text-white font-medium backdrop-blur-sm bg-black/35 mx-4 p-2 rounded-md">
      {{ $quiz->name }}
    </p>
  </div>
  <p class="text-xs text-momentum1 font-medium absolute top-3 left-3 p-1 rounded bg-white">
    {{ $quiz->duration }} min
  </p>
</a>
