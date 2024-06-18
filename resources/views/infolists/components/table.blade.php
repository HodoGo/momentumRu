<div {{ $attributes }}>
  {{ $getChildComponentContainer() }}
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-300">
      <thead class="bg-gray-50">
        <tr>
          <th class="py-2 px-4 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Ranking</th>
          <th class="py-2 px-4 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Nama</th>
          <th class="py-2 px-4 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Sekolah</th>
          <th class="py-2 px-4 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Nilai</th>
          <th class="py-2 px-4 border-b border-gray-300 text-left text-sm font-medium text-gray-700"></th>
        </tr>
      </thead>
      <tbody>
        {{-- {{ $getRecord() }} --}}
        @foreach ($getRecord()->student_quiz as $student_quiz)
          <tr class="hover:bg-gray-100">
            <td class="py-2 px-4 border-b border-gray-300">{{ $loop->iteration }}</td>
            <td class="py-2 px-4 border-b border-gray-300" style="color: black">{{ $student_quiz->student->name }}</td>
            {{-- <td class="py-2 px-4 border-b border-gray-300">{{ $user->name }}</td>
            <td class="py-2 px-4 border-b border-gray-300">{{ $user->email }}</td>
            <td class="py-2 px-4 border-b border-gray-300">
              <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
              <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Delete</button>
              </form>
            </td> --}}
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
