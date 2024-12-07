<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Vaccine') }}
        </h2>
    </x-slot>

    <div class="flex flex-col items-center bg-gray-100 sm:justify-center sm:pt-0 dark:bg-gray-900">
        <div class="w-full px-6 pb-6 mt-10 overflow-hidden bg-white shadow-md sm:max-w-md dark:bg-gray-800 sm:rounded-lg">
            <form method="POST" action="{{ route('vaccine.store') }}" class="space-y-8">
                @csrf

                <div class="max-w-md mx-auto">
                    <label for="vaccine_center" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Vaccine Center</label>
                    <select name="vaccine_center" id="vaccine_center"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-3"
                        required>
                        <option value="" selected>Choose a center</option>
                        @foreach ($centers as $center)
                            <option value="{{ $center->id }}">
                                {{ $center->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('vaccine_center')" class="mt-2" />
                </div>

                <x-primary-button>{{ __('Submit') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
