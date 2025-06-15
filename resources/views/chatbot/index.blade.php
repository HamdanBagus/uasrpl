<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chatbot Tanaman') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-teal-100 via-cyan-50 to-sky-100 dark:from-teal-800 dark:via-cyan-900 dark:to-sky-900 min-h-[calc(100vh-4rem)]"> {{-- Gradient lebih lembut, tinggi minimum untuk mengisi layar --}}
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8"> {{-- Max-width sedikit diperbesar --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-xl"> {{-- Shadow lebih kuat, rounded lebih besar --}}
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl lg:text-3xl font-bold text-gray-800 dark:text-white mb-6 border-b-2 pb-4 border-teal-300 dark:border-teal-700 text-center flex items-center justify-center">
                        <svg class="w-8 h-8 mr-3 text-teal-500 dark:text-teal-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-3.86 8.25-8.625 8.25S3.75 16.556 3.75 12s3.86-8.25 8.625-8.25S21 7.444 21 12z" />
                        </svg>
                        Ngobrol dengan AgriBot!
                    </h3>

                    <div id="chat-box" class="border border-gray-200 dark:border-gray-700 p-4 h-96 overflow-y-auto mb-4 rounded-lg bg-gray-50 dark:bg-gray-700/50 flex flex-col space-y-4 shadow-inner custom-scrollbar">
                        {{-- Pesan awal dari bot --}}
                        <div class="flex items-start space-x-2">
                            {{-- Avatar Bot --}}
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-teal-500 dark:bg-teal-600 flex items-center justify-center text-white shadow-md">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.486 2 2 5.589 2 10C2 11.894 2.784 13.622 4.049 15H2V20H7C11.973 20 16 15.973 16 11C16 10.261 15.903 9.54 15.72 8.848C14.797 8.304 13.462 8 12 8C10.432 8 9.018 8.344 7.972 8.928C9.141 7.074 10.857 6 12.797 6C13.036 6 13.273 6.013 13.509 6.036C13.123 5.392 12.939 4.869 12.939 4.529C12.939 3.492 13.565 3 14.333 3C14.921 3 15.299 3.359 15.512 3.815C16.441 3.298 17.458 3 18.529 3C20.399 3 22 4.251 22 6.061C22 7.254 21.294 8.274 20.23 8.801C20.084 9.507 20 10.239 20 11C20 11.133 19.994 11.265 19.987 11.396C20.621 12.077 21 12.977 21 14C21 15.939 18.467 18 15 18C14.218 18 13.483 17.861 12.809 17.607C12.551 17.861 12.282 18.091 12 18.299C11.718 18.091 11.449 17.861 11.191 17.607C10.517 17.861 9.782 18 9 18C8.533 18 8.092 17.961 7.671 17.891L7.003 17.755L7.027 17.751L7.016 17.748C5.043 17.018 4 15.692 4 14C4 12.271 6.019 10.897 8.5 10.262V10C8.5 9.411 8.038 9 7.5 9C6.962 9 6.5 9.411 6.5 10L6.482 10.003C5.002 10.073 4.152 10.752 3.65 11.592C3.116 12.299 2.826 13.152 2.826 14.061C2.826 14.176 2.831 14.291 2.839 14.405C3.288 12.932 4.398 12 6 12C7.31 12 8.5 12.957 8.5 14.5C8.5 15.766 7.632 16.424 7 16.5C6.902 16.424 6.58 16.065 6.58 15.589C6.58 15.016 7.161 14.747 7.5 14.747C7.839 14.747 8.012 15.016 8.012 15.284C8.012 15.624 7.689 16.082 7.003 16.225L7.001 16.225C7.39 16.03 7.73 15.784 8.012 15.491C8.012 15.405 8.002 15.316 8.002 15.227C8.002 14.887 8.186 14.364 8.186 13.827C8.186 12.789 7.56 12.459 6.792 12.459C6.024 12.459 5.694 12.789 5.694 13.129C5.694 13.215 5.704 13.304 5.704 13.39C5.256 14.863 4.146 15.541 2.839 15.595C2.831 15.709 2.826 15.824 2.826 15.939C2.826 17.074 3.694 18 5.063 18H5.13C5.486 18.392 6.082 18.85 7 18.972V19H4V16C3.337 15.364 3.036 14.848 3.036 14.5C3.036 13.471 4.206 13 5.375 13C5.913 13 6.272 13.411 6.272 13.95C6.272 14.036 6.262 14.125 6.262 14.211C6.71 15.684 7.82 16.362 9.127 16.405L9.125 16.405C9.471 16.013 10.067 15.555 10.925 15.433L11 15.422C11.718 15.139 12.282 14.575 12.282 13.95C12.282 12.887 11.113 12 9.744 12C9.206 12 8.847 11.589 8.847 11.05C8.847 10.964 8.856 10.875 8.856 10.789C8.309 9.316 7.199 8.638 5.892 8.595L5.875 8.595C5.529 8.987 4.933 9.445 4.075 9.567L4 9.578V10C4 10.589 4.462 11 5 11C5.538 11 6 10.589 6 10L6.018 9.997C7.498 9.927 8.348 9.248 8.85 8.408C9.384 7.701 9.674 6.848 9.674 5.939C9.674 5.824 9.669 5.709 9.661 5.595C9.212 4.122 8.102 3.445 6.792 3.393L6.775 3.393C6.429 3.001 5.833 2.543 4.975 2.421L5 2.41C5.718 2.127 6.282 1.563 6.282 1.05C6.282 0.013 7.451 0 8.82 0C9.358 0 9.717 0.411 9.717 0.95C9.717 1.036 9.708 1.125 9.708 1.211C10.156 2.684 11.266 3.362 12.573 3.405L12.575 3.405C12.921 3.013 13.517 2.555 14.375 2.433L14.5 2.422C15.218 2.139 15.782 1.575 15.782 1.05C15.782 0.013 16.951 0 18.32 0C20.19 0 21.061 1.131 21.061 2.061C21.061 3.013 20.19 4 18.32 4C17.581 4 17.038 3.859 16.686 3.63C16.787 4.438 17 5.176 17 6C17 6.962 16.716 7.815 16.266 8.529C16.838 8.781 17.314 9 17.797 9C18.036 9 18.273 8.987 18.509 8.964C18.123 8.32 17.939 7.797 17.939 7.457C17.939 6.42 18.565 6 19.333 6C19.921 6 20.299 6.359 20.512 6.815C21.441 6.298 22.458 6 23.529 6C23.794 6 24 6.206 24 6.471C24 6.735 23.794 6.941 23.529 6.941C22.575 6.941 21.743 7.186 21.061 7.58C21.319 8.223 21.461 8.909 21.461 9.625C21.461 10.551 21.188 11.431 20.71 12.185C20.901 12.773 21 13.375 21 14C21 14.047 20.999 14.092 20.998 14.138C20.99 14.252 20.977 14.366 20.961 14.479L20.939 14.625L20.939 14.641C20.388 16.125 19.27 17 17.5 17C16.189 17 15 16.043 15 14.5C15 13.234 15.868 12.576 16.5 12.5C16.598 12.576 16.92 12.935 16.92 13.411C16.92 13.984 16.339 14.253 16 14.253C15.661 14.253 15.488 13.984 15.488 13.716C15.488 13.376 15.811 12.918 16.497 12.775L16.503 12.775C16.115 12.978 15.778 13.23 15.497 13.527C15.497 13.617 15.507 13.71 15.507 13.803C15.507 14.147 15.327 14.674 15.327 15.215C15.327 16.257 15.957 16.591 16.729 16.591C17.501 16.591 17.835 16.257 17.835 15.913C17.835 15.823 17.828 15.73 17.828 15.638C18.281 14.156 19.399 13.473 20.71 13.415L20.725 13.415C20.977 13.017 21.577 12.555 22.439 12.433L22.5 12.422C23.218 12.139 23.782 11.575 23.782 11.05C23.782 10.013 22.613 10 21.244 10C20.706 10 20.347 10.411 20.347 10.95C20.347 11.036 20.356 11.125 20.356 11.211C19.908 12.684 18.798 13.362 17.491 13.405L17.475 13.405C17.129 13.013 16.533 12.555 15.675 12.433L15.5 12.422C14.782 12.139 14.218 11.575 14.218 11.05C14.218 10.013 13.049 10 11.68 10C11.142 10 10.783 10.411 10.783 10.95C10.783 11.036 10.792 11.125 10.792 11.211C11.24 12.684 12.35 13.362 13.657 13.405L13.625 13.405L13.657 13.405C13.971 13.032 14.497 12.617 15.203 12.484L15.25 12.475C15.467 12.13 15.736 11.803 16.039 11.516C15.438 11.032 14.729 10.739 13.939 10.604C13.576 10.152 13.086 10 12.529 10C12.29 10 12.053 10.013 11.817 10.036C12.203 10.68 12.387 11.203 12.387 11.543C12.387 12.58 11.761 13 10.993 13C10.405 13 10.027 12.641 9.814 12.185C8.885 12.702 7.868 13 6.797 13C4.927 13 4 11.749 4 9.939C4 8.746 4.706 7.726 5.77 7.199C5.916 6.493 6 5.761 6 5C6 4.867 5.994 4.735 5.987 4.604C5.353 3.923 5 3.023 5 2C5 0.061 7.533 0 11 0C11.782 0 12.517 0.139 13.191 0.393C12.933 0.139 12.664 0 12.382 0L12 0Z"/>
                                </svg>
                            </div>
                            {{-- Bubble Bot --}}
                            <div class="bg-teal-100 dark:bg-teal-700 text-teal-800 dark:text-teal-50 p-3 rounded-t-xl rounded-br-xl max-w-[75%] shadow-md">
                                <p>Halo! Saya AgriBot. Tanyakan apa saja tentang tanaman atau lahan Anda.</p>
                            </div>
                        </div>
                    </div>

                    <form id="chat-form" class="flex items-center gap-3">
                        @csrf
                        <input type="text" id="user-message" name="message" placeholder="Ketik pesan Anda di sini..."
                               class="flex-grow rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-teal-500 focus:ring-teal-500 p-3 transition-shadow duration-150 focus:shadow-md" required>
                        <button type="submit" class="px-5 py-3 bg-teal-600 text-white rounded-lg shadow-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 flex items-center justify-center transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2 transform -rotate-45 -translate-y-px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3.105 3.106a.75.75 0 01.814-.182l14.25 8.25a.75.75 0 010 1.322l-14.25 8.25a.75.75 0 01-.814-.182l-.028-.028a.75.75 0 01.028-1.028l3.857-3.857a.75.75 0 011.06-.028l4.303 2.484a.75.75 0 001.06-.028l3.857-3.857a.75.75 0 000-1.06l-3.857-3.857a.75.75 0 00-1.06-.028L8.02 8.49a.75.75 0 01-1.06-.028L3.105 4.574a.75.75 0 010-1.06l.028-.028z" />
                            </svg>
                            Kirim
                        </button>
                    </form>

                    <p id="error-message" class="text-red-500 dark:text-red-400 text-sm mt-3 hidden text-center font-medium"></p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const botAvatarHtml = `
                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-teal-500 dark:bg-teal-600 flex items-center justify-center text-white shadow-md">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.486 2 2 5.589 2 10C2 11.894 2.784 13.622 4.049 15H2V20H7C11.973 20 16 15.973 16 11C16 10.261 15.903 9.54 15.72 8.848C14.797 8.304 13.462 8 12 8C10.432 8 9.018 8.344 7.972 8.928C9.141 7.074 10.857 6 12.797 6C13.036 6 13.273 6.013 13.509 6.036C13.123 5.392 12.939 4.869 12.939 4.529C12.939 3.492 13.565 3 14.333 3C14.921 3 15.299 3.359 15.512 3.815C16.441 3.298 17.458 3 18.529 3C20.399 3 22 4.251 22 6.061C22 7.254 21.294 8.274 20.23 8.801C20.084 9.507 20 10.239 20 11C20 11.133 19.994 11.265 19.987 11.396C20.621 12.077 21 12.977 21 14C21 15.939 18.467 18 15 18C14.218 18 13.483 17.861 12.809 17.607C12.551 17.861 12.282 18.091 12 18.299C11.718 18.091 11.449 17.861 11.191 17.607C10.517 17.861 9.782 18 9 18C8.533 18 8.092 17.961 7.671 17.891L7.003 17.755L7.027 17.751L7.016 17.748C5.043 17.018 4 15.692 4 14C4 12.271 6.019 10.897 8.5 10.262V10C8.5 9.411 8.038 9 7.5 9C6.962 9 6.5 9.411 6.5 10L6.482 10.003C5.002 10.073 4.152 10.752 3.65 11.592C3.116 12.299 2.826 13.152 2.826 14.061C2.826 14.176 2.831 14.291 2.839 14.405C3.288 12.932 4.398 12 6 12C7.31 12 8.5 12.957 8.5 14.5C8.5 15.766 7.632 16.424 7 16.5C6.902 16.424 6.58 16.065 6.58 15.589C6.58 15.016 7.161 14.747 7.5 14.747C7.839 14.747 8.012 15.016 8.012 15.284C8.012 15.624 7.689 16.082 7.003 16.225L7.001 16.225C7.39 16.03 7.73 15.784 8.012 15.491C8.012 15.405 8.002 15.316 8.002 15.227C8.002 14.887 8.186 14.364 8.186 13.827C8.186 12.789 7.56 12.459 6.792 12.459C6.024 12.459 5.694 12.789 5.694 13.129C5.694 13.215 5.704 13.304 5.704 13.39C5.256 14.863 4.146 15.541 2.839 15.595C2.831 15.709 2.826 15.824 2.826 15.939C2.826 17.074 3.694 18 5.063 18H5.13C5.486 18.392 6.082 18.85 7 18.972V19H4V16C3.337 15.364 3.036 14.848 3.036 14.5C3.036 13.471 4.206 13 5.375 13C5.913 13 6.272 13.411 6.272 13.95C6.272 14.036 6.262 14.125 6.262 14.211C6.71 15.684 7.82 16.362 9.127 16.405L9.125 16.405C9.471 16.013 10.067 15.555 10.925 15.433L11 15.422C11.718 15.139 12.282 14.575 12.282 13.95C12.282 12.887 11.113 12 9.744 12C9.206 12 8.847 11.589 8.847 11.05C8.847 10.964 8.856 10.875 8.856 10.789C8.309 9.316 7.199 8.638 5.892 8.595L5.875 8.595C5.529 8.987 4.933 9.445 4.075 9.567L4 9.578V10C4 10.589 4.462 11 5 11C5.538 11 6 10.589 6 10L6.018 9.997C7.498 9.927 8.348 9.248 8.85 8.408C9.384 7.701 9.674 6.848 9.674 5.939C9.674 5.824 9.669 5.709 9.661 5.595C9.212 4.122 8.102 3.445 6.792 3.393L6.775 3.393C6.429 3.001 5.833 2.543 4.975 2.421L5 2.41C5.718 2.127 6.282 1.563 6.282 1.05C6.282 0.013 7.451 0 8.82 0C9.358 0 9.717 0.411 9.717 0.95C9.717 1.036 9.708 1.125 9.708 1.211C10.156 2.684 11.266 3.362 12.573 3.405L12.575 3.405C12.921 3.013 13.517 2.555 14.375 2.433L14.5 2.422C15.218 2.139 15.782 1.575 15.782 1.05C15.782 0.013 16.951 0 18.32 0C20.19 0 21.061 1.131 21.061 2.061C21.061 3.013 20.19 4 18.32 4C17.581 4 17.038 3.859 16.686 3.63C16.787 4.438 17 5.176 17 6C17 6.962 16.716 7.815 16.266 8.529C16.838 8.781 17.314 9 17.797 9C18.036 9 18.273 8.987 18.509 8.964C18.123 8.32 17.939 7.797 17.939 7.457C17.939 6.42 18.565 6 19.333 6C19.921 6 20.299 6.359 20.512 6.815C21.441 6.298 22.458 6 23.529 6C23.794 6 24 6.206 24 6.471C24 6.735 23.794 6.941 23.529 6.941C22.575 6.941 21.743 7.186 21.061 7.58C21.319 8.223 21.461 8.909 21.461 9.625C21.461 10.551 21.188 11.431 20.71 12.185C20.901 12.773 21 13.375 21 14C21 14.047 20.999 14.092 20.998 14.138C20.99 14.252 20.977 14.366 20.961 14.479L20.939 14.625L20.939 14.641C20.388 16.125 19.27 17 17.5 17C16.189 17 15 16.043 15 14.5C15 13.234 15.868 12.576 16.5 12.5C16.598 12.576 16.92 12.935 16.92 13.411C16.92 13.984 16.339 14.253 16 14.253C15.661 14.253 15.488 13.984 15.488 13.716C15.488 13.376 15.811 12.918 16.497 12.775L16.503 12.775C16.115 12.978 15.778 13.23 15.497 13.527C15.497 13.617 15.507 13.71 15.507 13.803C15.507 14.147 15.327 14.674 15.327 15.215C15.327 16.257 15.957 16.591 16.729 16.591C17.501 16.591 17.835 16.257 17.835 15.913C17.835 15.823 17.828 15.73 17.828 15.638C18.281 14.156 19.399 13.473 20.71 13.415L20.725 13.415C20.977 13.017 21.577 12.555 22.439 12.433L22.5 12.422C23.218 12.139 23.782 11.575 23.782 11.05C23.782 10.013 22.613 10 21.244 10C20.706 10 20.347 10.411 20.347 10.95C20.347 11.036 20.356 11.125 20.356 11.211C19.908 12.684 18.798 13.362 17.491 13.405L17.475 13.405C17.129 13.013 16.533 12.555 15.675 12.433L15.5 12.422C14.782 12.139 14.218 11.575 14.218 11.05C14.218 10.013 13.049 10 11.68 10C11.142 10 10.783 10.411 10.783 10.95C10.783 11.036 10.792 11.125 10.792 11.211C11.24 12.684 12.35 13.362 13.657 13.405L13.625 13.405L13.657 13.405C13.971 13.032 14.497 12.617 15.203 12.484L15.25 12.475C15.467 12.13 15.736 11.803 16.039 11.516C15.438 11.032 14.729 10.739 13.939 10.604C13.576 10.152 13.086 10 12.529 10C12.29 10 12.053 10.013 11.817 10.036C12.203 10.68 12.387 11.203 12.387 11.543C12.387 12.58 11.761 13 10.993 13C10.405 13 10.027 12.641 9.814 12.185C8.885 12.702 7.868 13 6.797 13C4.927 13 4 11.749 4 9.939C4 8.746 4.706 7.726 5.77 7.199C5.916 6.493 6 5.761 6 5C6 4.867 5.994 4.735 5.987 4.604C5.353 3.923 5 3.023 5 2C5 0.061 7.533 0 11 0C11.782 0 12.517 0.139 13.191 0.393C12.933 0.139 12.664 0 12.382 0L12 0Z"/>
                    </svg>
                </div>`;

            const userAvatarHtml = `
                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-indigo-500 dark:bg-indigo-600 flex items-center justify-center text-white shadow-md">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>`;

            function addMessage(sender, message) {
                let chatBox = $('#chat-box');
                let messageHtml;
                // Escape HTML to prevent XSS
                const escapedMessage = $('<div>').text(message).html();

                if (sender === 'user') {
                    messageHtml = `
                        <div class="flex justify-end items-start space-x-2">
                            <div class="bg-indigo-500 dark:bg-indigo-600 text-white p-3 rounded-t-xl rounded-bl-xl max-w-[75%] shadow-md">
                                <p class="break-words">${escapedMessage}</p>
                            </div>
                            ${userAvatarHtml}
                        </div>`;
                } else { // bot
                    messageHtml = `
                        <div class="flex items-start space-x-2">
                            ${botAvatarHtml}
                            <div class="bg-teal-100 dark:bg-teal-700 text-teal-800 dark:text-teal-50 p-3 rounded-t-xl rounded-br-xl max-w-[75%] shadow-md">
                                <p class="break-words">${escapedMessage}</p>
                            </div>
                        </div>`;
                }
                chatBox.append(messageHtml);
                chatBox.scrollTop(chatBox[0].scrollHeight);
            }

            $('#chat-form').on('submit', function(e) {
                e.preventDefault();
                let userMessage = $('#user-message').val();
                let errorMessage = $('#error-message');

                if (userMessage.trim() === '') {
                    errorMessage.removeClass('hidden').text('Pesan tidak boleh kosong.');
                    return;
                }

                addMessage('user', userMessage);
                errorMessage.addClass('hidden').text('');

                // Menampilkan pesan "Bot sedang mengetik..."
                let typingIndicatorHtml = `
                    <div id="typing-indicator" class="flex items-start space-x-2">
                        ${botAvatarHtml}
                        <div class="bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 p-3 rounded-t-xl rounded-br-xl max-w-[75%] shadow-md">
                            <p class="italic">AgriBot sedang mengetik...</p>
                        </div>
                    </div>`;
                $('#chat-box').append(typingIndicatorHtml);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);


                $.ajax({
                    url: "{{ route('chatbot.sendMessage') }}", // Pastikan route ini ada
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content') || "{{ csrf_token() }}", // Fallback jika meta tag tidak ada
                        message: userMessage
                    },
                    success: function(response) {
                        $('#typing-indicator').remove(); // Hapus indikator mengetik
                        addMessage('bot', response.response);
                        $('#user-message').val('');
                    },
                    error: function(xhr, status, error) {
                        $('#typing-indicator').remove(); // Hapus indikator mengetik jika error
                        console.error("Error:", xhr.responseText);
                        // Coba tampilkan pesan error dari server jika ada
                        let serverError = 'Gagal mengirim pesan. Silakan coba lagi.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            serverError = xhr.responseJSON.message;
                        } else if (xhr.responseText) {
                            try {
                                const parsedError = JSON.parse(xhr.responseText);
                                if(parsedError.message) serverError = parsedError.message;
                            } catch (e) { /* abaikan jika bukan JSON */ }
                        }
                        addMessage('bot', 'Maaf, terjadi kesalahan: ' + serverError);
                        // errorMessage.removeClass('hidden').text(serverError); // Alternatif: tampilkan di bawah input
                    }
                });
            });
        });
    </script>
    @endpush

    @push('styles')
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1; /* Light mode track */
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #888; /* Light mode thumb */
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #555; /* Light mode thumb hover */
        }

        /* Dark mode scrollbar styles (jika Anda menggunakan toggle dark mode global) */
        .dark .custom-scrollbar::-webkit-scrollbar-track {
            background: #2d3748; /* Dark mode track (sesuaikan dengan bg-gray-800 atau bg-gray-700/50) */
        }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #4a5568; /* Dark mode thumb (sesuaikan dengan warna yang kontras) */
        }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #718096; /* Dark mode thumb hover */
        }
        .break-words {
            word-break: break-word;
        }
    </style>
    @endpush
</x-app-layout>