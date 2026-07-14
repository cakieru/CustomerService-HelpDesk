<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('article_categories')->insert([
            ['category_name' => 'Shipping & Delivery', 'description' => 'Logistics tracking and handling updates.', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Returns & Refunds', 'description' => 'Return procedures and refund mechanisms.', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Account Management', 'description' => 'Security, login setups, and settings credentials.', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Promotions & Discounts', 'description' => 'Campaign voucher and processing metrics.', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Product Information', 'description' => 'Sizing matrices and peripheral document logs.', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Subscriptions', 'description' => 'Tier details, pauses, and billing schedules.', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Damaged Items', 'description' => 'Reporting logistics errors or broken components.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}