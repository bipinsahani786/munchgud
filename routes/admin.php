<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminSkuController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminInventoryController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminCouponController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminStorefrontController;
use App\Http\Controllers\Admin\AdminThemeController;
use App\Http\Controllers\Admin\AdminBannerController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminVariantTypeController;
use App\Http\Controllers\Admin\AdminSupportTicketController;
use App\Http\Controllers\Admin\RecipeController as AdminRecipeController;
use App\Http\Controllers\Admin\AdminSystemController;
use App\Http\Controllers\Admin\AdminInquiryController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminServiceableZoneController;

Route::prefix('admin')->name('admin.')->group(function() {
    // Auth
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected
    Route::middleware('admin')->group(function() {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Products
        Route::resource('products', AdminProductController::class);
        Route::post('products/{product}/images', [AdminProductController::class, 'uploadImage'])->name('products.images.upload');
        Route::delete('products/images/{image}', [AdminProductController::class, 'deleteImage'])->name('products.images.delete');
        Route::patch('products/images/{image}/primary', [AdminProductController::class, 'setPrimaryImage'])->name('products.images.primary');
        Route::post('products/{product}/skus', [AdminSkuController::class, 'store'])->name('products.skus.store');
        Route::patch('products/skus/{sku}', [AdminSkuController::class, 'update'])->name('products.skus.update');
        Route::delete('products/skus/{sku}', [AdminSkuController::class, 'destroy'])->name('products.skus.destroy');
        Route::post('products/{product}/skus/generate', [AdminSkuController::class, 'generate'])->name('products.skus.generate');

        // Categories
        Route::resource('categories', AdminCategoryController::class);

        // CMS Pages
        Route::get('/pages', [App\Http\Controllers\Admin\AdminPageController::class, 'index'])->name('pages.index');
        Route::get('/pages/{page}/edit', [App\Http\Controllers\Admin\AdminPageController::class, 'edit'])->name('pages.edit');
        Route::patch('/pages/{page}', [App\Http\Controllers\Admin\AdminPageController::class, 'update'])->name('pages.update');
        Route::post('/upload-image', [\App\Http\Controllers\Admin\ImageUploadController::class, 'upload'])->name('upload.image');

        // FAQs
        Route::resource('faqs', AdminFaqController::class)->except(['show']);

        // Orders
        Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
        Route::post('orders/{order}/tracking', [AdminOrderController::class, 'addTracking'])->name('orders.tracking');
        Route::post('orders/{order}/cancel', [AdminOrderController::class, 'cancel'])->name('orders.cancel');
        Route::patch('orders/{order}/payment', [AdminOrderController::class, 'markPayment'])->name('orders.payment');
        Route::get('orders/{order}/invoice', [AdminOrderController::class, 'invoice'])->name('orders.invoice');
        Route::get('orders/{order}/label', [AdminOrderController::class, 'printLabel'])->name('orders.label');
        Route::post('orders/{order}/refund', [AdminOrderController::class, 'refund'])->name('orders.refund');

        // Inventory
        Route::get('inventory', [AdminInventoryController::class, 'index'])->name('inventory.index');
        Route::patch('inventory/{sku}', [AdminInventoryController::class, 'updateStock'])->name('inventory.update');
        Route::post('inventory/import', [AdminInventoryController::class, 'import'])->name('inventory.import');

        // Customers
        Route::get('customers', [AdminCustomerController::class, 'index'])->name('customers.index');
        Route::get('customers/{user}', [AdminCustomerController::class, 'show'])->name('customers.show');
        Route::patch('customers/{user}/toggle', [AdminCustomerController::class, 'toggle'])->name('customers.toggle');

        // Coupons
        Route::resource('coupons', AdminCouponController::class);
        Route::post('coupons/generate-code', [AdminCouponController::class, 'generateCode'])->name('coupons.generate-code');

        // Reviews
        Route::get('reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
        Route::patch('reviews/{review}/approve', [AdminReviewController::class, 'approve'])->name('reviews.approve');
        Route::patch('reviews/{review}/reject', [AdminReviewController::class, 'reject'])->name('reviews.reject');
        Route::delete('reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');

        // Storefront Builder
        Route::get('storefront', [AdminStorefrontController::class, 'index'])->name('storefront.index');
        Route::post('storefront/sections', [AdminStorefrontController::class, 'storeSection'])->name('storefront.sections.store');
        Route::patch('storefront/sections/{section}', [AdminStorefrontController::class, 'updateSection'])->name('storefront.sections.update');
        Route::delete('storefront/sections/{section}', [AdminStorefrontController::class, 'destroySection'])->name('storefront.sections.destroy');
        Route::post('storefront/sections/reorder', [AdminStorefrontController::class, 'reorder'])->name('storefront.sections.reorder');
        Route::get('themes', [AdminThemeController::class, 'index'])->name('themes.index');
        Route::patch('themes/{theme}/activate', [AdminThemeController::class, 'activate'])->name('themes.activate');
        Route::patch('themes/{theme}', [AdminThemeController::class, 'update'])->name('themes.update');

        // Banners
        Route::resource('banners', AdminBannerController::class);

        // Reports
        Route::get('reports', [AdminReportController::class, 'index'])->name('reports.index');
        Route::get('reports/export', [AdminReportController::class, 'export'])->name('reports.export');

        // Settings
        Route::get('settings', [AdminSettingsController::class, 'index'])->name('settings.index');
        Route::post('settings', [AdminSettingsController::class, 'update'])->name('settings.update');

        // Delivery Zones
        Route::get('zones', [AdminServiceableZoneController::class, 'index'])->name('zones.index');
        Route::post('zones', [AdminServiceableZoneController::class, 'store'])->name('zones.store');
        Route::patch('zones/{zone}', [AdminServiceableZoneController::class, 'update'])->name('zones.update');
        Route::delete('zones/{zone}', [AdminServiceableZoneController::class, 'destroy'])->name('zones.destroy');

        // Variant Types
        Route::resource('variant-types', AdminVariantTypeController::class);

        // Support Tickets
        Route::get('tickets', [AdminSupportTicketController::class, 'index'])->name('tickets.index');
        Route::get('tickets/{ticket}', [AdminSupportTicketController::class, 'show'])->name('tickets.show');
        Route::post('tickets/{ticket}/reply', [AdminSupportTicketController::class, 'reply'])->name('tickets.reply');
        Route::patch('tickets/{ticket}/status', [AdminSupportTicketController::class, 'updateStatus'])->name('tickets.status');

        // Contact Inquiries
        Route::get('inquiries', [AdminInquiryController::class, 'index'])->name('inquiries.index');
        Route::get('inquiries/{inquiry}', [AdminInquiryController::class, 'show'])->name('inquiries.show');
        Route::delete('inquiries/{inquiry}', [AdminInquiryController::class, 'destroy'])->name('inquiries.destroy');

        // Recipes
        Route::resource('recipes', AdminRecipeController::class)->except(['show']);
        Route::patch('recipes/{recipe}/approve', [AdminRecipeController::class, 'approve'])->name('recipes.approve');
        Route::patch('recipes/{recipe}/reject', [AdminRecipeController::class, 'reject'])->name('recipes.reject');

        // System Tools
        Route::get('system/tools', [AdminSystemController::class, 'tools'])->name('system.tools');
        Route::post('system/tools', [AdminSystemController::class, 'runTool'])->name('system.tools.run');
        Route::get('system/logs', [AdminSystemController::class, 'logs'])->name('system.logs');
        Route::post('system/logs/clear', [AdminSystemController::class, 'clearLogs'])->name('system.logs.clear');
    });
});
