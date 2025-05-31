<div>
    <div class="py-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col space-y-6">

                    {{-- Header Info User --}}
                    <div class="flex items-center gap-4 border-b border-base-200 dark:border-gray-700 pb-4">
                        <div class="avatar">
                            <div class="w-12 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img
                                    src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff"
                                    alt="{{ $user->name }}"
                                />
                            </div>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-lg font-semibold">{{ $user->name }}</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Sedang ngobrol</p>
                        </div>
                        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-ghost">← Kembali</a>
                    </div>

                    {{-- Chat Container --}}
                    <div
                        wire:poll
                        id="chat-container"
                        class="space-y-6 overflow-y-auto pr-2"
                        style="max-height: 60vh;"
                    >
                        @foreach ($messages as $message)
                            <div class="flex items-start gap-3 {{ $message->form_user_id == auth()->id() ? 'flex-row-reverse' : '' }}">

                                {{-- Avatar --}}
                                <div class="avatar">
                                    <div class="w-10 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                        <img
                                            alt="{{ $message->formUser->name }}"
                                            src="https://ui-avatars.com/api/?name={{ urlencode($message->formUser->name) }}&background=random&color=fff"
                                            loading="lazy"
                                        />
                                    </div>
                                </div>

                                {{-- Chat Bubble --}}
                                <div class="flex flex-col max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg">
                                    <div class="text-sm text-gray-600 dark:text-gray-300 flex justify-between mb-1">
                                        <span class="font-semibold">{{ $message->formUser->name }}</span>
                                        <span class="text-xs">{{ $message->created_at->diffForHumans() }}</span>
                                    </div>

                                    <div class="bg-base-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 p-3 rounded-lg shadow space-y-2">
                                        @if ($message->message)
                                            <p class="whitespace-pre-wrap break-words">{{ $message->message }}</p>
                                        @endif

                                        @if ($message->image)
                                            <a href="{{ asset('storage/' . $message->image) }}"
                                               download="chat-image-{{ $message->id }}"
                                               class="block rounded-lg overflow-hidden hover:opacity-90 transition"
                                               title="Download Gambar">
                                                <img
                                                    src="{{ asset('storage/' . $message->image) }}"
                                                    alt="Gambar"
                                                    class="max-w-full object-cover rounded-lg"
                                                    style="max-height: 300px;"
                                                />
                                            </a>
                                        @endif
                                    </div>

                                    @if ($message->form_user_id == auth()->id())
                                        <div class="text-xs mt-1 text-gray-500 dark:text-gray-400">
                                            {{ $message->is_read ? '✓✓ Terbaca' : '✓ Terkirim' }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Form Input Pesan --}}
                    <div class="form-control mt-6">
                        <form wire:submit.prevent="sendMessage" class="flex items-end gap-3 flex-wrap sm:flex-nowrap">

                            {{-- Textarea --}}
                            <textarea
                                class="textarea textarea-bordered w-full resize-none dark:bg-gray-800 dark:text-gray-100"
                                rows="2"
                                wire:model.defer="message"
                                placeholder="Tulis Pesan di sini..."
                                required
                            ></textarea>

                            {{-- Upload Gambar Icon --}}
                            <div class="relative">
                                <label for="photo-upload" class="btn btn-square btn-ghost p-2 cursor-pointer" title="Upload gambar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v16a1 1 0 01-1 1H4a1 1 0 01-1-1V4z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M3 10l4-4 3 3 4-4 5 5v5H3v-5z" />
                                    </svg>
                                </label>
                                <input id="photo-upload" type="file" wire:model="photo" class="hidden" accept="image/*" />

                                @if ($photo)
                                    <div class="text-xs text-success mt-1">📎 Gambar siap diunggah</div>
                                @endif
                            </div>

                            {{-- Tombol Kirim --}}
                            <button type="submit" class="btn btn-primary whitespace-nowrap">Kirim</button>
                        </form>

                        @error('message') <p class="text-error mt-1 text-sm">{{ $message }}</p> @enderror
                        @error('photo') <p class="text-error mt-1 text-sm">{{ $message }}</p> @enderror
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('livewire:load', () => {
        const chatContainer = document.getElementById('chat-container');

        Livewire.hook('message.processed', () => {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        });
    });
</script>
@endpush
