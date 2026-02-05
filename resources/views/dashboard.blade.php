<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Plus+Jakarta+Sans:wght@400;500;600;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    protech: '#DFFF00',
                    darkBg: '#080808',
                    cardBg: '#111111',
                },
                fontFamily: {
                    tech: ['Orbitron', 'sans-serif'],
                    sans: ['Plus Jakarta Sans', 'sans-serif'],
                }
            }
        }
    }
</script>

<style>
    body { background-color: #080808; color: white; }
</style>

@include('navigation-menu')

<div class="min-h-screen bg-darkBg text-white font-sans">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-cardBg overflow-hidden shadow-xl sm:rounded-lg p-8">
                <h1 class="font-tech text-3xl text-protech mb-4">Dashboard</h1>
                <p class="text-white/70">Welcome to your dashboard!</p>
            </div>
        </div>
    </div>
</div>
