<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				{{ __('Dashboard') }}
		</h2>
</x-slot>

@if ($modal)
		@include('livewire.create')
@endif

<div class="py-8">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white overflow-hidden">
						<div class="min-w-screen min-h-screen flex justify-center bg-gray-100 font-sans overflow-hidden">
								<div class="w-full lg:w-5/6">
										@if (session()->has('message'))
												<div class="bg-gradient-to-r from-red-400 to-yellow-500 text-white px-4 py-2.5 rounded mb-6" role="alert">
														<div class="flex">
																<div class="">
																		<div class="text-sm">{{ session('message') }}</div>
																</div>
														</div>
												</div>
										@endif
										@if (session()->has('errMessage'))
												<div class="bg-gradient-to-r from-red-400 to-yellow-500 text-white px-4 py-2.5 rounded mb-6" role="alert">
														<div class="flex">
																<div class="">
																		<div class="text-sm">{{ session('errMessage') }}</div>
																</div>
														</div>
												</div>
										@endif
										<button wire:click="openModal()"
												class="py-2 px-4 bg-blue-700 hover:bg-blue-800 rounded-md text-white font-bold">+ Add Data</button>

										<div class="bg-white shadow-md rounded my-6">
												<table class="min-w-max w-full table-auto">
														<thead>
																<tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
																		<th class="py-3 px-6 text-left">Name</th>
																		<th class="py-3 px-6 text-center">Food</th>
																		<th class="py-3 px-6 text-center">Kind</th>
																		<th class="py-3 px-6 text-center">Actions</th>
																</tr>
														</thead>
														<tbody class="text-gray-600 text-sm font-light">
																@forelse ($animals as $animal)
																		<tr class="border-b border-gray-200 hover:bg-gray-100">
																				<td class="py-3 px-6 text-left">
																						<div class="flex items-center">
																								<span>{{ $animal->name }}</span>
																						</div>
																				</td>
																				<td class="py-3 px-6 text-center">
																						<div class="flex items-center justify-center">
																								{{ $animal->food }}
																						</div>
																				</td>
																				<td class="py-3 px-6 text-center">
																						<span
																								class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{ $animal->kind }}</span>
																				</td>
																				<td class="py-3 px-6 text-center">
																						<div class="flex item-center justify-center">
																								<button wire:click="edit({{ $animal->id }})"
																										class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
																										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
																												stroke="currentColor">
																												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
																														d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
																										</svg>
																								</button>
																								<div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
																										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
																												stroke="currentColor">
																												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
																														d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
																										</svg>
																								</div>
																						</div>
																				</td>
																		</tr>
																@empty
																		<h1 class="text-center font-bold text-2xl text-gray-800">
																				Data not found
																		</h1>
																@endforelse
														</tbody>
												</table>
										</div>
										{{ $animals->links() }}
								</div>
						</div>
				</div>
		</div>
</div>
