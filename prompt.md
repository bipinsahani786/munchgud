# MUNCHGUD — FULL ECOMMERCE MASTER PROMPT
# Laravel 11 + Livewire 3 + Tailwind CSS + Alpine.js
# Paste this into Cursor / any AI coding tool

---

## ROLE & MISSION

You are a senior full-stack Laravel developer. Build a complete, production-ready
ecommerce web application for **MunchGud** — a premium Indian makhana snack brand.
The app must include a customer-facing storefront AND a full admin panel.

**Tech stack (strict — do not deviate):**
- Backend: Laravel 11
- Reactive UI: Livewire 3 + Alpine.js
- Styling: Tailwind CSS (mobile-first, all screens responsive)
- Database: MySQL
- Cache / Queue: Redis
- Auth: Laravel Breeze (customised) + Sanctum for API
- Payments: Razorpay (primary), COD
- Email: Laravel Mail (SMTP / Mailpit for dev)
- File storage: Laravel Storage (local dev, S3-ready)
- PDF: DomPDF (barryvdh/laravel-dompdf)
- Image processing: Intervention Image

---

## DYNAMIC BRAND DESIGN & THEME ENGINE

You must act as a **Top-Tier UI/UX Designer** to produce a jaw-dropping, premium aesthetic. Do not use generic, plain designs. Prioritize rich visuals, glassmorphism, subtle micro-animations (hover effects), and modern typography.

**Dynamic Theme Engine:**
The application must support a dynamic Theme Engine controlled entirely by the Admin panel.
- **Admin Control**: The admin can switch themes (e.g., "Classic Green", "Festive Gold", "Dark Mode") and configure color hex codes directly from the dashboard.
- CSS Variables (`--primary`, `--secondary`, `--bg-color`) must be injected dynamically into the `<head>` based on the active theme from the database.

*Default Theme Fallback (Classic Green):*
```css
/* Color palette */
--forest:       #1B4332;   /* primary dark green */
--forest-light: #2D6A4F;   /* hover green */
--orange:       #E07B2A;   /* accent orange */
--orange-light: #F4A45A;
--cream:        #FAF7F0;   /* page background */
--cream-dark:   #F0EAD6;   /* card backgrounds */
--gold:         #F4C430;   /* badge / price */
--charcoal:     #1A1A1A;   /* body text */
--muted:        #6B7280;
```

**Fonts (Google Fonts — add to layout):**
- Headlines: `Playfair Display` (700, 900)
- Body / UI: `DM Sans` (300, 400, 500, 600)
- Prices / badges: `Space Mono` (400, 700)

**UI rules:**
- All buttons: pill-shaped (`rounded-full`), smooth hover transitions
- Cards: `rounded-2xl` with subtle border, `hover:-translate-y-1 hover:shadow-xl`
- Page background: `#FAF7F0` (cream), never plain white
- Navbar: sticky, glassmorphism on scroll (`backdrop-blur-md bg-cream/90`)
- All animations: `transition-all duration-300 ease-out`
- Mobile-first: every layout starts at mobile, then `md:` and `lg:` breakpoints

---

## DATABASE SCHEMA

Create all migrations in this order:

### 1. categories
```
id, name, slug, description, image, parent_id (nullable, self-ref), is_active, sort_order, meta_title, meta_description, timestamps
```

### 2. products
```
id, name, slug, description, short_description, category_id (FK),
is_active, is_featured, sort_order,
meta_title, meta_description, meta_keywords,
weight_grams (nullable), tags (json, nullable),
timestamps, soft_deletes
```

### 3. product_images
```
id, product_id (FK), path, alt_text, sort_order, is_primary, timestamps
```

### 4. variant_types
```
id, name (e.g. "Flavour", "Weight", "Pack Size"), slug, timestamps
```

### 5. variant_options
```
id, variant_type_id (FK), value (e.g. "Peri Peri", "50g", "3-Pack"),
display_value, color_hex (nullable), sort_order, timestamps
```

