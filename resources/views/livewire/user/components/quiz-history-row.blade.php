<div>
  {{-- Because she competes with no one, no one can compete with her. --}}
  <div wire:click="openModal" class="flex justify-between items-center md:gap-x-28 pb-6 cursor-pointer md:cursor-default">
    <div class="md:grow flex gap-x-1 items-center">
      <img src="{{ asset('images/icons/parchment.webp') }}" class="w-10 h-10 rounded-full bg-gray-300 md:hidden" />
      <div class="md:grow flex flex-col md:flex-row md:justify-between text-nowrap text-xs md:text-base font-medium">
        <p class="text-black">{{ $student_quiz['quiz_name'] }}</p>
        <p class="text-gray-500 md:text-black">{{ $student_quiz['quiz_type'] }}</p>
      </div>
    </div>
    <div
      class="md:grow flex md:justify-between flex-col md:flex-row text-nowrap text-xs md:text-base font-medium text-end">
      <p class="text-black">
        {{ date('d-m-Y H:i', strtotime($student_quiz['work_date'])) }}
      </p>
      <p class="text-gray-500 md:text-black">Nilai: {{ $student_quiz['score'] }}</p>
    </div>
    <div class="hidden md:block">
      <button wire:click="openModal" class="bg-momentum1 text-white px-3 rounded font-medium">Detail</button>
    </div>
  </div>

  @if ($isOpen)
    <div wire:click="closeModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-20">
      <div class="bg-white rounded-lg w-96 md:w-4/12">
        <div class="border-b px-4 py-2 flex justify-between items-center">
          <h3 class="text-lg font-semibold text-momentum1">Detail Pengerjaan</h3>
          <button wire:click="closeModal" class="text-black">
            <i class="fa-solid fa-xmark"></i>
          </button>
        </div>
        <div class="p-4">
          <div class="grid grid-cols-2 gap-y-2">
            <p>Nama Peserta</p>
            <p>: {{ $student_quiz['student_name'] }}</p>
            <p>Nama Quiz</p>
            <p>: {{ $student_quiz['quiz_name'] }}</p>
            <p>Jenis Soal</p>
            <p>: {{ $student_quiz['quiz_type'] }}</p>
            <p>Tanggal Pengerjaan</p>
            <p>:
              {{ date('d-m-Y H:i', strtotime($student_quiz['work_date'])) }}
            </p>
            <p>Durasi Pengerjaan</p>
            <p>: {{ $student_quiz['duration'] ?? '-' }} menit</p>
            <p>Jumlah Soal</p>
            <p>: {{ $student_quiz['question_count'] }} Soal</p>
            <p>Jumlah Soal Dijawab</p>
            <p>: {{ $student_quiz['answer_count'] }} / {{ $student_quiz['question_count'] }}</p>
            <p>Nilai </p>
            <p>: {{ $student_quiz['score'] }}</p>
          </div>
        </div>
        <div class="border-t px-4 py-2 flex justify-end">
          <button wire:click="closeModal" class="px-4 py-1 bg-gray-200 rounded mr-2">Tutup</button>
        </div>
      </div>
    </div>
  @endif
</div>
