<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Destinations Card -->
    <div
        class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg hover:shadow-xl transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm font-medium">Destinasi</p>
                <p class="text-3xl font-bold mt-2">{{ $this->destinations }}</p>
                <p class="text-blue-100 text-xs mt-1">+3 bulan ini</p>
            </div>
            <div class="bg-white/20 p-3 rounded-lg">
                <x-icon name="map-pin" class="w-6 h-6" />
            </div>
        </div>
    </div>

    <!-- Events Card -->
    <div
        class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg hover:shadow-xl transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-green-100 text-sm font-medium">Event</p>
                <p class="text-3xl font-bold mt-2">{{ $this->events }}</p>
                <p class="text-green-100 text-xs mt-1">+5 bulan ini</p>
            </div>
            <div class="bg-white/20 p-3 rounded-lg">
                <x-icon name="calendar-days" class="w-6 h-6" />
            </div>
        </div>
    </div>

    <!-- Culinary Card -->
    <div
        class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl p-6 text-white shadow-lg hover:shadow-xl transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-orange-100 text-sm font-medium">Kuliner</p>
                <p class="text-3xl font-bold mt-2">{{ $this->culinary }}</p>
                <p class="text-orange-100 text-xs mt-1">+8 bulan ini</p>
            </div>
            <div class="bg-white/20 p-3 rounded-lg">
                <x-icon name="utensils" class="w-6 h-6" />
            </div>
        </div>
    </div>

    <!-- Accommodations Card -->
    <div
        class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white shadow-lg hover:shadow-xl transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-100 text-sm font-medium">Penginapan</p>
                <p class="text-3xl font-bold mt-2">{{ $this->accommodations }}</p>
                <p class="text-purple-100 text-xs mt-1">+2 bulan ini</p>
            </div>
            <div class="bg-white/20 p-3 rounded-lg">
                <x-icon name="building-office-2" class="w-6 h-6" />
            </div>
        </div>
    </div>
</div>

@placeholder
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Skeleton Card 1 -->
        <div class="bg-gradient-to-br from-blue-400/50 to-blue-500/50 rounded-xl p-6 animate-pulse">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="h-4 bg-white/30 rounded w-20 mb-3"></div>
                    <div class="h-10 bg-white/40 rounded w-16 mb-2"></div>
                    <div class="h-3 bg-white/20 rounded w-24"></div>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-lg"></div>
            </div>
        </div>

        <!-- Skeleton Card 2 -->
        <div class="bg-gradient-to-br from-green-400/50 to-green-500/50 rounded-xl p-6 animate-pulse" style="animation-delay: 0.1s">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="h-4 bg-white/30 rounded w-16 mb-3"></div>
                    <div class="h-10 bg-white/40 rounded w-14 mb-2"></div>
                    <div class="h-3 bg-white/20 rounded w-20"></div>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-lg"></div>
            </div>
        </div>

        <!-- Skeleton Card 3 -->
        <div class="bg-gradient-to-br from-orange-400/50 to-orange-500/50 rounded-xl p-6 animate-pulse" style="animation-delay: 0.2s">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="h-4 bg-white/30 rounded w-16 mb-3"></div>
                    <div class="h-10 bg-white/40 rounded w-16 mb-2"></div>
                    <div class="h-3 bg-white/20 rounded w-20"></div>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-lg"></div>
            </div>
        </div>

        <!-- Skeleton Card 4 -->
        <div class="bg-gradient-to-br from-purple-400/50 to-purple-500/50 rounded-xl p-6 animate-pulse" style="animation-delay: 0.3s">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="h-4 bg-white/30 rounded w-20 mb-3"></div>
                    <div class="h-10 bg-white/40 rounded w-14 mb-2"></div>
                    <div class="h-3 bg-white/20 rounded w-24"></div>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-lg"></div>
            </div>
        </div>
    </div>
@endplaceholder
