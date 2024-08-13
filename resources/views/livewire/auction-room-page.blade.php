<div class="flex gap-5 p-10 mx-auto m-10 max-w-[65%]">
    <!-- Sidebar -->
    <div class="w-1/4 p-4 pr-4 bg-white rounded-lg shadow-lg">
        <h1 class="mb-4 text-3xl font-bold">{{ $auction->name }}</h1>
        <h2 class="mb-6 text-xl text-gray-700">Current Bid: ${{ $currentBid }}</h2>

        <div class="mb-6">
            <h3 class="mb-2 text-2xl font-semibold">Attenders:</h3>
            <ul class="list-disc list-inside">
                @foreach ($attenders as $attender)
                    <li class="flex gap-2 my-4 text-gray-800">
                        <img src="{{ $attender->image ? asset('storage/' . $attender->image) : asset('storage/unknown.jpg') }}"
                            alt="{{ $attender ? $attender->name : 'User' }}" class="object-cover w-8 h-8 rounded-full">
                        <span>{{ $attender ? $attender->name : 'Unknown User' }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Countdown Timer -->
        <div class="mb-6">
            <h3 class="text-2xl font-semibold">Auction Ends In:</h3>
            <div id="countdown-timer" class="text-xl font-bold text-red-500">
                <!-- Countdown Timer will be updated here -->
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex flex-col w-3/4 p-4 pl-4 bg-white rounded-lg shadow-lg">
        <h3 class="mb-2 text-2xl font-semibold">Bids:</h3>
        <div id="chat-container" class="flex-grow mb-6 overflow-y-auto" style="max-height: 500px;" x-data
            x-init="scrollToBottom();
            $watch('$el.scrollHeight', () => scrollToBottom())">
            <div class="flex flex-col-reverse space-y-4" wire:poll.keep-alive.2s>
                @foreach ($chats as $chat)
                    @php
                        $user = \App\Models\User::find($chat->user_id);
                    @endphp
                    <div class="flex items-start space-x-3 {{ $chat->user_id === $currentUserId ? 'justify-start' : 'justify-end' }} my-2"
                        wire:key="chat-{{ $chat->id }}">
                        @if ($chat->user_id !== $currentUserId)
                            <div class="flex-shrink-0">
                                <img src="{{ $user ? asset('storage/' . $user->image) : asset('storage/unknown.jpg') }}"
                                    alt="{{ $user ? $user->name : 'User' }}"
                                    class="object-cover w-10 h-10 rounded-full">
                            </div>
                        @endif
                        <div
                            class="flex-1 {{ $chat->user_id === $currentUserId ? 'bg-blue-100' : 'bg-gray-100' }} p-3 rounded-lg shadow-sm">
                            <div class="font-semibold text-gray-900">{{ $user ? $user->name : 'Unknown User' }}</div>
                            <div class="mt-1 text-gray-700">${{ $chat->price }}</div>
                            <div class="mt-1 text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($chat->message_time)->format('M d, Y h:i A') }}</div>
                        </div>
                        @if ($chat->user_id === $currentUserId)
                            <div class="flex-shrink-0">
                                <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('storage/unknown.jpg') }}"
                                    alt="{{ Auth::user()->name }}" class="object-cover w-10 h-10 rounded-full">
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        @if ($auction->status === 'ongoing')
            <form wire:submit.prevent="placeBid" class="space-y-4">
                <input type="number" wire:model="newBid" placeholder="Enter your bid"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <button type="submit"
                    class="w-full py-3 font-semibold text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">Place
                    Bid</button>
            </form>
        @else
            <div class="text-xl font-semibold text-red-500">The auction has ended.</div>
        @endif

    </div>
</div>

<script>
    function scrollToBottom() {
        const chatContainer = document.getElementById('chat-container');
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }
    // Update countdown timer
    updateCountdown();
    setInterval(updateCountdown, 1000);

    function updateCountdown() {
        const endTime = new Date("{{ $auction->end_date }}"); // Auction end time from your backend
        const now = new Date();
        const timeLeft = endTime - now;
        console.log(endTime);
        console.log(now);

        if (timeLeft <= 0) {
            document.getElementById("countdown-timer").innerHTML = "Auction Ended";
            clearInterval(this);
            Livewire.emit("auctionEnded");
            return;
        }

        const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        const hours = Math.floor(
            (timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
        );
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        document.getElementById(
            "countdown-timer"
        ).innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
    }
</script>
