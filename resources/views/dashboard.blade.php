<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="flex justify-between p-6 text-gray-900 dark:text-gray-100">

                    <a href="#"
                        class="w-[250px] h-[130px] block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Today</h5>
                        <p class="text-3xl font-normal text-gray-700 dark:text-gray-400">${{ $todaysSales ?? 'N/A' }}</p>
                    </a>
                    <a href="#"
                        class="w-[250px] h-[130px] block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Yesterday</h5>
                        <p class="text-3xl font-normal text-gray-700 dark:text-gray-400">${{ $yesterdaysSales ?? 'N/A' }}</p>
                    </a>
                    <a href="#"
                        class="w-[250px] h-[130px] block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">This Month</h5>
                        <p class="text-3xl font-normal text-gray-700 dark:text-gray-400">${{ $thisMonthsSales?? 'N/A' }}</p>
                    </a>
                    <a href="#"
                        class="w-[250px] h-[130px] block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Last Month </h5>
                        <p class="text-3xl font-normal text-gray-700 dark:text-gray-400">${{ $lastMonthsSales?? 'N/A' }}</p>
                    </a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
