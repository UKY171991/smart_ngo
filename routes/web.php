<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Member\DashboardController as MemberDashboard;

// Public Pages
Route::get('/', function () {
    $campaigns = \App\Models\Campaign::where('is_active', true)->take(3)->get();
    $news = \App\Models\News::where('is_active', true)->latest()->take(3)->get();
    $activities = \App\Models\Activity::latest()->take(5)->get();
    $programs = \App\Models\Program::active()->ordered()->get();
    $siteSettings = \App\Models\Setting::pluck('value', 'setting_key')->toArray();
    return view('welcome', compact('campaigns', 'news', 'activities', 'programs', 'siteSettings'));
})->name('home');

Route::get('/about', [\App\Http\Controllers\PageController::class, 'about'])->name('about');
Route::get('/campaigns', [\App\Http\Controllers\PageController::class, 'campaigns'])->name('pages.campaigns');
Route::get('/contact', [\App\Http\Controllers\PageController::class, 'contact'])->name('contact');
Route::get('/our-mission', [\App\Http\Controllers\PageController::class, 'mission'])->name('mission');
Route::get('/news', [\App\Http\Controllers\PageController::class, 'news'])->name('pages.news');
Route::get('/news/{slug}', [\App\Http\Controllers\PageController::class, 'newsDetail'])->name('pages.news-detail');
Route::get('/privacy-policy', [\App\Http\Controllers\PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-service', [\App\Http\Controllers\PageController::class, 'terms'])->name('terms');
Route::get('/cookie-policy', [\App\Http\Controllers\PageController::class, 'cookies'])->name('cookies');
Route::post('/enquiry', [\App\Http\Controllers\Admin\EnquiryController::class, 'store'])->name('enquiries.submit');

// Certificate Verification (Public)
Route::get('/verify/certificate/{certificate_number}', [\App\Http\Controllers\CertificateVerificationController::class, 'verify'])->name('certificate.verify');

// Donation Verification (Public)
Route::get('/verify/donation/{receipt_number}', [\App\Http\Controllers\DonationVerificationController::class, 'verify'])->name('donation.verify');

// Auth Routes
Route::redirect('/admin/login', '/login');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Member Dashboard
Route::middleware(['auth', 'member'])->prefix('member')->group(function () {
    Route::get('/dashboard', [MemberDashboard::class, 'index'])->name('member.dashboard');
    Route::get('/id-card', [MemberDashboard::class, 'idCard'])->name('member.id-card');
    Route::get('/membership-receipt', [MemberDashboard::class, 'membershipReceipt'])->name('member.membership-receipt');
    Route::get('/appointment-letter', [MemberDashboard::class, 'appointmentLetter'])->name('member.appointment-letter');
    Route::get('/enquiries', [MemberDashboard::class, 'enquiries'])->name('member.enquiries');
    Route::post('/enquiries', [MemberDashboard::class, 'postEnquiry'])->name('member.enquiries.post');
});

// Donation Routes
Route::get('/donate', [\App\Http\Controllers\DonationController::class, 'index'])->name('donations.index');
Route::post('/donate', [\App\Http\Controllers\DonationController::class, 'store'])->name('donations.store');
Route::get('/donate/payment/{id}', [\App\Http\Controllers\DonationController::class, 'showPayment'])->name('donations.payment');
Route::get('/donate/receipt/{id}', [\App\Http\Controllers\DonationController::class, 'downloadReceipt'])->name('donations.receipt');

// Admin Dashboard
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::post('/clear-cache', [AdminDashboard::class, 'clearCache'])->name('clear-cache');
    Route::post('/fix-folders', [AdminDashboard::class, 'fixSystemFolders'])->name('fix-folders');
    
    // Management Modules
    Route::resource('members', App\Http\Controllers\Admin\MemberController::class);
    Route::resource('donations', App\Http\Controllers\Admin\DonationController::class);
    Route::get('/donations/{id}/receipt', [App\Http\Controllers\Admin\DonationController::class, 'downloadReceipt'])->name('donations.receipt');
    Route::post('/donations/{donation}/email', [App\Http\Controllers\Admin\DonationController::class, 'sendEmail'])->name('donations.email');
    Route::resource('campaigns', App\Http\Controllers\Admin\CampaignController::class);
    
    // Operations Modules
    Route::resource('projects', App\Http\Controllers\Admin\ProjectController::class);
    Route::resource('events', App\Http\Controllers\Admin\EventController::class);
    Route::resource('expenses', App\Http\Controllers\Admin\ExpenseController::class);
    
    // Content Modules
    Route::resource('news', App\Http\Controllers\Admin\NewsController::class);
    Route::resource('activities', App\Http\Controllers\Admin\ActivityController::class);
    Route::resource('programs', App\Http\Controllers\Admin\ProgramController::class);
    Route::resource('enquiries', App\Http\Controllers\Admin\EnquiryController::class);
    Route::post('/enquiries/{enquiry}/reply', [App\Http\Controllers\Admin\EnquiryController::class, 'reply'])->name('enquiries.reply');
    Route::resource('beneficiaries', App\Http\Controllers\Admin\BeneficiaryController::class);
    Route::resource('certificates', App\Http\Controllers\Admin\CertificateController::class);
    Route::post('/certificates/{certificate}/email', [App\Http\Controllers\Admin\CertificateController::class, 'sendEmail'])->name('certificates.email');

    // Pages Management
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
    Route::get('/pages/privacy/edit', [\App\Http\Controllers\Admin\PageController::class, 'editPrivacy'])->name('pages.edit-privacy');
    Route::get('/pages/terms/edit', [\App\Http\Controllers\Admin\PageController::class, 'editTerms'])->name('pages.edit-terms');
    Route::get('/pages/cookies/edit', [\App\Http\Controllers\Admin\PageController::class, 'editCookies'])->name('pages.edit-cookies');

    // Profile & Password
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('password.update');

    // Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    Route::get('/settings/website-qr', [App\Http\Controllers\Admin\SettingController::class, 'websiteQr'])->name('settings.qr');
    Route::get('/settings/footer-links', [App\Http\Controllers\Admin\SettingController::class, 'footerLinks'])->name('settings.footer');
    Route::get('/settings/mail', [App\Http\Controllers\Admin\SettingController::class, 'mailSettings'])->name('settings.mail');
    Route::post('/settings/mail', [App\Http\Controllers\Admin\SettingController::class, 'updateMailSettings'])->name('settings.mail.update');
});
