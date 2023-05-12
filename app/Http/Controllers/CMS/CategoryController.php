<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $title = 'Danh mục sản phẩm';
        $category = Categories::query()->orderBy('thutu','asc')->paginate(10);
        return view('CMS.category.index',compact('title','category'));
    }

    public function create()
    {
        $title = 'Thêm danh mục sản phẩm';
        return view('CMS.category.create',compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten' => 'required|max:255|regex:/[A-Za-z]/',
            'thutu' => 'required|unique:categories,thutu|regex:/[0-9]/',
        ], [
            'ten.required' => 'Bạn cần nhập tên',
            'ten.max' => 'Tên không được quá 255 ký tự',
            'ten.regex' => 'Tên bạn nhập phải là chữ cái',
            'thutu.required' => 'Bạn cần nhập số thứ tự',
            'thutu.regex' => 'Thứ tự bạn nhập phải là chữ số',
            'thutu.unique'=>'Đã có thứ tự',
        ]);
        $data = $request->all();
        try {
            Categories::query()->create($data);
            return response()->json([
                'success' => false,
                'message' => 'Thêm danh mục sản phẩm thành công'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }

    }

    public function edit(Categories $categories,Request $request)
    {
        $category = $categories::query()->findOrFail($request->category_id);
        return view('CMS.category.modal-edit',compact('category'))->render();
    }

    public function update(Request $request, Categories $categories)
    {
        $request->validate([
            'ten' => 'required|max:255|regex:/[A-Za-z]/',
            'thutu' => 'required|regex:/[0-9]/',
        ], [
            'ten.required' => 'Bạn cần nhập tên',
            'ten.max' => 'Tên không được quá 255 ký tự',
            'ten.regex' => 'Tên bạn nhập phải là chữ cái',
            'thutu.required' => 'Bạn cần nhập số thứ tự',
            'thutu.regex' => 'Thứ tự bạn nhập phải là chữ số',
        ]);
        $data = $request->except(['id']);
        $id = $request->id;
        try {
            $categories::query()->findOrFail($id)->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Sửa danh mục thành công'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy(Categories $categories,Request $request)
    {
        $id = $request->category_id;
        try {
            $categories::query()->findOrFail($id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Xóa danh mục thành công'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
