<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    
    function index(Request $request){

        $sortBy = $request->get('sort', 'name','price');
        $direction = $request->get('direction', 'asc'); 
        if (!in_array($sortBy, ['name', 'price'])) {
            $sortBy = ['name','price'];
        }
        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'asc';
        }
        
        $query = Product::query();
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('product_id', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%");
            });
        }

        $products = $query->orderBy($sortBy, $direction)->paginate(3);
        return view('products.index',compact('products', 'sortBy', 'direction'));
    }



    public function create(){
        return view('products.create');
    }

    function store(Request $request){
      $request->validate([
        'product_id' => 'required|string|unique:products,product_id',
        'name' => 'required|string',
        'description' => 'nullable',
        'price' => 'required|numeric|min:0',
        'stock' => 'nullable|integer|min:0',
        'image' => 'required|mimes:jpeg,png,jpg,gif|max:6048',
      ]);

        if($request->hasFile('image')){
            $filename=time().".".$request->image->extension();
            $request->image->move(public_path('images'),$filename);
        }
        $product_id = rand(100000, 999999);

        Product::create([
            "product_id"=>$product_id,
            "name"=>$request->name,
            "description"=>$request->description,
            "price"=>$request->price,
            "stock"=>$request->stock,
            "image"=>$filename,
            "product_id"=>$product_id,
            
        ]);
        
       flash()->success('Product Created Successfull');
        return redirect()->route('products.index');
        // return redirect()->route('products.index')->with('success','Product Created Successfull !');
    }

    public function show(Request $request,$id){
        $product=Product::find($id);
        return view('products.show',compact('product'));
    }



    public function edit(Request $request ,$id){
      $product=Product::find($id);
      return view('products.edit',compact('product'));
    }

    public function update(Request $request ,$id){

        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
          ]);

        $product = Product::find($id);

        $product_id =rand(100000, 999999);
        $filename = $product->image;
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $filename);
            if ($product->image && File::exists(public_path('images/' . $product->image))) {
                File::delete(public_path('images/' . $product->image));
            }
        }
        
        $product->product_id=$product_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->image = $filename; 
        
        $product->save();


        
        flash()->options([
            'timeout' => 3000,
        ])->success('Product Update Successfull !');
        return redirect()->route('products.index');
        // flash()->success('The operation completed successfully.');
        // return redirect()->route('products.index')->with('success','Product Update Successfull !');
       

    }
    

    public function delete(Request $request ,$id){
        $product=Product::find($id);
        
        if(File::exists(public_path('images').'/'.$product->image)){
            File::delete(public_path('images').'/'.$product->image);
        }
        $product->delete();

        flash()->success('Product Delete Successfull ');
        return redirect()->route('products.index');
        // return redirect()->route('products.index')->with('success','Product Delete Successfull !');

    }

}
