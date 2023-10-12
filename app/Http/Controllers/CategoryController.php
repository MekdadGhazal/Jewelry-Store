<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class CategoryController extends Controller
{
    use ResponseTrait;

    public function index() {
        try {
            return $this->successResponse(Category::get());
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function create(Request $request) {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string'
                ]);

            $category = Category::create([
                'name' => $validatedData['name']
            ]);

            return $this->modifyResponse($category, 'category created successfully');

        }catch (\Exception $e){
            return $e->getMessage();
        }
    }


    public function update(Request $request, $id) {
        try {
            if($category = Category::find($id)) {
                $validatedData = $request->validate([
                    'name' => 'required|string'
                ]);
                $category->update([
                    'name' => $validatedData['name']
                ]);

                return $this->modifyResponse($category, 'category updated successfully');
            }
            return $this->errorResponse();
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }


    public function destroy($id) {
        try {
            if (!$category = Category::find($id)){
                return  $this->errorResponse();
            }

            $category->delete();

            return $this->modifyResponse(null, 'Categoey deleted successfully.');

        }catch (\Exception $e){
            return $e->getMessage();
        }
    }
}