### 6. product_skus  ← THE CORE VARIANT TABLE
```
id, product_id (FK), sku_code (unique), name (e.g. "Peri Peri 50g"),
mrp (decimal 10,2), sale_price (decimal 10,2), cost_price (decimal 10,2),
stock_qty (int, default 0), low_stock_threshold (int, default 10),
weight_grams (int), is_active (bool), is_default (bool),
barcode (nullable), timestamps
```

### 7. product_sku_options  ← pivot: sku ↔ variant_options
```
id, product_sku_id (FK), variant_option_id (FK)
```

### 8. users
```
id, name, email (unique, nullable), phone (unique, nullable),
email_verified_at, phone_verified_at, avatar, is_active, timestamps
```

### 9. admins
```
id, name, email (unique), password, role (enum: super_admin, admin, staff),
is_active, last_login_at, timestamps
```

### 10. addresses
```
id, user_id (FK), label (Home/Work/Other), name, phone,
line1, line2 (nullable), city, state, pincode, country (default IN),
is_default, timestamps
```

### 11. coupons
```
id, code (unique), description, type (enum: percent, flat),
value (decimal), min_order_amount, max_discount_amount (nullable),
usage_limit (nullable), used_count (default 0),
start_at (nullable), end_at (nullable), is_active, timestamps
```

### 12. orders
```
id, order_number (unique, e.g. MG-2024-00001), user_id (FK nullable),
status (enum: pending, confirmed, processing, shipped, delivered, cancelled, refunded),
payment_status (enum: pending, paid, failed, refunded),
payment_method (enum: razorpay, cod), payment_id (nullable),
subtotal, discount_amount, shipping_amount, tax_amount, total,
coupon_id (FK nullable), coupon_code (nullable),
shipping_name, shipping_phone, shipping_line1, shipping_line2,
shipping_city, shipping_state, shipping_pincode,
notes (nullable), cancelled_reason (nullable),
shipped_at, delivered_at, timestamps
```

### 13. order_items
```
id, order_id (FK), product_sku_id (FK), product_name, sku_name,
sku_code, quantity, unit_price, total_price, timestamps
```

### 14. razorpay_payments
```
id, order_id (FK), razorpay_order_id, razorpay_payment_id (nullable),
razorpay_signature (nullable), amount, currency, status,
raw_response (json), timestamps
```

### 15. reviews
```
id, product_id (FK), user_id (FK nullable), name, email,
rating (1-5), title, body, is_approved, timestamps
```

### 16. wishlists
```
id, user_id (FK), product_sku_id (FK), timestamps
(unique constraint on user_id + product_sku_id)
```

### 17. cart_items  (for persistent/guest cart)
```
id, session_id (nullable), user_id (FK nullable),
product_sku_id (FK), quantity, timestamps
```

### 18. banners
```
id, title, subtitle, image, cta_text, cta_url, position, is_active, sort_order, timestamps
```

### 19. settings
```
id, key (unique), value (text), group, timestamps
```

### 20. themes
```
id, name, primary_color, secondary_color, bg_color, text_color, heading_font, is_active, timestamps
```

### 21. homepage_sections
```
id, theme_id (FK), type (enum: hero, banners, product_carousel, testimonials, features, html, video),
title, subtitle, content (json for settings/images), sort_order, is_active, timestamps
```

### 22. activity_logs
```
id, admin_id (FK nullable), action, description, model_type, model_id, ip_address, timestamps
```

---

## MODELS & RELATIONSHIPS

```php
// Product.php
hasMany(ProductImage::class)
hasMany(ProductSku::class)
belongsTo(Category::class)
hasMany(Review::class)

// ProductSku.php
belongsTo(Product::class)
belongsToMany(VariantOption::class, 'product_sku_options')
hasMany(OrderItem::class)
hasMany(CartItem::class)
hasMany(Wishlist::class)

// Order.php
belongsTo(User::class)->nullable()
hasMany(OrderItem::class)
belongsTo(Coupon::class)->nullable()
hasOne(RazorpayPayment::class)

// User.php
hasMany(Order::class)
hasMany(Address::class)
hasMany(CartItem::class)
hasMany(Wishlist::class)
```

---

## STOREFRONT — ALL PAGES & COMPONENTS

