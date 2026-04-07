<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simpaud - Monitoring & Management PAUD</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .mesh-bg {
            background-color: #f2f8f5;
            background-image: 
                radial-gradient(at 40% 20%, #c5e2d4 0px, transparent 50%),
                radial-gradient(at 80% 0%, #e1f0e8 0px, transparent 50%),
                radial-gradient(at 0% 50%, #d4ebe0 0px, transparent 50%),
                radial-gradient(at 80% 50%, #b7dac9 0px, transparent 50%),
                radial-gradient(at 0% 100%, #e1f0e8 0px, transparent 50%),
                radial-gradient(at 80% 100%, #c5e2d4 0px, transparent 50%),
                radial-gradient(at 0% 0%, #f2f8f5 0px, transparent 50%);
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-float { animation: float 4s ease-in-out infinite; }
        
        @keyframes fadeOut {
            0% { opacity: 1; filter: blur(0); transform: scale(1); }
            100% { opacity: 0; filter: blur(10px); transform: scale(1.1); visibility: hidden; }
        }
        .fade-out {
            animation: fadeOut 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            animation-delay: 2.2s;
        }
        @keyframes fadeInScale {
            0% { opacity: 0; transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1); }
        }
        .animate-entrance {
            animation: fadeInScale 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
</head>
<body class="h-screen flex items-center justify-center mesh-bg overflow-hidden relative">

    <!-- Decorative modern blobs -->
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-green-200/40 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-teal-200/40 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse" style="animation-delay: 1s;"></div>

    <div class="text-center fade-out animate-entrance z-10">
        <div class="relative inline-block animate-float mb-6">
            <div class="absolute inset-0 bg-green-400 blur-xl opacity-30 rounded-full"></div>
            <!-- Ganti logo disini -->
            <img src="{{ asset('images/logo.png') }}" alt="Simpaud Logo" class="relative h-32 w-32 mx-auto rounded-3xl object-cover shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-white/60 bg-white/40 backdrop-blur-sm p-2">
        </div>
        
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-gray-800 drop-shadow-sm">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-teal-600">Simpaud</span>
        </h1>
        <p class="mt-3 text-lg md:text-xl font-medium text-gray-600 tracking-wide opacity-80">Monitoring & Management PAUD</p>
        
        <div class="mt-10 flex justify-center space-x-2">
            <div class="w-2 h-2 bg-green-400 rounded-full animate-bounce" style="animation-delay: 0s;"></div>
            <div class="w-2 h-2 bg-green-400 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
            <div class="w-2 h-2 bg-green-400 rounded-full animate-bounce" style="animation-delay: 0.4s;"></div>
        </div>
    </div>

    <script>
        setTimeout(function(){
            window.location.href = "/login"; // redirect ke login
        }, 3000);
    </script>
</body>
</html>
