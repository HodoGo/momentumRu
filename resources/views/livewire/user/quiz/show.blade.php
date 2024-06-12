<div>
  {{-- Because she competes with no one, no one can compete with her. --}}
  <div class="bg-white shadow-sm rounded-lg p-6">
    <h1 class="text-momentum1 font-bold">Detail Quiz</h1>
    <div class="flex flex-wrap gap-x-10 gap-y-3 mt-5">
      <div class="basis-full md:basis-7/12">
        <div class="h-60 md:h-72 w-full bg-no-repeat bg-cover bg-center rounded-md"
          style="background-image: url('{{ asset('images/quizzes/quiz-2.webp') }}')">
        </div>
        <p class="font-medium text-xl py-3">{{ $quiz->name }}</p>
      </div>
      <div class="basis-full md:basis-5/12">
        <div class="flex flex-col gap-y-5">
          <div class="flex">
            <div class="basis-6/12 font-medium text-gray-600">
              Jenis Quiz
            </div>
            <div class="basis-5/12 text-gray-500">
              {{ $quiz->quiz_type->description }}
            </div>
          </div>
          <div class="flex">
            <div class="basis-6/12 font-medium text-gray-600">
              Tanggal Mulai
            </div>
            <div class="basis-5/12 text-gray-500">
              {{ $quiz->start_time }}
            </div>
          </div>
          <div class="flex">
            <div class="basis-6/12 font-medium text-gray-600">
              Tanggal Selesai
            </div>
            <div class="basis-5/12 text-gray-500">
              {{ $quiz->end_time }}
            </div>
          </div>
          <div class="flex">
            <div class="basis-6/12 font-medium text-gray-600">
              Durasi Pengerjaan
            </div>
            <div class="basis-5/12 text-gray-500">
              {{ $quiz->duration }} Menit
            </div>
          </div>
          <button class="bg-momentum1 text-white font-medium px-2 py-1 rounded w-full w-8/12">
            Kerjakan Quiz
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
