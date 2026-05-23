@extends('storefront.layout')

@section('title', 'Frequently Asked Questions - MunchGud')

@section('content')
<div class="bg-munch-cream min-h-screen pb-24" x-data="{ 
    searchQuery: '',
    activeCategory: 'all',
    activeFaq: null,
    faqs: [
        {
            category: 'products',
            q: 'What is Makhana and what are its health benefits?',
            a: 'Makhana, also known as Fox Nuts or Lotus Seeds, is an ancient superfood that grows in fresh water bodies. It is an excellent source of plant-based protein, dietary fiber, magnesium, and antioxidants. It is naturally gluten-free, low in calories, cholesterol, and saturated fat, making it the perfect healthy snack!'
        },
        {
            category: 'products',
            q: 'Do you use palm oil or artificial preservatives?',
            a: 'Absolutely not! At MunchGud, health comes first. We never use palm oil or cheap seed oils. Instead, we use premium olive oil or ghee to slow-roast our makhanas. Our products contain zero MSG, zero artificial colors, and zero chemical preservatives.'
        },
        {
            category: 'orders',
            q: 'How can I track my order?',
            a: 'Once your order is shipped, we send you a confirmation message via SMS and email with a live tracking link. You can also track your order directly from your MunchGud Account Dashboard by clicking on the Orders section.'
        },
        {
            category: 'orders',
            q: 'Can I modify or cancel my order after placing it?',
            a: 'Orders can be modified or cancelled within 2 hours of placing them by contacting our customer support team directly at {{ $global_settings['store_email'] ?? 'support@munchgud.com' }} or raising a support ticket in your dashboard. Once the order is dispatched, we cannot cancel it.'
        },
        {
            category: 'shipping',
            q: 'What are the shipping charges and estimated delivery times?',
            a: 'We offer FREE Shipping on all orders above ₹999. For orders below ₹999, a flat shipping fee of ₹49 applies. Delivery typically takes 2-4 business days for metro cities and 4-7 business days for the rest of India.'
        },
        {
            category: 'shipping',
            q: 'Do you ship internationally?',
            a: 'Currently, we only ship within India. However, we are actively working on bringing our premium roasted makhanas to snack lovers worldwide. Stay tuned to our social media for updates!'
        },
        {
            category: 'payments',
            q: 'What payment options do you support?',
            a: 'We accept all major credit/debit cards, Netbanking, popular UPI apps (Google Pay, PhonePe, Paytm), digital wallets, and Cash on Delivery (COD). All online payments are handled securely through our encrypted payment partner, Razorpay.'
        },
        {
            category: 'payments',
            q: 'Is Cash on Delivery (COD) available?',
            a: 'Yes, we provide Cash on Delivery (COD) across most pincodes in India. There is a nominal COD processing fee of ₹30 charged by our logistics partners.'
        }
    ],
    filteredFaqs() {
        return this.faqs.filter(faq => {
            const matchesSearch = faq.q.toLowerCase().includes(this.searchQuery.toLowerCase()) || 
                                  faq.a.toLowerCase().includes(this.searchQuery.toLowerCase());
            const matchesCategory = this.activeCategory === 'all' || faq.category === this.activeCategory;
            return matchesSearch && matchesCategory;
        });
    }
}">
    <!-- Hero -->
    <div class="relative bg-munch-900 py-24 overflow-hidden text-center">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#E07B2A 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="relative z-10 max-w-3xl mx-auto px-4">
            <span class="text-munch-accent uppercase tracking-widest font-bold text-xs mb-3 block">Got Questions?</span>
            <h1 class="text-4xl md:text-5xl font-serif text-white mb-6">Frequently Asked Questions</h1>
            <p class="text-lg text-munch-200 font-light max-w-xl mx-auto">Find answers to common questions about our products, shipping, orders, and more.</p>
        </div>
    </div>

    <!-- Search and Navigation Bar -->
    <div class="max-w-4xl mx-auto px-4 -mt-8 relative z-20">
        <div class="bg-white rounded-2xl border border-munch-200 premium-shadow p-6 flex flex-col md:flex-row gap-4 items-center justify-between">
            <!-- Search bar -->
            <div class="relative w-full md:w-72">
                <input type="text" x-model="searchQuery" placeholder="Search FAQ..." class="w-full border border-munch-300 rounded-full px-5 py-3 pl-11 text-sm focus:border-mg-green focus:ring-mg-green text-munch-900 bg-munch-50/50">
                <svg class="w-4 h-4 text-munch-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35" stroke-linecap="round"/></svg>
            </div>
            
            <!-- Category Tabs -->
            <div class="flex flex-wrap gap-2 justify-center">
                <button @click="activeCategory = 'all'" :class="activeCategory === 'all' ? 'bg-mg-green text-white shadow-md' : 'bg-munch-50 text-munch-700 hover:bg-munch-100'" class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all">All</button>
                <button @click="activeCategory = 'products'" :class="activeCategory === 'products' ? 'bg-mg-green text-white shadow-md' : 'bg-munch-50 text-munch-700 hover:bg-munch-100'" class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all">Products</button>
                <button @click="activeCategory = 'orders'" :class="activeCategory === 'orders' ? 'bg-mg-green text-white shadow-md' : 'bg-munch-50 text-munch-700 hover:bg-munch-100'" class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all">Orders</button>
                <button @click="activeCategory = 'shipping'" :class="activeCategory === 'shipping' ? 'bg-mg-green text-white shadow-md' : 'bg-munch-50 text-munch-700 hover:bg-munch-100'" class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all">Shipping</button>
                <button @click="activeCategory = 'payments'" :class="activeCategory === 'payments' ? 'bg-mg-green text-white shadow-md' : 'bg-munch-50 text-munch-700 hover:bg-munch-100'" class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all">Payments</button>
            </div>
        </div>
    </div>

    <!-- Accordion Section -->
    <div class="max-w-3xl mx-auto px-4 mt-12">
        <div class="space-y-4">
            <!-- Dynamic Loop -->
            <template x-for="(faq, index) in filteredFaqs()" :key="index">
                <div class="bg-white border border-munch-200 rounded-2xl overflow-hidden transition-all duration-300 hover:border-mg-green/30" :class="activeFaq === index ? 'shadow-md ring-1 ring-mg-green/10' : ''">
                    <button @click="activeFaq = activeFaq === index ? null : index" class="w-full text-left px-6 py-5 flex items-center justify-between gap-4 select-none focus:outline-none">
                        <span class="text-base font-serif font-semibold text-munch-900 leading-snug" x-text="faq.q"></span>
                        <span class="flex-shrink-0 w-8 h-8 rounded-full bg-munch-50 text-munch-700 flex items-center justify-center transition-transform duration-300" :class="activeFaq === index ? 'rotate-180 bg-mg-green text-white' : ''">
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                    </button>
                    
                    <div x-show="activeFaq === index" x-collapse x-cloak class="border-t border-munch-100 bg-munch-50/20">
                        <div class="px-6 py-5 text-sm text-munch-600 leading-relaxed font-light" x-html="faq.a"></div>
                    </div>
                </div>
            </template>
            
            <!-- Empty state -->
            <div x-show="filteredFaqs().length === 0" x-cloak class="text-center py-12 bg-white rounded-2xl border border-munch-200">
                <svg class="w-12 h-12 text-munch-300 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <h3 class="text-lg font-serif text-munch-900 font-bold mb-2">No matching questions found</h3>
                <p class="text-sm text-munch-500 font-light max-w-xs mx-auto">Try typing a different keyword or explore our categories.</p>
            </div>
        </div>

        <!-- Contact CTA -->
        <div class="mt-16 text-center bg-white border border-munch-200 rounded-3xl p-8 max-w-xl mx-auto shadow-sm">
            <h3 class="text-2xl font-serif text-munch-900 mb-2">Still have questions?</h3>
            <p class="text-sm text-munch-600 font-light mb-6">Our support crew is always ready to guide you on your makhana journey.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center bg-mg-green text-white text-xs font-bold px-6 py-3.5 rounded-full hover:bg-mg-green-dark uppercase tracking-widest transition-all">Contact Support</a>
                <a href="mailto:{{ $global_settings['store_email'] ?? 'support@munchgud.com' }}" class="inline-flex items-center justify-center bg-munch-50 border border-munch-200 text-munch-800 text-xs font-bold px-6 py-3.5 rounded-full hover:bg-munch-100 uppercase tracking-widest transition-all">Email Us</a>
            </div>
        </div>
    </div>
</div>
@endsection
