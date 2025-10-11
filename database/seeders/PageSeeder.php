<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about',
                'excerpt' => 'Learn more about our mission to provide free, easy-to-use online tools for everyone.',
                'content' => '<h2>Our Mission</h2><p>We believe that everyone should have access to powerful, easy-to-use tools without barriers. That\'s why we created Online Tools - a completely free platform that requires no registration, no downloads, and no hassle.</p><h2>What We Offer</h2><p>Whether you\'re a student, professional, or just someone looking to get things done quickly, our tools are designed to save you time and make your life easier.</p>',
                'order' => 1,
                'is_active' => true,
                'show_in_menu' => true,
                'meta_title' => 'About Us - Online Tools',
                'meta_description' => 'Learn more about our mission to provide free, easy-to-use online tools for everyone.',
                'meta_keywords' => 'about, online tools, free tools, mission',
            ],
            [
                'title' => 'All Tools',
                'slug' => 'tools',
                'excerpt' => 'Browse our complete collection of free online tools',
                'content' => '<h2>Our Tools</h2><p>Explore our comprehensive collection of free online tools organized by category. From text manipulation to financial calculations, we have everything you need.</p>',
                'order' => 2,
                'is_active' => true,
                'show_in_menu' => true,
                'meta_title' => 'All Tools - Online Tools',
                'meta_description' => 'Browse our complete collection of free online tools including calculators, converters, and formatters.',
                'meta_keywords' => 'tools, calculators, converters, formatters, online tools',
            ],
            [
                'title' => 'Blog',
                'slug' => 'blog',
                'excerpt' => 'Read our latest articles, tips, and tutorials about using online tools effectively.',
                'content' => '<h2>Coming Soon!</h2><p>We\'re working hard to bring you valuable content, tutorials, and tips. Our blog will feature articles about productivity, tool guides, and much more.</p>',
                'order' => 3,
                'is_active' => true,
                'show_in_menu' => true,
                'meta_title' => 'Blog - Online Tools',
                'meta_description' => 'Read our latest articles, tips, and tutorials about using online tools effectively.',
                'meta_keywords' => 'blog, articles, tutorials, tips, online tools',
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact',
                'excerpt' => 'Get in touch with us. We\'d love to hear your feedback and suggestions.',
                'content' => '<h2>Get in Touch</h2><p>We\'re here to help! Whether you have a question, suggestion, or just want to say hello, feel free to reach out to us.</p><p>Email: support@onlinetools.com</p><p>Response Time: Usually within 24 hours</p>',
                'order' => 4,
                'is_active' => true,
                'show_in_menu' => true,
                'meta_title' => 'Contact Us - Online Tools',
                'meta_description' => 'Get in touch with us. We\'d love to hear your feedback and suggestions.',
                'meta_keywords' => 'contact, feedback, support, help',
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'excerpt' => 'Learn how we protect your privacy and handle your data.',
                'content' => '<h2>Privacy Policy</h2><p>Your privacy is important to us. This privacy policy explains how we collect, use, and protect your information.</p><h3>Information We Collect</h3><p>We do not collect personal information unless you voluntarily provide it through our contact form.</p><h3>How We Use Information</h3><p>Any information collected is used solely to respond to your inquiries.</p>',
                'order' => 5,
                'is_active' => true,
                'show_in_menu' => false,
                'meta_title' => 'Privacy Policy - Online Tools',
                'meta_description' => 'Learn how we protect your privacy and handle your data.',
                'meta_keywords' => 'privacy policy, data protection, privacy',
            ],
            [
                'title' => 'Terms of Service',
                'slug' => 'terms-of-service',
                'excerpt' => 'Terms and conditions for using our online tools.',
                'content' => '<h2>Terms of Service</h2><p>By accessing and using our website, you accept and agree to be bound by the terms and provision of this agreement.</p><h3>Use License</h3><p>Permission is granted to temporarily use our tools for personal, non-commercial transitory viewing only.</p>',
                'order' => 6,
                'is_active' => true,
                'show_in_menu' => false,
                'meta_title' => 'Terms of Service - Online Tools',
                'meta_description' => 'Terms and conditions for using our online tools.',
                'meta_keywords' => 'terms of service, terms, conditions',
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}
