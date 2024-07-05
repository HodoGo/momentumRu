<div class="flex h-screen">
  {{-- In work, do what you enjoy. --}}
  <div class="basis-6/12 bg-no-repeat bg-cover bg-center hidden md:block"
    style="background-image: url('{{ asset('images/login-bg.webp') }}')">
    <div class="w-full h-full backdrop-blur-sm bg-amber-400/[.65] grid place-items-center">
      <div class="w-6/12 text-white px-2">
        <i class="fa-solid fa-quote-left pb-5 text-amber-600"></i>
        <p class="ps-2 text-base">
          {{ $quote['quote'] }}
        </p>
        <p class="pt-8 font-medium text-lg">{{ $quote['name'] }}</p>
        <p class="text-end">
          <i class="fa-solid fa-angle-up rotate-[135deg] font-black text-4xl"></i>
        </p>
      </div>
    </div>
  </div>
  <div class="basis-full md:basis-6/12 flex flex-col">
    <div class="px-12 pt-2 hidden md:block">
      <img src="{{ asset('images/logo.webp') }}" alt="" srcset="" class="h-20">
    </div>
    <div class="grow grid place-items-center">
      <div class="w-96 md:w-6/12 px-2 md:py-5">
        <div class="pb-20 md:hidden">
          <img src="{{ asset('images/logo.webp') }}" alt="" srcset="" class="h-20 mx-auto">
        </div>
        <h6 class="font-bold text-xl text-momentum1">Login to your Account</h6>
        @if (flash()->message)
          <p class="text-sm text-red-400">{{ flash()->message }}</p>
        @endif
        <form action="" wire:submit="login">
          <div class="mt-4 mb-2 flex flex-col gap-y-2">
            <label for="username" class="text-gray-500 text-base">Username*</label>
            <input type="text" wire:model="username" name="username" id="username" placeholder="Enter username"
              class="shadow-[0px_5px_6px_0px_rgba(0,0,0,0.06)] px-5 py-2 rounded-md focus:outline-momentum1 placeholder-momentum1">
            @error('username')
              <livewire:components.input-error-message field="username" />
            @enderror
          </div>
          <div class="mb-5 flex flex-col gap-y-2">
            <label for="password" class="text-gray-500 text-base">Password*</label>
            <input type="password" wire:model="password" name="password" id="password" placeholder="Enter password"
              class="shadow-[0px_5px_6px_0px_rgba(0,0,0,0.06)] px-5 py-2 rounded-md focus:outline-momentum1 placeholder-momentum1">
            @error('password')
              <livewire:components.input-error-message field="password" />
            @enderror
          </div>
          <div>
            <button type="submit" class="bg-momentum1 text-white w-full px-5 py-2 rounded-lg font-medium">
              Login
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @push('script')
    <script src="{{ asset('build/assets/app-b9127d3d.js') }}"></script>
  @endpush
</div>
