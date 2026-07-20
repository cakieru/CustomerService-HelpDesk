@extends('layouts.app')

@section('content')
<div class="text-center max-w-3xl mx-auto mb-12">
    <div class="inline-flex items-center space-x-2 bg-indigo-50 text-indigo-700 px-4 py-1.5 rounded-full text-sm font-medium mb-6">
        <span>⚡ Average response time: under 2 hours</span>
    </div>
    <h2 class="text-4xl font-bold text-gray-900 mb-4">How can we help you?</h2>
    <p class="text-lg text-gray-600 mb-8">Search our knowledge base or submit a support request.</p>
    
    <div class="relative max-w-2xl mx-auto shadow-sm">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <input type="text" class="block w-full pl-11 pr-4 py-4 border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-lg border bg-white outline-none" placeholder="Search articles, FAQs, guides...">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
    <a href="{{ route('customer.create') }}" class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition group">
        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-6">🎫</div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">Submit a Request</h3>
        <p class="text-gray-500 text-sm mb-6">Create a new support ticket and our team will respond shortly.</p>
        <span class="text-blue-600 font-medium text-sm group-hover:underline flex items-center">Get started &rarr;</span>
    </a>

    <a href="{{ route('customer.tickets') }}" class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition group">
        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-6">🕒</div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">Track My Tickets</h3>
        <p class="text-gray-500 text-sm mb-6">Check the status of your open requests and view replies.</p>
        <span class="text-green-600 font-medium text-sm group-hover:underline flex items-center">View Tickets &rarr;</span>
    </a>

    <a href="#" class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition group">
        <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-xl flex items-center justify-center mb-6">📖</div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">Knowledge Base</h3>
        <p class="text-gray-500 text-sm mb-6">Browse guides, FAQs, and how-to articles to find quick answers.</p>
        <span class="text-yellow-700 font-medium text-sm group-hover:underline flex items-center">Browse Articles &rarr;</span>
    </a>
</div>

<h3 class="text-xl font-bold text-gray-900 mb-4">Popular topics</h3>
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white p-4 rounded-xl border border-gray-100 flex items-center space-x-3 cursor-pointer hover:shadow-sm">
        <div class="text-gray-400">🚚</div>
        <div>
            <h4 class="font-bold text-sm text-gray-900">Shipping & Delivery</h4>
            <p class="text-xs text-gray-500">2 articles</p>
        </div>
    </div>
    </div>
@endsection