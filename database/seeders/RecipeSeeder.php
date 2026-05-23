<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipes = [
            [
                'title' => 'Gourmet Roasted Makhana Chaat',
                'slug' => 'gourmet-roasted-makhana-chaat',
                'category' => 'Snacks',
                'time' => '15 mins',
                'difficulty' => 'Easy',
                'image' => 'images/recipes/makhana_chaat.png',
                'description' => 'A tangy, sweet, and crunchy Indian street-style chaat prepared with roasted fox nuts, tossed with fresh chopped onions, tomatoes, coriander leaves, and topped with vibrant green and tamarind chutneys.',
                'featured' => true,
                'ingredients' => json_encode([
                    '2 cups MunchGud Roasted Makhana',
                    '1 small onion, finely chopped',
                    '1 medium tomato, seeds removed & chopped',
                    '2 tbsp fresh coriander leaves, chopped',
                    '1 tbsp sweet tamarind chutney',
                    '1 tbsp spicy green chutney',
                    '1/2 tsp chaat masala',
                    '1/4 tsp red chili powder',
                    '1 tsp lemon juice',
                    'Fine sev for garnishing'
                ]),
                'steps' => json_encode([
                    'Take a large mixing bowl and add the MunchGud Roasted Makhana to keep them crunchy.',
                    'Add finely chopped onions, tomatoes, and fresh coriander leaves.',
                    'Drizzle sweet tamarind chutney and spicy green chutney over the mixture.',
                    'Sprinkle chaat masala, red chili powder, and freshly squeezed lemon juice.',
                    'Gently toss all ingredients together so the spices and chutneys coat the makhana evenly.',
                    'Garnish with fine crispy sev and serve immediately to maintain the light, crunchy texture.'
                ]),
                'author_name' => 'MunchGud Chef',
                'author_email' => 'chef@munchgud.com',
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Creamy Rose Makhana Kheer',
                'slug' => 'creamy-rose-makhana-kheer',
                'category' => 'Desserts',
                'time' => '30 mins',
                'difficulty' => 'Medium',
                'image' => 'images/recipes/makhana_kheer.png',
                'description' => 'A premium, rich, and creamy Indian dessert made by slow-cooking popped fox nuts in sweetened condensed milk, infused with real rose water and loaded with roasted slivered almonds and pistachios.',
                'featured' => false,
                'ingredients' => json_encode([
                    '1.5 cups MunchGud Makhana (slightly crushed)',
                    '1 liter full cream milk',
                    '1/4 cup sugar (or condensed milk to taste)',
                    '1/2 tsp green cardamom powder',
                    '1 tbsp rose water',
                    '10-12 saffron strands (soaked in warm milk)',
                    '2 tbsp mixed nuts (almonds, pistachios, cashews), slivered',
                    '1 tsp ghee'
                ]),
                'steps' => json_encode([
                    'Heat ghee in a pan and lightly roast the slivered nuts until golden, then set them aside.',
                    'In the same pan, roast the popped makhana for 2 minutes until crisp, and crush them slightly using your hands.',
                    'Bring milk to a boil in a heavy-bottomed pan, then reduce heat and let it simmer for 10 minutes until it thickens.',
                    'Add the crushed makhana to the boiling milk and slow-cook for 10-12 minutes until the makhana turns soft and absorbs the milk.',
                    'Stir in sugar, saffron milk, and green cardamom powder, cooking for another 5 minutes.',
                    'Turn off the heat, mix in the rose water, and let it cool.',
                    'Garnish with the roasted nuts and serve chilled or warm.'
                ]),
                'author_name' => 'Aditi Sharma',
                'author_email' => 'aditi@example.com',
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Crispy Peri Peri Makhana Bowl',
                'slug' => 'crispy-peri-peri-makhana-bowl',
                'category' => 'Snacks',
                'time' => '10 mins',
                'difficulty' => 'Easy',
                'image' => 'images/recipes/peri_peri_makhana.png',
                'description' => 'A fiery, spicy, and perfectly crunchy snack bowl. Slow-roasted makhana coated in a punchy garlic and chili peri peri seasoning, perfect for quick evening snack cravings.',
                'featured' => false,
                'ingredients' => json_encode([
                    '2 cups fresh popped fox nuts',
                    '1.5 tbsp olive oil or butter',
                    '1 tbsp gourmet peri peri spice powder',
                    '1/2 tsp garlic powder',
                    '1/4 tsp salt'
                ]),
                'steps' => json_encode([
                    'Heat olive oil or butter in a wide pan on low heat.',
                    'Add the raw popped makhana and slow-roast them for 5-7 minutes until they are completely crispy.',
                    'Turn off the flame so the dry spices do not burn in the pan.',
                    'Immediately sprinkle peri peri spice powder, garlic powder, and salt over the warm makhana.',
                    'Toss well for 1 minute until the spices stick evenly to the roasted fox nuts.',
                    'Let it cool completely and store in an airtight container or serve instantly in a snack bowl.'
                ]),
                'author_name' => 'Kabir Sen',
                'author_email' => 'kabir@example.com',
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($recipes as $recipe) {
            DB::table('recipes')->updateOrInsert(
                ['slug' => $recipe['slug']],
                $recipe
            );
        }
    }
}
