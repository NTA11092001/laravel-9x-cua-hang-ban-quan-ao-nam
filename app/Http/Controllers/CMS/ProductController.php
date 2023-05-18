<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $title = 'Sản phẩm';
        $products = Product::query()->orderBy('id','desc')->paginate(10);
        return view('CMS.product.index',compact('title','products'));
    }

    public function create(){
        $title = 'Thêm sản phẩm';
        $categories = Categories::query()->get();
        return view('CMS.product.create',compact('title','categories'));
    }

    public function store(Request $request){
        $request->validate([
            'ten' => 'required|unique:products|max:191',
            'masp' => 'required|unique:products',
            'giathuong' => 'required',
            'giakm' => 'required',
            'id_danhmuc'=> 'required',
            'soluong'=> 'required|regex:/[0-9]/',
            'hinhanh' => 'required|mimes:jpeg,jpg,png',
        ], [
            'ten.required' => 'Bạn cần nhập tên sản phẩm',
            'ten.unique' => 'Tên sản phẩm bị trùng',
            'ten.max' => 'Tên sản phẩm quá dài',
            'masp.required' => 'Bạn cần nhập mã sản phẩm',
            'masp.unique' => 'Mã sản phẩm bị trùng',
            'giathuong.required' => 'Bạn cần nhập mã sản phẩm',
            'giakm.required' => 'Bạn cần chọn danh mục khách sạn',
            'id_danhmuc.required' => 'Bạn cần chọn danh mục sản phẩm',
            'soluong.required' => 'Bạn cần nhập số lượng',
            'soluong.regex' => 'Số lượng phải là chữ số',
            'hinhanh.required' => 'Bạn cần tải lên hình ảnh đại diện',
            'hinhanh.mimes' => 'Hình ảnh đại diện phải là hình ảnh',
        ]);
        $data = $request->except(['hinhanh','images']);
        // thêm 1 ảnh
        if ($request->hasfile('hinhanh')) {
            $file_hinhanh = $request->file('hinhanh');
            $name_hinhanh = time().'_'.$file_hinhanh->getClientOriginalName();
            $file_hinhanh->move(public_path('product/hinhanh/'), $name_hinhanh);
            $data['hinhanh'] = 'product/hinhanh/'.$name_hinhanh;
        }
        // thêm nhiều ảnh
        if ($request->hasfile('images')) {
            foreach($request->file('images') as $image){
                $name_image = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('product/images/'), $name_image);
                $imageArray[] = 'product/images/'.$name_image;
            }
            $data['images'] = implode(',',$imageArray);
        }
        //dd($data);
        try {

            Product::query()->create($data);
            return response()->json([
                'success' => true,
                'message' => 'Thêm sản phẩm thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit(Request $request){
        $product = Product::query()->findOrFail($request->product_id);
        $categories = Categories::query()->get();
        return view('CMS.product.modal-edit',compact('product','categories'))->render();
    }

    public function update(Request $request){
        $id = $request->id;
        $product = Product::query()->findOrFail($id);
        $request->validate([
            'ten' => 'required|max:191',
            'masp' => 'required',
            'giathuong' => 'required',
            'giakm' => 'required',
            'id_danhmuc'=> 'required',
            'soluong'=> 'required|regex:/[0-9]/'
        ], [
            'ten.required' => 'Bạn cần nhập tên sản phẩm',
            'ten.max' => 'Tên sản phẩm quá dài',
            'masp.required' => 'Bạn cần nhập mã sản phẩm',
            'giathuong.required' => 'Bạn cần nhập mã sản phẩm',
            'giakm.required' => 'Bạn cần chọn danh mục khách sạn',
            'id_danhmuc.required' => 'Bạn cần chọn danh mục sản phẩm',
            'soluong.required' => 'Bạn cần nhập số lượng',
            'soluong.regex' => 'Số lượng phải là chữ số'
        ]);
        $data = $request->except(['id','hinhanh','images']);

        //edit 1 ảnh
        if ($request->hasfile('hinhanh')) {
            //xóa ảnh cũ
             if($product->hinhanh != ''  || $product->hinhanh != null){
                 unlink($product->hinhanh);
             }
             //upload ảnh mới
            $file_hinhanh = $request->file('hinhanh');
            $name_hinhanh = time().'_'.$file_hinhanh->getClientOriginalName();
            $file_hinhanh->move(public_path('product/hinhanh/'), $name_hinhanh);
            $data['hinhanh'] = 'product/hinhanh/'.$name_hinhanh;
        }
        //edit nhiều ảnh
        if ($request->hasfile('images')) {
            // xóa ảnh cũ
             if($product->images != ''  || $product->images != null){
                 $images_old = explode(',',$product->images);
                 foreach($images_old as $item){
                     unlink($item);
                 }

             }
             //upload ảnh mới
            foreach($request->file('images') as $image){
                $name_image = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('product/images/'), $name_image);
                $imageArray[] = 'product/images/'.$name_image;
            }
            $data['images'] = implode(',',$imageArray);
        }
        //dd($data);
        try {

            $product->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Sửa sản phẩm thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy(Request $request){
        $id = $request->product_id;
        try {
            $product = Product::query()->findOrFail($id);
            if($product->hinhanh != ''  || $product->hinhanh != null){
                unlink($product->hinhanh);
            }
            if($product->images != ''  || $product->images != null){
                $images_old = explode(',',$product->images);
                foreach($images_old as $item){
                    unlink($item);
                }

            }
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'Xóa sản phẩm thành công'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function status(Request $request){
        try{
            $product = Product::query()->findOrFail($request->id);
            $product->status = $request->status;
            $product->save();

            return response()->json([
                'success' => true,
                'status' => $product->status,
                'message' => 'Đổi trạng thái sản phẩm thành công'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
