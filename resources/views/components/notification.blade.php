<div x-data="{ 
    notifications: [],
    add(message, type = 'success', title = '') {
        const id = Date.now();
        this.notifications.push({ id, message, type, title });
        setTimeout(() => this.remove(id), 5000);
    },
    remove(id) {
        this.notifications = this.notifications.filter(notification => notification.id !== id);
    }
}" 
    @notification.window="add($event.detail.message, $event.detail.type, $event.detail.title)"
    class="fixed inset-0 z-50 pointer-events-none flex items-center justify-center"
>
    <div class="absolute top-0 left-0 right-0 bottom-0 bg-black/50 transition-opacity duration-500"
         :class="notifications.length > 0 ? 'opacity-100' : 'opacity-0'"
         style="backdrop-filter: blur(8px);">
    </div>

    <div class="relative w-full max-w-md px-4">
        <template x-for="notification in notifications" :key="notification.id">
            <div 
                x-show="true"
                x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-y-2 opacity-0 scale-95"
                x-transition:enter-end="translate-y-0 opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="mb-4 w-full bg-white rounded-2xl shadow-2xl overflow-hidden pointer-events-auto transform transition-all"
                style="box-shadow: 0 15px 40px rgba(0,0,0,0.15);"
            >
                <div class="relative">
                    <button @click="remove(notification.id)" 
                            class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 transition-colors duration-200">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <div class="p-6 flex flex-col items-center text-center">
                        <template x-if="notification.type === 'success'">
                            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100 mb-4">
                                <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </template>
                        <template x-if="notification.type === 'error'">
                            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-red-100 mb-4">
                                <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </template>

                        <h3 class="text-xl font-bold text-slate-800 mb-2"
                            x-text="notification.type === 'success' ? 'Berhasil!' : 'Gagal!'">
                        </h3>

                        <p class="text-lg text-gray-600" x-text="notification.message"></p>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>