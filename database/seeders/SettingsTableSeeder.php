<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $settings = [
        [
            'key'                       =>  'site_name',
            'value'                     =>  'Re-Usable Blog',
        ],
        [
            'key'                       =>  'site_logo',
            'value'                     =>  'default-logo.png',
        ],
        [
            'key'                       =>  'site_favicon',
            'value'                     =>  'default-favicon.png',
        ],
        [
            'key'                       =>  'seo_meta_title',
            'value'                     =>  'Responsive Reusable Blog.',
        ],
        [
            'key'                       =>  'seo_meta_keywords',
            'value'                     =>  'reusable,blog,responsive',
        ],
        [
            'key'                       =>  'seo_meta_description',
            'value'                     =>  'This is a reusable blog with utilize tools to edit and customise.',
        ],
        [
            'key'                       =>  'default_email_address',
            'value'                     =>  'siteemail@example.com',
        ],
        [
            'key'                       =>  'footer_copyright_text',
            'value'                     =>  '<p><span style="color: #ecf0f1;">Copyright &copy; All rights reserved | This template is made with ❤️ by Brainiac.</span></p>',
        ],
        [
            'key'                       =>  'base_color',
            'value'                     =>  '#d92626',
        ],
        [
            'key'                       =>  'secondary_color',
            'value'                     =>  '#ffda23',
        ],
        [
            'key'                       =>  'social_facebook',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'social_twitter',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'social_instagram',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'social_linkedin',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'google_analytics',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'facebook_pixels',
            'value'                     =>  '',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->settings as $index => $setting) {
            $result = Settings::create($setting);
            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
        $this->command->info('Inserted ' . count($this->settings) . ' settings records');
    }
}