### Navbar Component (`resources/views/components/navbar.blade.php`)
- Sticky top, transparent → glassmorphism on scroll (Alpine.js scroll listener)
- Logo left, nav links center (Shop, About, Contact), icons right (search, wishlist count, cart count, account)
- Mobile: hamburger → full-screen slide-in drawer
- Cart icon shows item count badge (Livewire real-time)
- Show user name if logged in, else "Login" button

### Announcement Bar
- Dark green bar above navbar
- Rotating messages: free shipping, new flavours, etc.
- Alpine.js carousel, auto-rotates every 4s

### Home Page (`/`)

*Note: The homepage must be fully dynamic and driven by the `homepage_sections` table. The sections below are the default seed data, but the order and content should be rendered dynamically based on Admin configuration (like Shopify Sections).*

**Dynamic Section 1 — Hero**
- Full-screen, dark forest green background
- Left: eyebrow tag "Direct from Bihar Farms", H1 "Snack Guilt-Free. Feel Gud.", subtext, two CTA buttons (Shop Now, Our Story)
- Right: product image with floating animation (CSS keyframes), price badge, "500K+ Happy Snackers" bubble
- Trust badges row: Non-Fried, Protein Rich, Gluten Free, Natural

**Section 2 — Features Strip**
- Dark green background, 4-column grid (2×2 on mobile)
- Icons + title + subtitle: Direct from Farms, Roasted Not Fried, Protein Rich, Free Shipping

**Section 3 — Flavour Showcase**
- 2-column grid of large cards
- Each card: gradient background, product image (floating on hover), flavour name, tagline, description, price, Shop Now CTA
- Peri Peri: orange-to-red gradient; Cream & Onion: forest green gradient

**Section 4 — All Products Grid (Livewire)**
- Heading: "All Products"
- 3-column grid (2 on tablet, 1 on mobile)
- Product cards with image, category, name, variant selector (flavour buttons), price, Add to Cart button
- Filter bar: category pills, sort dropdown (price, newest, popular)
- Livewire real-time filtering, no page reload

**Section 5 — About / Origin**
- 2-column: image collage left, text right
- "Born in Bihar, Made for India" heading
- Story text, feature badges, "Read Our Story" CTA

**Section 6 — Testimonials**
- Dark green background, 3-column card grid
- Each card: star rating, review text, customer name, city, verified badge

**Section 7 — Instagram / Social Strip**
- "Tag us @munchgud" heading
- Grid of 6 placeholder images (or dynamic if Instagram API connected)

**Section 8 — Newsletter CTA**
- Cream background, centered
- Heading, subtext, email input + Subscribe button (Livewire, saves to DB)

### Product Listing Page (`/products`)
- Livewire component `ProductList`
- Sidebar filters: Category, Flavour, Weight, Price range slider, In Stock toggle
- Top bar: result count, sort dropdown
- Grid / list view toggle (Alpine.js)
- Each card: primary image, hover shows secondary image, flavour chips, quick-add to cart
- URL-driven filters (query strings sync with Livewire)
- Pagination (Livewire)

### Product Detail Page (`/products/{slug}`)
- Livewire component `ProductDetail`
- Left: image gallery (main image + thumbnails, click to switch)
- Right:
  - Breadcrumb, product name, category
  - Rating stars + review count
  - Variant selector: Flavour buttons → Weight buttons → Pack Size buttons
    (selecting combination updates SKU, price, stock status)
  - Price display: MRP (strikethrough if on sale) + Sale price + "Save X%"
  - Stock status badge: In Stock / Low Stock (< threshold) / Out of Stock
  - Quantity input (+ / - buttons, capped at stock)
  - Add to Cart button (Livewire, instant feedback)
  - Add to Wishlist button
  - Delivery info accordion (pin code check)
- Tabs below: Description | Nutrition Info | Reviews
- Reviews tab: show approved reviews, star breakdown, "Write a Review" form (Livewire)
- Related Products carousel (same category)

### Cart Page (`/cart`) — Livewire `Cart`
- Item rows: image, name, variant combo, unit price, qty stepper, row total, remove
- Coupon code input (Livewire validate + apply)
- Order summary: subtotal, discount, shipping, total
- "Proceed to Checkout" CTA
- Empty cart state with "Shop Now" CTA

