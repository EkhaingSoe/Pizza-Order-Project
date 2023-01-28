<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct admin home page
    // public function index(){
    //     return view('admin.home');
    // }



    //direct admin category page
    public function category(){
        $data = Category::select('categories.*',DB::raw('count(pizzas.category_id) as count'))
                        ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
                        ->groupBy('categories.category_id')
                        ->paginate();


        return view('admin.category.list')->with(['category'=>$data]);
    }

    //direct add category page
    public function addCategory(){
        return view('admin.category.addCategory');
    }

    //creating category
    public function createCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data=[
            'category_name'=>$request->name
        ];

        Category::create($data);
        return redirect()->route('admin#category')->with(['categorySuccess'=>"Category added..."]);
    }

    //delete category
    public function deleteCategory($id){
        Category::where('category_id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Category deleted...']);
    }

    public function editCategory($id){
        $data=Category::where('category_id',$id)->first();
       // dd($data->toArray());
        return view('admin.category.editCategory')->with(['category'=>$data]);
    }

    public function updateCategory(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $updateData=[
            'category_name'=>$request->name
        ];

        Category::where('category_id',$request->id)->update($updateData);
        return redirect()->route('admin#category')->with(['updateSuccess'=>'Category Updated...']);


    }

    public function searchCategory(Request $request){
        $data=Category::where('category_name','like','%'.$request->searchData.'%')->paginate(5);
        $data -> appends($request->all());
        return view('admin.category.list')->with(['category'=>$data]);
    }

}
