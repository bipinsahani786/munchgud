<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Str;

class RecipeController extends Controller
{
    private $defaultRecipes = [
        [
            'slug' => 'creamy-makhana-curry',
            'title' => 'Creamy Makhana Curry',
            'category' => 'Dinner',
            'time' => '30 Mins',
            'difficulty' => 'Medium',
            'image' => 'https://images.unsplash.com/photo-1585937421612-70a008356fbe?q=80&w=1000&auto=format&fit=crop',
            'description' => 'A rich, luscious cashew and tomato gravy infused with roasted makhana. A significantly healthier, lighter alternative to paneer butter masala that doesn\'t compromise on the royal taste.',
            'featured' => true,
            'ingredients' => [
                '2 cups MunchGud Plain Roasted Makhana',
                '1 cup tomato puree',
                '1/2 cup cashew paste',
                '1/4 cup heavy cream or coconut milk',
                '1 tsp ginger-garlic paste',
                '1 tsp garam masala',
                '1/2 tsp turmeric powder',
                'Salt to taste',
                'Fresh coriander for garnish'
            ],
            'steps' => [
                'Dry roast the makhana for 2-3 minutes until completely crisp. Set aside.',
                'In a pan, heat some oil or ghee. Add ginger-garlic paste and sauté for a minute.',
                'Add tomato puree, turmeric, salt, and garam masala. Cook until oil separates from the masala.',
                'Stir in the cashew paste and cook for another 5 minutes on low heat.',
                'Add cream or coconut milk and a little water to adjust consistency. Bring to a gentle simmer.',
                'Just before serving, fold in the roasted makhana and garnish with fresh coriander.'
            ]
        ],
        [
            'slug' => 'saffron-makhana-kheer',
            'title' => 'Saffron Makhana Kheer',
            'category' => 'Dessert',
            'time' => '45 Mins',
            'difficulty' => 'Easy',
            'image' => 'https://images.unsplash.com/photo-1551024601-bec78aea704b?q=80&w=800&auto=format&fit=crop',
            'description' => 'A traditional Indian pudding made lighter. Slow-cooked milk, cardamom, premium saffron, and crushed roasted makhana instead of heavy rice.',
            'featured' => false,
            'ingredients' => [
                '2 cups MunchGud Plain Roasted Makhana',
                '4 cups full-fat milk or almond milk',
                '1/4 cup sugar or jaggery powder',
                'A pinch of saffron strands',
                '1/2 tsp cardamom powder',
                '2 tbsp chopped mixed nuts (almonds, pistachios)'
            ],
            'steps' => [
                'Coarsely crush half of the makhana and leave the rest whole.',
                'Bring milk to a boil in a heavy-bottomed pan.',
                'Add the crushed and whole makhana to the boiling milk.',
                'Reduce heat and let it simmer for 30 minutes, stirring occasionally until the milk thickens.',
                'Add sugar, saffron, and cardamom powder. Simmer for another 5 minutes.',
                'Garnish with chopped nuts and serve warm or chilled.'
            ]
        ],
        [
            'slug' => 'crunchy-makhana-bhel',
            'title' => 'Crunchy Makhana Bhel',
            'category' => 'Appetizer',
            'time' => '10 Mins',
            'difficulty' => 'Easy',
            'image' => 'https://images.unsplash.com/photo-1541529086526-db283c563270?q=80&w=800&auto=format&fit=crop',
            'description' => 'A tangy, spicy street-style chaat using our Himalayan Pink Salt makhana mixed with freshly chopped onions, tomatoes, and zesty chutneys.',
            'featured' => false,
            'ingredients' => [
                '2 cups MunchGud Himalayan Pink Salt Makhana',
                '1/2 cup finely chopped onions',
                '1/2 cup finely chopped tomatoes',
                '1/4 cup boiled potatoes, cubed',
                '2 tbsp mint-coriander chutney',
                '1 tbsp sweet tamarind chutney',
                '1/2 tsp chaat masala',
                'Fresh coriander and sev for garnish'
            ],
            'steps' => [
                'In a large mixing bowl, combine the chopped onions, tomatoes, and potatoes.',
                'Add the mint-coriander and sweet tamarind chutneys.',
                'Sprinkle chaat masala over the mixture and toss well.',
                'Just before serving, gently fold in the roasted makhana to maintain their crunch.',
                'Garnish with fresh coriander and a generous sprinkle of sev.'
            ]
        ],
        [
            'slug' => 'protein-smoothie-bowl',
            'title' => 'Protein Smoothie Bowl Topper',
            'category' => 'Breakfast',
            'time' => '5 Mins',
            'difficulty' => 'Easy',
            'image' => 'https://images.unsplash.com/photo-1505253716362-afaea1d3d1af?q=80&w=800&auto=format&fit=crop',
            'description' => 'Ditch the sugary granola. Use our Plain Roasted Makhana as a zero-sugar, high-protein crunchy topping for your morning acai or smoothie bowls.',
            'featured' => false,
            'ingredients' => [
                '1 frozen banana',
                '1 cup frozen mixed berries',
                '1/2 cup greek yogurt or almond milk',
                '1 scoop protein powder (optional)',
                '1/2 cup MunchGud Plain Roasted Makhana',
                '1 tbsp chia seeds',
                'Fresh fruit slices for topping'
            ],
            'steps' => [
                'Blend the frozen banana, berries, yogurt/milk, and protein powder until smooth and thick.',
                'Pour the smoothie mixture into a bowl.',
                'Arrange the MunchGud Makhana on top for a massive crunch factor.',
                'Sprinkle with chia seeds and fresh fruit slices.',
                'Enjoy immediately!'
            ]
        ]
    ];

    private function seedIfEmpty()
    {
        if (Recipe::count() === 0) {
            foreach ($this->defaultRecipes as $recipe) {
                $recipe['status'] = 'approved';
                Recipe::create($recipe);
            }
        }
    }

    public function index()
    {
        $this->seedIfEmpty();

        $recipes = Recipe::where('status', 'approved')->get();
        $featuredRecipe = $recipes->where('featured', true)->first();
        $otherRecipes = $recipes->where('featured', false);

        return view('storefront.recipes', compact('featuredRecipe', 'otherRecipes'));
    }

    public function show($slug)
    {
        $recipe = Recipe::where('slug', $slug)->where('status', 'approved')->firstOrFail();
        $otherRecipes = Recipe::where('status', 'approved')->where('id', '!=', $recipe->id)->take(3)->get();

        return view('storefront.recipes.show', compact('recipe', 'otherRecipes'));
    }

    public function create()
    {
        return view('storefront.recipes.submit');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email|max:255',
            'title' => 'required|string|max:255',
            'time' => 'required|string|max:50',
            'difficulty' => 'required|string|in:Easy,Medium,Hard',
            'category' => 'required|string|max:50',
            'ingredients' => 'required|string',
            'steps' => 'required|string',
        ]);

        // Convert newline separated string into array
        $ingredients = array_filter(array_map('trim', explode("\n", $request->ingredients)));
        $steps = array_filter(array_map('trim', explode("\n", $request->steps)));

        $slug = Str::slug($request->title) . '-' . time();

        Recipe::create([
            'title' => $request->title,
            'slug' => $slug,
            'category' => $request->category,
            'time' => $request->time,
            'difficulty' => $request->difficulty,
            'ingredients' => $ingredients,
            'steps' => $steps,
            'author_name' => $request->author_name,
            'author_email' => $request->author_email,
            'status' => 'pending',
            'featured' => false,
        ]);

        return redirect()->back()->with('success', 'Thank you! Your recipe has been submitted and is under review.');
    }
}