### Checkout Page (`/checkout`) — Livewire `Checkout`
- Step 1: Address
  - Logged-in: show saved addresses as selectable cards + "Add New" form
  - Guest: full address form
- Step 2: Payment
  - Razorpay (card/UPI/netbanking) via Razorpay.js
  - COD option
- Step 3: Review & Place Order
  - Order summary, selected address, payment method
  - "Place Order" button
  - On success: create Order record, trigger notifications, redirect to /order-success/{id}

### Order Success Page (`/order-success/{orderNumber}`)
- Green check animation, order number, summary
- "Track Order" and "Continue Shopping" CTAs

### My Account (`/account`) — Auth required
- `/account/orders` — order list with status badges, click to view detail
- `/account/orders/{id}` — order detail: items, timeline, invoice download
- `/account/addresses` — manage saved addresses (add/edit/delete/set default)
- `/account/wishlist` — wishlist items with add-to-cart
- `/account/profile` — name, email, phone, avatar upload

### Auth Pages
- `/login` — OTP-based: enter phone/email → get OTP → verify
- `/register` — name, phone/email, password
- `/forgot-password`, `/reset-password`
- Google OAuth (Laravel Socialite)

### Static Pages
- `/about` — brand story, team, farm sourcing
- `/contact` — contact form (Livewire), map embed, social links
- `/faq` — accordion component
- `/privacy-policy`, `/terms`, `/refund-policy`, `/shipping-policy`

---

## ADMIN PANEL — ALL PAGES

Route prefix: `/admin`
Middleware: `auth:admin`
Layout: `resources/views/layouts/admin.blade.php`

