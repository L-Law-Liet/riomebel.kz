<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Category, Color, Product, Size, SubCategory};

class ProductController extends Controller
{
    public function product($id)
    {
        $product = Product::where('slug', $id)->firstOrFail();
        $product->images = json_decode($product->images);
        $description = $product->description;
        $title = $product->name;
        $ancestors = [];
        $category = $product->subcategory->category;
        $route_back = route('category', $category->slug);
        $ancestors[] = (object)
        ['name' => $category->name, 'link' => $route_back.'?page=1'];
        $route_back .= '/'.$product->subcategory->slug;
        $ancestors[] = (object)
        ['name' => $product->subcategory->name, 'link' => $route_back.'?page=1'];
        return view('product', compact('product', 'description', 'title', 'ancestors'));
    }

    public function category($category_slug, $subcategory_slug = null)
    {
        $products = Product::whereIn('city_id', [session('city_id', \App\Contact::first()->id), null]);
        $category_id = Category::where('slug', $category_slug)->first()->id;
        $page = 1;
        $ancestors = [];
        if ($subcategory_slug){
            $subcategory_id = SubCategory::where('slug', $subcategory_slug)->firstOrFail()->id;
            $ancestors[] = (object)
            [
                'name' => Category::findOrFail($category_id)->name,
                'link' => route('category', $category_slug)
            ];
            $title = SubCategory::where('slug', $subcategory_slug)->firstOrFail()->name;
            $seo_title = "Купить $title в Алматы и Казахстане по лучшей цене с гарантией и доставкой | Интернет-магазин RioMebel.kz";
            $data['products'] = $products->where('subcategory_id', $subcategory_id)->paginate(12);
            return view('category', compact('category_id', 'subcategory_id', 'page', 'title', 'ancestors', 'seo_title'), $data);
        }
        else {
            $title = Category::where('slug', $category_slug)->firstOrFail()->name;
            $seo_title = "【 $title 】100% наличие товара :airplane: Доставка по Алматы и Усть-Каменогорску ➤  Гарантия качества. Интернет-магазин «RioMebel.kz» №1 в Алматы ✓ Звоните :phone:: +7 (771) 410-12-26";
            $data['products'] = $products->whereIn('subcategory_id', Category::where('slug', $category_slug)->firstOrFail()->subcategory->pluck('id'))->paginate(12);
            return view('category', compact('category_id', 'page', 'title', 'ancestors', 'seo_title'), $data);
        }

    }

    public function search(Request $request)
    {
        $products = Product::whereIn('city_id', [session('city_id', \App\Contact::first()->id), null]);
        $q = $request->search;
        $products = $products->where('name', 'like', "%$q%")->paginate(12);
        $title = 'Поиск';
    	return view('search', compact('products', 'q', 'title'));
    }

     public function modal(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

         return [
            'product'  => view('partials.modal_content', compact('product'))->render(),
        ];
    }
}
