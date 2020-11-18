    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Contacts
        </h2>
    </x-slot>
    <div>

        <a href="contact/create"
            class="mr-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Contact</a>

        <div class="p-10 bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @if (session()->has('message'))
                <div
                    class="text-green-800 px-6 py-4 border border-green-600 rounded relative mb-4 bg-green-300 bg-opacity-50">
                    <span class="inline-block align-middle mr-8">
                        {{ session('message') }}
                    </span>
                    <button
                        class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
                        <span>×</span>
                    </button>
                </div>
            @endif
            <div class="flex mb-3">
                <div class="w-ful">
                    <select wire:model="paginate" class="border border-gray-300 rounded p-2">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>

                <div class="w-ful ml-auto">
                    <input wire:model="search" class="rounded border border-gray-300 p-2" placeholder="Search...">
                </div>

            </div>

            <div class="relative flex items-start">
                <div class="flex items-center h-5">
                    <input wire:model="active" id="active" type="checkbox"
                        class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                </div>
                <div class="ml-3 text-sm leading-5">
                    <label for="active" class="font-medium text-gray-700">Active?</label>
                </div>
            </div>
            <table class="table-fixed w-full">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2 w-1/12">#</th>
                        <th class="px-6 py-3 text-left">
                            <div class="flex items-center">Name
                                <button wire:click="sortBy('name')"class="mx-1">
                                <x-sort-icon field="name" :sortField="$sortField" :sortAsc="$sortAsc" /></button>
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left">
                            <div class="flex items-center">Phone
                                <button wire:click="sortBy('phone')" class="mx-1">
                                <x-sort-icon field="phone" :sortField="$sortField" :sortAsc="$sortAsc" /></button>
                            </div>
                        </th>
                        <th class="px-4 py-2 w-1/6">Status</th>
                        <th class="px-4 py-2 w-1/6">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contacts as $contact)
                        <tr>
                            <td class="border px-4 py-2">{{ $contact->id }}</td>
                            <td class="border px-4 py-2">{{ $contact->name }}</td>
                            <td class="border px-4 py-2">{{ $contact->phone }}</td>
                            <td class="border px-4 py-2">{{ $contact->status }}</td>
                            <td class="flex flex-wrap border px-4 py-2">
                                <a href="{{ route('contact.edit', $contact->id) }}"
                                    class="mr-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                <button wire:click="destroy({{ $contact->id }})"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>Not Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-5">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
