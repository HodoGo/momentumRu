<div>
  {{-- Because she competes with no one, no one can compete with her. --}}
  <div wire:click="openModal" class="flex justify-between items-center md:gap-x-28 pb-6 cursor-pointer md:cursor-default">
    <div class="md:grow flex gap-x-1 items-center">
      <img src="{{ asset('images/icons/parchment.png') }}" class="w-10 h-10 rounded-full bg-gray-300 md:hidden" />
      <div class="md:grow flex flex-col md:flex-row md:justify-between text-nowrap text-xs md:text-base font-medium">
        <p class="text-black">Quiz 1</p>
        <p class="text-gray-500 md:text-black">Pilihan Ganda</p>
      </div>
    </div>
    <div
      class="md:grow flex md:justify-between flex-col md:flex-row text-nowrap text-xs md:text-base font-medium text-end">
      <p class="text-black">12/12/24 10:20</p>
      <p class="text-gray-500 md:text-black">Nilai: 85/100</p>
    </div>
    <div class="hidden md:block">
      <button wire:click="openModal" class="bg-momentum1 text-white px-3 rounded font-medium">Detail</button>
    </div>
  </div>

  @if ($isOpen)
    <div wire:click="closeModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
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
            <p>: Ahmad Ikbal Djaya</p>
            <p>Nama Quiz</p>
            <p>: Quiz 1</p>
            <p>Jenis Soal</p>
            <p>: Pilihan Ganda</p>
            <p>Tanggal Pengerjaan</p>
            <p>: 12/12/24 10:20</p>
            <p>Durasi Pengerjaan</p>
            <p>: 25 menit</p>
            <p>Jumlah Soal</p>
            <p>: 25 Soal</p>
            <p>Jumlah Soal Dijawab</p>
            <p>: 23/25</p>
            <p>Nilai </p>
            <p>: 89 / 100</p>
          </div>
        </div>
        <div class="border-t px-4 py-2 flex justify-end">
          <button wire:click="closeModal" class="px-4 py-1 bg-gray-200 rounded mr-2">Tutup</button>
          {{-- <button class="px-4 py-2 bg-blue-500 text-white rounded">Confirm</button> --}}
        </div>
      </div>
    </div>
  @endif
</div>
