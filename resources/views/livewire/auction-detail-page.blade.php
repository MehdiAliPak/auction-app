@php
    use Carbon\Carbon;
@endphp
<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="overflow-hidden bg-white py-11 font-poppins dark:bg-gray-800">
        <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full mb-8 md:w-1/2 md:mb-0" x-data="{ mainImage: '{{ url('storage', $auction->images[0]) }}' }">
                    <div class="sticky top-0 z-50 overflow-hidden ">
                        <div class="relative mb-6 lg:mb-10 lg:h-2/4 ">
                            <img x-bind:src="mainImage" alt="" class="object-cover w-full lg:h-full ">
                        </div>
                        <div class="flex-wrap hidden md:flex ">
                            @foreach ($auction->images as $image)
                                <div class="w-1/2 p-2 sm:w-1/4" x-on:click="mainImage='{{ url('storage', $image) }}'">
                                    <img src="{{ url('storage', $image) }}" alt="{{ $auction->name }}"
                                        class="object-cover w-full cursor-pointer lg:h-20 hover:border hover:border-blue-500">
                                </div>
                            @endforeach
                        </div>
                        <div class="px-6 pb-6 mt-6 border-t border-gray-300 dark:border-gray-400 ">
                            {{-- <div class="flex flex-wrap items-center mt-6">
                  <span class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 text-gray-700 dark:text-gray-400 bi bi-truck" viewBox="0 0 16 16">
                      <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z">
                      </path>
                    </svg>
                  </span>
                  <h2 class="text-lg font-bold text-gray-700 dark:text-gray-400">Free Shipping</h2>
                </div> --}}
                        </div>
                    </div>
                </div>
                <div class="w-full px-4 md:w-1/2 ">
                    <div class="lg:pl-20">
                        <div class="mb-8 [&>ul]:list-disc [&>ul]:ml-4">
                            <h2 class="max-w-xl mb-6 text-2xl font-bold dark:text-gray-400 md:text-4xl">
                                {{ $auction->name }}</h2>
                            <p class="inline-block mb-6 text-2xl font-bold text-gray-700 dark:text-gray-400 ">
                                <span>Base Price:</span>
                                <span>{{ Number::currency($auction->base_price) }}</span>
                                {{-- <span class="text-base font-normal text-gray-500 line-through dark:text-gray-400">$1800.99</span> --}}
                            </p>
                            <p class="max-w-md text-gray-700 dark:text-gray-400">
                                {!! Str::markdown($auction->description) !!}
                            </p>
                            @if ($auction->file)
                                <a href="{{ asset('storage/' . $auction->file) }}" download
                                    class="inline-flex items-center gap-2 px-4 py-2 mt-4 text-sm font-semibold text-white bg-blue-500 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z" />
                                    </svg>
                                    Download PDF
                                </a>
                            @endif
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-base">
                                by <span class="font-medium">{{ $auction->auctionOwner->name }}</span>
                            </p>
                            <span
                                class="
                                    {{ $auction->status == 'accepted' ? 'bg-blue-500 text-white' : 'bg-green-500 text-white' }}
                                    px-2 py-1 rounded text-sm
                                ">
                                {{ $auction->status == 'accepted' ? 'Registering' : 'OnGoing' }}
                            </span>
                        </div>
                        <div class="flex justify-between mt-2">
                            <p class="text-base">
                                {{ $auction->status == 'accepted' ? 'Starts in:' : 'Time remaining:' }}
                            </p>
                            <p class="text-base">
                                @php
                                    $endDate = Carbon::parse($auction->end_date);
                                    $now = Carbon::now();
                                    $diff = $endDate->diff($now);
                                @endphp
                                @if ($auction->status == 'accepted')
                                    {{ $auction->start_date }}
                                @else
                                    @if ($now->lt($endDate))
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
                                    @else
                                        Auction has ended.
                                    @endif
                                @endif
                            </p>
                        </div>
                        <div class="flex mt-5">
                            @auth
                                @if (in_array($auction->id, $registeredAuctions) && $auction->status == 'accepted')
                                    <span
                                        class="flex items-center px-4 py-2 space-x-2 text-gray-500 border cursor-default dark:text-gray-400">
                                        Registered
                                    </span>
                                @elseif (in_array($auction->id, $registeredAuctions) && $auction->status == 'ongoing')
                                    <a href="#"
                                        class="flex items-center px-4 py-2 space-x-2 text-gray-500 border rounded cursor-pointer dark:text-gray-400 hover:text-red-500 dark:hover:text-red-300 hover:border-red-400 dark:hover:border-red-300">
                                        <span>
                                            Start to Bid
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-up-right-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.854 10.803a.5.5 0 1 1-.708-.707L9.243 6H6.475a.5.5 0 1 1 0-1h3.975a.5.5 0 0 1 .5.5v3.975a.5.5 0 1 1-1 0V6.707z" />
                                        </svg>
                                    </a>
                                @else
                                    <a wire:click.prevent='registerToAuction({{ $auction->id }})'
                                        class="flex items-center px-4 py-2 space-x-2 text-gray-500 border rounded cursor-pointer dark:text-gray-400 hover:text-red-500 dark:hover:text-red-300 hover:border-red-400 dark:hover:border-red-300">
                                        <span wire:loading.remove wire:target='registerToAuction({{ $auction->id }})'>
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
                                    class="flex items-center px-2 py-1 space-x-2 text-white bg-green-400 border rounded dark:hover:text-white hover:bg-green-500">
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
            </div>
        </div>
</div>
</section>
</div>
