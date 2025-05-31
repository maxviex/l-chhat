<x-master-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Daftar Pengguna</h1>

                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($users as $user)
                        <div class="flex items-center justify-between py-4">
                            <div class="flex items-center gap-4">
                                <div class="avatar">
                                    <div class="w-12 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                        <img
                                            src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff"
                                            alt="{{ $user->name }}"
                                        />
                                    </div>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800 dark:text-white">
                                        {{ $user->name }}
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Terakhir aktif {{ $user->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <a href="{{ route('chat', $user) }}" class="btn btn-outline btn-primary btn-sm">
                                Chat
                            </a>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Tidak ada pengguna lain.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-master-layout>
