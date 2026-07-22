<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Dashboard</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                Selamat datang kembali, <span class="font-semibold text-blue-600">{{ auth()->user()->name }}</span>!
            </p>
        </div>
        <div class="flex items-center gap-2 text-sm text-gray-500">
            <x-icon name="calendar" class="w-4 h-4" />
            <span>{{ now()->format('l, d F Y') }}</span>
        </div>
    </div>

    <!-- Statistics Cards -->
    <livewire:admin.dashboard.statistic-card lazy />

    <!-- Charts and Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Chart Section -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Statistik Pengunjung</h3>
                <select class="text-sm border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-1 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                    <option>30 Hari Terakhir</option>
                    <option>7 Hari Terakhir</option>
                    <option>3 Bulan Terakhir</option>
                </select>
            </div>
            
            <!-- Simple Chart Representation -->
            <div class="h-64 flex items-end justify-between gap-2">
                @for ($i = 0; $i < 12; $i++)
                    <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-400 rounded-t-lg relative group cursor-pointer hover:from-blue-600 hover:to-blue-500 transition-colors duration-200"
                         style="height: {{ rand(40, 100) }}%">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                            {{ rand(100, 500) }} pengunjung
                        </div>
                    </div>
                @endfor
            </div>
            
            <div class="flex items-center justify-between mt-4 text-sm text-gray-600 dark:text-gray-400">
                <span>Jan</span>
                <span>Feb</span>
                <span>Mar</span>
                <span>Apr</span>
                <span>Mei</span>
                <span>Jun</span>
                <span>Jul</span>
                <span>Agu</span>
                <span>Sep</span>
                <span>Okt</span>
                <span>Nov</span>
                <span>Des</span>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Aktivitas Terbaru</h3>
            <div class="space-y-4">
                <!-- Activity Item 1 -->
                <div class="flex items-start gap-3">
                    <div class="bg-blue-100 p-2 rounded-lg">
                        <x-icon name="map-pin" class="w-4 h-4 text-blue-600" />
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Destinasi baru ditambahkan</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Pantai Kuta - 2 jam yang lalu</p>
                    </div>
                </div>

                <!-- Activity Item 2 -->
                <div class="flex items-start gap-3">
                    <div class="bg-green-100 p-2 rounded-lg">
                        <x-icon name="calendar-days" class="w-4 h-4 text-green-600" />
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Event dibuat</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Festival Budaya - 5 jam yang lalu</p>
                    </div>
                </div>

                <!-- Activity Item 3 -->
                <div class="flex items-start gap-3">
                    <div class="bg-orange-100 p-2 rounded-lg">
                        <x-icon name="utensils" class="w-4 h-4 text-orange-600" />
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Kuliner baru ditambahkan</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Warung Nasi Padang - 1 hari yang lalu</p>
                    </div>
                </div>

                <!-- Activity Item 4 -->
                <div class="flex items-start gap-3">
                    <div class="bg-purple-100 p-2 rounded-lg">
                        <x-icon name="building-office-2" class="w-4 h-4 text-purple-600" />
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Penginapan diperbarui</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Hotel Grand Bali - 2 hari yang lalu</p>
                    </div>
                </div>
            </div>

            <button class="w-full mt-4 text-center text-sm text-blue-600 hover:text-blue-700 font-medium">
                Lihat semua aktivitas
            </button>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.destinations.create') }}" 
               class="flex flex-col items-center gap-2 p-4 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/20 dark:hover:bg-blue-900/30 rounded-lg transition-colors duration-200">
                <x-icon name="plus-circle" class="w-8 h-8 text-blue-600" />
                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Tambah Destinasi</span>
            </a>
            
            <a href="#" 
               class="flex flex-col items-center gap-2 p-4 bg-green-50 hover:bg-green-100 dark:bg-green-900/20 dark:hover:bg-green-900/30 rounded-lg transition-colors duration-200">
                <x-icon name="plus-circle" class="w-8 h-8 text-green-600" />
                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Tambah Event</span>
            </a>
            
            <a href="#" 
               class="flex flex-col items-center gap-2 p-4 bg-orange-50 hover:bg-orange-100 dark:bg-orange-900/20 dark:hover:bg-orange-900/30 rounded-lg transition-colors duration-200">
                <x-icon name="plus-circle" class="w-8 h-8 text-orange-600" />
                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Tambah Kuliner</span>
            </a>
            
            <a href="{{ route('admin.accomodations') }}" 
               class="flex flex-col items-center gap-2 p-4 bg-purple-50 hover:bg-purple-100 dark:bg-purple-900/20 dark:hover:bg-purple-900/30 rounded-lg transition-colors duration-200">
                <x-icon name="plus-circle" class="w-8 h-8 text-purple-600" />
                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Tambah Penginapan</span>
            </a>
        </div>
    </div>
</div>
