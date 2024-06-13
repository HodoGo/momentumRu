<div class="flex flex-col gap-y-3">
  <nav class="bg-gray-100 px-3 pt-0 pb-1 rounded-md w-full text-gray-500 font-normal">
    <ol class="list-reset flex">
      <li>
        <a href="{{ route('home') }}" class="text-gray-500 text-nowrap">
          Home
        </a>
      </li>
      <li>
        <span class="mx-2">/</span>
      </li>
      <li>
        <a class="text-gray-500 text-nowrap">
          Profile
        </a>
      </li>
    </ol>
  </nav>
  {{-- Be like water. --}}
  <div class="bg-white shadow-sm rounded-lg p-4 p-6">
    <div class="flex gap-x-2 gap-y-3 md:gap-x-6 flex-wrap md:flex-nowrap">
      <div class="basis-full md:basis-auto">
        <img src="{{ asset('images/man2.png') }}" alt="" srcset="" class="md:h-36 bg-momentum1 rounded-lg">
      </div>
      <div class="md:grow flex flex-col justify-around md:py-0">
        <div class="">
          <h6 class="text-momentum1 text-xl font-medium">Ahmad Ikbal Djaya</h6>
          <p class="text-gray-400 font-medium text-sm">djaya_ikbal</p>
          <p class="text-gray-400 font-medium text-sm">Asal Sekolah : SMA Negeri 11 Pangkep</p>
          <p class="text-gray-400 font-medium text-sm">Jenis Kelamin: Laki-Laki</p>
        </div>
        <div class="flex flex-wrap md:flex-nowrap gap-y-3 gap-x-2 mt-3 md:mt-0 md:gap-x-8">
          <div class="flex gap-3">
            <div class="shadow px-3 py-2 rounded grid place-items-center">
              <i class="fa-solid fa-flag text-momentum1 text-lg"></i>
            </div>
            <div class="flex md:flex-col gap-x-1 items-center md:items-start">
              <h6 class="text-gray-400 text-xs md:text-lg font-bold">888</h6>
              <p class="text-gray-400 text-xs">Quiz Diselesaikan</p>
            </div>
          </div>
          <div class="flex gap-3">
            <div class="shadow px-3 py-2 rounded grid place-items-center">
              <i class="fa-solid fa-circle-check text-momentum1 text-lg"></i>
            </div>
            <div class="flex md:flex-col gap-x-1 items-center md:items-start">
              <h6 class="text-gray-400 text-xs md:text-lg font-bold">888</h6>
              <p class="text-gray-400 text-xs">Soal Dijawab</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-white shadow-sm rounded-lg p-4 p-6">
    <h1 class="text-momentum1 font-bold">Ganti Password</h1>
    <form action="">
      <div class="mt-4 mb-2 flex flex-col gap-y-2">
        <label for="password_old" class="text-gray-500 text-base">Password Saat Ini*</label>
        <input type="text" name="password_old" id="password_old" placeholder="Masukkan Password Saat Ini"
          class="shadow-[0px_5px_6px_0px_rgba(0,0,0,0.06)] md:w-1/2 px-5 py-2 rounded-md focus:outline-momentum1 placeholder-momentum1">
      </div>
      <div class="mt-4 mb-2 flex flex-col gap-y-2">
        <label for="new_password" class="text-gray-500 text-base">Password Baru*</label>
        <input type="text" name="new_password" id="new_password" placeholder="Masukkan Password Baru"
          class="shadow-[0px_5px_6px_0px_rgba(0,0,0,0.06)] md:w-1/2 px-5 py-2 rounded-md focus:outline-momentum1 placeholder-momentum1">
      </div>
      <div class="mt-4 mb-2 flex flex-col gap-y-2">
        <label for="new_password_confirmation" class="text-gray-500 text-base">Konfirmasi Password Baru*</label>
        <input type="text" name="new_password_confirmation" id="new_password_confirmation"
          placeholder="Masukkan Konfirmasi Password Baru"
          class="shadow-[0px_5px_6px_0px_rgba(0,0,0,0.06)] md:w-1/2 px-5 py-2 rounded-md focus:outline-momentum1 placeholder-momentum1">
      </div>
      <button class="bg-momentum1 text-white w-full px-5 py-2 rounded-lg font-medium md:w-1/2 mt-3">
        Ganti password
      </button>
    </form>
  </div>
</div>