**Admin layout:**
- Fixed sidebar (dark forest green, #1B4332)
- Sidebar nav groups: Dashboard, Products, Orders, Customers, Marketing, Settings
- Top header: breadcrumb, admin name, notification bell, logout
- Main content area: white card container
- All tables: sortable columns, search input, bulk actions, pagination
- All forms: validation errors inline, success toast notifications

---

### Dashboard (`/admin`)
Livewire component `AdminDashboard`

**KPI Cards row:**
- Today's Revenue, Today's Orders, Total Customers, Pending Orders
- Each with trend arrow vs yesterday

**Charts (use Chart.js via CDN):**
- Revenue last 30 days (line chart)
- Orders by status (doughnut chart)
- Top selling products (horizontal bar)

**Tables:**
- Recent 10 orders with quick status update dropdown
- Low stock SKUs alert list

---

### Products (`/admin/products`)

**Product List** (`AdminProductList` Livewire):
- Table: image thumbnail, name, category, SKU count, price range, stock total, status toggle, actions
- Search, filter by category, filter by status
- Bulk: activate, deactivate, delete
- "Add Product" button

**Create / Edit Product** (`/admin/products/create`, `/admin/products/{id}/edit`):
- Tab 1 — Basic Info:
  - Name, slug (auto-generate from name, editable)
  - Category dropdown, tags input
  - Short description (textarea, 160 chars)
  - Full description (TinyMCE / Trix rich editor)
  - is_active toggle, is_featured toggle
- Tab 2 — Images:
  - Drag-and-drop multi-image uploader (Livewire file upload)
  - Reorder images (drag handles)
  - Set primary image
  - Delete individual images
- Tab 3 — Variants & SKUs:
  - Variant type selector (add flavour options, weight options, pack options)
  - Auto-generate SKU combinations button
  - SKU table: for each combination show:
    - SKU code (editable), name, MRP, Sale Price, Cost Price, Stock Qty, Low Stock Threshold, is_active
  - Inline edit all SKU fields
  - Add custom SKU manually
- Tab 4 — SEO:
  - Meta title, meta description, meta keywords
  - Preview snippet (shows how it looks in Google)
- Save as Draft / Publish buttons

**Product SKU Quick-Edit Modal:**
- Click any SKU → slide-over panel with all fields editable

---

### Categories (`/admin/categories`)
- Tree view (parent → children)
- Add/edit/delete, reorder (sort_order)
- Image upload per category

---

### Orders (`/admin/orders`)

**Order List** (`AdminOrderList` Livewire):
- Table: order number, customer, date, items count, total, payment status, order status, action
- Filters: status, payment method, date range picker
- Search by order number, customer name, phone
- Bulk status update

**Order Detail** (`/admin/orders/{id}`):
- Order info card: number, date, customer, payment method
- Status timeline (visual steps: Pending → Confirmed → Processing → Shipped → Delivered)
- Status update dropdown + "Update Status" button (triggers notification)
- Order items table with images
- Pricing breakdown card (subtotal, discount, shipping, tax, total)
- Shipping address card
- Payment details card (Razorpay ID / COD)
- Add tracking number + courier name
- Add internal note
- "Generate Invoice" button → PDF download
- "Process Refund" button (if paid, integrates Razorpay refund API)
- Cancel Order button with reason input

---

### Inventory (`/admin/inventory`)
- Table: SKU code, product, variant combo, current stock, low stock threshold, cost price
- Inline edit stock quantity
- Bulk stock import via CSV
- Low stock filter (shows only below threshold)
- Stock history log per SKU (manual adjustments + order deductions)

---

### Customers (`/admin/customers`)
- Table: name, email, phone, total orders, total spent, joined date, status
- Customer detail page:
  - Profile info, order history, addresses
  - Block / unblock account
  - Add admin note

---

### Coupons (`/admin/coupons`)
- Table: code, type, value, usage, validity, status
- Create coupon form:
  - Code (auto-generate option)
  - Type: Percentage / Flat amount
  - Value, min order amount, max discount amount
  - Usage limit (total + per user)
  - Valid from / valid to date pickers
  - is_active toggle
- Usage analytics per coupon

---

### Reviews (`/admin/reviews`)
- Table: product, customer, rating, excerpt, date, approved status
- Approve / reject actions
- Filter: pending only, by product, by rating

---

### Storefront Builder & Themes (`/admin/storefront`)
- **Theme Manager:** Switch active themes, configure global colors (Primary, Secondary, Background) and fonts.
- **Dynamic Homepage Builder:** Add, edit, reorder (drag-and-drop), and remove homepage sections (like a professional brand builder).
- **Section Types:** Hero Banner, Features Strip, Product Carousel, Testimonials, Video Embed, HTML Block.
- Configure titles, subtitles, images, CTA links, and section padding directly from the admin UI.

---

### Reports (`/admin/reports`)
- Sales report: date range → total orders, revenue, avg order value, top products
- Export to CSV / PDF

---

### Settings (`/admin/settings`)
- **General:** site name, logo, favicon, tagline, contact email, phone, address
- **Shipping:** free shipping threshold, default shipping amount, COD charge
- **Tax:** GST rate, GSTIN number
- **Payments:** Razorpay key/secret (masked), enable/disable COD
- **Notifications:** email notification toggles, WhatsApp number for alerts
- **Social:** Instagram, Facebook, Twitter URLs
- **SEO:** global meta title suffix, global meta description
- All saved to `settings` table via key-value pairs

---

## CORE BUSINESS LOGIC

### Cart Service (`app/Services/CartService.php`)
```php
// Methods:
addItem(productSkuId, quantity, userId/sessionId)
removeItem(cartItemId)
updateQuantity(cartItemId, quantity)
applyCoupon(code, userId)  // validates + calculates discount
removeCoupon()
getCartSummary()  // returns subtotal, discount, shipping, tax, total
mergGuestCartToUser(sessionId, userId)  // on login
clearCart(userId/sessionId)
```

### Order Service (`app/Services/OrderService.php`)
```php
createOrder(cartData, addressData, paymentMethod, userId)
// → creates Order + OrderItems + RazorpayPayment record
// → deducts stock from ProductSku
// → marks coupon used_count++
// → fires OrderPlaced event

updateStatus(orderId, newStatus, adminId)
// → fires OrderStatusUpdated event
// → triggers customer notification

processRefund(orderId, amount, reason)
// → calls Razorpay refund API
// → updates payment_status
// → restores stock if cancellation
```

### Payment Service (`app/Services/PaymentService.php`)
```php
createRazorpayOrder(amount, orderId)
verifyPaymentSignature(razorpayOrderId, paymentId, signature)
processWebhook(payload, signature)
initiateRefund(paymentId, amount)
```

### Notification Service (`app/Services/NotificationService.php`)
```php
// Listens to events and sends:
sendOrderConfirmation(order)     // email + WhatsApp to customer
sendOrderStatusUpdate(order)     // email + WhatsApp to customer
sendNewOrderAlert(order)         // email to admin
sendLowStockAlert(sku)           // email to admin
sendOtp(phone/email, otp)        // SMS + email
```

---

## EVENTS & LISTENERS

```php
// Events:
OrderPlaced
OrderStatusUpdated
PaymentCompleted
StockLow

// Listeners (queued):
SendOrderConfirmationEmail
SendOrderWhatsApp
SendAdminNewOrderAlert
GenerateInvoicePDF
UpdateInventory
```

---

## RAZORPAY INTEGRATION

```php
// routes/web.php
Route::post('/checkout/razorpay/create-order', [PaymentController::class, 'createOrder']);
Route::post('/checkout/razorpay/verify', [PaymentController::class, 'verifyPayment']);
Route::post('/razorpay/webhook', [PaymentController::class, 'webhook'])->withoutMiddleware(['web']);
```

Frontend (blade + Alpine.js):
```javascript
// In checkout blade:
const options = {
  key: "{{ config('services.razorpay.key') }}",
  amount: {{ $order->total * 100 }},
  currency: "INR",
  name: "MunchGud",
  description: "Order {{ $order->order_number }}",
  order_id: "{{ $razorpayOrderId }}",
  handler: function(response) {
    // POST to /checkout/razorpay/verify
    fetch('/checkout/razorpay/verify', {
      method: 'POST',
      headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken},
      body: JSON.stringify(response)
    }).then(r => r.json()).then(data => {
      if (data.success) window.location.href = '/order-success/' + data.order_number;
    });
  },
  prefill: { name: "{{ auth()->user()->name }}", contact: "{{ auth()->user()->phone }}" },
  theme: { color: "#1B4332" }
};
const rzp = new Razorpay(options);
rzp.open();
```

---

## INVOICE PDF TEMPLATE

Using barryvdh/laravel-dompdf. Template at `resources/views/pdf/invoice.blade.php`:
- MunchGud logo top-left, INVOICE heading top-right
- Invoice number, date, order number
- Billing address, shipping address (two columns)
- Items table: S.No, Product, Variant, Qty, Unit Price, Total
- Totals section: subtotal, discount, shipping, GST, Grand Total
- Payment method, transaction ID
- Footer: "Thank you for shopping with MunchGud™" + contact info
- GST compliant format (GSTIN, HSN code)

---

## API ROUTES (for mobile app readiness)

```php
// routes/api.php — all behind auth:sanctum except public ones
Route::get('/products', [ApiProductController::class, 'index']);
Route::get('/products/{slug}', [ApiProductController::class, 'show']);
Route::get('/categories', [ApiCategoryController::class, 'index']);
Route::post('/cart/add', [ApiCartController::class, 'add']);
Route::post('/orders', [ApiOrderController::class, 'store']);
Route::get('/orders/{id}', [ApiOrderController::class, 'show']);
```

---

## QUEUE CONFIGURATION

```php
// config/queue.php — use Redis
QUEUE_CONNECTION=redis

// Jobs:
SendEmailJob
SendWhatsAppJob
GenerateInvoiceJob
ProcessRazorpayWebhookJob
SendLowStockAlertJob

// Horizon for queue monitoring (optional but recommended)
composer require laravel/horizon
```

---

## SEARCH & FILTERING (Livewire)

```php
// ProductList Livewire component
public string $search = '';
public array $selectedCategories = [];
public array $selectedFlavours = [];
public array $selectedWeights = [];
public int $minPrice = 0;
public int $maxPrice = 1000;
public bool $inStockOnly = false;
public string $sortBy = 'newest';

public function getProductsProperty() {
    return Product::with(['skus', 'images', 'category'])
        ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
        ->when($this->selectedCategories, fn($q) => $q->whereIn('category_id', $this->selectedCategories))
        ->whereHas('skus', function($q) {
            $q->whereBetween('sale_price', [$this->minPrice, $this->maxPrice]);
            if ($this->inStockOnly) $q->where('stock_qty', '>', 0);
            // join variant options for flavour/weight filter
        })
        ->orderBy(match($this->sortBy) {
            'price_asc'  => ['skus.sale_price', 'asc'],
            'price_desc' => ['skus.sale_price', 'desc'],
            'popular'    => ['order_items_count', 'desc'],
            default      => ['created_at', 'desc'],
        })
        ->paginate(12);
}
```

---

## OTP AUTHENTICATION

```php
// OTP flow:
// 1. User enters phone/email
// 2. Generate 6-digit OTP, store in cache (key: "otp:{phone}", TTL: 10min)
// 3. Send via SMS (MSG91) or email
// 4. User enters OTP → verify → issue session

// OtpController:
public function send(Request $request) {
    $otp = rand(100000, 999999);
    Cache::put("otp:{$request->phone}", $otp, now()->addMinutes(10));
    // dispatch SendOtpJob
}

public function verify(Request $request) {
    $cached = Cache::get("otp:{$request->phone}");
    if ($cached && $cached == $request->otp) {
        Cache::forget("otp:{$request->phone}");
        $user = User::firstOrCreate(['phone' => $request->phone]);
        Auth::login($user);
        return redirect()->intended('/account');
    }
    return back()->withErrors(['otp' => 'Invalid OTP']);
}
```

---

## FILE STRUCTURE

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── DashboardController.php
│   │   │   ├── ProductController.php
│   │   │   ├── OrderController.php
│   │   │   ├── CustomerController.php
│   │   │   ├── CouponController.php
│   │   │   ├── InventoryController.php
│   │   │   └── SettingsController.php
│   │   ├── Auth/
│   │   │   ├── OtpController.php
│   │   │   └── SocialController.php
│   │   ├── CartController.php
│   │   ├── CheckoutController.php
│   │   ├── PaymentController.php
│   │   └── ProfileController.php
├── Livewire/
│   ├── Storefront/
│   │   ├── ProductList.php
│   │   ├── ProductDetail.php
│   │   ├── Cart.php
│   │   ├── Checkout.php
│   │   └── ReviewForm.php
│   └── Admin/
│       ├── Dashboard.php
│       ├── ProductList.php
│       ├── ProductForm.php
│       ├── OrderList.php
│       ├── OrderDetail.php
│       └── InventoryTable.php
├── Models/
│   ├── Product.php, ProductSku.php, ProductImage.php
│   ├── VariantType.php, VariantOption.php
│   ├── Category.php, Order.php, OrderItem.php
│   ├── User.php, Admin.php, Address.php
│   ├── Coupon.php, Review.php, Banner.php
│   ├── CartItem.php, Wishlist.php, Setting.php
├── Services/
│   ├── CartService.php
│   ├── OrderService.php
│   ├── PaymentService.php
│   └── NotificationService.php
├── Events/ & Listeners/
├── Jobs/
└── Helpers/
    └── SettingsHelper.php  // settings('site_name')

resources/views/
├── layouts/
│   ├── app.blade.php         (storefront)
│   └── admin.blade.php       (admin panel)
├── components/
│   ├── navbar.blade.php
│   ├── footer.blade.php
│   ├── product-card.blade.php
│   └── admin/sidebar.blade.php
├── pages/
│   ├── home.blade.php
│   ├── products/index.blade.php
│   ├── products/show.blade.php
│   ├── cart.blade.php
│   ├── checkout.blade.php
│   └── account/...
├── admin/
│   ├── dashboard.blade.php
│   ├── products/...
│   ├── orders/...
│   └── settings.blade.php
└── pdf/
    └── invoice.blade.php
```

---

## ADVANCED E-COMMERCE FEATURES (D2C GROWTH)

These features are essential for a modern D2C brand and must be integrated into the architecture:

1. **Subscriptions (Subscribe & Save)**
   - Allow users to subscribe to their favorite snacks (e.g., weekly, monthly deliveries).
   - Razorpay Subscriptions integration for automated recurring payments.
   - Discount logic for subscribed products (e.g., 10% off).

2. **Loyalty, Rewards & Wallet System (MunchPoints)**
   - Earn points on every purchase (e.g., 1 point per ₹10 spent).
   - Referral system: "Refer a friend, both get ₹50 wallet credit".
   - Points can be redeemed at checkout for instant discounts.
   - Needs `wallets`, `wallet_transactions` tables.

3. **Abandoned Cart Recovery**
   - Track guest and logged-in user carts.
   - Cron job / Scheduled Task to send email/WhatsApp reminders after 2 hours and 24 hours of inactivity.
   - Include a dynamic single-use discount code in the 24-hour reminder to convert the sale.

4. **Custom Bundling ("Build Your Own Box")**
   - A dedicated interactive page (`/build-a-box`) where users pick any 4 or 6 flavours.
   - Fixed price for the box, adding custom variations to the cart as a single bundled item.

5. **Logistics & Shipping Aggregator Integration (Shiprocket)**
   - API integration with Shiprocket.
   - Real-time Pincode serviceability check on Product Page.
   - Accurate "Expected Delivery Date" estimation.
   - Auto-sync tracking AWB number back to the order and notify the customer.

6. **Gifting Capabilities**
   - "Is this a gift?" checkbox in Cart.
   - Add a personalized gift message (printed on a card).
   - Option to hide pricing on the physical delivery invoice.

7. **Blog & Recipes (SEO Booster)**
   - Simple CMS for articles: "Healthy recipes using Makhana", "Diet tips", etc.
   - Helps heavily with organic search traffic.

8. **B2B / Wholesale Portal**
   - Separate registration for retailers/distributors.
   - After admin approval, they see discounted bulk-pricing and minimum-order quantities.

---

## SEEDERS

Create seeders with realistic data:

```php
// DatabaseSeeder:
$this->call([
    AdminSeeder::class,       // 1 super admin: admin@munchgud.com / password
    CategorySeeder::class,    // Makhana Snacks, Combo Packs, Gift Boxes
    VariantTypeSeeder::class, // Flavour, Weight, Pack Size
    VariantOptionSeeder::class, // Peri Peri, Cream & Onion / 50g, 100g / Single, 3-pack
    ProductSeeder::class,     // 4 products with full SKU matrix
    CouponSeeder::class,      // WELCOME10, MUNCH20, FREESHIP
    BannerSeeder::class,
    SettingsSeeder::class,
]);
```

---

## ENVIRONMENT (.env additions)

```env
APP_NAME="MunchGud"
APP_URL=http://localhost:8000

DB_DATABASE=munchgud
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

RAZORPAY_KEY=rzp_test_xxxxx
RAZORPAY_SECRET=xxxxx

GOOGLE_CLIENT_ID=xxxxx
GOOGLE_CLIENT_SECRET=xxxxx
GOOGLE_REDIRECT_URL="${APP_URL}/auth/google/callback"

MSG91_API_KEY=xxxxx
MSG91_SENDER_ID=MUNCHG

MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_FROM_ADDRESS=hello@munchgud.com
MAIL_FROM_NAME="MunchGud"

AWS_BUCKET=munchgud-assets
```

---

## COMMANDS TO RUN AFTER SCAFFOLDING

```bash
composer require livewire/livewire
composer require barryvdh/laravel-dompdf
composer require intervention/image
composer require laravel/socialite
composer require razorpay/razorpay

npm install -D tailwindcss @tailwindcss/forms @tailwindcss/typography alpinejs

php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan queue:work &
php artisan serve
```

---

## QUALITY REQUIREMENTS

- Every form has server-side validation (Laravel Form Requests)
- Every Livewire component uses `#[Validate]` attributes
- All DB queries use eager loading to prevent N+1
- Admin actions logged to activity_logs
- Soft deletes on Product, Order models
- All money stored as integers (paise) or decimal(10,2) — never float
- CSRF protection on all forms
- Rate limiting on OTP send endpoint (5 per hour per IP)
- Signed URLs for invoice PDF downloads
- Images stored in storage/app/public, resized on upload (800px max)
- Mobile-first CSS: start at smallest breakpoint, expand up
- All pages score 90+ Lighthouse mobile performance

---

*Build this complete, end-to-end, production-quality application.
Do not skip any section. Ask for clarification only if truly ambiguous.*