<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="mb-4 text-lg font-semibold">Your Vaccine Records</h3>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Center Name</th>
                                    <th scope="col" class="px-6 py-3">Scheduled Date</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($vaccineRecords as $record)
                                    <tr class="border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $record->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            @if (is_null($record->pivot->scheduled_date))
                                                <span class="italic text-gray-500">To be scheduled</span>
                                            @else
                                                {{ $record->pivot->scheduled_date }}
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 py-1 rounded-full text-sm font-medium {{ match ($record->pivot->status->value) {
                                                    'not_scheduled' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                                    'scheduled' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                                    'vaccinated' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                                } }}">
                                                {{ ucfirst(str_replace('_', ' ', $record->pivot->status->value)) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            No records found.
                                        </th>
                                        <td class="px-6 py-4"></td>
                                        <td class="px-6 py-4"></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $vaccineRecords->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
