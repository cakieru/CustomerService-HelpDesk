<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tickets - Support Center</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Sans Flex Link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans+Flex:wght@100..1000&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Tailwind Font Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Google Sans Flex', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Custom Smooth Animation Utilities -->
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        
        .animation-delay-75 { animation-delay: 75ms; }
        .animation-delay-150 { animation-delay: 150ms; }
        .animation-delay-200 { animation-delay: 200ms; }
        .animation-delay-250 { animation-delay: 250ms; }
        .animation-delay-300 { animation-delay: 300ms; }

        /* Hide Scrollbar for cleaner look but preserve functionality */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
        }
    </style>
</head>
<body class="bg-[#fafafa] font-sans antialiased text-[#2d3748] min-h-screen flex flex-col justify-between selection:bg-blue-100">

    <!-- Navbar -->
    <header class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-6xl mx-auto px-6 h-20 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                <div class="bg-[#0f4c81] text-white p-2.5 rounded-xl shadow-sm group-hover:scale-110 transition-transform duration-300">
                    <i data-lucide="headphones" class="w-6 h-6"></i>
                </div>
                <div>
                    <h1 class="text-base font-bold text-gray-800 leading-tight">Support Center</h1>
                    <p class="text-xs text-gray-400 font-medium">We're here to help</p>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="flex items-center space-x-8">
                <a href="{{ route('customer') }}" class="text-gray-500 hover:text-gray-800 font-medium text-sm transition-colors duration-300">
                    Home
                </a>
                <a href="#" class="bg-[#f0f4f8] text-[#0f4c81] font-semibold px-4 py-2 rounded-xl text-sm transition-all duration-300 shadow-sm">My Tickets</a>
                <a href="#" class="bg-[#0f62fe] hover:bg-[#0052cc] text-white font-semibold px-5 py-2.5 rounded-xl text-sm shadow-sm hover:shadow-md flex items-center space-x-1.5 transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]">
                    <span>+ New Request</span>
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="max-w-6xl mx-auto px-6 py-8 w-full flex-grow">
        
        <!-- Breadcrumb Navigation -->
        <div class="flex items-center space-x-2 text-xs font-medium text-gray-400 mb-6 animate-fade-in-up">
            <a href="{{ route('customer') }}" class="hover:text-gray-600 transition-colors duration-300">
                Home
            </a>
            <span>&rsaquo;</span>
            <span class="text-gray-500">My Tickets</span>
        </div>

        <!-- Header Section -->
        <div class="mb-10 opacity-0 animate-fade-in-up">
            <h2 class="text-3xl font-extrabold text-gray-950 tracking-tight mb-2">My Support Tickets</h2>
            <p class="text-gray-500 font-normal text-base">Track the status of your open and past requests.</p>
        </div>

        <!-- Metric Counter Cards Section -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <!-- Open Tickets Counter -->
            <div class="bg-amber-50/40 border border-amber-100/70 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 opacity-0 animate-fade-in-up animation-delay-75">
                <span class="block text-3xl font-bold text-amber-600 mb-1">3</span>
                <span class="text-sm font-medium text-gray-400">open</span>
            </div>
            <!-- In Process Tickets Counter -->
            <div class="bg-blue-50/40 border border-blue-100/70 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 opacity-0 animate-fade-in-up animation-delay-150">
                <span class="block text-3xl font-bold text-blue-600 mb-1">2</span>
                <span class="text-sm font-medium text-gray-400">in process</span>
            </div>
            <!-- Resolved Tickets Counter -->
            <div class="bg-emerald-50/40 border border-emerald-100/70 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 opacity-0 animate-fade-in-up animation-delay-200">
                <span class="block text-3xl font-bold text-emerald-600 mb-1">1</span>
                <span class="text-sm font-medium text-gray-400">resolved</span>
            </div>
            <!-- Closed Tickets Counter -->
            <div class="bg-gray-50 border border-gray-100 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 opacity-0 animate-fade-in-up animation-delay-250">
                <span class="block text-3xl font-bold text-gray-700 mb-1">0</span>
                <span class="text-sm font-medium text-gray-400">closed</span>
            </div>
        </div>

        <!-- Interactive Ticket Search & Filter Container Wrapper -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden opacity-0 animate-fade-in-up animation-delay-300">
            
            <!-- Filters Utility Header Toolbar -->
            <div class="p-4 border-b border-gray-100 flex flex-col md:flex-row items-center gap-4 justify-between bg-white">
                <!-- Inside Input Search Bar -->
                <div class="relative w-full md:max-w-md">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </span>
                    <input type="text" id="ticketSearch" placeholder="Search by subject or ticket ID..." class="w-full bg-gray-50/50 pl-10 pr-4 py-2 rounded-xl border border-gray-200 text-sm outline-none focus:border-[#0f62fe] focus:bg-white focus:ring-4 focus:ring-blue-100/50 transition-all duration-300 placeholder-gray-400 text-gray-700" />
                </div>

                <!-- Horizontal Pill Category Filter Tabs -->
                <div class="flex flex-wrap items-center gap-1.5 self-start md:self-auto text-xs font-semibold text-gray-500">
                    <button onclick="filterStatus('all')" id="tab-all" class="px-3 py-1.5 rounded-lg bg-gray-100 text-gray-800 transition-all duration-300">All (6)</button>
                    <button onclick="filterStatus('open')" id="tab-open" class="px-3 py-1.5 rounded-lg hover:bg-gray-50 hover:text-gray-800 transition-all duration-300">Open (3)</button>
                    <button onclick="filterStatus('in-progress')" id="tab-in-progress" class="px-3 py-1.5 rounded-lg hover:bg-gray-50 hover:text-gray-800 transition-all duration-300">In progress (2)</button>
                    <button onclick="filterStatus('resolved')" id="tab-resolved" class="px-3 py-1.5 rounded-lg hover:bg-gray-50 hover:text-gray-800 transition-all duration-300">Resolved (1)</button>
                    <button onclick="filterStatus('closed')" id="tab-closed" class="px-3 py-1.5 rounded-lg hover:bg-gray-50 hover:text-gray-800 transition-all duration-300">Closed (0)</button>
                </div>
            </div>

            <!-- Scrollable Dynamic Ticket Feed Rows List -->
            <div id="ticketContainer" class="divide-y divide-gray-100 max-h-[550px] overflow-y-auto custom-scrollbar">
                @php
                    $mockTickets = [
                        ['id' => 'TKT-1001', 'subject' => 'Order #54321 not received after 10 days', 'category' => 'Shipping & Delivery', 'status' => 'open', 'updated' => 'Updated 3d ago', 'agent' => 'Louise Lane'],
                        ['id' => 'TKT-1002', 'subject' => 'Received wrong item - ordered blue, got red', 'category' => 'Wrong Item', 'status' => 'in-progress', 'updated' => 'Updated 2d ago', 'agent' => 'Prinz Geon'],
                        ['id' => 'TKT-1003', 'subject' => 'Cannot apply discount code at checkout', 'category' => 'Promotions & Discounts', 'status' => 'open', 'updated' => 'Updated 1d ago', 'agent' => ''],
                        ['id' => 'TKT-1004', 'subject' => 'Refund not received after return confirmation', 'category' => 'Refunds', 'status' => 'in-progress', 'updated' => 'Updated 2d ago', 'agent' => 'Emman Aragon'],
                        ['id' => 'TKT-1005', 'subject' => 'Product arrived damaged - broken Screen', 'category' => 'Damaged Items', 'status' => 'open', 'updated' => 'Updated 1d ago', 'agent' => 'Louise Lane'],
                        ['id' => 'TKT-1006', 'subject' => 'Account login issues after password reset', 'category' => 'Account Issues', 'status' => 'resolved', 'updated' => 'Updated 2d ago', 'agent' => 'Jerard Baluyot']
                    ];
                @endphp

                @foreach($mockTickets as $index => $ticket)
                <div class="ticket-row flex items-center justify-between p-5 hover:bg-gray-50/80 transition-all duration-300 ease-out border-b border-gray-100 hover:translate-x-1 group cursor-pointer" 
                     onclick="window.location=`{{ route('ticket.details') }}`"
                     data-status="{{ $ticket['status'] }}" 
                     data-search="{{ strtolower($ticket['id'] . ' ' . $ticket['subject']) }}"
                     style="--delay: {{ 350 + ($index * 40) }}ms; opacity: 0; transform: translateY(12px); animation: fadeInUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) var(--delay) forwards;">
                    
                    <div class="flex items-start space-x-4">
                        <!-- Message Icon Container Box -->
                        <div class="bg-gray-50 border border-gray-100 text-gray-400 p-2.5 rounded-xl mt-0.5 group-hover:bg-white group-hover:border-gray-200 group-hover:scale-105 transition-all duration-300">
                            <i data-lucide="message-square" class="w-5 h-5 group-hover:rotate-6 transition-transform duration-300"></i>
                        </div>
                        
                        <!-- Content Matrix Metas details fields -->
                        <div class="space-y-1.5">
                            <div class="flex items-center flex-wrap gap-2">
                                <h4 class="font-bold text-gray-900 text-sm leading-snug group-hover:text-[#0f62fe] transition-colors duration-300">{{ $ticket['subject'] }}</h4>
                                
                                <!-- Reactive Badges status indicators switches logic -->
                                @if($ticket['status'] == 'open')
                                    <span class="bg-amber-50 text-amber-600 border border-amber-100/50 text-[10px] font-bold px-2 py-0.5 rounded-md uppercase tracking-wider shadow-sm">Open</span>
                                @elseif($ticket['status'] == 'in-progress')
                                    <span class="bg-blue-50 text-blue-600 border border-blue-100/50 text-[10px] font-bold px-2 py-0.5 rounded-md uppercase tracking-wider shadow-sm">In Progress</span>
                                @elseif($ticket['status'] == 'resolved')
                                    <span class="bg-emerald-50 text-emerald-600 border border-emerald-100/50 text-[10px] font-bold px-2 py-0.5 rounded-md uppercase tracking-wider shadow-sm">Resolved</span>
                                @endif
                            </div>
                            
                            <!-- Inline Contextual Metas List -->
                            <div class="flex flex-wrap items-center text-xs text-gray-400 font-medium">
                                <span class="text-gray-500 font-semibold">{{ $ticket['id'] }}</span>
                                <span class="mx-2 text-gray-300">&bull;</span>
                                <span>{{ $ticket['category'] }}</span>
                                <span class="mx-2 text-gray-300">&bull;</span>
                                <span>{{ $ticket['updated'] }}</span>
                                @if(!empty($ticket['agent']))
                                    <span class="mx-2 text-gray-300">&bull;</span>
                                    <span>Agent: {{ $ticket['agent'] }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right Chevron Action Caret Icon -->
                    <div class="text-gray-300 group-hover:text-gray-500 group-hover:translate-x-1 transition-all duration-300 pr-1">
                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 w-full mt-12">
        <div class="max-w-6xl mx-auto px-6 h-16 flex flex-col sm:flex-row items-center justify-between text-xs text-gray-400 font-medium">
            <p>&copy; {{ date('Y') }} Support Center. All rights reserved.</p>
            <div class="flex space-x-6 mt-2 sm:mt-0">
                <a href="{{ route('agent') }}" class="hover:text-gray-600 font-bold text-blue-600 transition-colors duration-300">Agent Portal</a>
                <a href="#" class="hover:text-gray-600 transition-colors duration-300">FAQ</a>
                <a href="{{ route('terms') }}" class="hover:text-gray-600 transition-colors duration-300">Terms</a>
            </div>
        </div>
    </footer>

    <!-- Frontend Filter Interactivity Logic Engine Script Block -->
    <script>
        lucide.createIcons();

        let currentActiveStatus = 'all';

        function filterStatus(status) {
            currentActiveStatus = status;
            
            // Highlight Selected Tab Style Switching Layout configuration
            const tabs = ['all', 'open', 'in-progress', 'resolved', 'closed'];
            tabs.forEach(t => {
                const tabBtn = document.getElementById(`tab-${t}`);
                if(t === status) {
                    tabBtn.className = "px-3 py-1.5 rounded-lg bg-gray-100 text-gray-800 transition-all duration-300";
                } else {
                    tabBtn.className = "px-3 py-1.5 rounded-lg hover:bg-gray-50 hover:text-gray-800 transition-all duration-300";
                }
            });

            applyCombinedFilters();
        }

        // Live Text Search Input Listener Trigger
        document.getElementById('ticketSearch').addEventListener('input', applyCombinedFilters);

        function applyCombinedFilters() {
            const searchQuery = document.getElementById('ticketSearch').value.toLowerCase().trim();
            const rows = document.querySelectorAll('.ticket-row');

            rows.forEach((row, index) => {
                const matchesStatus = (currentActiveStatus === 'all') || (row.getAttribute('data-status') === currentActiveStatus);
                const matchesSearch = row.getAttribute('data-search').includes(searchQuery);

                if (matchesStatus && matchesSearch) {
                    // Reset styling to allow clean fade-in entry transitions when filtering
                    row.style.display = 'flex';
                    row.style.opacity = '0';
                    row.style.transform = 'translateY(10px)';
                    
                    // Stagger the visible items matching the new search/filter criteria
                    setTimeout(() => {
                        row.style.transition = 'all 0.35s cubic-bezier(0.16, 1, 0.3, 1)';
                        row.style.opacity = '1';
                        row.style.transform = 'translateY(0)';
                    }, index * 30);
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>