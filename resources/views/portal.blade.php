<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Support Center' }}</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Premium Fonts Link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans+Flex:wght@100..1000&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

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

   <!-- Custom Animation Utilities -->
   <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .animation-delay-100 { animation-delay: 100ms; }
        .animation-delay-200 { animation-delay: 200ms; }
        .animation-delay-300 { animation-delay: 300ms; }
    </style>
</head>
<body class="bg-[#fafafa] font-sans antialiased text-[#2d3748] min-h-screen flex flex-col justify-between selection:bg-blue-100">

    <!-- Navbar -->
    <header class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-6xl mx-auto px-6 h-20 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('customer') }}" class="flex items-center space-x-3 group">
                <div class="bg-[#0f4c81] text-white p-2.5 rounded-xl shadow-sm group-hover:scale-105 transition-transform duration-300">
                    <i data-lucide="headphones" class="w-6 h-6"></i>
                </div>
                <div>
                    <h1 class="text-base font-bold text-gray-800 leading-tight">Support Center</h1>
                    <p class="text-xs text-gray-400 font-medium">We're here to help</p>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="flex items-center space-x-8">
                <a href="{{ route('customer') }}" class="bg-[#f0f4f8] text-[#0f4c81] font-semibold px-4 py-2 rounded-xl text-sm transition-all duration-300 hover:opacity-90">Home</a>
                <a href="#" class="text-gray-500 hover:text-gray-800 font-medium text-sm transition-colors duration-300">My Tickets</a>
                <a href="#" class="bg-[#0f62fe] hover:bg-[#0052cc] text-white font-semibold px-5 py-2.5 rounded-xl text-sm shadow-sm hover:shadow-md flex items-center space-x-1.5 transition-all duration-300 hover:-translate-y-0.5 active:translate-y-0">
                    <span>+ New Request</span>
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content Grid -->
    <main class="max-w-6xl mx-auto px-6 py-12 w-full flex-grow">
        
        <!-- Hero Section -->
        <div class="text-center max-w-2xl mx-auto mb-14 opacity-0 animate-fade-in-up">
            <!-- Badge -->
            <div class="inline-flex items-center space-x-1.5 bg-[#f0f4f8] text-[#0f4c81] px-4 py-1.5 rounded-full text-xs font-semibold mb-6 hover:bg-blue-100 transition-colors duration-300 cursor-default">
                <i data-lucide="zap" class="w-3.5 h-3.5 fill-[#0f4c81] animate-pulse"></i>
                <span>Average response time: under 2 hours</span>
            </div>
            
            <h2 class="text-4xl font-extrabold text-gray-950 tracking-tight mb-4">How can we help you?</h2>
            <p class="text-gray-500 font-normal text-lg mb-8">Search our knowledge base or submit a support request.</p>
            
            <!-- Search Bar -->
            <div class="relative max-w-xl mx-auto shadow-sm hover:shadow-md focus-within:shadow-md transition-shadow duration-300 rounded-2xl">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                    <i data-lucide="search" class="w-5 h-5"></i>
                </span>
                <input type="text" placeholder="Search articles, FAQs, guides..." class="w-full bg-white pl-12 pr-4 py-4 rounded-2xl border border-gray-200 outline-none focus:border-[#0f62fe] focus:ring-4 focus:ring-blue-100/50 transition-all duration-300 text-gray-700 placeholder-gray-400" />
            </div>
        </div>

        <!-- Three Core Action Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16 opacity-0 animate-fade-in-up animation-delay-100">
            <!-- Card 1 -->
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm flex flex-col justify-between hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div>
                    <div class="bg-[#edf2ff] text-[#4c6ef5] p-3 rounded-2xl w-fit mb-5 group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="ticket" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Submit a Request</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">Create a new support ticket and our team will respond shortly.</p>
                </div>
                <a href="#" class="text-[#0f62fe] font-semibold text-sm flex items-center space-x-1">
                    <span>Get started</span>
                    <span class="transform group-hover:translate-x-1.5 transition-transform duration-300">&rarr;</span>
                </a>
            </div>

            <!-- Card 2 -->
            <a href="{{ route('tickets') }}" class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm flex flex-col justify-between hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div>
                    <div class="bg-[#ebfbee] text-[#40c057] p-3 rounded-2xl w-fit mb-5 group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="clock" class="w-6 h-6"></i>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-2">Track My Tickets</h3>

                    <p class="text-gray-500 text-sm leading-relaxed mb-6">
                        Check the status of your open requests and view replies.
                    </p>
                </div>

                <div class="text-[#40c057] font-semibold text-sm flex items-center space-x-1">
                    <span>View Tickets</span>
                    <span class="transform group-hover:translate-x-1.5 transition-transform duration-300">&rarr;</span>
                </div>
            </a>

            <!-- Card 3 -->
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm flex flex-col justify-between hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div>
                    <div class="bg-[#fff9db] text-[#f59f00] p-3 rounded-2xl w-fit mb-5 group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="book-open" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Knowledge Base</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">Browse guides, FAQs, and how-to articles to find quick answers.</p>
                </div>
                <a href="#" class="text-[#f59f00] font-semibold text-sm flex items-center space-x-1">
                    <span>Browse Articles</span>
                    <span class="transform group-hover:translate-x-1.5 transition-transform duration-300">&rarr;</span>
                </a>
            </div>
        </div>

        <!-- Popular Topics Section -->
        <div class="mb-16 opacity-0 animate-fade-in-up animation-delay-200">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Popular topics</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @php
                    $topics = [
                        ['icon' => 'truck', 'title' => 'Shipping & Delivery', 'count' => 2],
                        ['icon' => 'credit-card', 'title' => 'Subscription', 'count' => 1],
                        ['icon' => 'refresh-cw', 'title' => 'Returns & Refunds', 'count' => 1],
                        ['icon' => 'key', 'title' => 'Account Management', 'count' => 1],
                        ['icon' => 'shopping-cart', 'title' => 'Damaged Items', 'count' => 1],
                        ['icon' => 'box', 'title' => 'Product Information', 'count' => 1],
                    ];
                @endphp

                @foreach($topics as $topic)
                <a href="#" class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between hover:shadow-md hover:border-gray-200 transition-all duration-300 group">
                    <div class="flex items-center space-x-4">
                        <div class="text-gray-700 bg-gray-50 p-2.5 rounded-xl group-hover:bg-gray-100 transition-colors duration-300">
                            <i data-lucide="{{ $topic['icon'] }}" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm group-hover:text-[#0f62fe] transition-colors duration-300">{{ $topic['title'] }}</h4>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $topic['count'] }} {{ Str::plural('article', $topic['count']) }}</p>
                        </div>
                    </div>
                    <i data-lucide="arrow-right" class="w-4 h-4 text-gray-400 group-hover:text-gray-600 group-hover:translate-x-1 transition-all duration-300"></i>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Trust Features Footer Banner -->
        <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm grid grid-cols-1 md:grid-cols-3 gap-8 items-center px-8 opacity-0 animate-fade-in-up animation-delay-300 hover:shadow-md transition-shadow duration-500">
            <!-- Metric 1 -->
            <div class="flex items-start space-x-4 group">
                <div class="bg-green-50 text-green-500 p-2.5 rounded-xl mt-0.5 group-hover:scale-105 transition-transform duration-300">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                </div>
                <div>
                    <h5 class="font-bold text-gray-900 text-sm">98.4% Satisfaction</h5>
                    <p class="text-xs text-gray-400 leading-normal mt-0.5">Based on customer feedback from the last 30 days</p>
                </div>
            </div>
            
            <!-- Metric 2 -->
            <div class="flex items-start space-x-4 md:border-x md:border-gray-100 md:px-8 group">
                <div class="bg-blue-50 text-blue-500 p-2.5 rounded-xl mt-0.5 group-hover:scale-105 transition-transform duration-300">
                    <i data-lucide="message-square" class="w-5 h-5"></i>
                </div>
                <div>
                    <h5 class="font-bold text-gray-900 text-sm">&lt; 2hr Response</h5>
                    <p class="text-xs text-gray-400 leading-normal mt-0.5">Average first reply during business hours</p>
                </div>
            </div>

            <!-- Metric 3 -->
            <div class="flex items-start space-x-4 group">
                <div class="bg-purple-50 text-purple-500 p-2.5 rounded-xl mt-0.5 group-hover:scale-105 transition-transform duration-300">
                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                </div>
                <div>
                    <h5 class="font-bold text-gray-900 text-sm">24/7 Self-Service</h5>
                    <p class="text-xs text-gray-400 leading-normal mt-0.5">Knowledge base always available, agents 9am–6pm</p>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 w-full mt-12">
        <div class="max-w-6xl mx-auto px-6 h-16 flex flex-col sm:flex-row items-center justify-between text-xs text-gray-400 font-medium">
            <p>&copy; {{ date('Y') }} Support Center. All rights reserved.</p>
            <div class="flex space-x-6 mt-2 sm:mt-0">
                <a href="{{ route('agent') }}" class="hover:text-gray-600 transition-colors duration-300">
                Agent Portal
                </a>
                <a href="#" class="hover:text-gray-600 transition-colors duration-300">FAQ</a>
                <a href="{{ route('terms') }}">
                Terms
                </a>    
            </div>
        </div>
    </footer>

    <!-- Initialize Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>