<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Contact Edit
    </h2>
</x-slot>
<div class="p-10 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
    id: {{ $contactId }}

    <div class="flex flex-wrap -mx-3 mb-6">
        <form class="flex flex-wrap w-full" wire:submit.prevent="update" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <input type="hidden" wire:model="contactId">
            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Name
                </label>
                <input wire:model.lazy="name"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('name') border-red-500 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-first-name" type="text" placeholder="Jane">
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Phone
                </label>
                <input wire:model.lazy="phone"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('phone') border-red-500 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-last-name" type="text" placeholder="+628126498">
                @error('phone')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Status {{$status}}
                </label>
                <select wire:model="status"
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8  @error('status') border-red-500 @enderror rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-state">
                    <option value="">Select </option>
                    @foreach($statuses as $status)
                    <option value="{{ $status->id }}">{{$status->name}}</option>
                    @endforeach
                  </select>
                @error('status')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Photo
                </label>
                <input wire:model="photo"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('photo') border-red-500 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-300"
                    type="file">
                @error('photo')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
                {{-- <div wire:loading wire:target="photo"
                    class="text-sm text-gray-500 italic">Uploading...</div> --}}
                <div class="mt-4">
                    @if ($photo)
                        <img src="{{ $photo->temporaryUrl() }}" class="md:w-1/2" alt="temp">
                    @elseif ($currentPhoto)
                        <img src="{{ Storage::url("contact/{$currentPhoto}") }}" alt="cover image">
                    @endif
                </div>
            </div>
            <div class="flex items-center ml-3 mt-4">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
