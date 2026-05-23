@extends('storefront.account.layout')

@section('account_content')
<div class="flex items-center justify-between mb-8">
    <h2 class="font-heading text-3xl font-bold text-mg-dark">Create Support Ticket</h2>
    <a href="{{ route('account.tickets.index') }}" class="text-sm font-semibold text-mg-muted hover:text-mg-green flex items-center gap-1">
        &larr; Back
    </a>
</div>

<div class="bg-white rounded-3xl p-8 border border-mg-dark/5 shadow-xl shadow-mg-dark/5">
    <form action="{{ route('account.tickets.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-mg-dark mb-2">Subject <span class="text-red-500">*</span></label>
                <input type="text" name="subject" required class="w-full bg-mg-cream border border-mg-dark/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-mg-green/20" placeholder="Brief summary of your issue">
            </div>
            
            <div>
                <label class="block text-sm font-bold text-mg-dark mb-2">Priority <span class="text-red-500">*</span></label>
                <select name="priority" required class="w-full bg-mg-cream border border-mg-dark/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-mg-green/20">
                    <option value="low">Low - General Question</option>
                    <option value="medium" selected>Medium - Issue with product</option>
                    <option value="high">High - Missing/Damaged items</option>
                    <option value="urgent">Urgent - Payment/Security issue</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-mg-dark mb-2">Related Order (Optional)</label>
            <select name="order_id" class="w-full bg-mg-cream border border-mg-dark/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-mg-green/20">
                <option value="">Select an order...</option>
                @foreach($orders as $order)
                    <option value="{{ $order->id }}" {{ request('order_id') == $order->id ? 'selected' : '' }}>
                        Order #{{ $order->order_number }} - {{ $order->created_at->format('M d, Y') }} (₹{{ $order->total }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold text-mg-dark mb-2">Message <span class="text-red-500">*</span></label>
            <textarea name="message" required rows="6" class="w-full bg-mg-cream border border-mg-dark/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-mg-green/20" placeholder="Please provide as much detail as possible so we can help you quickly..."></textarea>
        </div>

        <div class="flex justify-end pt-4 border-t border-mg-dark/5">
            <button type="submit" class="bg-mg-green text-white font-bold px-8 py-3 rounded-xl hover:bg-mg-green-dark transition-all">Submit Ticket</button>
        </div>
    </form>
</div>
@endsection
