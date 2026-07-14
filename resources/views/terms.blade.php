<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions - Support Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans+Flex:wght@100..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
</head>
<body class="bg-[#fcfdfe] text-slate-700 font-sans antialiased min-h-screen flex flex-col justify-between">

    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-[1100px] mx-auto px-6 py-3.5 flex justify-between items-center">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-full bg-blue-600 flex items-center justify-center text-white text-base shadow-sm">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <div>
                    <span class="block font-bold text-slate-800 text-sm tracking-tight leading-none">Support Center</span>
                    <span class="text-[10px] text-slate-400 font-medium">We're here to help</span>
                </div>
            </div>

            <nav class="flex items-center gap-6">
                <a href="{{ route('customer') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 transition">Home</a>
                <a href="{{ route('tickets') }}" class="text-sm font-medium text-slate-500 hover:text-slate-800 transition">My Tickets</a>
                <a href="#" class="bg-[#0252cc] hover:bg-blue-700 transition text-white px-4 py-2 rounded-md text-xs font-semibold shadow-sm">+ New Request</a>
            </nav>
        </div>
    </header>

    <main class="max-w-[850px] mx-auto px-6 py-12 flex-grow w-full">
        <nav class="text-xs text-slate-500 mb-4 flex items-center gap-2 font-medium">
            <a href="{{ route('customer') }}" class="hover:text-slate-800 transition">
                <i class="fa-solid fa-house"></i> Home
            </a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <a href="{{ route('tickets') }}" class="hover:text-slate-800 transition">
                My Tickets
            </a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span class="text-slate-800">
                Terms & Conditions
            </span>
        </nav>

        <h1 class="text-3xl font-bold text-slate-900 mb-8">Terms and Conditions</h1>

        <div class="bg-white border border-slate-200 rounded-xl p-8 md:p-12 shadow-sm">
            <p class="text-slate-600 text-[1.05rem] mb-12 leading-relaxed">
                These Terms & Conditions govern your use of our Support Center and the services provided through our ticketing system. By using our system, you agree to the following terms.
            </p>

            @php
                $sections = [
                    [
                        'icon' => 'fa-scroll',
                        'title' => '1. Use of Our Support Center',
                        'desc' => 'Our support center is provided to assist customers with inquiries, issues, and support related to our products and services.',
                        'list_type' => 'bullet',
                        'items' => [
                            'You agree to provide accurate and complete information when submitting tickets.',
                            'You will not use the system for any unlawful, abusive, or fraudulent purposes.',
                            'We reserve the right to suspend or restrict access to users who violate these terms.'
                        ]
                    ],
                    [
                        'icon' => 'fa-clipboard-list',
                        'title' => '2. Ticket Management System',
                        'desc' => 'Our ticketing system is designed to ensure efficient tracking and resolution of custom issues.',
                        'list_type' => 'alpha',
                        'items' => [
                            'Create new support tickets (manually or via customer input)',
                            'Assign tickets to support agents',
                            'Track status (Open, In progress, Resolved, closed)',
                            'Set priority levels (Low, Medium, High)',
                            'Add internal notes and updates to tickets'
                        ]
                    ],
                    [
                        'icon' => 'fa-book-open',
                        'title' => '3. Self-Service Portal',
                        'desc' => 'Our self-service portal provides resources to help you find solutions independently.',
                        'list_type' => 'alpha',
                        'items' => [
                            'Search database of solutions/articles',
                            'Categorize help topics',
                            'User feedback on article helpfulness',
                            'Reduce ticket volume by promoting self-resolution'
                        ]
                    ],
                    [
                        'icon' => 'fa-comments',
                        'title' => '4. Customer Communication History',
                        'desc' => 'We maintain a detailed log of all interactions to ensure continuity and quality support.',
                        'list_type' => 'alpha',
                        'items' => [
                            'View full conversation history for each customer',
                            'Send automated or manual follow-up responses',
                            'Ensure consistent support across different agents',
                            'Enable personalized customer service'
                        ]
                    ],
                    [
                        'icon' => 'fa-clock',
                        'title' => '5. Service Level Agreement (SLA) Tracking',
                        'desc' => 'We ensure support is delivered within the agreed time frames based on priority and severity.',
                        'list_type' => 'alpha',
                        'items' => [
                            'Set SLA rules for response and resolution times',
                            'Monitor compliance with SLA targets',
                            'Escalate overdue tickets automatically',
                            'Generate reports on SLA performance'
                        ]
                    ],
                    [
                        'icon' => 'fa-shield-halved',
                        'title' => '6. Data & Privacy',
                        'desc' => 'We value your privacy and are committed to protecting your information. Your data will be used solely for support and service purposes in accordance with our Privacy Policy.',
                        'list_type' => 'none',
                        'items' => []
                    ],
                    [
                        'icon' => 'fa-pen-to-square',
                        'title' => '7. Changes to Terms',
                        'desc' => 'We may update these terms & conditions from time to time. Continued use of our Support Center constitutes acceptance of any changes.',
                        'list_type' => 'none',
                        'items' => []
                    ],
                    [
                        'icon' => 'fa-envelope',
                        'title' => '8. Contact Us',
                        'desc' => 'If you have any questions about these Terms & conditions, please contact our support team through the Support Center.',
                        'list_type' => 'none',
                        'items' => []
                    ],
                ];
            @endphp

            @foreach($sections as $section)
                <div class="scroll-anim-section mb-14 opacity-0 translate-y-8 transition-all duration-[900ms] ease-[cubic-bezier(0.215,0.610,0.355,1)]">
                    <div class="flex items-center gap-3.5 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-slate-50 border border-slate-200 text-slate-700 flex items-center justify-center text-lg shadow-sm">
                            <i class="fa-solid {{ $section['icon'] }}"></i>
                        </div>
                        <h2 class="text-xl font-bold text-slate-800">{{ $section['title'] }}</h2>
                    </div>
                    
                    <p class="text-slate-600 mb-4 pl-14 leading-relaxed">{{ $section['desc'] }}</p>

                    @if(count($section['items']) > 0)
                        <ul class="pl-14 text-slate-600 space-y-2">
                            @foreach($section['items'] as $item)
                                @if($section['list_type'] === 'bullet')
                                    <li class="relative pl-5 before:content-['•'] before:absolute before:left-0 before:text-slate-400 font-normal">
                                        {{ $item }}
                                    </li>
                                @elseif($section['list_type'] === 'alpha')
                                    <li class="list-[lower-alpha] list-inside pl-1">
                                        <span class="pl-2">{{ $item }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach

            <p class="text-center text-xs text-slate-400 mt-16 font-medium tracking-wide italic">You've reached the end.</p>
        </div>
    </main>

    <!-- Locate the footer inside terms.blade -->
    <footer class="bg-white border-t border-slate-200 text-[11px] text-slate-400 py-4 font-medium mt-12">
        <div class="max-w-[1100px] mx-auto px-6 flex justify-between items-center">
            <div>&copy; 2026 Support Center. All rights reserved.</div>
            <div class="flex gap-4">
                <a href="{{ route('agent') }}" class="hover:text-slate-600">Agent Portal</a>
                <a href="#" class="hover:text-slate-600">FAQ</a>
                <a href="#" class="hover:text-slate-600">Terms</a>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const animatedSections = document.querySelectorAll('.scroll-anim-section');
            
            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -80px 0px', 
                threshold: 0.1
            };

            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.remove('opacity-0', 'translate-y-8');
                        observer.unobserve(entry.target); 
                    }
                });
            }, observerOptions);

            animatedSections.forEach(section => revealObserver.observe(section));
        });
    </script>
</body>
</html>