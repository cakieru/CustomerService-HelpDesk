<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kb_articles')->insert([
            [
                'title' => 'How to Track Your Order',
                'category' => 'Shipping & Delivery',
                'cat_id' => 'shipping',
                'desc' => 'Once your order ships, you\'ll receive a tracking number via email. Click the tracking link to see real-time updates. Tracking information may take 24 hours to update after shipment.',
                'tags' => 'Tracking, Shipping, Order',
                'views' => 1245,
                'yes_votes' => 982,
                'no_votes' => 43,
                'visibility' => 'public',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Return & Refund Policy',
                'category' => 'Returns & Refunds',
                'cat_id' => 'returns',
                'desc' => 'You can return most items within 30 days of delivery for a full refund. Items must be unused and in original packaging. Refunds are processed dynamically once received.',
                'tags' => 'Returns, Refunds, Policy',
                'views' => 2156,
                'yes_votes' => 1420,
                'no_votes' => 12,
                'visibility' => 'public',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'How to Reset Your Password',
                'category' => 'Account Management',
                'cat_id' => 'account',
                'desc' => 'Click Forgot Password on the login page, enter your email, and click the reset link sent to you. Make sure to clear your browser cache if you\'re having trouble logging in after reset.',
                'tags' => 'Password, Account, Security',
                'views' => 876,
                'yes_votes' => 745,
                'no_votes' => 23,
                'visibility' => 'public',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Using Discount Codes',
                'category' => 'Promotions & Discounts',
                'cat_id' => 'promotions',
                'desc' => 'Enter your discount code at checkout in the \'Promo Code\' field. Codes are case-sensitive and cannot be combined with other offers. Check active campaign conditions for applicability.',
                'tags' => 'Promo, Discount, Checkout',
                'views' => 3421,
                'yes_votes' => 1890,
                'no_votes' => 45,
                'visibility' => 'public',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Guide For Peripherals',
                'category' => 'Product Information',
                'cat_id' => 'product',
                'desc' => 'Our dimension chart includes measurements in both inches and centimeters. Just measure your desk space or hand size and compare it to the standard hardware dimensions provided.',
                'tags' => 'Peripherals, Size-Guide, Hardware',
                'views' => 4532,
                'yes_votes' => 2311,
                'no_votes' => 180,
                'visibility' => 'public',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Managing Your Subscription',
                'category' => 'Subscriptions',
                'cat_id' => 'subscriptions',
                'desc' => 'Log into your account and go to \'Subscriptions\' to view, pause, or cancel. Cancellations take effect at the end of your current billing cycle. Change tier configurations instantly.',
                'tags' => 'Subscription, Billing, Cancel',
                'views' => 1687,
                'yes_votes' => 844,
                'no_votes' => 39,
                'visibility' => 'public',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'What to do if Your Order is Delayed',
                'category' => 'Shipping & Delivery',
                'cat_id' => 'shipping',
                'desc' => 'Most orders arrive within 3-7 business days. If your order is delayed, check the tracking for updates. Contact us if there\'s no movement for 3 consecutive handling periods.',
                'tags' => 'Delay, Shipping, Logistics',
                'views' => 892,
                'yes_votes' => 340,
                'no_votes' => 28,
                'visibility' => 'public',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'How to Report a Damaged Item',
                'category' => 'Damaged Items',
                'cat_id' => 'damaged',
                'desc' => 'Take photos of the damage and packaging. Contact us within 48 hours of delivery with your order number and photos. We\'ll arrange a replacement dispatch vector right away.',
                'tags' => 'Damaged, Replacement, Support',
                'views' => 347,
                'yes_votes' => 112,
                'no_votes' => 15,
                'visibility' => 'public',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
