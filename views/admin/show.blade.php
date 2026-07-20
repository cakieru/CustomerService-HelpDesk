@extends('layouts.app')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="bg-gray-50 font-sans text-gray-800 min-h-screen flex w-full">
    <main class="flex-1 flex flex-col h-full bg-white relative">
        
        <header class="h-16 border-b border-gray-200 bg-white flex items-center justify-between px-8 flex-shrink-0">
            <div class="relative w-96">
                <input type="text" placeholder="Search tickets..." class="w-full pl-4 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none">
            </div>

            <div class="flex items-center space-x-6">
                <div x-data="{ notificationsOpen: false }" class="relative">
                    <button @click="notificationsOpen = !notificationsOpen" class="relative text-gray-500 hover:text-gray-700 focus:outline-none cursor-pointer">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        @if(count($notifications) > 0)
                            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                        @endif
                    </button>

                    <div x-cloak x-show="notificationsOpen" @click.outside="notificationsOpen = false" x-transition class="absolute right-0 mt-3 w-80 bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden z-50">
                        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100 bg-gray-50">
                            <h3 class="font-semibold text-gray-800 text-xs">Dynamic Live Feed</h3>
                        </div>
                        <div class="max-h-96 overflow-y-auto divide-y divide-gray-50">
                            @forelse($notifications as $notif)
                                <a href="{{ route('admin.support.tickets.show', $notif->id) }}" class="flex px-4 py-3 hover:bg-gray-50 transition">
                                    <div class="flex-grow">
                                        <p class="text-xs font-bold text-gray-900">New Ticket Added</p>
                                        <p class="text-[11px] text-gray-500">Ref #{{ $notif->ticket_reference }}</p>
                                    </div>
                                </a>
                            @empty
                                <div class="p-4 text-center text-xs text-gray-400">No new alerts.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm shadow-sm">AD</div>
            </div>
        </header>
        
        <div class="flex-1 bg-gray-50/50 p-6 overflow-y-auto">
            <div class="max-w-7xl mx-auto">
                <a href="{{ route('admin.support.tickets.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 mb-6 transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Tickets Master List
                </a>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-xs font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex flex-col lg:flex-row gap-6">
                    <div class="flex-1 space-y-6">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-3">
                                    <span class="text-sm font-semibold text-gray-500">{{ $ticket->ticket_reference }}</span>
                                    <span class="px-2 py-0.5 rounded text-xs font-medium bg-red-50 text-red-600 capitalize">{{ $ticket->priority }}</span>
                                </div>
                                
                                <form action="{{ route('admin.support.tickets.update-status', $ticket->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="px-3 py-1.5 border border-gray-200 rounded-lg text-xs font-semibold bg-white cursor-pointer focus:outline-none">
                                        <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                                        <option value="in-progress" {{ $ticket->status === 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                        <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </form>
                            </div>

                            <h1 class="text-xl font-bold text-gray-900 mb-2">{{ $ticket->subject }}</h1>
                            <p class="text-gray-600 text-sm whitespace-pre-wrap">{{ $ticket->description }}</p>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                            <h2 class="text-sm font-bold text-gray-900 mb-4">Activity logs & Responses</h2>
                            <div class="space-y-4">
                                @foreach($ticket->replies as $reply)
                                    <div class="p-4 rounded-xl text-xs {{ $reply->user->is_admin ? 'bg-blue-50/50 border border-blue-100 text-blue-900' : 'bg-gray-50 text-gray-800' }}">
                                        <div class="flex justify-between font-bold mb-1">
                                            <span>{{ $reply->user->name }} {{ $reply->user->is_admin ? '(Staff)' : '' }}</span>
                                            <span class="text-gray-400 font-normal">{{ $reply->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="whitespace-pre-wrap">{{ $reply->body }}</p>
                                    </div>
                                @endforeach
                            </div>

                            <form action="{{ route('admin.support.tickets.reply', $ticket->id) }}" method="POST" class="mt-6 pt-4 border-t border-gray-100">
                                @csrf
                                <textarea name="body" required rows="3" placeholder="Respond or post internal actions record..." class="w-full border border-gray-200 rounded-xl p-3 text-xs focus:ring-1 focus:ring-blue-500 outline-none resize-none"></textarea>
                                <div class="flex justify-end mt-2">
                                    <button type="submit" class="bg-blue-600 text-white text-xs font-semibold px-4 py-2 rounded-lg hover:bg-blue-700 transition">Submit Message</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="w-full lg:w-80 space-y-6">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 text-xs">
                            <h3 class="font-bold text-gray-900 mb-3">Customer Profile</h3>
                            <p class="font-bold text-gray-800">{{ $ticket->customer->name ?? 'Unknown Client' }}</p>
                            <p class="text-gray-400 mt-0.5">{{ $ticket->customer->email ?? 'N/A' }}</p>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 text-xs">
                            <h3 class="font-bold text-gray-900 mb-2">Assign Representative</h3>
                            <form action="{{ route('admin.support.tickets.assign', $ticket->id) }}" method="POST">
                                @csrf
                                <select name="agent_id" onchange="this.form.submit()" class="w-full border border-gray-200 rounded-lg p-2 bg-white font-medium focus:outline-none">
                                    <option value="">Choose Agent...</option>
                                    @foreach($admins as $admin)
                                        <option value="{{ $admin->id }}" {{ $ticket->agent_id == $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>
@endsection