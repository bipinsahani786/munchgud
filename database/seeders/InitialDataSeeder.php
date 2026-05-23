<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Page;
use App\Models\Blog;
use App\Models\Faq;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Run PageSeeder (Base Pages)
        echo "1. Seeding base page models...\n";
        $this->call(PageSeeder::class);

        // 2. Run RecipeSeeder (Makhana Recipes)
        echo "2. Seeding makhana recipes...\n";
        $this->call(RecipeSeeder::class);

        // 3. Seed Flavour Pages (Cream & Onion and Peri Peri)
        echo "3. Seeding Cream & Onion / Peri Peri page entries...\n";
        Page::updateOrCreate(
            ['slug' => 'cream-and-onion'],
            [
                'name' => 'Cream and Onion',
                'meta_title' => 'MunchGud Premium Cream & Onion Roasted Makhana',
                'meta_description' => 'Enjoy the comforting and savoury taste of MunchGud\'s premium Cream & Onion roasted makhana snacks. Prepared with care to keep it fresh and crunchy.',
                'is_active' => true,
                'sections' => []
            ]
        );
        Page::updateOrCreate(
            ['slug' => 'peri-peri-makhana'],
            [
                'name' => 'Peri Peri Makhana',
                'meta_title' => 'MunchGud Premium Peri Peri Roasted Makhana',
                'meta_description' => 'Make your everyday snacking more exciting with MunchGud\'s premium spicy peri peri makhana. Roasted to absolute perfection with bold seasoning.',
                'is_active' => true,
                'sections' => []
            ]
        );

        // 4. Seed Static Pages content from Blade Templates
        echo "4. Reading and importing static pages content...\n";
        $staticPages = [
            'privacy-policy' => 'resources/views/pages/privacy.blade.php',
            'terms' => 'resources/views/pages/terms.blade.php',
            'refund-policy' => 'resources/views/pages/refund.blade.php',
            'shipping-policy' => 'resources/views/pages/shipping.blade.php',
            'about' => 'resources/views/pages/about.blade.php',
            'faq' => 'resources/views/pages/faq.blade.php',
        ];

        foreach ($staticPages as $slug => $file) {
            $filePath = base_path($file);
            if (file_exists($filePath)) {
                $content = file_get_contents($filePath);
                
                // Extract article tag content
                if (preg_match('/<article[^>]*>(.*?)<\/article>/s', $content, $matches)) {
                    $html = trim($matches[1]);
                    Page::where('slug', $slug)->update(['content' => $html]);
                } 
                // Fallback for FAQ or others
                elseif (preg_match('/<div class="max-w-3xl mx-auto[^>]*>(.*?)<\/div>\s*<\/div>\s*<\/div>\s*@endsection/s', $content, $matches)) {
                    $html = trim($matches[1]);
                    Page::where('slug', $slug)->update(['content' => $html]);
                }
            }
        }

        // 5. Seed Story Page Default Team Sections
        echo "5. Seeding Story Page team details...\n";
        $storyPage = Page::where('slug', 'story')->first();
        if ($storyPage) {
            $sections = is_array($storyPage->sections) ? $storyPage->sections : [];
            $defaults = [
                'team_1_image' => '', 
                'team_1_name' => 'Rahul Sharma', 
                'team_1_role' => 'Co-Founder & CEO', 
                'team_1_quote' => 'We wanted to build a brand that our own families could trust blindly.', 
                'team_2_image' => '', 
                'team_2_name' => 'Priya Patel', 
                'team_2_role' => 'Co-Founder & Head of Product', 
                'team_2_quote' => 'Creating guilt-free snacks that actually taste amazing was the ultimate puzzle.'
            ];
            foreach ($defaults as $k => $v) {
                if (!isset($sections[$k])) {
                    $sections[$k] = $v;
                }
            }
            $storyPage->sections = $sections;
            $storyPage->save();
        }

        // 6. Seed Story, Recipes, and Products Pages custom section blocks
        echo "6. Seeding section blocks for Story, Recipes, and Products...\n";
        
        // Story Page Sections
        $pageStory = Page::where('slug', 'story')->first();
        if ($pageStory) {
            $storySecs = is_array($pageStory->sections) ? $pageStory->sections : [];
            $newStorySecs = [
                'roots_badge' => '📍 Mithilanchal, Bihar',
                'roots_title' => 'Sourced from the Makhana Capital of the World.',
                'roots_desc' => 'Over 80% of the world\'s Makhana is grown in the pristine water bodies of Bihar, India. We bypassed the middlemen and established direct relationships with the generational farmers of the Mithilanchal region.',
                'roots_stat_1_num' => '200+',
                'roots_stat_1_label' => 'Partner Farmers',
                'roots_stat_2_num' => '100%',
                'roots_stat_2_label' => 'Traceable',
                'process_title' => 'The Seed to Snack Journey',
                'process_desc' => 'It takes meticulous care and traditional wisdom to craft the perfect crunch.',
                'process_step_1_title' => 'Harvesting',
                'process_step_1_desc' => 'Seeds are hand-collected from the bottom of water lily ponds by skilled divers.',
                'process_step_2_title' => 'Sun-Drying',
                'process_step_2_desc' => 'The raw seeds are cleaned and left to dry naturally under the Indian sun.',
                'process_step_3_title' => 'Popping',
                'process_step_3_desc' => 'Roasted in earthen pots and cracked open manually to reveal the white puff.',
                'process_step_4_title' => 'Flavoring',
                'process_step_4_desc' => 'Slow-air-roasted (never fried) and coated in our proprietary gourmet spice blends.',
                'values_badge' => 'Our DNA',
                'values_title' => 'Our Philosophy',
                'values_1_title' => 'Unapologetically Natural',
                'values_1_desc' => 'If an ingredient sounds like a science experiment, it doesn\'t go in our bags. No artificial colors, flavors, or preservatives. Ever.',
                'values_2_title' => 'Fair Trade Always',
                'values_2_desc' => 'We believe in shared prosperity. By partnering directly with farmers, we ensure they receive a premium price for their painstaking labor.',
                'values_3_title' => 'Flavor First',
                'values_3_desc' => 'Healthy shouldn\'t taste like cardboard. We spend months perfecting our spice blends to ensure every bite is an explosion of flavor.',
                'team_title' => 'The Faces Behind the Crunch',
                'team_desc' => 'A team of snack-enthusiasts, nutrition nerds, and flavor scientists.',
                'impact_title' => 'Snacking that gives back.',
                'impact_desc' => 'We are committed to leaving the planet better than we found it. From utilizing eco-friendly packaging materials to empowering rural farming communities, sustainability is baked into our DNA.',
                'impact_stat_1_num' => '100%',
                'impact_stat_1_label' => 'Recyclable Pouches',
                'impact_stat_2_num' => '0',
                'impact_stat_2_label' => 'Plastic Waste',
            ];
            foreach ($newStorySecs as $key => $val) {
                if (!isset($storySecs[$key])) {
                    $storySecs[$key] = $val;
                }
            }
            $pageStory->sections = $storySecs;
            $pageStory->save();
        }

        // Recipes Page Sections
        $pageRecipes = Page::where('slug', 'recipes')->first();
        if ($pageRecipes) {
            $recipesSecs = is_array($pageRecipes->sections) ? $pageRecipes->sections : [];
            $newRecipesSecs = [
                'hero_badge' => 'The Culinary Canvas',
                'hero_title' => 'MunchGud<br><span class="italic text-mg-orange">Recipes.</span>',
                'hero_desc' => 'Elevate your culinary game. Discover quick, healthy, and incredibly tasty makhana-based recipes.',
                'banner_title' => 'Got a unique recipe?',
                'banner_desc' => 'Share your own creative way to eat MunchGud. The best recipes will get featured on our website and social media, and you might just win a free box of snacks!',
            ];
            foreach ($newRecipesSecs as $key => $val) {
                if (!isset($recipesSecs[$key])) {
                    $recipesSecs[$key] = $val;
                }
            }
            $pageRecipes->sections = $recipesSecs;
            $pageRecipes->save();
        }

        // Products Page Sections
        $pageProducts = Page::where('slug', 'products')->first();
        if ($pageProducts) {
            $productsSecs = is_array($pageProducts->sections) ? $pageProducts->sections : [];
            $newProductsSecs = [
                'hero_title' => 'Our <span class="italic text-mg-green">Flavours</span>',
                'hero_desc' => 'Explore our premium range of roasted makhana, packed with protein and crunch.',
            ];
            foreach ($newProductsSecs as $key => $val) {
                if (!isset($productsSecs[$key])) {
                    $productsSecs[$key] = $val;
                }
            }
            $pageProducts->sections = $productsSecs;
            $pageProducts->save();
        }

        // 7. Seed Homepage Custom and Dynamic Section Lists
        echo "7. Seeding Home Page specific dynamic lists...\n";
        $pageHome = Page::where('slug', 'home')->first();
        if ($pageHome) {
            $homeSecs = is_array($pageHome->sections) ? $pageHome->sections : [];
            
            // Dynamic text lists
            $homeSecs['ingredients_list'] = $homeSecs['ingredients_list'] ?? "Premium Makhana (Fox Nuts)\nHimalayan Pink Salt\nCold-pressed spice extracts\nNatural flavour powders\nLove & good vibes ✨";
            $homeSecs['whats_not_list'] = $homeSecs['whats_not_list'] ?? "No MSG or Ajinomoto\nNo artificial colours\nNo trans fats or palm oil\nNo preservatives — ever\nNo refined sugar";
            $homeSecs['bestseller_benefits'] = $homeSecs['bestseller_benefits'] ?? "Hand-picked lotus seeds from Bihar ponds\nAir-roasted at 180°C for maximum crunch\nBold peri peri seasoning — not for the faint-hearted\nSealed within 2 hours of roasting";
            
            // JSON lists
            $homeSecs['health_benefits_json'] = $homeSecs['health_benefits_json'] ?? json_encode([
                ['n'=>'Protein Power', 'v'=>'15g', 'd'=>'Per 100g. Excellent for muscle recovery.'],
                ['n'=>'Antioxidant Rich', 'v'=>'High', 'd'=>'Fights free radicals and aging.'],
                ['n'=>'Glycemic Index', 'v'=>'Low', 'd'=>'Perfect for sustained energy levels.'],
                ['n'=>'Gluten Free', 'v'=>'100%', 'd'=>'Naturally free from gluten.'],
                ['n'=>'Fat Content', 'v'=>'Low', 'd'=>'Significantly lower than popcorn.'],
                ['n'=>'Minerals', 'v'=>'Iron+', 'd'=>'Rich in Magnesium & Potassium.']
            ]);
            $homeSecs['combo_packs_json'] = $homeSecs['combo_packs_json'] ?? json_encode([
                ['n'=>'Starter Pack','it'=>'3 Flavours','p'=>399,'m'=>519,'s'=>120,'pop'=>false],
                ['n'=>'Snack Box','it'=>'6 Flavours','p'=>699,'m'=>999,'s'=>300,'pop'=>true],
                ['n'=>'Family Pack','it'=>'12 Units','p'=>1199,'m'=>1799,'s'=>600,'pop'=>false]
            ]);

            $pageHome->sections = $homeSecs;
            $pageHome->save();
        }

        // 8. Run add_home_sections core configuration blocks
        echo "8. Adding additional home page visual block data...\n";
        $pageHome = Page::where('slug', 'home')->first();
        if ($pageHome) {
            $sections = is_array($pageHome->sections) ? $pageHome->sections : [];
            $homeBlocks = [
                'hero_badge' => '🍿 SMARTER SNACKING FOR ACTIVE LIFESTYLES',
                'hero_title' => 'Gourmet <span class="italic font-normal text-mg-orange font-heading">Roasted Makhana</span> Sourced from Bihar.',
                'hero_desc' => 'We air-roast hand-picked water lily seeds to absolute, crispy perfection and dust them in clean, nutrient-dense, plant-based culinary seasonings.',
                'hero_btn_text' => 'Shop Flavours',
                
                'why_badge' => 'THE CRISPY CHAMP',
                'why_title' => 'Better than Popcorn.<br>Healthier than Chips.',
                'why_desc' => 'MunchGud is slow air-roasted (never fried!) to give you that light, airy, deeply satisfying crunch without the heavy calories or trans fats.',
                'why_stat_1_num' => '89',
                'why_stat_1_label' => 'Calories / Cup',
                'why_stat_2_num' => '0%',
                'why_stat_2_label' => 'Trans Fats',
                
                'ingredients_badge' => '100% CLEAN LABEL',
                'ingredients_title' => 'Everything you want.<br><span class="italic text-mg-orange font-heading">Nothing you don\'t.</span>',
                'ingredients_desc' => 'We are obsessed with transparency. We source premium fox nuts directly from Mithila farmers and use cold-pressed spice oils and pure mineral salts.',
                
                'bestseller_badge' => 'FAN FAVORITE',
                'bestseller_title' => 'Our Legendary<br><span class="italic text-mg-orange font-heading">Peri Peri Makhana.</span>',
                'bestseller_desc' => 'Made for people who love bold, unapologetic spice. We blend African bird\'s eye chilies with organic garlic, onion, and sea salt.',
                
                'banner_title' => 'Gourmet Crunch. Smarter Fuel.',
                'banner_desc' => 'Ready to experience snack time without the crash? Grab our multi-flavour combo pack and get free shipping across India.',
                'banner_btn_text' => 'Order Combo Pack',
                
                'review_badge' => 'HAPPY CRUNCHERS',
                'review_title' => 'What the MunchGud community says.',
                'review_desc' => 'Over 10,000+ snack lovers have upgraded their desk side drawer with our air-roasted pops.',
                
                'recipes_badge' => 'BEYOND SNACKING',
                'recipes_title' => 'Crafted with <span class="italic text-mg-green font-heading">MunchGud.</span>',
                'recipes_desc' => 'Makhana is a culinary canvas. Elevate your dishes with high-protein, air-roasted popped lotus seeds.',
                
                'insta_badge' => 'JOIN THE COMMUNITY',
                'insta_title' => 'Show us your crunch.',
                'insta_desc' => 'Follow @munchgud on Instagram and share your snacking moments using #MunchGud to get featured and win monthly snack vouchers!',
                'instagram_handle' => '@munchgud',
                'instagram_url' => 'https://instagram.com/munchgud',
            ];
            foreach ($homeBlocks as $key => $val) {
                if (!isset($sections[$key])) {
                    $sections[$key] = $val;
                }
            }
            $pageHome->sections = $sections;
            $pageHome->save();
        }

        // 9. Seed Blog Posts Table (Base Posts)
        echo "9. Seeding blog articles table...\n";
        if (Blog::count() == 0) {
            $blogs = [
                [
                    'title' => 'Why Makhana is the Ultimate Superfood for Your Daily Diet',
                    'content' => '<p>In recent years, Makhana (fox nuts) has emerged as a powerhouse of nutrition and an incredibly popular healthy snacking alternative...</p><h3>1. Packed with Protein and Fiber</h3><p>Makhana is naturally rich in plant-based protein and high in dietary fiber...</p>',
                    'author_name' => 'Dr. Aditi Sharma',
                    'meta_title' => 'Why Makhana is the Ultimate Superfood | MunchGud',
                    'meta_description' => 'Discover the amazing health benefits of Makhana (Fox Nuts). Learn why this protein-rich, low-calorie snack is the ultimate superfood.',
                ],
                [
                    'title' => '5 Guilt-Free Midnight Snacks You Can Enjoy While Binge-Watching',
                    'content' => '<p>We\'ve all been there: It\'s midnight, you\'re three episodes deep... Before you reach for that bag of greasy chips, consider these 5 guilt-free alternatives!</p><ol><li><strong>Roasted Makhana:</strong> Our absolute favorite!...</li></ol>',
                    'author_name' => 'Rahul Verma',
                    'meta_title' => '5 Guilt-Free Midnight Snacks | MunchGud',
                    'meta_description' => 'Craving a midnight snack? Here are 5 healthy, guilt-free snacks including roasted makhana to enjoy during your next binge-watching session.',
                ],
                [
                    'title' => 'From Ponds to Packets: The Fascinating Journey of Fox Nuts',
                    'content' => '<p>Have you ever wondered where that delicious, crunchy ball of goodness comes from?...</p><h3>The Harvesting Process</h3><p>The journey of makhana is highly labor-intensive...</p>',
                    'author_name' => 'MunchGud Team',
                    'meta_title' => 'The Journey of Fox Nuts: From Ponds to Packets | MunchGud',
                    'meta_description' => 'Learn the fascinating journey of Makhana (Fox Nuts) from the wetlands of Bihar to becoming your favorite healthy roasted snack.',
                ]
            ];
            foreach ($blogs as $data) {
                $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
                $data['is_active'] = true;
                Blog::create($data);
            }
        }

        // 10. Seed FAQs Table
        echo "10. Seeding FAQs support table...\n";
        if (Faq::count() == 0) {
            $faqs = [
                [
                    'question' => 'Are MunchGud makhanas suitable for weight loss?', 
                    'answer' => 'Absolutely! Air-roasted with zero oil, only 89 calories per 30g, high in fiber and protein — the perfect weight-loss snack.', 
                    'category' => 'product'
                ], 
                [
                    'question' => 'What is the shelf life?', 
                    'answer' => '6 months from manufacturing. Best consumed within 15 days of opening for optimal crunch.', 
                    'category' => 'product'
                ], 
                [
                    'question' => 'Do you ship pan-India?', 
                    'answer' => 'Yes! Free shipping on orders above 499. Standard delivery 3-5 business days across India.', 
                    'category' => 'shipping'
                ]
            ];
            foreach ($faqs as $i => $faq) { 
                $faq['sort_order'] = $i; 
                Faq::create($faq); 
            }
        }

        echo "\n🎉 SUCCESS: All initial page schemas, gourmet recipes, sections, and metadata have been seeded successfully!\n";
    }
}
