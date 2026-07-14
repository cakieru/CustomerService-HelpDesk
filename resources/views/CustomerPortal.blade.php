<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Center - Customer Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans+Flex&display=swap" rel="stylesheet">
    <style>
        body, * {
            font-family: 'Google Sans Flex', sans-serif !important;
        }
        @keyframes toastPop {
            0% { opacity: 0; transform: scale(0.92); }
            100% { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col">

    <header class="bg-white border-b border-slate-200 sticky top-0 z-20">
        <div class="max-w-5xl mx-auto px-6 h-16 flex items-center justify-between">
            <div onclick="resetPortalHome()" class="flex items-center space-x-3 cursor-pointer select-none">
                <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center text-white">
                    <i data-lucide="headphones" class="w-5 h-5"></i>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-900 leading-none">Support Center</h2>
                    <p class="text-[11px] text-slate-400 mt-0.5">We're here to help</p>
                </div>
            </div>
            <div class="flex items-center space-x-6">
                <button onclick="resetPortalHome()" class="text-sm font-medium bg-slate-100 text-slate-700 px-3.5 py-1.5 rounded-lg hover:bg-slate-200 transition-colors">Home</button>
                <a href="#" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">My Tickets</a>
                <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-1.5 rounded-lg text-sm transition-all shadow-sm inline-block">+ New Request</a>
            </div>
        </div>
    </header>

    <main class="flex-1 max-w-5xl w-full mx-auto px-6 pt-1 pb-12 flex flex-col justify-between space-y-12">
        
        <div id="portalHeroSection" class="text-center max-w-2xl mx-auto space-y-4 w-full block pt-6">
            <div class="inline-flex items-center space-x-1.5 bg-blue-50 border border-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs font-medium">
                <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                <span>Average response time: under 2 hours</span>
            </div>
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">How can we help you?</h1>
            <p class="text-sm text-slate-500">Search our knowledge base to find quick answers.</p>
            
           <div class="relative pt-2 w-full text-left">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 pt-2 pointer-events-none">
                    <i data-lucide="search" class="w-5 h-5 text-slate-400"></i>
                </span>
                
                <input type="text" 
                       id="heroSearchInput" 
                       oninput="handleLiveSearch(this.value)" 
                       onkeydown="if(event.key === 'Enter') handleHeroSearch(this.value)" 
                       placeholder="Search articles, FAQs, guides... " 
                       class="w-full pl-12 pr-4 py-3.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm transition-all">
                
                <div id="searchSuggestionsDropdown" class="absolute left-0 right-0 mt-2 bg-white border border-slate-200 rounded-xl shadow-xl hidden z-30 max-h-60 overflow-y-auto text-left divide-y divide-slate-100"></div>
            </div>
        </div>

        <div id="portalPillarCards" class="grid grid-cols-1 md:grid-cols-3 gap-6 block">
            <a href="#" class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all flex flex-col justify-between h-48 cursor-pointer group text-left">
                <div>
                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center mb-4">
                        <i data-lucide="sticky-note" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 group-hover:text-blue-600 transition-colors">Submit a Request</h3>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">Create a new support ticket and our team will respond shortly.</p>
                </div>
                <span class="text-xs font-semibold text-blue-600 group-hover:underline inline-flex items-center gap-1">Get started &rarr;</span>
            </a>

            <a href="#" class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all flex flex-col justify-between h-48 cursor-pointer group text-left">
                <div>
                    <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-4">
                        <i data-lucide="clock" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 group-hover:text-blue-600 transition-colors">Track My Tickets</h3>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">Check the status of your open requests and view replies.</p>
                </div>
                <span class="text-xs font-semibold text-emerald-600 group-hover:underline inline-flex items-center gap-1">View Tickets &rarr;</span>
            </a>

            <div onclick="switchView('ARTICLES')" class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all flex flex-col justify-between h-48 cursor-pointer group">
                <div>
                    <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-4">
                        <i data-lucide="book" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 group-hover:text-blue-600 transition-colors">Knowledge Base</h3>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">Browse guides, FAQs, and how-to articles to find quick answers.</p>
                </div>
                <span class="text-xs font-semibold text-amber-600 group-hover:underline inline-flex items-center gap-1">Browse Articles &rarr;</span>
            </div>
        </div>

        <div id="portalPopularTopicsWrapper" class="space-y-4 block">
            <h2 class="text-lg font-bold text-slate-900 tracking-tight">Popular topics</h2>
            <div id="popularTopicsGrid" class="grid grid-cols-1 md:grid-cols-3 gap-4"></div>
        </div>

        <div id="filteredArticlesContainer" class="space-y-6 hidden"></div>

        <div id="portalNewRequestView" class="space-y-6 hidden">
            <nav class="text-xs text-slate-400 flex items-center space-x-2 mb-2 select-none">
                <button onclick="resetPortalHome()" class="hover:underline flex items-center gap-1 text-slate-400 font-medium"><i data-lucide="home" class="w-3 h-3"></i> Home</button>
                <span class="text-slate-300">&rsaquo;</span>
                <span class="text-slate-500 font-medium">Submit a Request</span>
            </nav>
            <div class="pb-2">
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Submit a support request</h1>
                <p class="text-xs text-slate-500 mt-0.5 font-medium">Please provide details about your issue, and we will get back to you as soon as possible.</p>
            </div>

            <form onsubmit="handleSupportRequestSubmit(event)" id="supportRequestForm" class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm space-y-6 text-left max-w-2xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-700 tracking-wide uppercase">Your Name <span class="text-rose-500">*</span></label>
                        <input required type="text" name="name" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-slate-700" placeholder="e.g. John Doe">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-700 tracking-wide uppercase">Email Address <span class="text-rose-500">*</span></label>
                        <input required type="email" name="email" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-slate-700" placeholder="yourname@example.com">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-700 tracking-wide uppercase">Category <span class="text-rose-500">*</span></label>
                        <select required name="category" class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-slate-700">
                            <option value="">Choose category</option>
                            <option value="shipping">Shipping & Delivery</option>
                            <option value="returns">Returns & Refunds</option>
                            <option value="damaged">Damaged Items</option>
                            <option value="product">Product Information</option>
                            <option value="subscriptions">Subscription</option>
                            <option value="account">Account Management</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-700 tracking-wide uppercase">Priority <span class="text-rose-500">*</span></label>
                        <select required name="priority" class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-slate-700">
                            <option value="low">Low</option>
                            <option value="medium" selected>Medium</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-700 tracking-wide uppercase">Order Number <span class="text-slate-400 font-normal">(Optional)</span></label>
                        <input type="text" name="orderNumber" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-slate-700" placeholder="e.g. #ORD-12459">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700 tracking-wide uppercase">Subject <span class="text-rose-500">*</span></label>
                    <input required type="text" name="subject" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-slate-700" placeholder="Brief summary of your request">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700 tracking-wide uppercase">Description / Details <span class="text-rose-500">*</span></label>
                    <textarea required name="description" rows="5" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-slate-700" placeholder="Provide as much detail as possible. For hardware issues, please include component models..."></textarea>
                </div>

                <div class="pt-2 flex items-center justify-between">
                    <p class="text-[10px] text-slate-400 max-w-sm">By submitting this form, you agree that we may process your data to resolve your inquiry.</p>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs px-6 py-3 rounded-xl transition-all shadow-md inline-flex items-center space-x-2">
                        <i data-lucide="send" class="w-4 h-4"></i>
                        <span>Submit Request</span>
                    </button>
                </div>
            </form>
        </div>

        <div id="portalMyTicketsView" class="space-y-6 hidden">
            <nav class="text-xs text-slate-400 flex items-center space-x-2 mb-2 select-none">
                <button onclick="resetPortalHome()" class="hover:underline flex items-center gap-1 text-slate-400 font-medium"><i data-lucide="home" class="w-3 h-3"></i> Home</button>
                <span class="text-slate-300">&rsaquo;</span>
                <span class="text-slate-500 font-medium">My Tickets</span>
            </nav>
            <div class="pb-2">
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Your support requests</h1>
                <p class="text-xs text-slate-500 mt-0.5 font-medium">Track your tickets, view status details, and communicate with support agents.</p>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden text-left">
                <div class="p-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-50/50">
                    <div class="flex items-center space-x-2">
                        <button onclick="filterTicketsBy('all')" id="ticketFilter-all" class="text-xs font-semibold px-4 py-1.5 rounded-lg transition-all bg-white text-slate-700 border border-slate-200 shadow-sm">All Requests</button>
                        <button onclick="filterTicketsBy('open')" id="ticketFilter-open" class="text-xs font-semibold px-4 py-1.5 rounded-lg transition-all text-slate-500 hover:text-slate-700">Open</button>
                        <button onclick="filterTicketsBy('solved')" id="ticketFilter-solved" class="text-xs font-semibold px-4 py-1.5 rounded-lg transition-all text-slate-500 hover:text-slate-700">Solved</button>
                    </div>
                    <div class="relative w-full md:w-64">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i data-lucide="search" class="w-4 h-4 text-slate-400"></i>
                        </span>
                        <input type="text" oninput="handleTicketSearch(this.value)" placeholder="Search tickets..." class="w-full pl-9 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm transition-all text-slate-700">
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 text-[10px] font-bold text-slate-400 uppercase tracking-wider bg-slate-50/20">
                                <th class="py-4 px-6">Ticket ID</th>
                                <th class="py-4 px-6">Subject</th>
                                <th class="py-4 px-6">Category</th>
                                <th class="py-4 px-6">Priority</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6 text-right">Created</th>
                            </tr>
                        </thead>
                        <tbody id="ticketsTableBody" class="divide-y divide-slate-100 text-xs text-slate-600"></tbody>
                    </table>
                </div>
                <div id="ticketsTableEmptyState" class="hidden p-12 text-center text-xs text-slate-400 font-medium italic">No support requests match your criteria.</div>
            </div>
        </div>

        <div id="portalArticlesView" class="space-y-6 hidden">
            <nav class="text-xs text-slate-400 flex items-center space-x-2 mb-2 select-none">
                <button onclick="resetPortalHome()" class="hover:underline flex items-center gap-1 text-slate-400 font-medium"><i data-lucide="home" class="w-3 h-3"></i> Home</button>
                <span class="text-slate-300">&rsaquo;</span>
                <span class="text-slate-500 font-medium">View Articles</span>
            </nav>
            <div class="pb-2">
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Knowledge Base</h1>
                <p class="text-xs text-slate-500 mt-0.5 font-medium">Self service portal for customers and support agents</p>
            </div>
            <div id="fullKnowledgeBaseStream" class="space-y-6"></div>
        </div>

        <div id="portalFAQView" class="space-y-6 hidden">
            <nav class="text-xs text-slate-400 flex items-center space-x-2 mb-2 select-none">
                <button onclick="resetPortalHome()" class="hover:underline flex items-center gap-1 text-slate-400 font-medium"><i data-lucide="home" class="w-3 h-3"></i> Home</button>
                <span class="text-slate-300">&rsaquo;</span>
                <span class="text-slate-500 font-medium">FAQs</span>
            </nav>
            <div class="pb-2"><h1 class="text-3xl font-bold text-slate-900 tracking-tight">Frequently Asked Questions</h1></div>
            
            <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm space-y-8 text-slate-700">
                <div class="space-y-4">
                    <div class="flex items-center space-x-3 font-bold text-slate-900 text-lg">
                        <i data-lucide="monitor" class="w-5 h-5 text-slate-800"></i>
                        <h2>General & Products Question</h2>
                    </div>
                    <div class="pl-2 space-y-4">
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-slate-900 flex items-start gap-2"><span class="text-slate-400 font-normal text-base leading-none">•</span> Are all your components brand new?</h3>
                            <p class="text-xs text-slate-500 leading-relaxed pl-4">Yes, we only sell brand-new, factory-sealed products sourced directly from authorized manufacturers and distributors. Every item includes the original manufacturer's warranty.</p>
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-slate-900 flex items-start gap-2"><span class="text-slate-400 font-normal text-base leading-none">•</span> Do you offer pre-built PCs, or just individual parts?</h3>
                            <p class="text-xs text-slate-500 leading-relaxed pl-4">We offer both! We have a curated selection of pre-built gaming and workstation PCs, as well as a "Build Your Own" option where you pick the parts and our expert technicians assemble and test it for you before shipping.</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4 pt-2">
                    <div class="flex items-center space-x-3 font-bold text-slate-900 text-lg">
                        <i data-lucide="truck" class="w-5 h-5 text-slate-800"></i>
                        <h2>Shipping & Delivery</h2>
                    </div>
                    <div class="pl-2 space-y-4">
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-slate-900 flex items-start gap-2"><span class="text-slate-400 font-normal text-base leading-none">•</span> How long will it take for my order to arrive?</h3>
                            <div class="text-xs text-slate-500 leading-relaxed pl-4 space-y-0.5">
                                <p>Standard Shipping: 3–5 business days.</p>
                                <p>Express Shipping: 1–2 business days.</p>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-slate-900 flex items-start gap-2"><span class="text-slate-400 font-normal text-base leading-none">•</span> Do you ship internationally?</h3>
                            <p class="text-xs text-slate-500 leading-relaxed pl-4">Currently, we ship nationwide. We are working on expanding our shipping options to international tech enthusiasts soon!</p>
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-slate-900 flex items-start gap-2"><span class="text-slate-400 font-normal text-base leading-none">•</span> Are shipments insured? Computer parts are fragile.</h3>
                            <p class="text-xs text-slate-500 leading-relaxed pl-4">Absolutely. All shipments—especially high-value items like GPUs and custom PCs—are fully insured and packed with specialized anti-static, shock-absorbing materials to ensure they arrive safely.</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4 pt-2">
                    <div class="flex items-center space-x-3 font-bold text-slate-900 text-lg">
                        <i data-lucide="credit-card" class="w-5 h-5 text-slate-800"></i>
                        <h2>Payment & Ordering</h2>
                    </div>
                    <div class="pl-2 space-y-4">
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-slate-900 flex items-start gap-2"><span class="text-slate-400 font-normal text-base leading-none">•</span> What payment methods do you accept?</h3>
                            <p class="text-xs text-slate-500 leading-relaxed pl-4">We mainly accept Cash on Delivery orders, we also accept all major credit/debit cards (BDO, Visa, and Mastercard) and E - Wallets like PayPal, G Cash, and Maya.</p>
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-slate-900 flex items-start gap-2"><span class="text-slate-400 font-normal text-base leading-none">•</span> Can I cancel or modify my order after placing it?</h3>
                            <p class="text-xs text-slate-500 leading-relaxed pl-4">Because we aim to ship orders as quickly as possible, you can only cancel or modify an order within 30 minutes of placing it. Please contact our live chat or support hotline immediately for urgent changes.</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4 pt-2">
                    <div class="flex items-center space-x-3 font-bold text-slate-900 text-lg">
                        <i data-lucide="refresh-cw" class="w-5 h-5 text-slate-800"></i>
                        <h2>Returns, Warranties, & Technical Support</h2>
                    </div>
                    <div class="pl-2 space-y-4">
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-slate-900 flex items-start gap-2"><span class="text-slate-400 font-normal text-base leading-none">•</span> What is your return policy?</h3>
                            <p class="text-xs text-slate-500 leading-relaxed pl-4">We offer a 30-day return policy for most unopened items. If an item has been opened but is defective, you can return it for a full refund or replacement.</p>
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-slate-900 flex items-start gap-2"><span class="text-slate-400 font-normal text-base leading-none">•</span> What should I do if my component arrives Damaged?</h3>
                            <p class="text-xs text-slate-500 leading-relaxed pl-4">Let us know within 48 hours. Send us your order number and a photo or video of the issue, and we will arrange a free return and rush you a replacement.</p>
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-slate-900 flex items-start gap-2"><span class="text-slate-400 font-normal text-base leading-none">•</span> How does the warranty work?</h3>
                            <p class="text-xs text-slate-500 leading-relaxed pl-4">Every item is covered by its respective manufacturer's warranty (typically 1 to 10 years depending on the component, like power supplies or RAM). For the first 30 days, we handle defects directly. After 30 days, we can assist you in contacting the manufacturer for a Warranty Claim (RMA).</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center py-2 text-[11px] text-slate-400 select-none font-medium">You've reached the end.</div>
        </div>

        <div id="portalTermsView" class="space-y-6 hidden">
            <nav class="text-xs text-slate-400 flex items-center space-x-2 mb-2 select-none">
                <button onclick="resetPortalHome()" class="hover:underline flex items-center gap-1 text-slate-400 font-medium"><i data-lucide="home" class="w-3 h-3"></i> Home</button>
                <span class="text-slate-300">&rsaquo;</span>
                <span class="text-slate-500 font-medium">Terms & Conditions</span>
            </nav>
            <div class="pb-2"><h1 class="text-3xl font-bold text-slate-900 tracking-tight">Terms and Conditions</h1></div>

            <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm space-y-8 text-slate-700">
                <p class="text-sm text-slate-500 leading-relaxed">These Terms & Conditions govern your use of our Support Center and the services provided through our ticketing system. By using our system, you agree to the following terms.</p>

                <div class="space-y-3 pt-2">
                    <div class="flex items-center space-x-3 font-bold text-slate-900 text-lg">
                        <i data-lucide="file-text" class="w-5 h-5 text-slate-800"></i>
                        <h2>1. Use of Our Support Center</h2>
                    </div>
                    <div class="pl-2 space-y-2">
                        <p class="text-xs text-slate-500 leading-relaxed">Our support center is provided to assist customers with inquiries, issues, and support related to our products and services.</p>
                        <ul class="space-y-1 text-xs text-slate-500 leading-relaxed pl-1">
                            <li class="flex items-start gap-2"><span class="text-slate-400">•</span> You agree to provide accurate and complete information when submitting tickets.</li>
                            <li class="flex items-start gap-2"><span class="text-slate-400">•</span> You will not use the system for any unlawful, abusive, or fraudulent purposes.</li>
                            <li class="flex items-start gap-2"><span class="text-slate-400">•</span> We reserve the right to suspend or restrict access to users who violate these terms.</li>
                        </ul>
                    </div>
                </div>

                <div class="space-y-3 pt-2">
                    <div class="flex items-center space-x-3 font-bold text-slate-900 text-lg">
                        <i data-lucide="book-open" class="w-5 h-5 text-slate-800"></i>
                        <h2>2. Self-Service Portal</h2>
                    </div>
                    <div class="pl-2 space-y-2">
                        <p class="text-xs text-slate-500 leading-relaxed">Our self-service portal provides resources to help you find solutions independently.</p>
                        <ul class="space-y-1 text-xs text-slate-500 leading-relaxed pl-1">
                            <li class="flex items-start gap-2"><span class="text-slate-400">a.</span> Search database of solutions/articles</li>
                            <li class="flex items-start gap-2"><span class="text-slate-400">b.</span> Categorize help topics</li>
                            <li class="flex items-start gap-2"><span class="text-slate-400">c.</span> User feedback on article helpfulness</li>
                            <li class="flex items-start gap-2"><span class="text-slate-400">d.</span> Reduce ticket volume by promoting self-resolution</li>
                        </ul>
                    </div>
                </div>

                <div class="space-y-3 pt-2">
                    <div class="flex items-center space-x-3 font-bold text-slate-900 text-lg">
                        <i data-lucide="shield" class="w-5 h-5 text-slate-800"></i>
                        <h2>3. Privacy & Data Protection</h2>
                    </div>
                    <div class="pl-2 space-y-2">
                        <p class="text-xs text-slate-500 leading-relaxed">We take the privacy of your data seriously and handle it in accordance with applicable data protection laws.</p>
                        <ul class="space-y-1 text-xs text-slate-500 leading-relaxed pl-1">
                            <li class="flex items-start gap-2"><span class="text-slate-400">a.</span> Personal information is only used to process and resolve your requests</li>
                            <li class="flex items-start gap-2"><span class="text-slate-400">b.</span> We do not sell your personal data to third parties</li>
                            <li class="flex items-start gap-2"><span class="text-slate-400">c.</span> Data is stored securely and access is restricted to authorized personnel</li>
                        </ul>
                    </div>
                </div>

                <div class="space-y-3 pt-2">
                    <div class="flex items-center space-x-3 font-bold text-slate-900 text-lg">
                        <i data-lucide="refresh-cw" class="w-5 h-5 text-slate-800"></i>
                        <h2>4. Changes to These Terms</h2>
                    </div>
                    <div class="pl-2 space-y-2">
                        <p class="text-xs text-slate-500 leading-relaxed">We may update these Terms & Conditions from time to time to reflect changes in our services or legal requirements.</p>
                        <ul class="space-y-1 text-xs text-slate-500 leading-relaxed pl-1">
                            <li class="flex items-start gap-2"><span class="text-slate-400">a.</span> Continued use of our support center after changes means you accept the updated terms</li>
                            <li class="flex items-start gap-2"><span class="text-slate-400">b.</span> Major updates will be communicated via our website or email</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="text-center py-2 text-[11px] text-slate-400 select-none font-medium">You've reached the end.</div>
        </div>

        <div id="portalSatisfactionBanner" class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm grid grid-cols-1 md:grid-cols-3 gap-6 items-center block">
            <div class="flex items-start space-x-4">
                <div class="p-2 bg-emerald-50 text-emerald-600 rounded-xl"><i data-lucide="check-circle-2" class="w-5 h-5"></i></div>
                <div>
                    <h4 class="text-xs font-bold text-slate-800 leading-snug">98.4% Satisfaction</h4>
                    <p class="text-[10px] text-slate-400 mt-0.5 leading-normal">Based on customer feedback from the last 30 days</p>
                </div>
            </div>
            <div class="flex items-start space-x-4 border-t md:border-t-0 md:border-x border-slate-100 pt-4 md:pt-0 md:px-6">
                <div class="p-2 bg-blue-50 text-blue-600 rounded-xl"><i data-lucide="message-square-code" class="w-5 h-5"></i></div>
                <div>
                    <h4 class="text-xs font-bold text-slate-800 leading-snug">&lt; 2hr Response</h4>
                    <p class="text-[10px] text-slate-400 mt-0.5 leading-normal">Average first reply during business hours</p>
                </div>
            </div>
            <div class="flex items-start space-x-4 border-t md:border-t-0 pt-4 md:pt-0">
                <div class="p-2 bg-purple-50 text-purple-600 rounded-xl"><i data-lucide="shield-check" class="w-5 h-5"></i></div>
                <div>
                    <h4 class="text-xs font-bold text-slate-800 LOGO leading-snug">24/7 Self-Service</h4>
                    <p class="text-[10px] text-slate-400 mt-0.5 leading-normal">Knowledge base always available, agents 9am-6pm</p>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between text-xs text-slate-400 border-t border-slate-200 pt-8 !mt-12">
            <p>&copy; 2026 Support Center. All rights reserved.</p>
            <div class="space-x-4">
                <a href="{{ route('KnowledgeBase') }}" class="hover:underline">Agent Portal</a>
                <button onclick="switchView('FAQ')" class="hover:underline focus:outline-none">FAQ</button>
                <button onclick="switchView('TERMS')" class="hover:underline focus:outline-none">Terms</button>
            </div>
        </div>
    </main>

    <div id="toastNotification" class="fixed bottom-6 right-6 z-50 hidden bg-slate-900 border border-slate-800 text-white rounded-xl shadow-2xl p-4 flex items-start gap-3 max-w-sm" style="animation: toastPop 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
        <div class="p-1 bg-emerald-500/20 text-emerald-400 rounded-lg shrink-0">
            <i data-lucide="check" class="w-4 h-4"></i>
        </div>
        <div>
            <h4 class="text-xs font-bold">Request Submitted!</h4>
            <p class="text-[10px] text-slate-400 mt-0.5 leading-normal">Your support ticket has been created. Use the ticket ID in "My Tickets" to trace updates.</p>
        </div>
        <button onclick="document.getElementById('toastNotification').classList.add('hidden')" class="text-slate-400 hover:text-slate-200 shrink-0 select-none">&times;</button>
    </div>

    <script>
        @php
            /** @var \Illuminate\Support\Collection $articles */
            /** @var \Illuminate\Support\Collection $tickets */
        @endphp
        
        const articles = {{ \Illuminate\Support\Js::from($articles) }};
        const backendTickets = {{ \Illuminate\Support\Js::from($tickets) }};

        const baseTopics = [
            { id: "shipping", name: "Shipping & Delivery", icon: "truck" },
            { id: "subscriptions", name: "Subscription", icon: "credit-card" },
            { id: "returns", name: "Returns & Refunds", icon: "refresh-cw" },
            { id: "account", name: "Account Management", icon: "key" },
            { id: "damaged", name: "Damaged Items", icon: "shopping-cart" },
            { id: "product", name: "Product Information", icon: "box" }
        ];

        const topics = baseTopics.map(topic => {
            const dynamicCount = articles.filter(art => art.catId === topic.id).length;
            return {
                ...topic,
                count: dynamicCount
            };
        });

        let activeTopicId = null;

        let tickets = [...backendTickets];
        let ticketStatusFilter = 'all';
        let ticketSearchQuery = '';

        function renderPopularTopicsGrid() {
            const grid = document.getElementById('popularTopicsGrid');
            grid.innerHTML = topics.map(topic => {
                const isSelected = topic.id === activeTopicId;
                const cardClasses = isSelected 
                    ? "bg-blue-600 border-blue-600 text-white shadow-md transform scale-[1.01]" 
                    : "bg-white border-slate-200 text-slate-800 hover:bg-slate-50 shadow-sm";
                
                const iconContainerClasses = isSelected ? "bg-blue-700 text-white" : "bg-slate-50 text-slate-700";
                const textMutedClasses = isSelected ? "text-blue-200" : "text-slate-400";
                const chevronClasses = isSelected ? "text-white" : "text-slate-400";

                return `
                    <div onclick="handleTopicClick('${topic.id}')" class="border rounded-xl p-4 flex items-center justify-between cursor-pointer transition-all ${cardClasses}">
                        <div class="flex items-center space-x-3.5">
                            <div class="p-2 rounded-lg ${iconContainerClasses}"><i data-lucide="${topic.icon}" class="w-5 h-5"></i></div>
                            <div>
                                <h4 class="text-xs font-bold leading-snug">${topic.name}</h4>
                                <p class="text-[11px] ${textMutedClasses}">${topic.count} articles</p>
                            </div>
                        </div>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 ${chevronClasses}"></i>
                    </div>
                `;
            }).join('');
            lucide.createIcons();
        }

        function handleTopicClick(topicId) {
            if (activeTopicId === topicId) {
                resetPortalHome();
                return;
            }

            activeTopicId = topicId;
            
            document.getElementById('portalHeroSection').classList.add('hidden');
            document.getElementById('portalPillarCards').classList.add('hidden');
            document.getElementById('portalNewRequestView').classList.add('hidden');
            document.getElementById('portalMyTicketsView').classList.add('hidden');
            document.getElementById('portalArticlesView').classList.add('hidden');
            document.getElementById('portalFAQView').classList.add('hidden');

            document.getElementById('portalPopularTopicsWrapper').classList.remove('hidden');
            document.getElementById('portalSatisfactionBanner').classList.remove('hidden');
            
            renderPopularTopicsGrid();
            renderFilteredArticles();
        }
        
        window.handleLiveSearch = function(query) {
            const dropdown = document.getElementById('searchSuggestionsDropdown');
            const cleanQuery = query.trim().toLowerCase();

            if (cleanQuery.length < 2) {
                dropdown.innerHTML = '';
                dropdown.classList.add('hidden');
                return;
            }

            let suggestionsHTML = '';

            const matchedArticles = articles.filter(art => 
                art.title.toLowerCase().includes(cleanQuery) || 
                art.desc.toLowerCase().includes(cleanQuery)
            );

            if (matchedArticles.length > 0) {
                suggestionsHTML += `<div class="px-3 py-1.5 bg-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Articles</div>`;
                matchedArticles.forEach(art => {
                    suggestionsHTML += `
                        <div onclick="selectSuggestion('ARTICLE', '${art.title.replace(/'/g, "\\'")}')" 
                             class="px-4 py-2.5 text-xs hover:bg-slate-50 cursor-pointer text-slate-700 font-medium flex items-center gap-2">
                             <i data-lucide="file-text" class="w-3.5 h-3.5 text-slate-400"></i>
                             <span class="truncate">${art.title}</span>
                        </div>`;
                });
            }

            const faqBlocks = document.querySelectorAll('#portalFAQView .space-y-1');
            let matchedFaqs = [];

            faqBlocks.forEach((node) => {
                const questionText = node.querySelector('h3')?.textContent || "";
                if (questionText.toLowerCase().includes(cleanQuery)) {
                    matchedFaqs.push({ title: questionText.replace('•', '').trim() });
                }
            });

            if (matchedFaqs.length > 0) {
                suggestionsHTML += `<div class="px-3 py-1.5 bg-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-wider">FAQs</div>`;
                matchedFaqs.forEach(faq => {
                    suggestionsHTML += `
                        <div onclick="selectSuggestion('FAQ', '${faq.title.replace(/'/g, "\\'")}')" 
                             class="px-4 py-2.5 text-xs hover:bg-slate-50 cursor-pointer text-slate-700 font-medium flex items-center gap-2">
                             <i data-lucide="help-circle" class="w-3.5 h-3.5 text-slate-400"></i>
                             <span class="truncate">${faq.title}</span>
                        </div>`;
                });
            }

            if (suggestionsHTML !== '') {
                dropdown.innerHTML = suggestionsHTML;
                dropdown.classList.remove('hidden');
                lucide.createIcons();
            } else {
                dropdown.innerHTML = `<div class="px-4 py-3 text-xs text-slate-400 italic font-medium">No matches found...</div>`;
                dropdown.classList.remove('hidden');
            }
        };

        window.selectSuggestion = function(type, title) {
            const input = document.getElementById('heroSearchInput');
            const dropdown = document.getElementById('searchSuggestionsDropdown');
            
            input.value = title;
            dropdown.classList.add('hidden');

            window.handleHeroSearch(title);
        };

        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('searchSuggestionsDropdown');
            const input = document.getElementById('heroSearchInput');
            if (dropdown && !dropdown.contains(e.target) && e.target !== input) {
                dropdown.classList.add('hidden');
            }
        });

        window.handleHeroSearch = function(query) {
            const cleanQuery = query.trim().toLowerCase();
            if (!cleanQuery) return;

            const matchedArticle = articles.find(art => 
                art.title.toLowerCase().includes(cleanQuery) || 
                art.desc.toLowerCase().includes(cleanQuery) ||
                art.tags.some(t => t.toLowerCase().includes(cleanQuery))
            );

            if (matchedArticle) {
                switchView('ARTICLES');
                
                setTimeout(() => {
                    const articleNodes = document.querySelectorAll('#fullKnowledgeBaseStream h2');
                    let targetNode = null;
                    
                    articleNodes.forEach(node => {
                        if (node.textContent.includes(matchedArticle.title)) {
                            targetNode = node.closest('.bg-white');
                        }
                    });

                    if (targetNode) {
                        targetNode.style.transition = 'all 0.5s ease';
                        targetNode.style.outline = '3px solid #3b82f6';
                        targetNode.style.transform = 'scale(1.01)';
                        
                        targetNode.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        
                        setTimeout(() => {
                            targetNode.style.outline = 'none';
                            targetNode.style.transform = 'none';
                        }, 3000);
                    }
                }, 150);
                return;
            }

            const faqBlocks = document.querySelectorAll('#portalFAQView .space-y-1');
            let matchedFaqNode = null;

            faqBlocks.forEach(node => {
                const questionText = node.querySelector('h3')?.textContent.toLowerCase() || "";
                const answerText = node.querySelector('p, div')?.textContent.toLowerCase() || "";
                
                if (questionText.includes(cleanQuery) || answerText.includes(cleanQuery)) {
                    matchedFaqNode = node;
                }
            });

            if (matchedFaqNode) {
                switchView('FAQ');
                
                setTimeout(() => {
                    matchedFaqNode.style.transition = 'all 0.5s ease';
                    matchedFaqNode.style.backgroundColor = '#eff6ff';
                    matchedFaqNode.style.padding = '0.5rem';
                    matchedFaqNode.style.borderRadius = '0.5rem';
                    
                    matchedFaqNode.scrollIntoView({ behavior: 'smooth', block: 'center' });

                    setTimeout(() => {
                        matchedFaqNode.style.backgroundColor = 'transparent';
                    }, 3000);
                }, 150);
                return;
            }

            alert('No matching articles or FAQs found for your query.');
        };

        function renderFilteredArticles() {
            const container = document.getElementById('filteredArticlesContainer');
            const targetArticles = articles.filter(art => art.catId === activeTopicId);

            if (targetArticles.length === 0) {
                container.innerHTML = `<p class="text-xs text-slate-400 text-center py-6 font-medium">No articles listed here yet.</p>`;
                container.classList.remove('hidden');
                return;
            }

            container.innerHTML = targetArticles.map(art => generateArticleCardMarkup(art)).join('') + 
                `<div class="text-center py-4 text-xs text-slate-400 tracking-wide select-none font-medium">You've reached the end.</div>`;
            
            container.classList.remove('hidden');
            lucide.createIcons();
            targetArticles.forEach(art => trackArticleView(art.id));
        }

        function generateArticleCardMarkup(art) {
            const voted = votedArticleIds.get(art.id);
            const yesBtnClasses = voted === 'yes'
                ? 'bg-emerald-50 border-emerald-300 text-emerald-700'
                : 'bg-white border-slate-200 hover:bg-slate-50 text-slate-700';
            const noBtnClasses = voted === 'no'
                ? 'bg-rose-50 border-rose-300 text-rose-700'
                : 'bg-white border-slate-200 hover:bg-slate-50 text-slate-700';
            const disabledAttr = voted ? 'disabled' : '';

            return `
                <div id="articleCard-${art.id}" class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                    <div class="p-8 space-y-4">
                        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">${art.title}</h2>
                        <p class="text-[14px] text-slate-500 leading-relaxed">
                            ${art.desc}
                            <span class="inline-flex flex-wrap gap-1.5 ml-1.5">
                                ${art.tags.map(t => `<span class="text-[11px] bg-slate-100 text-slate-400 px-1.5 py-0.5 rounded font-medium">#${t}</span>`).join('')}
                            </span>
                        </p>
                        <div class="flex items-center space-x-6 pt-1 text-xs text-slate-400 font-medium select-none">
                            <span class="bg-blue-100 text-blue-600 font-semibold px-3 py-1 rounded-full text-[11px]">${art.category}</span>
                            <span class="flex items-center gap-1.5"><i data-lucide="eye" class="w-4 h-4 text-slate-400"></i>${art.views} views</span>
                            <span class="flex items-center gap-1.5 text-emerald-500"><i data-lucide="thumbs-up" class="w-4 h-4"></i>${art.helpful} helpful</span>
                        </div>
                    </div>
                    <div class="bg-slate-50/80 border-t border-slate-200/60 p-5 px-8 space-y-3">
                        <span class="text-xs font-semibold text-slate-500 block">Was this article helpful?</span>
                        <div class="flex items-center space-x-3">
                            <button onclick="voteArticle(${art.id}, 'yes')" ${disabledAttr} class="inline-flex items-center space-x-2 border px-5 py-1.5 rounded-lg text-xs font-medium transition-all shadow-sm ${yesBtnClasses} ${voted ? 'cursor-not-allowed' : ''}">
                                <i data-lucide="thumbs-up" class="w-3.5 h-3.5 ${voted === 'yes' ? 'text-emerald-600' : 'text-emerald-500'}"></i><span>Yes (${art.yesVotes})</span>
                            </button>
                            <button onclick="voteArticle(${art.id}, 'no')" ${disabledAttr} class="inline-flex items-center space-x-2 border px-5 py-1.5 rounded-lg text-xs font-medium transition-all shadow-sm ${noBtnClasses} ${voted ? 'cursor-not-allowed' : ''}">
                                <i data-lucide="thumbs-down" class="w-3.5 h-3.5 ${voted === 'no' ? 'text-rose-600' : 'text-rose-400'}"></i><span>No (${art.noVotes})</span>
                            </button>
                        </div>
                        <span class="text-[11px] text-slate-400 block">${art.helpful} found this helpful${voted ? ' &middot; Thanks for your feedback!' : ''}</span>
                    </div>
                </div>
            `;
        }

        window.votedArticleIds = new Map();
        window.viewedArticleIds = new Set();

        function voteArticle(articleId, type) {
            if (votedArticleIds.has(articleId)) return;

            fetch(`/knowledge-base/${articleId}/vote`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ type })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    if (data.message) alert(data.message);
                    return;
                }
                votedArticleIds.set(articleId, type);

                const art = articles.find(a => a.id === articleId);
                if (art) {
                    art.yesVotes = data.yesVotes;
                    art.noVotes = data.noVotes;
                    art.helpful = data.helpful;
                }

                const cardEl = document.getElementById(`articleCard-${articleId}`);
                if (cardEl && art) {
                    cardEl.outerHTML = generateArticleCardMarkup(art);
                    lucide.createIcons();
                }
            })
            .catch(error => console.error("Error voting on article:", error));
        }

        function trackArticleView(articleId) {
            if (viewedArticleIds.has(articleId)) return;
            viewedArticleIds.add(articleId);

            fetch(`/knowledge-base/${articleId}/view`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) return;
                const art = articles.find(a => a.id === articleId);
                if (!art) return;
                art.views = (parseInt(String(art.views).replace(/,/g, '')) + 1).toLocaleString();
                const cardEl = document.getElementById(`articleCard-${articleId}`);
                if (cardEl) {
                    cardEl.outerHTML = generateArticleCardMarkup(art);
                    lucide.createIcons();
                }
            })
            .catch(error => console.error("Error tracking article view:", error));
        }

        function handleSupportRequestSubmit(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            
            const payload = {
                name: formData.get('name'),
                email: formData.get('email'),
                category: formData.get('category'),
                priority: formData.get('priority'),
                orderNumber: formData.get('orderNumber'),
                subject: formData.get('subject'),
                description: formData.get('description'),
            };

            fetch('/support-tickets', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(payload)
            })
            .then(response => response.json())
            .then(data => {
                if (data.id) {
                    form.reset();
                    
                    const newTkt = {
                        ticket_number: data.id,
                        subject: data.subject,
                        category: data.category,
                        priority: data.priority,
                        status: data.status,
                        created_at: data.created_at
                    };
                    tickets.unshift(newTkt);

                    const toast = document.getElementById('toastNotification');
                    toast.classList.remove('hidden');
                    setTimeout(() => { toast.classList.add('hidden'); }, 6000);

                    resetPortalHome();
                } else {
                    alert('Failed to submit support request. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error submitting support request:', error);
                alert('An error occurred. Please try again.');
            });
        }

        function filterTicketsBy(status) {
            ticketStatusFilter = status;

            const buttons = ['all', 'open', 'solved'];
            buttons.forEach(btn => {
                const el = document.getElementById(`ticketFilter-${btn}`);
                if (btn === status) {
                    el.className = "text-xs font-semibold px-4 py-1.5 rounded-lg transition-all bg-white text-slate-700 border border-slate-200 shadow-sm";
                } else {
                    el.className = "text-xs font-semibold px-4 py-1.5 rounded-lg transition-all text-slate-500 hover:text-slate-700";
                }
            });

            renderMyTicketsView();
        }

        function handleTicketSearch(query) {
            ticketSearchQuery = query.trim().toLowerCase();
            renderMyTicketsView();
        }

        function renderMyTicketsView() {
            const tableBody = document.getElementById('ticketsTableBody');
            const emptyState = document.getElementById('ticketsTableEmptyState');

            let filtered = [...tickets];

            if (ticketStatusFilter !== 'all') {
                filtered = filtered.filter(t => t.status.toLowerCase() === ticketStatusFilter);
            }

            if (ticketSearchQuery) {
                filtered = filtered.filter(t => 
                    t.ticket_number.toLowerCase().includes(ticketSearchQuery) ||
                    t.subject.toLowerCase().includes(ticketSearchQuery) ||
                    t.category.toLowerCase().includes(ticketSearchQuery)
                );
            }

            if (filtered.length === 0) {
                tableBody.innerHTML = '';
                emptyState.classList.remove('hidden');
                return;
            }

            emptyState.classList.add('hidden');

            tableBody.innerHTML = filtered.map(t => {
                let statusBadge = '';
                if (t.status.toLowerCase() === 'open') {
                    statusBadge = `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-blue-50 text-blue-700 border border-blue-100">Open</span>`;
                } else if (t.status.toLowerCase() === 'solved') {
                    statusBadge = `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">Solved</span>`;
                } else {
                    statusBadge = `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-slate-100 text-slate-700 border border-slate-200">${t.status}</span>`;
                }

                let priorityColor = 'text-slate-500';
                if (t.priority.toLowerCase() === 'high' || t.priority.toLowerCase() === 'urgent') {
                    priorityColor = 'text-rose-500 font-semibold';
                } else if (t.priority.toLowerCase() === 'medium') {
                    priorityColor = 'text-amber-500';
                }

                const displayDate = t.created_at ? new Date(t.created_at).toLocaleDateString() : 'N/A';

                return `
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-6 font-bold text-slate-900 select-all">${t.ticket_number}</td>
                        <td class="py-4 px-6 font-medium text-slate-800 max-w-xs truncate">${t.subject}</td>
                        <td class="py-4 px-6 text-slate-400 capitalize">${t.category}</td>
                        <td class="py-4 px-6 capitalize ${priorityColor}">${t.priority}</td>
                        <td class="py-4 px-6">${statusBadge}</td>
                        <td class="py-4 px-6 text-right text-slate-400 font-medium">${displayDate}</td>
                    </tr>
                `;
            }).join('');
        }

        function resetPortalHome() {
            activeTopicId = null;

            document.getElementById('portalHeroSection').classList.remove('hidden');
            document.getElementById('portalPillarCards').classList.remove('hidden');
            document.getElementById('portalPopularTopicsWrapper').classList.remove('hidden');
            document.getElementById('portalSatisfactionBanner').classList.remove('hidden');
            
            document.getElementById('filteredArticlesContainer').classList.add('hidden');
            document.getElementById('portalNewRequestView').classList.add('hidden');
            document.getElementById('portalMyTicketsView').classList.add('hidden');
            document.getElementById('portalArticlesView').classList.add('hidden');
            document.getElementById('portalFAQView').classList.add('hidden');
            document.getElementById('portalTermsView').classList.add('hidden');

            renderPopularTopicsGrid();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function switchView(targetView) {
            activeTopicId = null; 

            document.getElementById('portalHeroSection').classList.add('hidden');
            document.getElementById('portalPillarCards').classList.add('hidden');
            document.getElementById('portalPopularTopicsWrapper').classList.add('hidden');
            document.getElementById('portalSatisfactionBanner').classList.add('hidden');
            document.getElementById('filteredArticlesContainer').classList.add('hidden');
            
            document.getElementById('portalNewRequestView').classList.add('hidden');
            document.getElementById('portalMyTicketsView').classList.add('hidden');
            document.getElementById('portalArticlesView').classList.add('hidden');
            document.getElementById('portalFAQView').classList.add('hidden');
            document.getElementById('portalTermsView').classList.add('hidden');

            if (targetView === 'ARTICLES') {
                const stream = document.getElementById('fullKnowledgeBaseStream');
                
                if (articles.length === 0) {
                    stream.innerHTML = `<div class="col-span-2 text-center py-8 text-sm text-slate-400">No published articles found.</div>`;
                } else {
                    stream.innerHTML = articles.map(art => generateArticleCardMarkup(art)).join('') + 
                        `<div class="col-span-2 text-center py-4 text-xs text-slate-400 font-medium">You've reached the end.</div>`;
                    articles.forEach(art => trackArticleView(art.id));
                }
                
                document.getElementById('portalArticlesView').classList.remove('hidden');
                document.getElementById('portalSatisfactionBanner').classList.remove('hidden');
            } else if (targetView === 'FAQ') {
                document.getElementById('portalFAQView').classList.remove('hidden');
            } else if (targetView === 'NEW_REQUEST') {
                document.getElementById('portalNewRequestView').classList.remove('hidden');
            } else if (targetView === 'TERMS') {
                document.getElementById('portalTermsView').classList.remove('hidden');
                document.getElementById('portalSatisfactionBanner').classList.remove('hidden');
            } else if (targetView === 'MY_TICKETS') {
                document.getElementById('portalMyTicketsView').classList.remove('hidden');
                document.getElementById('portalSatisfactionBanner').classList.remove('hidden');
                ticketStatusFilter = 'all';
                ticketSearchQuery = '';
                renderMyTicketsView();
            }

            lucide.createIcons();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        renderPopularTopicsGrid();
    </script>
</body>
</html>