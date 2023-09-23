<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use ResponseTrait;

    /**
     *  Get all Products.
     */
    public function index()
    {
        try {
            $products = Product::get();
            if (!$products->isEmpty()){
                return $this->successResponse($products, 'Products retrieved successfully.');
            }else{
                return $this->errorResponse(null, 'Products retrieved successfully.');
            }
        } catch (\Exception $e) {
            return $this->serveErrorResponse();
        }
    }

//-----------------------------------------------------------------------------
    /**
     *  Get a Product using $id param.
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProduct($id)
    {
        try {
            $product = Product::find($id);
            if($product){
                return $this->successResponse($product, 'Products retrieved successfully.');
            }else{
                return $this->errorResponse(null, 'There is no product following your Request.');
            }
        } catch (\Exception $e) {
            return $this->serveErrorResponse();
        }
    }


//-----------------------------------------------------------------------------
    /**
     *  Create a new Product.
     */
    public function create(Request $request)
    {
        try{
            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required|string',
                'karat' => 'required|integer',
                'category' => 'required|exists:categories,id',
                'closed_image' => 'required|image',
                'far_image' => 'required|image',
                'price' => 'required|numeric',
            ]);

            // Store the uploaded images
            $productFolder =  Product::get()->count()+1;
            $closedImage = $this->upload($request, 'closed_image', 'image', $productFolder);
            $farImage = $this->upload($request, 'far_image', 'image', $productFolder);

            // Create a new product using the validated data
            $product = Product::create([
                'name' => $validatedData['name'],
                'karat' => $validatedData['karat'],
                'category' => $validatedData['category'],
                'closed_image' => 'images/'. $closedImage,
                'far_image' => 'images/' . $farImage,
                'price' => $validatedData['price'],
            ]);

            // Return a success response with the created product
            return $this->modifyResponse($product, 'Product created successfully');

        } catch (\Exception $e) {
            return $this->serveErrorResponse();
        }
    }


//-----------------------------------------------------------------------------
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     *  Get all Products that belong to one Category.
     */
    public function show($id)
    {
        try {
            $category = Category::find($id);
            if($category){
                $items = $category->items;

                if ($items->isEmpty()) {
                    return $this->invalidResponse([], 'No products found for this category.');

                } else {
                    return $this->successResponse($items, 'Products retrieved successfully.');
                }
            }else{
                return $this->errorResponse(null, 'The category is not Found.');
            }

        } catch (\Exception $e) {
            return $this->serveErrorResponse();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     *  Update specified Product using $request->id.
     */
    public function update(Request $request)
    {
        try {
            // Find the product by ID
            $product = Product::find($request->id);

            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required|string',
                'karat' => 'required|integer',
                'category' => 'required|exists:categories,id',
                'closed_image' => 'required|image',
                'far_image' => 'required|image',
                'price' => 'required|numeric',
            ]);

            // Store the uploaded images
            $productFolder =  $request->id;
            $closedImage = $this->upload($request, 'closed_image', 'image', $productFolder);
            $farImage = $this->upload($request, 'far_image', 'image', $productFolder);

            // Update the product using the validated data
            $product->update([
                'name' => $validatedData['name'],
                'karat' => $validatedData['karat'],
                'category' => $validatedData['category'],
                'closed_image' => 'images/'. $closedImage,
                'far_image' => 'images/' . $farImage,
                'price' => $validatedData['price'],
            ]);

            // Return a success response with the updated product
            return $this->modifyResponse($product, 'Product updated successfully.');

        } catch (\Exception $e) {
            // Handle any errors
            return $this->serveErrorResponse();
//            return $e->getMessage();
        }
    }

    /**
     *  Remove a Product using $request->input('product_id') from DB.
     */
    public function destroy($id)
    {
        try {
            // Get the product ID from the request
            $productId = $id;

            // Find the product by ID
            if (!$product = Product::find($productId)){
                return  $this->errorResponse();
            }

            // Delete the product
            $product->delete();

            // Delete the associated images from storage
            Storage::delete([$product->closed_image, $product->far_image]);

            // Return a success response
            return $this->modifyResponse(null, 'Product deleted successfully.');

        } catch (\Exception $e) {
            // Handle any errors
            return $this->serveErrorResponse();
//            return $e->getMessage();
        }
    }

    /**
     *  Get the Category of a product
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public  function getCategory($id)
    {
        try {
            $product = Product::find($id);
            if($product){
                return $this->successResponse($product->category, 'Products retrieved successfully.');
            }else{
                return $this->errorResponse(null, 'There is no product following your Request.');
            }
        } catch (\Exception $e) {
            return $this->serveErrorResponse();
        }
    }


    public function upload($request, $inputFileName, $optionFileSystem, $storeIn = null): mixed
    {
        $file = $request->file($inputFileName)->getClientOriginalName();
        $path = $request->file($inputFileName)->storeAs($storeIn ,$file, $optionFileSystem);
        return $path;
    }
}
