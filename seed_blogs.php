<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Blog;
use Illuminate\Support\Str;

echo "Seeding blogs...\n";

$blogs = [
    [
        'title' => 'Why Makhana is the Ultimate Superfood for Your Daily Diet',
        'content' => '
            <p>In recent years, Makhana (fox nuts) has emerged as a powerhouse of nutrition and an incredibly popular healthy snacking alternative. But what exactly makes it a "superfood"? Let\'s dive into the amazing health benefits of this traditional Indian snack.</p>
            
            <h3>1. Packed with Protein and Fiber</h3>
            <p>Makhana is naturally rich in plant-based protein and high in dietary fiber, which makes it an excellent snack for weight loss. It keeps you feeling full longer, preventing those mid-day sugar cravings.</p>
            
            <h3>2. Low in Calories and Fat</h3>
            <p>Unlike deep-fried potato chips, MunchGud roasted makhana contains significantly fewer calories and negligible amounts of saturated fat. This makes it perfect for guilt-free munching while watching a movie or working at your desk.</p>
            
            <h3>3. Antioxidant Powerhouse</h3>
            <p>Rich in antioxidants like kaempferol, makhana helps reduce inflammation and fight free radicals in the body, promoting healthy, glowing skin and an active immune system.</p>
            
            <blockquote>"Switching to makhana was the best snacking decision I made. It\'s crunchy, tasty, and doesn\'t leave me feeling bloated." - A happy MunchGud customer.</blockquote>
            
            <p>Ready to make the switch? Try our <strong>Classic Salted</strong> or <strong>Cheese & Herbs</strong> flavors today and experience the crunch of good health!</p>
        ',
        'author_name' => 'Dr. Aditi Sharma',
        'meta_title' => 'Why Makhana is the Ultimate Superfood | MunchGud',
        'meta_description' => 'Discover the amazing health benefits of Makhana (Fox Nuts). Learn why this protein-rich, low-calorie snack is the ultimate superfood for your diet.',
    ],
    [
        'title' => '5 Guilt-Free Midnight Snacks You Can Enjoy While Binge-Watching',
        'content' => '
            <p>We\'ve all been there: It\'s midnight, you\'re three episodes deep into a new Netflix series, and suddenly, the cravings hit. You want something crunchy, salty, and satisfying. Before you reach for that bag of greasy chips, consider these 5 guilt-free alternatives!</p>
            
            <ol>
                <li><strong>Roasted Makhana:</strong> Our absolute favorite! Tossed in delicious seasonings like Himalayan Pink Salt or Tangy Tomato, makhana provides the perfect crunch with a fraction of the calories of potato chips.</li>
                <li><strong>Air-Popped Popcorn:</strong> Keep it light and simple. Skip the heavy butter and sprinkle some nutritional yeast or peri-peri seasoning for an extra kick.</li>
                <li><strong>Roasted Chickpeas:</strong> Packed with protein and crunch, roasted chickpeas are incredibly satisfying and easy to prepare.</li>
                <li><strong>Apple Slices with Peanut Butter:</strong> The perfect balance of sweet, salty, and healthy fats to keep you satiated.</li>
                <li><strong>Greek Yogurt with Berries:</strong> For when you\'re craving something sweet and creamy.</li>
            </ol>
            
            <p>Midnight snacking doesn\'t have to derail your health goals. Keep a pack of MunchGud Makhana on your nightstand, and you\'ll always have a healthy, delicious option ready to go!</p>
        ',
        'author_name' => 'Rahul Verma',
        'meta_title' => '5 Guilt-Free Midnight Snacks | MunchGud',
        'meta_description' => 'Craving a midnight snack? Here are 5 healthy, guilt-free snacks including roasted makhana to enjoy during your next binge-watching session.',
    ],
    [
        'title' => 'From Ponds to Packets: The Fascinating Journey of Fox Nuts',
        'content' => '
            <p>Have you ever wondered where that delicious, crunchy ball of goodness comes from? Makhana, or Fox Nut, isn\'t actually a nut at all! It\'s the seed of the Euryale Ferox plant, a type of water lily that grows in the stagnant waters of wetlands and ponds, primarily in Bihar, India.</p>
            
            <h3>The Harvesting Process</h3>
            <p>The journey of makhana is highly labor-intensive and requires immense skill. Farmers dive into the muddy waters to collect the heavy seeds that have fallen from the lily pads to the pond bed. It\'s a physically demanding process that has been passed down through generations.</p>
            
            <h3>Cleaning and Roasting</h3>
            <p>Once harvested, the black, hard seeds are cleaned, sun-dried, and then carefully roasted over high heat. The roasting process is crucial—the hot seeds are quickly hit with a wooden mallet, causing the hard shell to burst open and reveal the white, fluffy puff we all know and love.</p>
            
            <h3>The MunchGud Promise</h3>
            <p>At MunchGud, we source our makhana directly from these skilled farmers, ensuring they get fair compensation for their hard work. We then carefully dry-roast the pops without deep frying them, and toss them in our signature, all-natural seasonings.</p>
            
            <p>Every time you open a packet of MunchGud, you\'re not just enjoying a snack; you\'re participating in a rich, traditional agricultural process. Enjoy the crunch!</p>
        ',
        'author_name' => 'MunchGud Team',
        'meta_title' => 'The Journey of Fox Nuts: From Ponds to Packets | MunchGud',
        'meta_description' => 'Learn the fascinating journey of Makhana (Fox Nuts) from the wetlands of Bihar to becoming your favorite healthy roasted snack at MunchGud.',
    ]
];

foreach($blogs as $data) {
    $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
    $data['is_active'] = true;
    Blog::create($data);
}

echo "Seeded " . count($blogs) . " blog posts successfully!\n";
