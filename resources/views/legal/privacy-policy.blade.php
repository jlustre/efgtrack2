@extends('layouts.legal')

@section('title', 'Privacy Policy - EFGTrack')

@section('content')
<!-- Page Header -->
<div class="text-center mb-12">
    <h1 class="text-4xl font-bold text-gray-900 mb-4">Privacy Policy</h1>
    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Your privacy is important to us. This policy explains how we collect, use, and protect your information.
    </p>
    <p class="text-sm text-gray-500 mt-4">Last updated: {{ date('F d, Y') }}</p>
</div>

<!-- Content -->
<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
    <div class="prose prose-blue max-w-none">
        <h2>Introduction</h2>
        <p>
            EFGTrack ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy
            explains how we collect, use, disclose, and safeguard your information when you use our team management
            platform and related services.
        </p>

        <h2>Information We Collect</h2>
        <h3>Personal Information</h3>
        <ul>
            <li>Name, email address, and contact information</li>
            <li>Professional details such as role, department, and hierarchy level</li>
            <li>Account credentials and authentication information</li>
            <li>Profile information and preferences</li>
        </ul>

        <h3>Usage Information</h3>
        <ul>
            <li>Log data including IP address, browser type, and device information</li>
            <li>Platform usage patterns and feature interactions</li>
            <li>Performance metrics and analytics data</li>
            <li>Communication and collaboration data within the platform</li>
        </ul>

        <h2>How We Use Your Information</h2>
        <ul>
            <li>Provide and maintain our team management services</li>
            <li>Facilitate mentoring relationships and team collaboration</li>
            <li>Generate progress analytics and performance insights</li>
            <li>Communicate with you about your account and platform updates</li>
            <li>Improve our services and develop new features</li>
            <li>Ensure platform security and prevent unauthorized access</li>
        </ul>

        <h2>Information Sharing</h2>
        <p>We may share your information in the following circumstances:</p>
        <ul>
            <li><strong>Within Your Organization:</strong> With team members and mentors as necessary for platform
                functionality</li>
            <li><strong>Service Providers:</strong> With trusted third-party services that support our platform
                operations</li>
            <li><strong>Legal Requirements:</strong> When required by law or to protect our rights and safety</li>
            <li><strong>Business Transfers:</strong> In connection with mergers, acquisitions, or asset sales</li>
        </ul>

        <h2>Data Security</h2>
        <p>
            We implement industry-standard security measures to protect your information, including encryption,
            secure data transmission, and access controls. However, no method of transmission over the internet
            is 100% secure.
        </p>

        <h2>Your Rights and Choices</h2>
        <ul>
            <li>Access, update, or delete your personal information</li>
            <li>Opt-out of non-essential communications</li>
            <li>Request data portability or account deactivation</li>
            <li>Contact us with privacy-related questions or concerns</li>
        </ul>

        <h2>Contact Us</h2>
        <p>If you have questions about this Privacy Policy or our privacy practices, please contact us at:</p>
        <div class="bg-gray-50 p-4 rounded-lg mt-4">
            <p><strong>Email:</strong> privacy@efgtrack.com</p>
            <p><strong>Address:</strong> EFGTrack Privacy Team</p>
            <p>123 Business Ave, Suite 100</p>
            <p>Financial District, NY 10001</p>
        </div>
    </div>
</div>
@endsection