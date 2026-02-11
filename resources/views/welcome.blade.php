@extends('layouts.auth2')
@section('title', config('app.name', 'MeltaPay') . ' — Modern POS for Every Business')
@inject('request', 'Illuminate\Http\Request')
@section('content')
<style>
    .landing-hero { background: linear-gradient(135deg, #eef2ff 0%, #f0f4f8 50%, #e0e7ff 100%); }
    .landing-section { max-width: 1140px; margin: 0 auto; padding: 0 24px; }
    .landing-icon-box {
        width: 56px; height: 56px; border-radius: 16px;
        display: inline-flex; align-items: center; justify-content: center;
        margin-bottom: 16px; flex-shrink: 0;
    }
    .landing-feature-card {
        background: #fff; border: 1px solid #e2e8f0; border-radius: 16px;
        padding: 28px 24px; transition: box-shadow 0.2s, transform 0.2s;
    }
    .landing-feature-card:hover { box-shadow: 0 8px 30px -6px rgba(99,102,241,0.12); transform: translateY(-2px); }
    .landing-stat { text-align: center; }
    .landing-stat-num { font-size: 40px; font-weight: 800; color: #4f46e5; line-height: 1; }
    .landing-stat-label { font-size: 14px; color: #64748b; margin-top: 6px; }
    .landing-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 32px; align-items: center; }
    .landing-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
    .landing-grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
    @media (max-width: 900px) {
        .landing-grid-2, .landing-grid-3, .landing-grid-4 { grid-template-columns: 1fr; }
        .landing-hero-img { display: none !important; }
    }
    @media (min-width: 901px) and (max-width: 1100px) {
        .landing-grid-4 { grid-template-columns: repeat(2, 1fr); }
    }
</style>

<div style="width:100%;">

    {{-- ═══ HERO ═══ --}}
    <section class="landing-hero" style="padding: 64px 0 72px;">
        <div class="landing-section landing-grid-2">
            <div>
                <span style="display:inline-block; background:#e0e7ff; color:#4f46e5; font-weight:700; font-size:13px; padding:6px 14px; border-radius:20px; margin-bottom:20px; letter-spacing:0.02em;">
                    #1 POS SOLUTION FOR GROWING BUSINESSES
                </span>
                <h1 style="font-size:44px; font-weight:800; color:#0f172a; line-height:1.15; letter-spacing:-0.03em; margin:0 0 18px;">
                    Run Your Entire Business From One Screen
                </h1>
                <p style="font-size:18px; color:#475569; line-height:1.7; margin:0 0 28px; max-width:520px;">
                    MeltaPay is an all-in-one point-of-sale system that helps retailers, restaurants, pharmacies and service businesses sell faster, manage stock smarter, and grow revenue — without the complexity.
                </p>
                <div style="display:flex; gap:20px; flex-wrap:wrap;">
                    <div style="display:flex; align-items:center; gap:8px;">
                        <svg width="20" height="20" fill="none" stroke="#16a34a" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        <span style="font-size:14px; font-weight:600; color:#334155;">No credit card required</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:8px;">
                        <svg width="20" height="20" fill="none" stroke="#16a34a" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        <span style="font-size:14px; font-weight:600; color:#334155;">Setup in 5 minutes</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:8px;">
                        <svg width="20" height="20" fill="none" stroke="#16a34a" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        <span style="font-size:14px; font-weight:600; color:#334155;">Works on any device</span>
                    </div>
                </div>
            </div>
            <div class="landing-hero-img" style="display:flex; justify-content:center;">
                <div style="border-radius:20px; overflow:hidden; box-shadow:0 20px 60px -12px rgba(0,0,0,0.18); border:4px solid #fff; max-width:460px;">
                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=900&q=80" alt="Point of Sale" style="width:100%; display:block;">
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ STATS ═══ --}}
    <section style="background:#fff; border-top:1px solid #e2e8f0; border-bottom:1px solid #e2e8f0; padding:44px 0;">
        <div class="landing-section landing-grid-4">
            <div class="landing-stat">
                <div class="landing-stat-num">50+</div>
                <div class="landing-stat-label">Business Types Supported</div>
            </div>
            <div class="landing-stat">
                <div class="landing-stat-num">24/7</div>
                <div class="landing-stat-label">Cloud Access Anywhere</div>
            </div>
            <div class="landing-stat">
                <div class="landing-stat-num">10k+</div>
                <div class="landing-stat-label">Products per Store</div>
            </div>
            <div class="landing-stat">
                <div class="landing-stat-num">99.9%</div>
                <div class="landing-stat-label">Uptime Reliability</div>
            </div>
        </div>
    </section>

    {{-- ═══ WHY YOUR BUSINESS NEEDS A POS ═══ --}}
    <section style="padding:72px 0;">
        <div class="landing-section">
            <div style="text-align:center; margin-bottom:48px;">
                <h2 style="font-size:34px; font-weight:800; color:#0f172a; margin:0 0 12px; letter-spacing:-0.02em;">
                    Why Every Business Needs a POS System
                </h2>
                <p style="font-size:16px; color:#64748b; max-width:620px; margin:0 auto; line-height:1.7;">
                    A modern POS system is more than a cash register — it's the brain of your business. Here's what it does for you.
                </p>
            </div>

            <div class="landing-grid-3">
                <div class="landing-feature-card">
                    <div class="landing-icon-box" style="background:linear-gradient(135deg,#dbeafe,#c7d2fe);">
                        <svg width="28" height="28" fill="none" stroke="#4f46e5" stroke-width="1.8" viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    </div>
                    <h3 style="font-size:18px; font-weight:700; color:#0f172a; margin:0 0 8px;">Lightning-Fast Checkout</h3>
                    <p style="font-size:14px; color:#64748b; line-height:1.65; margin:0;">
                        Reduce queue times by 60%. Barcode scanning, touch-friendly interface, and one-tap payment processing means your staff ring up sales in seconds, not minutes.
                    </p>
                </div>

                <div class="landing-feature-card">
                    <div class="landing-icon-box" style="background:linear-gradient(135deg,#d1fae5,#a7f3d0);">
                        <svg width="28" height="28" fill="none" stroke="#059669" stroke-width="1.8" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4M4 7l8 4M4 7v10l8 4m0-10v10"/></svg>
                    </div>
                    <h3 style="font-size:18px; font-weight:700; color:#0f172a; margin:0 0 8px;">Real-Time Inventory</h3>
                    <p style="font-size:14px; color:#64748b; line-height:1.65; margin:0;">
                        Always know what's in stock. Automatic low-stock alerts, purchase order management, and multi-location tracking keep shelves full and money flowing.
                    </p>
                </div>

                <div class="landing-feature-card">
                    <div class="landing-icon-box" style="background:linear-gradient(135deg,#fef3c7,#fde68a);">
                        <svg width="28" height="28" fill="none" stroke="#d97706" stroke-width="1.8" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 style="font-size:18px; font-weight:700; color:#0f172a; margin:0 0 8px;">Profit & Sales Analytics</h3>
                    <p style="font-size:14px; color:#64748b; line-height:1.65; margin:0;">
                        See your top-selling products, busiest hours, and profit margins at a glance. Data-driven decisions replace guesswork and boost your bottom line.
                    </p>
                </div>

                <div class="landing-feature-card">
                    <div class="landing-icon-box" style="background:linear-gradient(135deg,#fce7f3,#fbcfe8);">
                        <svg width="28" height="28" fill="none" stroke="#db2777" stroke-width="1.8" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 style="font-size:18px; font-weight:700; color:#0f172a; margin:0 0 8px;">Customer Management</h3>
                    <p style="font-size:14px; color:#64748b; line-height:1.65; margin:0;">
                        Build lasting relationships. Track purchase history, manage loyalty points, send payment reminders, and turn one-time buyers into repeat customers.
                    </p>
                </div>

                <div class="landing-feature-card">
                    <div class="landing-icon-box" style="background:linear-gradient(135deg,#e0e7ff,#c7d2fe);">
                        <svg width="28" height="28" fill="none" stroke="#4f46e5" stroke-width="1.8" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 style="font-size:18px; font-weight:700; color:#0f172a; margin:0 0 8px;">Secure & Role-Based</h3>
                    <p style="font-size:14px; color:#64748b; line-height:1.65; margin:0;">
                        Assign cashier, manager, and admin roles with fine-grained permissions. Every transaction is logged — no more shrinkage or unexplained losses.
                    </p>
                </div>

                <div class="landing-feature-card">
                    <div class="landing-icon-box" style="background:linear-gradient(135deg,#ccfbf1,#99f6e4);">
                        <svg width="28" height="28" fill="none" stroke="#0d9488" stroke-width="1.8" viewBox="0 0 24 24"><path d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/></svg>
                    </div>
                    <h3 style="font-size:18px; font-weight:700; color:#0f172a; margin:0 0 8px;">Cloud-Based, Always On</h3>
                    <p style="font-size:14px; color:#64748b; line-height:1.65; margin:0;">
                        Access your business from a laptop, tablet or phone — at the shop or on the go. Data syncs in real-time so you never miss a beat.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ WHY MELTAPAY ═══ --}}
    <section style="background:#fff; padding:72px 0;">
        <div class="landing-section">
            <div class="landing-grid-2">
                <div>
                    <span style="display:inline-block; background:#f0fdf4; color:#16a34a; font-weight:700; font-size:13px; padding:6px 14px; border-radius:20px; margin-bottom:20px;">
                        WHY MELTAPAY?
                    </span>
                    <h2 style="font-size:32px; font-weight:800; color:#0f172a; margin:0 0 18px; letter-spacing:-0.02em; line-height:1.2;">
                        Built for Businesses Like Yours
                    </h2>
                    <p style="font-size:16px; color:#475569; line-height:1.7; margin:0 0 28px;">
                        Whether you run a retail shop, a restaurant, a pharmacy, or a service business — MeltaPay adapts to your workflow, not the other way around.
                    </p>

                    <div style="display:flex; flex-direction:column; gap:20px;">
                        <div style="display:flex; gap:14px; align-items:flex-start;">
                            <div style="min-width:36px; height:36px; border-radius:10px; background:#e0e7ff; display:flex; align-items:center; justify-content:center;">
                                <svg width="18" height="18" fill="none" stroke="#4f46e5" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <h4 style="font-size:15px; font-weight:700; color:#0f172a; margin:0 0 4px;">Multi-Location Support</h4>
                                <p style="font-size:14px; color:#64748b; margin:0; line-height:1.6;">Manage inventory, sales, and staff across all your branches from one dashboard.</p>
                            </div>
                        </div>
                        <div style="display:flex; gap:14px; align-items:flex-start;">
                            <div style="min-width:36px; height:36px; border-radius:10px; background:#d1fae5; display:flex; align-items:center; justify-content:center;">
                                <svg width="18" height="18" fill="none" stroke="#059669" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <h4 style="font-size:15px; font-weight:700; color:#0f172a; margin:0 0 4px;">Invoicing & Receipts</h4>
                                <p style="font-size:14px; color:#64748b; margin:0; line-height:1.6;">Generate professional invoices, thermal receipts, and share digital copies via WhatsApp or email.</p>
                            </div>
                        </div>
                        <div style="display:flex; gap:14px; align-items:flex-start;">
                            <div style="min-width:36px; height:36px; border-radius:10px; background:#fef3c7; display:flex; align-items:center; justify-content:center;">
                                <svg width="18" height="18" fill="none" stroke="#d97706" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <h4 style="font-size:15px; font-weight:700; color:#0f172a; margin:0 0 4px;">Expense & Accounting</h4>
                                <p style="font-size:14px; color:#64748b; margin:0; line-height:1.6;">Track every rupee coming in and going out. Expense categories, payment accounts, and profit reports built in.</p>
                            </div>
                        </div>
                        <div style="display:flex; gap:14px; align-items:flex-start;">
                            <div style="min-width:36px; height:36px; border-radius:10px; background:#fce7f3; display:flex; align-items:center; justify-content:center;">
                                <svg width="18" height="18" fill="none" stroke="#db2777" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <h4 style="font-size:15px; font-weight:700; color:#0f172a; margin:0 0 4px;">Barcode & Label Printing</h4>
                                <p style="font-size:14px; color:#64748b; margin:0; line-height:1.6;">Generate and print barcodes for your products. Scan to sell, scan to stock — keep everything organized.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="landing-hero-img" style="display:flex; justify-content:center;">
                    <div style="border-radius:20px; overflow:hidden; box-shadow:0 20px 60px -12px rgba(0,0,0,0.15); border:4px solid #fff; max-width:440px;">
                        <img src="https://images.unsplash.com/photo-1556742111-a301076d9d18?w=900&q=80" alt="Inventory" style="width:100%; display:block;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ INDUSTRIES ═══ --}}
    <section style="padding:72px 0; background:linear-gradient(180deg,#f8fafc 0%,#f0f4f8 100%);">
        <div class="landing-section">
            <div style="text-align:center; margin-bottom:48px;">
                <h2 style="font-size:34px; font-weight:800; color:#0f172a; margin:0 0 12px; letter-spacing:-0.02em;">
                    One POS, Every Industry
                </h2>
                <p style="font-size:16px; color:#64748b; max-width:560px; margin:0 auto; line-height:1.7;">
                    MeltaPay is designed to work out of the box for a wide range of businesses.
                </p>
            </div>
            <div class="landing-grid-4">
                <div style="background:#fff; border:1px solid #e2e8f0; border-radius:14px; padding:24px 20px; text-align:center;">
                    <div style="font-size:36px; margin-bottom:10px;">🛒</div>
                    <h4 style="font-size:16px; font-weight:700; color:#0f172a; margin:0 0 6px;">Retail & Supermarket</h4>
                    <p style="font-size:13px; color:#64748b; margin:0; line-height:1.6;">Barcode scanning, bulk pricing, and loyalty points for high-volume shops.</p>
                </div>
                <div style="background:#fff; border:1px solid #e2e8f0; border-radius:14px; padding:24px 20px; text-align:center;">
                    <div style="font-size:36px; margin-bottom:10px;">🍽️</div>
                    <h4 style="font-size:16px; font-weight:700; color:#0f172a; margin:0 0 6px;">Restaurant & Café</h4>
                    <p style="font-size:13px; color:#64748b; margin:0; line-height:1.6;">Table management, kitchen orders, modifiers and KOT printing.</p>
                </div>
                <div style="background:#fff; border:1px solid #e2e8f0; border-radius:14px; padding:24px 20px; text-align:center;">
                    <div style="font-size:36px; margin-bottom:10px;">💊</div>
                    <h4 style="font-size:16px; font-weight:700; color:#0f172a; margin:0 0 6px;">Pharmacy</h4>
                    <p style="font-size:13px; color:#64748b; margin:0; line-height:1.6;">Expiry tracking, batch management, and GST-ready billing.</p>
                </div>
                <div style="background:#fff; border:1px solid #e2e8f0; border-radius:14px; padding:24px 20px; text-align:center;">
                    <div style="font-size:36px; margin-bottom:10px;">🔧</div>
                    <h4 style="font-size:16px; font-weight:700; color:#0f172a; margin:0 0 6px;">Services & Repair</h4>
                    <p style="font-size:13px; color:#64748b; margin:0; line-height:1.6;">Job cards, service tracking, warranty management and customer follow-ups.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ HOW IT WORKS ═══ --}}
    <section style="background:#fff; padding:72px 0;">
        <div class="landing-section">
            <div style="text-align:center; margin-bottom:48px;">
                <h2 style="font-size:34px; font-weight:800; color:#0f172a; margin:0 0 12px; letter-spacing:-0.02em;">
                    Get Started in 3 Simple Steps
                </h2>
                <p style="font-size:16px; color:#64748b; max-width:480px; margin:0 auto;">
                    From sign-up to your first sale — it takes less than 5 minutes.
                </p>
            </div>
            <div class="landing-grid-3">
                <div style="text-align:center; padding:20px;">
                    <div style="width:64px; height:64px; border-radius:50%; background:linear-gradient(135deg,#6366f1,#4f46e5); color:#fff; font-size:28px; font-weight:800; display:inline-flex; align-items:center; justify-content:center; margin-bottom:18px;">1</div>
                    <h4 style="font-size:18px; font-weight:700; color:#0f172a; margin:0 0 8px;">Register Your Business</h4>
                    <p style="font-size:14px; color:#64748b; line-height:1.65; margin:0;">
                        Create an account, set up your business info, tax rates, and locations. Takes under 2 minutes.
                    </p>
                </div>
                <div style="text-align:center; padding:20px;">
                    <div style="width:64px; height:64px; border-radius:50%; background:linear-gradient(135deg,#6366f1,#4f46e5); color:#fff; font-size:28px; font-weight:800; display:inline-flex; align-items:center; justify-content:center; margin-bottom:18px;">2</div>
                    <h4 style="font-size:18px; font-weight:700; color:#0f172a; margin:0 0 8px;">Add Your Products</h4>
                    <p style="font-size:14px; color:#64748b; line-height:1.65; margin:0;">
                        Import products from Excel or add them manually. Set pricing, variants, and opening stock.
                    </p>
                </div>
                <div style="text-align:center; padding:20px;">
                    <div style="width:64px; height:64px; border-radius:50%; background:linear-gradient(135deg,#6366f1,#4f46e5); color:#fff; font-size:28px; font-weight:800; display:inline-flex; align-items:center; justify-content:center; margin-bottom:18px;">3</div>
                    <h4 style="font-size:18px; font-weight:700; color:#0f172a; margin:0 0 8px;">Start Selling</h4>
                    <p style="font-size:14px; color:#64748b; line-height:1.65; margin:0;">
                        Open the POS screen and make your first sale. Print receipts, track payments, and watch your dashboard come alive.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ BOTTOM BANNER ═══ --}}
    <section style="padding:56px 0 64px;">
        <div class="landing-section">
            <div style="background:linear-gradient(135deg,#4f46e5 0%,#6366f1 50%,#818cf8 100%); border-radius:20px; padding:52px 48px; text-align:center;">
                <h2 style="font-size:30px; font-weight:800; color:#fff; margin:0 0 12px; letter-spacing:-0.02em;">
                    Your Business Deserves a Better POS
                </h2>
                <p style="font-size:16px; color:rgba(255,255,255,0.8); max-width:520px; margin:0 auto 8px; line-height:1.7;">
                    Join thousands of businesses using MeltaPay to streamline operations, delight customers, and increase profits every single day.
                </p>
            </div>
        </div>
    </section>

    {{-- ═══ FOOTER ═══ --}}
    <footer style="border-top:1px solid #e2e8f0; padding:28px 0; text-align:center;">
        <p style="font-size:13px; color:#94a3b8; margin:0;">
            &copy; {{ date('Y') }} MeltaPay. All rights reserved.
        </p>
    </footer>
</div>

@endsection
            