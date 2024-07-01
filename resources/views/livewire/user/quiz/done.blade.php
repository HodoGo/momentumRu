<div>
  {{-- Do your work, then step back. --}}
  <div class="bg-white shadow-sm rounded-lg p-4 p-6 min-h-full text-center">
    <h6 class="text-momentum1 font-bold text-lg">Quiz Telah Selesai</h6>
    <img src="{{ asset('images/icons/check.png') }}" alt="" srcset="" class="h-56 mx-auto py-5">
    <a wire:navigate href="{{ route('quiz.history') }}" class="bg-momentum1 text-white font-medium text-lg px-3 py-1 rounded">
      Lihat history quiz
    </a>
  </div>
</div>
