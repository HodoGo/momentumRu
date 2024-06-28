<div>
  <div class="relative overflow-x-auto rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th class="px-6 py-3">No</th>
          <th class="px-6 py-3">Nama</th>
          <th class="px-6 py-3">Sekolah</th>
          <th class="px-6 py-3">Status</th>
          <th class="px-6 py-3">Jawaban</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($students as $student)
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td class="px-6 py-2 text-nowrap font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ $loop->iteration }}
            </td>
            <td class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ $student->name }}
            </td>
            <td class="px-6 py-2 text-nowrap">{{ $student->school->name }}</td>
            <td class="px-6 py-2 text-nowrap">
              @if ($student->status == 'offline')
                <span
                  class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                  Offline
                </span>
              @elseif ($student->status == 'online')
                <span
                  class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                  {{ $student->status }}
                </span>
              @elseif ($student->status == 'done')
                <span
                  class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                  Selesai
                </span>
              @endif
            </td>
            <td class="px-6 py-2 font-medium">
              {{ $student->answer_count }} / {{ $quiz->questions->count() }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
