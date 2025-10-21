<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $perfumes = [
    [
        'id' => 1,
        'name' => 'Eternal Blossom',
        'price' => 120,
        'category' => 'Women',
        'image' => 'perfume.png'
    ],
    [
        'id' => 2,
        'name' => 'Midnight Oud',
        'price' => 150,
        'category' => 'Men',
        'image' => 'perfume1.png'
    ],
    [
        'id' => 3,
        'name' => 'Citrus Breeze',
        'price' => 95,
        'category' => 'Unisex',
        'image' => 'perfume2.png'
    ],
    [
        'id' => 4,
        'name' => 'Amber Essence',
        'price' => 140,
        'category' => 'Men',
        'image' => 'perfume3.png'
    ],
    [
        'id' => 5,
        'name' => 'Velvet Rose',
        'price' => 110,
        'category' => 'Women',
        'image' => 'perfume4.png'
    ],
    [
        'id' => 6,
        'name' => 'Aqua Noir',
        'price' => 130,
        'category' => 'Unisex',
        'image' => 'perfume5.png'
    ],
    [
        'id' => 7,
        'name' => 'Golden Sand',
        'price' => 125,
        'category' => 'Men',
        'image' => 'perfume6.png'
    ],
    [
        'id' => 8,
        'name' => 'Mystic Musk',
        'price' => 160,
        'category' => 'Unisex',
        'image' => 'perfume7.png'
    ],
  ];
    function index()
    {
        // return "index works";
        return view('product.index', ["perfumes" => $this->perfumes]);
    }

     function create()
    {
        // return "create works";
        return view('product.create');
    }

    function store(Request $request)
    {
        return view('product.new', ['data' => $request->all()]);
    }

     function show($id)
    {
        // return "show works";
       $product = collect($this->perfumes)->firstWhere('id', $id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        return view('product.show', ['perfume' => $product]);
    }
}
