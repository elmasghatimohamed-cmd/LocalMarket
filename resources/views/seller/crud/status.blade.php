<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">

<div class="bg-[#080808] min-h-screen text-white font-sans p-4 md:p-10">
    <div class="container mx-auto max-w-6xl">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
            <div>
                <h1 class="text-3xl font-bold uppercase tracking-tighter font-[Orbitron]">
                    Orders<span class="text-[#DFFF00]">_</span>Control
                </h1>
                <p class="text-gray-500 text-[10px] uppercase tracking-[0.4em] mt-1">Incoming hardware transmissions</p>
            </div>
            
            <div class="flex gap-3">
                <div class="bg-white/5 border border-white/10 px-6 py-2 rounded-full flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-[#DFFF00] animate-pulse"></span>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-gray-300">Live Server Active</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="relative">
                <input type="text" placeholder="Filter by ID..." class="w-full bg-[#111] border border-white/5 rounded-2xl py-3 px-5 text-sm focus:outline-none focus:border-[#DFFF00] transition-all">
            </div>
            <select class="bg-[#111] border border-white/5 rounded-2xl py-3 px-5 text-sm text-gray-400 appearance-none focus:outline-none focus:border-[#DFFF00]">
                <option>All Statuses</option>
                <option>Pending</option>
                <option>Processing</option>
                <option>Shipped</option>
            </select>
            <div class="bg-[#DFFF00]/5 border border-[#DFFF00]/20 rounded-2xl py-3 px-5 text-center">
                <span class="text-[#DFFF00] text-[10px] font-black uppercase tracking-widest">Total Orders: 128</span>
            </div>
        </div>

        <div class="bg-[#111] border border-white/5 rounded-[2.5rem] overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-gray-500 text-[9px] uppercase tracking-[0.3em] bg-white/[0.02]">
                            <th class="px-8 py-5 font-bold">Protocol ID</th>
                            <th class="px-8 py-5 font-bold">Client / Hardware</th>
                            <th class="px-8 py-5 font-bold">Current Status</th>
                            <th class="px-8 py-5 font-bold">Update Status</th>
                            <th class="px-8 py-5 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        
                        <tr class="hover:bg-white/[0.03] transition-colors group">
                            <td class="px-8 py-6">
                                <span class="text-xs font-mono text-gray-500 block">#CMD-9901</span>
                                <span class="text-[9px] text-gray-600 uppercase">2 mins ago</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-white uppercase tracking-tight">John Wick</span>
                                    <span class="text-[10px] text-gray-500 italic">NVIDIA RTX 4090 Founders Edition</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="bg-blue-500/10 text-blue-400 text-[9px] font-black px-3 py-1 rounded-full uppercase">Processing</span>
                            </td>
                            <td class="px-8 py-6">
                                <select class="bg-[#080808] border border-white/10 text-[10px] font-bold uppercase py-1.5 px-3 rounded-lg focus:ring-1 focus:ring-[#DFFF00] outline-none">
                                    <option>Pending</option>
                                    <option selected>Processing</option>
                                    <option>Shipped</option>
                                    <option>Delivered</option>
                                    <option>Cancelled</option>
                                </select>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <button class="bg-[#DFFF00] text-black text-[9px] font-black px-4 py-2 rounded-lg uppercase hover:shadow-[0_0_15px_rgba(223,255,0,0.4)] transition-all">Update</button>
                            </td>
                        </tr>

                        <tr class="hover:bg-white/[0.03] transition-colors group">
                            <td class="px-8 py-6">
                                <span class="text-xs font-mono text-gray-500 block">#CMD-9895</span>
                                <span class="text-[9px] text-gray-600 uppercase">1 hour ago</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-white uppercase tracking-tight">Sarah Connor</span>
                                    <span class="text-[10px] text-gray-500 italic">Logitech G Pro Keyboard</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="bg-[#DFFF00]/10 text-[#DFFF00] text-[9px] font-black px-3 py-1 rounded-full uppercase">Pending</span>
                            </td>
                            <td class="px-8 py-6">
                                <select class="bg-[#080808] border border-white/10 text-[10px] font-bold uppercase py-1.5 px-3 rounded-lg focus:ring-1 focus:ring-[#DFFF00] outline-none">
                                    <option selected>Pending</option>
                                    <option>Processing</option>
                                    <option>Shipped</option>
                                    <option>Delivered</option>
                                </select>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <button class="bg-white/10 text-white text-[9px] font-black px-4 py-2 rounded-lg uppercase hover:bg-[#DFFF00] hover:text-black transition-all">Update</button>
                            </td>
                        </tr>

                        <tr class="hover:bg-white/[0.03] transition-colors group">
                            <td class="px-8 py-6">
                                <span class="text-xs font-mono text-gray-500 block">#CMD-9882</span>
                                <span class="text-[9px] text-gray-600 uppercase">Yesterday</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-white uppercase tracking-tight">Tony Stark</span>
                                    <span class="text-[10px] text-gray-500 italic">Arc Reactor Cooling Fan</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="bg-red-500/10 text-red-500 text-[9px] font-black px-3 py-1 rounded-full uppercase">Cancelled</span>
                            </td>
                            <td class="px-8 py-6">
                                <select class="bg-[#080808] border border-white/10 text-[10px] font-bold uppercase py-1.5 px-3 rounded-lg focus:ring-1 focus:ring-[#DFFF00] outline-none opacity-50">
                                    <option>Pending</option>
                                    <option selected>Cancelled</option>
                                </select>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <button class="bg-white/5 text-gray-600 text-[9px] font-black px-4 py-2 rounded-lg uppercase cursor-not-allowed">Locked</button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 flex justify-center gap-2">
            <button class="w-10 h-10 bg-[#111] border border-white/10 rounded-xl flex items-center justify-center text-xs hover:border-[#DFFF00] transition-all text-gray-500 hover:text-[#DFFF00]">1</button>
            <button class="w-10 h-10 bg-[#DFFF00] border border-[#DFFF00] rounded-xl flex items-center justify-center text-xs font-black text-black">2</button>
            <button class="w-10 h-10 bg-[#111] border border-white/10 rounded-xl flex items-center justify-center text-xs hover:border-[#DFFF00] transition-all text-gray-500 hover:text-[#DFFF00]">3</button>
        </div>

    </div>
</div>