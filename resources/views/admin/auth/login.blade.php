<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - StrathConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded shadow-md w-96">
            <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>
            
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" 
                       class="w-full mb-4 p-2 border rounded" required autofocus>
                <input type="password" name="password" placeholder="Password" 
                       class="w-full mb-4 p-2 border rounded" required>
                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        <span class="text-sm">Remember Me</span>
                    </label>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>