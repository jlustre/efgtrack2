@extends('layouts.legal')

@section('title', 'Terms of Service - EFGTrack')

@section('content')
<!-- Page Header -->
<div class="text-center mb-12">
    <h1 class="text-4xl font-bold text-gray-900 mb-4">Terms of Service</h1>
    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Please read these terms carefully before using our platform.
    </p>
    <p class="text-sm text-gray-500 mt-4">Last updated: {{ date('F d, Y') }}</p>
</div>

<!-- Content -->
<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
    <div class="prose prose-blue max-w-none">
        <h2>Acceptance of Terms</h2>
        <p>
            By accessing or using EFGTrack's team management platform ("Service"), you agree to be bound by
            these Terms of Service ("Terms"). If you disagree with any part of these terms, then you may not
            access the Service.
        </p>

        <h2>Description of Service</h2>
        <p>
            EFGTrack provides a comprehensive team management platform designed for financial services
            organizations. Our Service includes mentoring tools, performance analytics, AI-powered training
            modules, and collaborative features to enhance team productivity and development.
        </p>

        <h2>User Accounts</h2>
        <ul>
            <li>You must provide accurate and complete information when creating an account</li>
            <li>You are responsible for maintaining the security of your account credentials</li>
            <li>You must notify us immediately of any unauthorized access to your account</li>
            <li>One person or legal entity may not maintain more than one account</li>
        </ul>

        <h2>Acceptable Use</h2>
        <p>You agree not to:</p>
        <ul>
            <li>Use the Service for any unlawful purpose or in violation of applicable laws</li>
            <li>Transmit any harmful, offensive, or inappropriate content</li>
            <li>Attempt to gain unauthorized access to other users' accounts or data</li>
            <li>Interfere with or disrupt the Service or servers</li>
            <li>Use automated scripts or bots to access the Service</li>
        </ul>

        <h2>Intellectual Property Rights</h2>
        <p>
            The Service and its original content, features, and functionality are owned by EFGTrack and are
            protected by international copyright, trademark, patent, trade secret, and other intellectual
            property laws.
        </p>

        <h2>Privacy and Data Protection</h2>
        <p>
            Your privacy is important to us. Please review our Privacy Policy, which also governs your use of
            the Service, to understand our practices regarding the collection and use of your information.
        </p>

        <h2>Termination</h2>
        <p>
            We may terminate or suspend your account and access to the Service immediately, without prior notice
            or liability, for any reason, including if you breach the Terms. Upon termination, your right to use
            the Service will cease immediately.
        </p>

        <h2>Limitation of Liability</h2>
        <p>
            In no event shall EFGTrack, its directors, employees, or agents be liable for any indirect,
            incidental, special, consequential, or punitive damages, including loss of profits, data, use,
            goodwill, or other intangible losses, resulting from your use of the Service.
        </p>

        <h2>Governing Law</h2>
        <p>
            These Terms shall be governed by and construed in accordance with the laws of New York State,
            without regard to its conflict of law provisions. Any disputes arising from these Terms or the
            Service shall be resolved in the state or federal courts located in New York.
        </p>

        <h2>Changes to Terms</h2>
        <p>
            We reserve the right to modify or replace these Terms at any time. If a revision is material, we will
            try to provide at least 30 days' notice before any new terms take effect.
        </p>

        <h2>Contact Us</h2>
        <p>If you have any questions about these Terms of Service, please contact us:</p>
        <div class="bg-gray-50 p-4 rounded-lg mt-4">
            <p><strong>Email:</strong> legal@efgtrack.com</p>
            <p><strong>Address:</strong> EFGTrack Legal Department</p>
            <p>123 Business Ave, Suite 100</p>
            <p>Financial District, NY 10001</p>
        </div>
    </div>
</div>
@endsection