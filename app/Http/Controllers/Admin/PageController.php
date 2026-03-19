<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'content' => 'required',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        Page::create($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully!');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'content' => 'required',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $page->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully!');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully!');
    }

    // Quick edit methods for legal pages
    public function editPrivacy()
    {
        $page = Page::firstOrCreate(['slug' => 'privacy-policy'], [
            'title' => 'Privacy Policy',
            'content' => $this->getDefaultPrivacyContent(),
            'is_active' => true,
        ]);
        return view('admin.pages.edit', compact('page'));
    }

    public function editTerms()
    {
        $page = Page::firstOrCreate(['slug' => 'terms-of-service'], [
            'title' => 'Terms of Service',
            'content' => $this->getDefaultTermsContent(),
            'is_active' => true,
        ]);
        return view('admin.pages.edit', compact('page'));
    }

    public function editCookies()
    {
        $page = Page::firstOrCreate(['slug' => 'cookie-policy'], [
            'title' => 'Cookie Policy',
            'content' => $this->getDefaultCookiesContent(),
            'is_active' => true,
        ]);
        return view('admin.pages.edit', compact('page'));
    }

    private function getDefaultPrivacyContent()
    {
        return '<h2>Privacy Policy</h2>
        <p><em>Last updated: ' . date('F j, Y') . '</em></p>
        
        <h3>1. Information We Collect</h3>
        <p>We collect information you provide directly to us, such as when you create an account, make a donation, or contact us. This may include:</p>
        <ul>
            <li>Name and contact information</li>
            <li>Payment information for donations</li>
            <li>Communication preferences</li>
            <li>Usage data and analytics</li>
        </ul>
        
        <h3>2. How We Use Your Information</h3>
        <p>We use the information we collect to:</p>
        <ul>
            <li>Provide, maintain, and improve our services</li>
            <li>Process transactions and send related information</li>
            <li>Communicate with you about our activities</li>
            <li>Analyze website usage and optimize user experience</li>
        </ul>
        
        <h3>3. Information Sharing</h3>
        <p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except in the following circumstances:</p>
        <ul>
            <li>When required by law</li>
            <li>To protect our rights and prevent fraud</li>
            <li>With trusted service providers who assist us in operating our website</li>
        </ul>
        
        <h3>4. Data Security</h3>
        <p>We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.</p>
        
        <h3>5. Your Rights</h3>
        <p>You have the right to:</p>
        <ul>
            <li>Access your personal information</li>
            <li>Update or correct your information</li>
            <li>Delete your account and data</li>
            <li>Opt-out of marketing communications</li>
        </ul>
        
        <h3>6. Contact Us</h3>
        <p>If you have any questions about this Privacy Policy, please contact us at:</p>
        <blockquote>
            <p>Email: privacy@smartngo.in<br>
            Phone: +91 98765 43210<br>
            Address: 123 Social Avenue, NGO Tower, Mumbai 400001</p>
        </blockquote>';
    }

    private function getDefaultTermsContent()
    {
        return '<h2>Terms of Service</h2>
        <p><em>Last updated: ' . date('F j, Y') . '</em></p>
        
        <h3>1. Acceptance of Terms</h3>
        <p>By accessing and using Smart NGO, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.</p>
        
        <h3>2. Use License</h3>
        <p>Permission is granted to temporarily download one copy of the materials on Smart NGO for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>
        <ul>
            <li>Modify or copy the materials</li>
            <li>Use the materials for any commercial purpose</li>
            <li>Attempt to reverse engineer any software</li>
            <li>Remove any copyright or other proprietary notations</li>
        </ul>
        
        <h3>3. Disclaimer</h3>
        <p>The materials on Smart NGO are provided on an \'as is\' basis. Smart NGO makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</p>
        
        <h3>4. Limitations</h3>
        <p>In no event shall Smart NGO or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on Smart NGO, even if Smart NGO or an authorized representative has been notified orally or in writing of the possibility of such damage.</p>
        
        <h3>5. Donations</h3>
        <p>All donations are processed securely through our payment partners. By making a donation, you agree to:</p>
        <ul>
            <li>Provide accurate payment information</li>
            <li>Authorize the payment processing</li>
            <li>Understand that donations are non-refundable unless required by law</li>
        </ul>
        
        <h3>6. Privacy</h3>
        <p>Your privacy is important to us. Please review our Privacy Policy, which also governs the site, to understand our practices.</p>
        
        <h3>7. Revisions and Errata</h3>
        <p>Materials appearing on Smart NGO could include technical, typographical, or photographic errors. We do not warrant that any of the materials on its website are accurate, complete, or current. We may change the materials on its website at any time without notice.</p>';
    }

    private function getDefaultCookiesContent()
    {
        return '<h2>Cookie Policy</h2>
        <p><em>Last updated: ' . date('F j, Y') . '</em></p>
        
        <h3>1. What Are Cookies</h3>
        <p>Cookies are small text files that are placed on your device (computer, smartphone, or tablet) when you visit our website. They help us provide you with a better experience by remembering your preferences and allowing us to analyze website traffic.</p>
        
        <h3>2. How We Use Cookies</h3>
        <p>We use cookies to:</p>
        <ul>
            <li>Make our website work properly (essential cookies)</li>
            <li>Remember your preferences and settings</li>
            <li>Understand how visitors interact with our website</li>
            <li>Provide personalized content and advertisements</li>
            <li>Improve website performance and user experience</li>
        </ul>
        
        <h3>3. Types of Cookies We Use</h3>
        <p>We use the following types of cookies:</p>
        
        <h4>Essential Cookies</h4>
        <p>These cookies are required for the website to function properly and cannot be disabled. They include:</p>
        <ul>
            <li>Session management (login, user preferences)</li>
            <li>Shopping cart and donation process</li>
            <li>Security features</li>
        </ul>
        
        <h4>Analytics Cookies</h4>
        <p>These cookies help us understand how visitors interact with our website by collecting and reporting information anonymously. We use Google Analytics for this purpose.</p>
        
        <h4>Functional Cookies</h4>
        <p>These cookies enable enhanced functionality and personalization, such as:</p>
        <ul>
            <li>Remembering your preferences</li>
            <li>Providing personalized content</li>
            <li>Social media integration</li>
        </ul>
        
        <h4>Advertising Cookies</h4>
        <p>These cookies are used to deliver advertisements that are relevant to you and your interests. They are also used to limit the number of times you see an advertisement.</p>
        
        <h3>4. Managing Cookies</h3>
        <p>You can control and/or delete cookies as you wish. You can:</p>
        <ul>
            <li>Delete all cookies already on your device</li>
            <li>Set most browsers to prevent cookies from being placed</li>
            <li>Use browser extensions to manage cookies</li>
        </ul>
        <p><strong>Note:</strong> Disabling cookies may affect your ability to use certain features of our website.</p>
        
        <h3>5. Third-Party Cookies</h3>
        <p>We may use third-party services that also set cookies on your device for our services to function. These include:</p>
        <ul>
            <li>Payment processors for secure donations</li>
            <li>Analytics services for website optimization</li>
            <li>Social media platforms for sharing content</li>
        </ul>
        
        <h3>6. Updates to This Policy</h3>
        <p>We may update this Cookie Policy from time to time to reflect changes in our practices, technology, or legal requirements. Any changes will be posted on this page with an updated revision date.</p>
        
        <h3>7. Contact Us</h3>
        <p>If you have any questions about our use of cookies, please contact us at:</p>
        <blockquote>
            <p>Email: privacy@smartngo.in<br>
            Phone: +91 98765 43210</p>
        </blockquote>';
    }
}
