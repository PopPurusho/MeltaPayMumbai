@extends('layouts.auth2')
@section('title', config('app.name', 'ultimatePOS'))
@inject('request', 'Illuminate\Http\Request')
@section('content')
<div class="tw-w-full">
    {{-- Hero --}}
    <section class="tw-max-w-6xl tw-mx-auto tw-flex tw-items-center tw-gap-8 tw-py-12 tw-px-6">
        <div class="tw-flex-1">
            <h1 class="tw-text-4xl md:tw-text-5xl tw-font-extrabold tw-text-gray-900">MeltaPay — POS for modern businesses</h1>
            <p class="tw-mt-4 tw-text-lg tw-text-gray-600">Fast, reliable and beautiful point-of-sale software to manage sales, inventory, customers and payments — all from one dashboard.</p>

            <div class="tw-mt-6 tw-flex tw-gap-3">
                <a href="{{ route('business.getRegister') }}" class="auth-btn-primary" style="width:auto; padding:10px 22px;">Get Started — Free</a>
                <a href="{{ route('login') }}" class="auth-btn-outline" style="width:auto; padding:10px 18px;">Sign In</a>
            </div>

            <div class="tw-mt-10 tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-4">
                <div class="tw-bg-white tw-p-4 tw-rounded-lg tw-shadow-sm">
                    <h3 class="tw-font-semibold tw-text-gray-800">Fast Checkout</h3>
                    <p class="tw-text-sm tw-text-gray-600 tw-mt-2">Process sales quickly with an intuitivePOS interface and built-in payment links.</p>
                </div>
                <div class="tw-bg-white tw-p-4 tw-rounded-lg tw-shadow-sm">
                    <h3 class="tw-font-semibold tw-text-gray-800">Inventory Control</h3>
                    <p class="tw-text-sm tw-text-gray-600 tw-mt-2">Track stock levels, set alerts and manage variants across locations.</p>
                </div>
                <div class="tw-bg-white tw-p-4 tw-rounded-lg tw-shadow-sm">
                    <h3 class="tw-font-semibold tw-text-gray-800">Reports & Insights</h3>
                    <p class="tw-text-sm tw-text-gray-600 tw-mt-2">View sales, profits, and customer analytics to grow your business.</p>
                </div>
            </div>
        </div>

        <div class="tw-w-1/2 md:tw-w-1/3 tw-hidden sm:tw-block">
            <div class="tw-rounded-xl tw-overflow-hidden tw-shadow-lg">
                <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1200&q=80" alt="POS" style="width:100%; height:100%; object-fit:cover; display:block;">
            </div>
        </div>
    </section>

    {{-- Feature strip --}}
    <section class="tw-bg-gray-50 tw-border-t tw-border-gray-100">
        <div class="tw-max-w-6xl tw-mx-auto tw-py-12 tw-px-6">
            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-8">
                <div>
                    <h4 class="tw-text-lg tw-font-semibold tw-text-gray-800">Accept Payments</h4>
                    <p class="tw-text-gray-600 tw-mt-2">Integrated payment options for terminals, cards and online checkout.</p>
                </div>
                <div>
                    <h4 class="tw-text-lg tw-font-semibold tw-text-gray-800">Multi-Store Ready</h4>
                    <p class="tw-text-gray-600 tw-mt-2">Manage multiple locations, stock transfers and consolidated reporting.</p>
                </div>
                <div>
                    <h4 class="tw-text-lg tw-font-semibold tw-text-gray-800">Secure & Compliant</h4>
                    <p class="tw-text-gray-600 tw-mt-2">Role-based access, encrypted data and audit trails built in.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA footer --}}
    <section class="tw-max-w-6xl tw-mx-auto tw-py-10 tw-px-6">
        <div class="tw-bg-gradient-to-r tw-from-indigo-600 tw-to-indigo-500 tw-rounded-xl tw-p-8 tw-flex tw-items-center tw-justify-between tw-gap-6">
            <div>
                <h3 class="tw-text-2xl tw-font-bold tw-text-white">Ready to modernize your checkout?</h3>
                <p class="tw-text-indigo-100 tw-mt-2">Start a free trial and see how MeltaPay fits your business.</p>
            </div>
            <div class="tw-flex tw-gap-3">
                <a href="{{ route('business.getRegister') }}" class="auth-btn-primary" style="width:auto; padding:10px 22px;">Create Account</a>
                <a href="{{ route('login') }}" class="auth-btn-outline" style="width:auto; padding:10px 18px; background:rgba(255,255,255,0.12); color:#fff;">Sign In</a>
            </div>
        </div>
    </section>
</div>

@endsection
            