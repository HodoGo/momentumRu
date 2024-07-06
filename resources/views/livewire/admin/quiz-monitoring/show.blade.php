<div wire:poll.3s='check_expire'>
  <div class="w-full p-6 bg-white rounded-lg shadow dark:bg-zinc-900">
    <div class="flex flex-col-reverse md:flex-row">
      <div class="basis-12/12 md:basis-8/12 grid grid-cols-2 gap-y-2">
        <p>Nama</p>
        <p class="">: {{ $quiz->name }}</p>
        <p>Kode</p>
        <p class="">: {{ $quiz->code }}</p>
        <p>Jenis Sekolah</p>
        <p class="">: {{ $quiz->school_category->name }}</p>
        <p>Jenis Kuis</p>
        <p class="">: {{ $quiz->quiz_type->description }}</p>
        <p>Waktu Mulai</p>
        <p class="">: {{ date('d M Y H:i', strtotime($quiz->start_time)) }}</p>
        <p>Waktu Selesai</p>
        <p class="">: {{ date('d M Y H:i', strtotime($quiz->end_time)) }}</p>
        <p>Durasi Pengerjaan</p>
        <p class="">: {{ $quiz->duration }} Menit</p>
      </div>
      <div class="basis-12/12 mx-10 md:mx-0 md:basis-3/12">
        <img src="{{ asset('images/icons/quiz.webp') }}" alt="" srcset="" class="">
      </div>
    </div>
  </div>

  <div class="mt-5 relative overflow-x-auto rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th class="px-6 py-3">No</th>
          <th class="px-6 py-3">Nama</th>
          <th class="px-6 py-3">Sekolah</th>
          <th class="px-6 py-3">Status</th>
          <th class="px-6 py-3">Waktu tersisa</th>
          <th class="px-6 py-3">Jawaban</th>
        </tr>
      </thead>
      <tbody id="students-table-body">
        @foreach ($students as $student)
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td class="px-6 py-2 text-nowrap font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ $loop->iteration }}
            </td>
            <td class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ $student['name'] }}
            </td>
            <td class="px-6 py-2 text-nowrap">{{ $student['school_name'] }}</td>
            <td class="px-6 py-2 text-nowrap">
              {{-- {{ $student["status"]}} --}}
              @if ($student['status'] == 'online')
                <span
                  class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                  Online
                </span>
              @else
                <span
                  class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                  Offline
                </span>
              @endif
            </td>
            <td class="px-6 py-2 font-medium">{{ $student['time_remaining'] }}</td>
            <td class="px-6 py-2 font-medium">{{ $student['answer_count'] }} / {{ $quiz->questions->count() }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@assets
  <script src="{{ asset('build/assets/app-b9127d3d.js') }}"></script>
@endassets
