<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Contact Create
    </h2>
</x-slot>
<div class="p-10 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <div class="flex flex-wrap -mx-3 mb-6">
        <form class="flex flex-wrap w-full" wire:submit.prevent="store">
            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Name
                </label>
                <input wire:model.lazy="name" value="" class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('name') border-red-500 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-300" id="grid-first-name" type="text" placeholder="Jane">
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Phone
                </label>
                <input wire:model.lazy="phone" class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('phone') border-red-500 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-300" id="grid-last-name" type="text" placeholder="+628126498">
                @error('phone')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Status
                </label>
                    <select  wire:model.lazy="status" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8  @error('status') border-red-500 @enderror rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                    <option value="">Select </option>
                    <option value="1">Active</option>
                    <option value="2">Inactive</option>
                  </select>
                @error('status')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Photo
                </label>
                <input wire:model="photo" class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('photo') border-red-500 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-300" type="file">
                @error('photo')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
                {{-- <div wire:loading wire:target="photo" class="text-sm text-gray-500 italic">Uploading...</div> --}}
                <svg wire:loading wire:target="photo" class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-600"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
            </div>
            <div class="flex items-center ml-3 mt-4">
                <button type="submit" class="inline-flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    <svg wire:loading wire:target="store" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                      </svg>
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>