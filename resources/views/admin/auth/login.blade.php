<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - MunchGud</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        mg: {
                            green: '#1B4332',
                            dark: '#111827',
                            muted: '#6B7280'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-screen w-screen overflow-hidden bg-gray-50 flex items-center justify-center">

    <div class="w-full max-w-md px-6">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <img src="{{ \App\Models\Setting::get('company_logo') ? Storage::url(\App\Models\Setting::get('company_logo')) : asset('images/logo.jpg') }}" alt="MunchGud" class="h-14 w-auto mx-auto object-contain rounded-xl shadow-sm mb-5">
            <h2 class="text-2xl font-bold tracking-tight text-mg-dark">
                Admin Portal
            </h2>
            <p class="mt-1.5 text-sm text-mg-muted font-medium">
                Sign in to manage your store
            </p>
        </div>

        <!-- Card -->
        <div class="bg-white py-8 px-8 shadow-sm rounded-2xl border border-gray-100/80">
            
            <!-- Error Alerts -->
            @if ($errors->any())
                <div class="rounded-xl bg-red-50 p-4 mb-6 border border-red-100">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-red-800">Authentication failed</h3>
                            <div class="mt-1 text-sm text-red-700 font-medium">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="block text-xs font-bold text-gray-500 uppercase tracking-wider">Email address</label>
                    <div class="mt-2 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-4.5 w-4.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                               class="block w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 text-gray-900 shadow-sm placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mg-green focus:border-mg-green sm:text-sm sm:leading-6 outline-none transition"
                               placeholder="admin@munchgud.com">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-gray-500 uppercase tracking-wider">Password</label>
                    <div class="mt-2 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-4.5 w-4.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="block w-full pl-11 pr-11 py-3 rounded-xl border border-gray-200 text-gray-900 shadow-sm placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mg-green focus:border-mg-green sm:text-sm sm:leading-6 outline-none transition"
                               placeholder="••••••••">
                        <button type="button" 
                                onclick="toggleAdminPassword()"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-700 focus:outline-none transition cursor-pointer" 
                                id="togglePasswordBtn"
                                title="Show password"
                                aria-label="Toggle password visibility">
                            <!-- Eye Open (shown when type=password) -->
                            <svg id="eyeOpenIcon" class="w-5 h-5 transition-transform active:scale-90" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <!-- Eye Slash (shown when type=text) -->
                            <svg id="eyeSlashIcon" class="w-5 h-5 hidden text-emerald-600 transition-transform active:scale-90" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <script>
                    function toggleAdminPassword() {
                        var input = document.getElementById('password');
                        var openIcon = document.getElementById('eyeOpenIcon');
                        var slashIcon = document.getElementById('eyeSlashIcon');
                        var btn = document.getElementById('togglePasswordBtn');
                        if (!input) return;

                        if (input.type === 'password') {
                            input.type = 'text';
                            openIcon.classList.add('hidden');
                            slashIcon.classList.remove('hidden');
                            btn.title = 'Hide password';
                        } else {
                            input.type = 'password';
                            openIcon.classList.remove('hidden');
                            slashIcon.classList.add('hidden');
                            btn.title = 'Show password';
                        }
                    }
                </script>



                <div>
                    <button type="submit" class="flex w-full justify-center items-center gap-2 rounded-xl bg-mg-green px-3 py-3.5 text-sm font-bold text-white shadow-sm hover:bg-green-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mg-green transition active:scale-[0.98]">
                        Sign in to Dashboard
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </form>
        </div>
        
        <p class="text-center text-[11px] font-medium text-gray-400 mt-8">
            &copy; {{ date('Y') }} MunchGud. All rights reserved.
        </p>

    </div>

</body>
</html>
