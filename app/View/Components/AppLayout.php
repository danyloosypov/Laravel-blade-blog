<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class AppLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public ?string $metaTitle = null, public ?string $metaDescription = null)
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {

        $categories = Category::query()
            ->join('category_post', 'categories.id', '=', 'category_post.category_id')
            ->select('categories.title', 'categories.slug', DB::raw('count(*) as total'))
            ->groupBy('categories.id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('layouts.app', compact('categories'));
    }
}
