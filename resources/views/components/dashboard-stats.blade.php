<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    @foreach($stats as $stat)
        <div class="flex items-center bg-white shadow rounded-lg px-5 py-4">
            <div class="flex-shrink-0">
                <span class="inline-flex items-center justify-center h-12 w-12 rounded-full {{ $stat['bg'] }}">
                    <i class="{{ $stat['icon'] }} text-2xl {{ $stat['icon_color'] }}"></i>
                </span>
            </div>
            <div class="ml-4">
                <div class="text-sm text-gray-500 font-medium">{{ $stat['label'] }}</div>
                <div class="text-2xl font-bold text-gray-800">{{ $stat['value'] }}</div>
            </div>
        </div>
    @endforeach
</div> 