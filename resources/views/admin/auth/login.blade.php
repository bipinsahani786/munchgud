<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - MunchGud</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            <img src="{{ asset('images/logo.jpg') }}" alt="MunchGud" class="h-14 w-auto mx-auto object-contain rounded-xl shadow-sm mb-5">
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
                               class="block w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 text-gray-900 shadow-sm placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mg-green focus:border-mg-green sm:text-sm sm:leading-6 outline-none transition"
                               placeholder="••••••••">
                    </div>
                </div>



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
