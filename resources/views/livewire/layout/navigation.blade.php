<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav class="bg-[#fdfde2] border-b border-gray-200 shadow-md relative">
    <div x-data="{ open: false }" @click.away="open = false" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" wire:navigate class="flex items-center space-x-2">
                        <img src="{{ asset('images/logo.png') }}" class="w-6 h-auto" alt="Logo">
                        <h1 class="text-3xl font-light gray-color">Easy</h1>
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 px-1 py-2 transition-colors duration-200" wire:navigate>
                    Home
                </a>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-4 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white text-sm font-medium mr-2">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <!-- Profile -->
                        <x-dropdown-link href="{{ route('profile', ['user' => Auth::user()->username]) }}" wire:navigate class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <p class="text-sm font-medium text-gray-900" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></p>
                        </x-dropdown-link>

                        <!-- Settings -->
                        <x-dropdown-link :href="route('settings')" wire:navigate class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ __('Settings') }}
                        </x-dropdown-link>

                        <div class="border-t border-gray-100">
                            <!-- Authentication -->
                            <button wire:click="logout" class="w-full text-left flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                {{ __('Log Out') }}
                            </button>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Toggle Button -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    
                    <!-- Hamburger Icon -->
                    <svg x-show="!open" x-cloak class="h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                    <!-- Close Icon -->
                    <svg x-show="open" x-cloak class="h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div x-show="open"
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="sm:hidden absolute top-full left-0 right-0 bg-white border-t border-gray-200 shadow-lg z-50 w-full">
             
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}"
                   wire:navigate
                   @click="open = false"
                   class="block w-full px-4 py-3 text-base font-medium text-gray-700 bg-white hover:bg-gray-100">
                    Home
                </a>
                <a href="#"
                   @click="open = false"
                   class="block w-full px-4 py-3 text-base font-medium text-gray-700 bg-white hover:bg-gray-100">
                    About
                </a>
                <a href="#"
                   @click="open = false"
                   class="block w-full px-4 py-3 text-base font-medium text-gray-700 bg-white hover:bg-gray-100">
                    Contact
                </a>
            </div>

            <!-- User Info and Actions -->
            <div class="pt-4 pb-1 border-t border-gray-200 bg-white">
                <div class="px-4 pb-3">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-medium mr-3">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="font-medium text-base text-gray-800">{{ auth()->user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <a href="{{ route('profile', ['user' => Auth::user()->username]) }}" wire:navigate @click="open = false"
                       class="flex items-center px-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 border-l-4 border-transparent hover:border-indigo-300 bg-white w-full">
                        {{ __('Profile') }}
                    </a>

                    <a href="{{ route('settings') }}" wire:navigate @click="open = false"
                       class="flex items-center px-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 border-l-4 border-transparent hover:border-indigo-300 bg-white w-full">
                        {{ __('Settings') }}
                    </a>

                    <button wire:click="logout" @click="open = false"
                            class="w-full text-left flex items-center px-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 border-l-4 border-transparent hover:border-indigo-300 bg-white">
                        {{ __('Log Out') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>