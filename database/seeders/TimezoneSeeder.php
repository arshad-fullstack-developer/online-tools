<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimezoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timezones = [
            // Americas
            ['value' => 'America/New_York', 'label' => 'Eastern Time (ET) - New York', 'city' => 'New York', 'country' => 'United States', 'region' => 'Americas', 'is_popular' => true, 'order' => 1],
            ['value' => 'America/Chicago', 'label' => 'Central Time (CT) - Chicago', 'city' => 'Chicago', 'country' => 'United States', 'region' => 'Americas', 'is_popular' => false, 'order' => 2],
            ['value' => 'America/Denver', 'label' => 'Mountain Time (MT) - Denver', 'city' => 'Denver', 'country' => 'United States', 'region' => 'Americas', 'is_popular' => false, 'order' => 3],
            ['value' => 'America/Los_Angeles', 'label' => 'Pacific Time (PT) - Los Angeles', 'city' => 'Los Angeles', 'country' => 'United States', 'region' => 'Americas', 'is_popular' => true, 'order' => 4],
            ['value' => 'America/Anchorage', 'label' => 'Alaska Time (AKT) - Anchorage', 'city' => 'Anchorage', 'country' => 'United States', 'region' => 'Americas', 'is_popular' => false, 'order' => 5],
            ['value' => 'Pacific/Honolulu', 'label' => 'Hawaii Time (HT) - Honolulu', 'city' => 'Honolulu', 'country' => 'United States', 'region' => 'Americas', 'is_popular' => false, 'order' => 6],
            ['value' => 'America/Toronto', 'label' => 'Eastern Time - Toronto', 'city' => 'Toronto', 'country' => 'Canada', 'region' => 'Americas', 'is_popular' => false, 'order' => 7],
            ['value' => 'America/Mexico_City', 'label' => 'Central Time - Mexico City', 'city' => 'Mexico City', 'country' => 'Mexico', 'region' => 'Americas', 'is_popular' => false, 'order' => 8],
            ['value' => 'America/Sao_Paulo', 'label' => 'Brasília Time - São Paulo', 'city' => 'São Paulo', 'country' => 'Brazil', 'region' => 'Americas', 'is_popular' => false, 'order' => 9],
            ['value' => 'America/Buenos_Aires', 'label' => 'Argentina Time - Buenos Aires', 'city' => 'Buenos Aires', 'country' => 'Argentina', 'region' => 'Americas', 'is_popular' => false, 'order' => 10],
            
            // Europe
            ['value' => 'Europe/London', 'label' => 'Greenwich Mean Time (GMT) - London', 'city' => 'London', 'country' => 'United Kingdom', 'region' => 'Europe', 'is_popular' => true, 'order' => 11],
            ['value' => 'Europe/Paris', 'label' => 'Central European Time (CET) - Paris', 'city' => 'Paris', 'country' => 'France', 'region' => 'Europe', 'is_popular' => true, 'order' => 12],
            ['value' => 'Europe/Berlin', 'label' => 'Central European Time (CET) - Berlin', 'city' => 'Berlin', 'country' => 'Germany', 'region' => 'Europe', 'is_popular' => false, 'order' => 13],
            ['value' => 'Europe/Rome', 'label' => 'Central European Time (CET) - Rome', 'city' => 'Rome', 'country' => 'Italy', 'region' => 'Europe', 'is_popular' => false, 'order' => 14],
            ['value' => 'Europe/Madrid', 'label' => 'Central European Time (CET) - Madrid', 'city' => 'Madrid', 'country' => 'Spain', 'region' => 'Europe', 'is_popular' => false, 'order' => 15],
            ['value' => 'Europe/Amsterdam', 'label' => 'Central European Time (CET) - Amsterdam', 'city' => 'Amsterdam', 'country' => 'Netherlands', 'region' => 'Europe', 'is_popular' => false, 'order' => 16],
            ['value' => 'Europe/Brussels', 'label' => 'Central European Time (CET) - Brussels', 'city' => 'Brussels', 'country' => 'Belgium', 'region' => 'Europe', 'is_popular' => false, 'order' => 17],
            ['value' => 'Europe/Vienna', 'label' => 'Central European Time (CET) - Vienna', 'city' => 'Vienna', 'country' => 'Austria', 'region' => 'Europe', 'is_popular' => false, 'order' => 18],
            ['value' => 'Europe/Athens', 'label' => 'Eastern European Time (EET) - Athens', 'city' => 'Athens', 'country' => 'Greece', 'region' => 'Europe', 'is_popular' => false, 'order' => 19],
            ['value' => 'Europe/Moscow', 'label' => 'Moscow Standard Time (MSK) - Moscow', 'city' => 'Moscow', 'country' => 'Russia', 'region' => 'Europe', 'is_popular' => false, 'order' => 20],
            
            // Middle East / Arab Countries
            ['value' => 'Asia/Riyadh', 'label' => 'Arabia Standard Time (AST) - Riyadh, Saudi Arabia', 'city' => 'Riyadh', 'country' => 'Saudi Arabia', 'region' => 'Middle East', 'is_popular' => true, 'order' => 21],
            ['value' => 'Asia/Kuwait', 'label' => 'Arabia Standard Time (AST) - Kuwait City', 'city' => 'Kuwait City', 'country' => 'Kuwait', 'region' => 'Middle East', 'is_popular' => false, 'order' => 22],
            ['value' => 'Asia/Bahrain', 'label' => 'Arabia Standard Time (AST) - Manama, Bahrain', 'city' => 'Manama', 'country' => 'Bahrain', 'region' => 'Middle East', 'is_popular' => false, 'order' => 23],
            ['value' => 'Asia/Qatar', 'label' => 'Arabia Standard Time (AST) - Doha, Qatar', 'city' => 'Doha', 'country' => 'Qatar', 'region' => 'Middle East', 'is_popular' => false, 'order' => 24],
            ['value' => 'Asia/Dubai', 'label' => 'Gulf Standard Time (GST) - Dubai, UAE', 'city' => 'Dubai', 'country' => 'United Arab Emirates', 'region' => 'Middle East', 'is_popular' => true, 'order' => 25],
            ['value' => 'Asia/Muscat', 'label' => 'Gulf Standard Time (GST) - Muscat, Oman', 'city' => 'Muscat', 'country' => 'Oman', 'region' => 'Middle East', 'is_popular' => false, 'order' => 26],
            ['value' => 'Asia/Baghdad', 'label' => 'Arabia Standard Time (AST) - Baghdad, Iraq', 'city' => 'Baghdad', 'country' => 'Iraq', 'region' => 'Middle East', 'is_popular' => false, 'order' => 27],
            ['value' => 'Asia/Amman', 'label' => 'Eastern European Time (EET) - Amman, Jordan', 'city' => 'Amman', 'country' => 'Jordan', 'region' => 'Middle East', 'is_popular' => false, 'order' => 28],
            ['value' => 'Asia/Beirut', 'label' => 'Eastern European Time (EET) - Beirut, Lebanon', 'city' => 'Beirut', 'country' => 'Lebanon', 'region' => 'Middle East', 'is_popular' => false, 'order' => 29],
            ['value' => 'Asia/Damascus', 'label' => 'Eastern European Time (EET) - Damascus, Syria', 'city' => 'Damascus', 'country' => 'Syria', 'region' => 'Middle East', 'is_popular' => false, 'order' => 30],
            ['value' => 'Asia/Jerusalem', 'label' => 'Israel Standard Time (IST) - Jerusalem', 'city' => 'Jerusalem', 'country' => 'Israel', 'region' => 'Middle East', 'is_popular' => false, 'order' => 31],
            ['value' => 'Africa/Cairo', 'label' => 'Eastern European Time (EET) - Cairo, Egypt', 'city' => 'Cairo', 'country' => 'Egypt', 'region' => 'Middle East', 'is_popular' => true, 'order' => 32],
            ['value' => 'Asia/Aden', 'label' => 'Arabia Standard Time (AST) - Aden, Yemen', 'city' => 'Aden', 'country' => 'Yemen', 'region' => 'Middle East', 'is_popular' => false, 'order' => 33],
            
            // Other Asia
            ['value' => 'Asia/Karachi', 'label' => 'Pakistan Standard Time (PKT) - Karachi', 'city' => 'Karachi', 'country' => 'Pakistan', 'region' => 'Asia', 'is_popular' => false, 'order' => 34],
            ['value' => 'Asia/Kolkata', 'label' => 'India Standard Time (IST) - Mumbai/Delhi', 'city' => 'Mumbai', 'country' => 'India', 'region' => 'Asia', 'is_popular' => true, 'order' => 35],
            ['value' => 'Asia/Dhaka', 'label' => 'Bangladesh Standard Time (BST) - Dhaka', 'city' => 'Dhaka', 'country' => 'Bangladesh', 'region' => 'Asia', 'is_popular' => false, 'order' => 36],
            ['value' => 'Asia/Bangkok', 'label' => 'Indochina Time (ICT) - Bangkok', 'city' => 'Bangkok', 'country' => 'Thailand', 'region' => 'Asia', 'is_popular' => false, 'order' => 37],
            ['value' => 'Asia/Singapore', 'label' => 'Singapore Time (SGT) - Singapore', 'city' => 'Singapore', 'country' => 'Singapore', 'region' => 'Asia', 'is_popular' => true, 'order' => 38],
            ['value' => 'Asia/Hong_Kong', 'label' => 'Hong Kong Time (HKT) - Hong Kong', 'city' => 'Hong Kong', 'country' => 'Hong Kong', 'region' => 'Asia', 'is_popular' => false, 'order' => 39],
            ['value' => 'Asia/Shanghai', 'label' => 'China Standard Time (CST) - Beijing/Shanghai', 'city' => 'Shanghai', 'country' => 'China', 'region' => 'Asia', 'is_popular' => false, 'order' => 40],
            ['value' => 'Asia/Tokyo', 'label' => 'Japan Standard Time (JST) - Tokyo', 'city' => 'Tokyo', 'country' => 'Japan', 'region' => 'Asia', 'is_popular' => true, 'order' => 41],
            ['value' => 'Asia/Seoul', 'label' => 'Korea Standard Time (KST) - Seoul', 'city' => 'Seoul', 'country' => 'South Korea', 'region' => 'Asia', 'is_popular' => false, 'order' => 42],
            
            // Pacific
            ['value' => 'Australia/Sydney', 'label' => 'Australian Eastern Time (AET) - Sydney', 'city' => 'Sydney', 'country' => 'Australia', 'region' => 'Pacific', 'is_popular' => true, 'order' => 43],
            ['value' => 'Australia/Melbourne', 'label' => 'Australian Eastern Time (AET) - Melbourne', 'city' => 'Melbourne', 'country' => 'Australia', 'region' => 'Pacific', 'is_popular' => false, 'order' => 44],
            ['value' => 'Australia/Brisbane', 'label' => 'Australian Eastern Time (AET) - Brisbane', 'city' => 'Brisbane', 'country' => 'Australia', 'region' => 'Pacific', 'is_popular' => false, 'order' => 45],
            ['value' => 'Australia/Perth', 'label' => 'Australian Western Time (AWT) - Perth', 'city' => 'Perth', 'country' => 'Australia', 'region' => 'Pacific', 'is_popular' => false, 'order' => 46],
            ['value' => 'Pacific/Auckland', 'label' => 'New Zealand Time (NZST) - Auckland', 'city' => 'Auckland', 'country' => 'New Zealand', 'region' => 'Pacific', 'is_popular' => false, 'order' => 47],
            
            // Africa
            ['value' => 'Africa/Johannesburg', 'label' => 'South Africa Standard Time (SAST) - Johannesburg', 'city' => 'Johannesburg', 'country' => 'South Africa', 'region' => 'Africa', 'is_popular' => false, 'order' => 48],
            ['value' => 'Africa/Lagos', 'label' => 'West Africa Time (WAT) - Lagos', 'city' => 'Lagos', 'country' => 'Nigeria', 'region' => 'Africa', 'is_popular' => false, 'order' => 49],
            
            // UTC
            ['value' => 'UTC', 'label' => 'Coordinated Universal Time (UTC)', 'city' => null, 'country' => null, 'region' => 'UTC', 'is_popular' => false, 'order' => 50],
        ];

        foreach ($timezones as $timezone) {
            \App\Models\Timezone::create($timezone);
        }
    }
}
