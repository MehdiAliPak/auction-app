@php
    use App\Helpers\AuctionHelper;
@endphp

<div class="w-full px-4 py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
  <section class="rounded-lg shadow-lg bg-gray-50 dark:bg-gray-800">
      <div class="px-4 py-6 mx-auto max-w-7xl lg:py-8 md:px-6">
          <div class="flex flex-wrap mb-24 -mx-3">
              <div class="w-full pr-2 lg:w-1/4 lg:block">
                  <div class="p-4 mb-5 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-900">
                      <h2 class="text-2xl font-semibold dark:text-gray-400">Categories</h2>
                      <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                      <ul>
                          @foreach ( $categories as $category )
                          <li wire:key="{{$category->id}}" class="mb-4">
                              <label for="{{$category->slug}}" class="flex items-center dark:text-gray-400">
                                  <input type="checkbox" wire:model.live="selected_categories" id="{{$category->slug}}" value="{{$category->id}}" class="w-4 h-4 mr-2">
                                  <span class="text-lg font-medium">{{$category->name}}</span>
                              </label>
                          </li>
                          @endforeach
                      </ul>
                  </div>
                  <div class="p-4 mb-5 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-900 dark:border-gray-700">
                      <h2 class="text-2xl font-semibold dark:text-gray-400">Auction Status</h2>
                      <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                      <ul>
                          <li class="mb-4">
                              <label for="registering" class="flex items-center dark:text-gray-400">
                                  <input type="checkbox" id="registering" wire:model.live="registering" value="1" class="w-4 h-4 mr-2">
                                  <span class="text-lg font-medium">Registering</span>
                              </label>
                          </li>
                          <li class="mb-4">
                              <label for="ongoing" class="flex items-center dark:text-gray-400">
                                  <input type="checkbox" id="ongoing" wire:model.live="ongoing" value="1" class="w-4 h-4 mr-2">
                                  <span class="text-lg font-medium">On Going</span>
                              </label>
                          </li>
                          <li class="mb-4">
                              <label for="finished" class="flex items-center dark:text-gray-400">
                                  <input type="checkbox" id="finished" wire:model.live="finished" value="1" class="w-4 h-4 mr-2">
                                  <span class="text-lg font-medium">Finished</span>
                              </label>
                          </li>
                      </ul>
                  </div>
              </div>
              <div class="w-full px-3 lg:w-3/4">
                  <div class="px-3 mb-4">
                    <div class="items-center justify-between hidden px-3 py-2 bg-gray-100 md:flex dark:bg-gray-900 ">
                      <div class="flex items-center justify-between">
                        <select wire:model.live="sort" class="block w-40 text-base bg-gray-100 cursor-pointer dark:text-gray-400 dark:bg-gray-900">
                          <option value="latest">Sort by latest</option>
                          <option value="price">Sort by Price</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="flex flex-wrap items-center">
                      @foreach ( $auctions as $auction )
                      <div wire:key="{{$auction->id}}" class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3">
                          <div class="overflow-hidden border border-gray-300 rounded-lg shadow-sm dark:border-gray-700">
                              <div class="relative bg-gray-200">
                                  <a href="/auctions/{{$auction->id}}" class="">
                                      <img src="{{url('storage', $auction->images[0])}}" alt="{{$auction->name}}" class="object-cover w-full h-56 mx-auto">
                                  </a>
                              </div>
                              <div class="p-4">
                                  <div class="flex items-center justify-between gap-2 mb-2">
                                      <h3 class="text-xl font-semibold dark:text-gray-400">
                                          {{$auction->name}}
                                      </h3>
                                  </div>
                                  <p class="text-lg">
                                      <span class="text-green-600 dark:text-green-600">{{ Number::currency($auction->base_price) }}</span>
                                  </p>
                              </div>
                              <div class="flex justify-center p-4 border-t border-gray-300 dark:border-gray-700">
                                  <a href="#" class="flex items-center space-x-2 text-gray-500 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-300">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-cart3" viewBox="0 0 16 16">
                                          <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                                      </svg>
                                      <span>Add to Cart</span>
                                  </a>
                              </div>
                          </div>
                      </div>
                      @endforeach
                  </div>
                  <!-- pagination start -->
                  <div class="flex justify-end mt-6">
                      {{ $auctions->links('vendor.pagination.default')}}
                  </div>
                  <!-- pagination end -->
              </div>
          </div>
      </div>
  </section>
</div>
