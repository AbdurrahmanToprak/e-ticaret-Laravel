<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function products(Request $request , $slug=null)
    {

        $category = request()->segment(1) ?? null;
        $sizes = !empty($request->size) ? explode(',',$request->size ) : null;

        $colors = !empty($request->color) ? explode(',',$request->color ) : null;

        $startprice = $request->min ?? null;

        $endprice = $request->max ?? null;

        $order = $request->order ?? 'id';
        $sort = $request->sort ?? 'desc';

        $anakategori =null;
        $altkategori = null;

        if(!empty($category) && empty($slug)){
            $anakategori = Category::where('slug',$category)->first();

        }else if(!empty($category) && !empty($slug)){
            $anakategori = Category::where('slug' , $category)->first();
            $altkategori = Category::where('slug' , $slug)->first();
        }

        $breadcrumb =[
            'sayfalar' => [

            ],
            'active' => 'Ürünler'
        ];

        if(!empty($anakategori) && empty($altkategori)){
            $breadcrumb ['active'] = $anakategori->name;

        }
        if(!empty($altkategori)){
            $breadcrumb ['sayfalar'][] = [
                'link' => route($anakategori->slug.'urunler'),
                'name' => $anakategori->name,
            ];
            $breadcrumb ['active'] = $altkategori->name;
        }

        $products = Product::where('status' , '1')
            ->where(function ($q) use($sizes,$colors,$startprice,$endprice){
                if(!empty($sizes)){
                    $q->whereIn('size' , $sizes);
                }
                if(!empty($colors)){
                    $q->whereIn('color' , $colors);
                }
                if(!empty($startprice) && $endprice){
                    //$q->whereBetween('price' , [$startprice,$endprice]);
                    $q->where('price' ,'>=', $startprice);
                    $q->where('price' ,'<=', $endprice);
                }
                return $q;
            })
            ->with('category:id,name,slug')
            ->whereHas('category', function ($q) use ($category,$slug){
                if(!empty($slug)){
                    $q->where('slug' , $slug);
                }
                return $q;
            }) ->orderBy($order,$sort)->paginate(21);

            if($request->ajax()){
                $view = view('frontend.ajax.productList' , compact('products'))->render();
                return response(['data' => $view , 'paginate' => (string) $products->withQueryString()->links('vendor.pagination.custom')]);
            }
            $maxprice = Product::max('price');

            $sizelists = Product::where('status' , '1')->groupBy('size')->pluck('size')->toArray();
            $colors = Product::where('status' , '1')->groupBy('color')->pluck('color')->toArray();


        return view("frontend.pages.products" , compact('breadcrumb','products','maxprice','sizelists', 'colors'));
    }
    public function productsOnSale()
    {
        $breadcrumb =[
            'sayfalar' => [

            ],
            'active' => 'İndirimli  Ürünler'
        ];
        return view("frontend.pages.products",compact('breadcrumb'));
    }

    public function about()
    {

        $about = About::where('id', 1)->first();

        $breadcrumb =[
            'sayfalar' => [

            ],
            'active' => 'Hakkımızda'
        ];
        return view("frontend.pages.about" , compact('breadcrumb','about'));
    }
    public function contact()
    {

        $breadcrumb =[
            'sayfalar' => [

            ],
            'active' => 'İletişim'
        ];
        return view("frontend.pages.contact" ,compact('breadcrumb'));
    }
    public function productDetail($slug)
    {
        $product = Product::where('slug' , $slug)->where('status' , '1')->firstOrFail();

        $products = Product::where('id' , '!=', $product->id)
            ->where('category_id' , $product->category_id)
            ->where('status' , '1')
            ->limit(6)
            ->orderBy('id','desc')
            ->get();

        $category = Category::where('id', $product->category_id)->first();



        $breadcrumb =[
            'sayfalar' => [

            ],
            'active' => $product->name
        ];

        if(!empty($category)){
            $breadcrumb ['sayfalar'][] = [
                'link' => route($category->slug.'urunler'),
                'name' => $category->name,
            ];
        }
        return view("frontend.pages.product" , compact('breadcrumb','product','products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
