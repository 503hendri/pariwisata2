<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky collapsible class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.header>
            <flux:sidebar.brand href="#" logo="{{ asset('storage/images/sawahlunto_tourism.png') }}"
                logo:dark="{{ asset('storage/images/sawahlunto_tourism.png') }}"
                name="{{ config('app.name', 'Laravel') }}" />
            <flux:sidebar.collapse
                class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
        </flux:sidebar.header>
        <flux:sidebar.nav>
            <flux:sidebar.item icon="home" href="{{ route('dashboard') }}" :current="request()->routeIs('dashboard')"
                wire:navigate>
                Home
            </flux:sidebar.item>
            <flux:sidebar.item icon="map" href="{{ route('admin.destinations.index') }}"
                :current="request()->routeIs('admin.destinations.*')" wire:navigate>
                Destinasi
            </flux:sidebar.item>
            <flux:sidebar.item icon="calendar-days" href="{{ route('admin.events') }}"
                :current="request()->routeIs('admin.events')" wire:navigate>
                Event
            </flux:sidebar.item>
            <flux:sidebar.item icon="rectangle-group" href="{{ route('admin.culinaries') }}"
                :current="request()->routeIs('admin.culinaries')" wire:navigate>
                Kuliner
            </flux:sidebar.item>
            <flux:sidebar.item icon="building-office-2" href="{{ route('admin.accomodations') }}"
                :current="request()->routeIs('admin.accomodations')" wire:navigate>
                Penginapan
            </flux:sidebar.item>
            <flux:sidebar.item icon="newspaper" href="{{ route('admin.news') }}"
                :current="request()->routeIs('admin.news')" wire:navigate>
                Berita
            </flux:sidebar.item>
            @role('editor')
                <flux:sidebar.group expandable icon="cog-6-tooth" heading="Settings" class="grid">
                    <flux:sidebar.item href="{{ route('users.index') }}" :current="request()->routeIs('users.*')"
                        wire:navigate>
                        Users
                    </flux:sidebar.item>
                    <flux:sidebar.item href="{{ route('admin.profile') }}" :current="request()->routeIs('admin.profile')"
                        wire:navigate>
                        Profile Website
                    </flux:sidebar.item>
                    {{-- <flux:sidebar.item href="#" wire:navigate>Permissions</flux:sidebar.item> --}}
                </flux:sidebar.group>
            @endrole
        </flux:sidebar.nav>
        <flux:sidebar.spacer />
        <flux:sidebar.nav>
            {{-- <flux:sidebar.item icon="cog-6-tooth" href="{{ route('settings.users') }}">Settings</flux:sidebar.item> --}}
            <flux:sidebar.item icon="information-circle" href="#">Help</flux:sidebar.item>
        </flux:sidebar.nav>
        <flux:dropdown position="top" align="start" class="max-lg:hidden">
            {{-- <flux:sidebar.profile avatar="{{ asset('storage/images/sawahlunto_tourism.png') }}"
                name="{{ auth()->user()->name }}" /> --}}
            <flux:button icon="user" variant="subtle">{{ auth()->user()->name }}</flux:button>
            <flux:menu>
                {{-- <flux:menu.radio.group>
                    <flux:menu.radio checked>{{ auth()->user()->name }}</flux:menu.radio>
                    <flux:menu.radio>Truly Delta</flux:menu.radio>
                </flux:menu.radio.group> --}}
                {{-- <flux:menu.separator /> --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                        class="w-full cursor-pointer">
                        Logout
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                        class="w-full cursor-pointer" data-test="logout-button">
                        {{ __('Log out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @fluxScripts
</body>

</html>
