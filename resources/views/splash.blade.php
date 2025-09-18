<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Splash Screen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeOut {
            to { opacity: 0; visibility: hidden; }
        }
        .fade-out {
            animation: fadeOut 1s ease-in-out forwards;
            animation-delay: 2.5s;
        }
    </style>
</head>
<body class="h-screen flex items-center justify-center bg-gradient-to-br from-green-400 via-green-500 to-green-700">

    <div class="text-center fade-out">
        <div class="animate-bounce">
            <!-- Ganti logo disini -->
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="h-28 w-28 mx-auto rounded-full object-cover shadow-lg border-4 border-white">
        <h1 class="mt-6 text-4xl font-extrabold text-white drop-shadow-lg">Simpaud Kartoharjo</h1>
        <p class="mt-2 text-lg text-green-100">Monitoring & Management PAUD</p>
    </div>

    <script>
        setTimeout(function(){
            window.location.href = "/login"; // redirect ke login
        }, 3000);
    </script>
</body>
</html>
