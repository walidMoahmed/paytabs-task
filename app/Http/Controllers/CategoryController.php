<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\GeneralTrait;

class CategoryController extends Controller
{
    use GeneralTrait;
    /**
     * Get All Data from this method.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $main_categories = Category::where('parent_id',null)->get(["category_name", "id"]);
        return view('welcome', compact('main_categories'));
    }

    /**
     * Retrieve Item / Items by ID
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetch_sub_category()
    {
        if (request()->ajax()) {

            $data = Category::where('parent_id', request('category_id'))->get(["category_name", "id"]);

            return $this->returnDate('main_categories',$data,'Sub Categories Data');
            
        }
        $this->returnError('You Must Get This Data From Ajax Only',404);
    }
}
