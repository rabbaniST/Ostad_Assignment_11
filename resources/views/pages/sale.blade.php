<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Sale Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">

                @if(session('error'))
            
                <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=> show = false, 3000)" class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                    <div class="mx-auto max-w-7xl">{{ session('error') }}</div>
                </div>  
                @endif
                
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form class="max-w-sm mx-auto" method="POST" action="{{ route('product.saleStore') }}">
                        @csrf
                        <div class="mb-5">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer
                                Name</label>
                            <input type="text" id="customer_name" name="customer_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                                @error('customer_name')
                                    <p class="text-red-600">{{ $message }}</p>
                                @enderror
                        </div>
                        <div class="mb-5">
                            <label for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                Name</label>

                            <select name="product_name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                                <option value="">Select a product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                @endforeach
                            </select>
                            @error('product_name')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                            
                        </div>
                        <div class="mb-5">
                            <label for="quantity"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                Quantity</label>
                            <input type="number" id="quantity" name="quantity"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                                @error('quantity')
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sale</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
