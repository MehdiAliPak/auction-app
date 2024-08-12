@php
    use Carbon\Carbon;
@endphp

<div class="w-full px-4 py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <section class="rounded-lg shadow-lg bg-gray-50 dark:bg-gray-800">
        <div class="px-4 py-6 mx-auto max-w-7xl lg:py-8 md:px-6">
            <div class="flex flex-wrap mb-24 -mx-3">
                <div class="w-full pr-2 lg:w-1/4 lg:block">
                    <div
                        class="p-4 mb-5 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-900">
                        <h2 class="text-2xl font-semibold dark:text-gray-400">Categories</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <ul>
                            @foreach ($categories as $category)
                                <li wire:key="{{ $category->id }}" class="mb-4">
                                    <label for="{{ $category->slug }}" class="flex items-center dark:text-gray-400">
                                        <input type="checkbox" wire:model.live="selected_categories"
                                            id="{{ $category->slug }}" value="{{ $category->id }}" class="w-4 h-4 mr-2">
                                        <span class="text-lg font-medium">{{ $category->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div
                        class="p-4 mb-5 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-900 dark:border-gray-700">
                        <h2 class="text-2xl font-semibold dark:text-gray-400">Auction Status</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <ul>
                            <li class="mb-4">
                                <label for="registering" class="flex items-center dark:text-gray-400">
                                    <input type="checkbox" id="registering" wire:model.live="registering" value="1"
                                        class="w-4 h-4 mr-2">
                                    <span class="text-lg font-medium">Registering</span>
                                </label>
                            </li>
                            <li class="mb-4">
                                <label for="ongoing" class="flex items-center dark:text-gray-400">
                                    <input type="checkbox" id="ongoing" wire:model.live="ongoing" value="1"
                                        class="w-4 h-4 mr-2">
                                    <span class="text-lg font-medium">On Going</span>
                                </label>
                            </li>
                            {{-- <li class="mb-4">
                                <label for="finished" class="flex items-center dark:text-gray-400">
                                    <input type="checkbox" id="finished" wire:model.live="finished" value="1"
                                        class="w-4 h-4 mr-2">
                                    <span class="text-lg font-medium">Finished</span>
                                </label>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                <div class="w-full px-3 lg:w-3/4">
                    <div class="px-3 mb-4">
                        <div
                            class="items-center justify-between hidden px-3 py-2 bg-gray-100 md:flex dark:bg-gray-900 ">
                            <div class="flex items-center justify-between">
                                <select wire:model.live="sort"
                                    class="block w-40 text-base bg-gray-100 cursor-pointer dark:text-gray-400 dark:bg-gray-900">
                                    <option value="latest">Sort by latest</option>
                                    <option value="price">Sort by Price</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center">
                        @foreach ($auctions as $auction)
                            <div wire:key="{{ $auction->id }}" class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3">
                                <div
                                    class="overflow-hidden border border-gray-300 rounded-lg shadow-sm dark:border-gray-700">
                                    <div class="relative bg-gray-200">
                                        <a href="/auctions/{{ $auction->id }}" class="">
                                            <img src="{{ url('storage', $auction->images[0]) }}"
                                                alt="{{ $auction->name }}" class="object-cover w-full h-56 mx-auto">
                                        </a>
                                    </div>
                                    <div class="p-4">
                                        <div class="flex items-center justify-between gap-2 mb-2">
                                            <h3 class="text-xl font-semibold dark:text-gray-400">
                                                {{ $auction->name }}
                                            </h3>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm">
                                                by <span class="font-medium">{{ $auction->auctionOwner->name }}</span>
                                            </p>
                                            <span
                                                class="
                                                {{ $auction->status == 'accepted' ? 'bg-blue-500 text-white' : 'bg-green-500 text-white' }}
                                                px-2 py-1 rounded text-xs
                                            ">
                                                {{ $auction->status == 'accepted' ? 'Registering' : 'OnGoing' }}
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-between mt-2">
                                            <p class="text-sm">
                                                <span class="font-medium">Base Price:</span>
                                            </p>
                                            <span class="px-2 py-1 text-xs rounded">
                                                {{ Number::currency($auction->base_price) }}
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <p class="text-sm">
                                                {{ $auction->status == 'accepted' ? 'Starts in:' : 'Time remaining:' }}
                                            </p>
                                            <p class="text-sm">
                                                @php
                                                    $endDate = Carbon::parse($auction->end_date);
                                                    $now = Carbon::now();

                                                    // Check if auction has ended
                                                    $hasEnded = $now->greaterThanOrEqualTo($endDate);

                                                    // Calculate the difference only if the auction has not ended
                                                    if (!$hasEnded) {
                                                        $diff = $now->diff($endDate);
                                                    }
                                                @endphp

                                                @if ($auction->status == 'accepted')
                                                    {{ $auction->start_date }}
                                                @else
                                                    @if ($hasEnded)
                                                        Auction has ended.
                                                    @else
                                                        {{-- Display time remaining --}}
                                                        @if (isset($diff))
                                                            @if ($diff->days > 0)
                                                                {{ $diff->days }} d
                                                            @endif
                                                            @if ($diff->h > 0 || $diff->days > 0)
                                                                {{ $diff->h }} h
                                                            @endif
                                                            @if ($diff->i > 0 || $diff->h > 0 || $diff->days > 0)
                                                                {{ $diff->i }} m
                                                            @endif
                                                            @if ($diff->s > 0 || $diff->i > 0 || $diff->h > 0 || $diff->days > 0)
                                                                {{ $diff->s }} s
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex justify-center p-4 border-t border-gray-300 dark:border-gray-700">
                                        @auth
                                            @if (in_array($auction->id, $registeredAuctions) && $auction->status == 'accepted')
                                                <span
                                                    class="flex items-center space-x-2 text-gray-500 cursor-default dark:text-gray-400">
                                                    Registered
                                                </span>
                                            @elseif (in_array($auction->id, $registeredAuctions) && $auction->status == 'ongoing')
                                                <a href="#"
                                                    class="flex items-center space-x-2 text-gray-500 cursor-pointer dark:text-gray-400 hover:text-red-500 dark:hover:text-red-300">
                                                    <span>
                                                        Start to Bid
                                                    </span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-arrow-up-right-circle"
                                                        viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.854 10.803a.5.5 0 1 1-.708-.707L9.243 6H6.475a.5.5 0 1 1 0-1h3.975a.5.5 0 0 1 .5.5v3.975a.5.5 0 1 1-1 0V6.707z" />
                                                    </svg>
                                                </a>
                                            @else
                                                <a wire:click.prevent='registerToAuction({{ $auction->id }})'
                                                    class="flex items-center space-x-2 text-gray-500 cursor-pointer dark:text-gray-400 hover:text-red-500 dark:hover:text-red-300">
                                                    <span wire:loading.remove
                                                        wire:target='registerToAuction({{ $auction->id }})'>
                                                        Register
                                                    </span>
                                                    <span wire:loading
                                                        wire:target='registerToAuction({{ $auction->id }})'>Registering...</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                                    </svg>
                                                </a>
                                            @endif
                                        @else
                                            <a wire:navigate href="/login"
                                                class="flex items-center space-x-2 text-gray-500 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-300">
                                                <span>Login to Register</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                                </svg>
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- pagination start -->
                    <div class="flex justify-end mt-6">
                        {{ $auctions->links('vendor.pagination.default') }}
                    </div>
                    <!-- pagination end -->
                </div>
            </div>
        </div>
    </section>
</div>
