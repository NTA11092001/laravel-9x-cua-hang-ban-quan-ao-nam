<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Suppliers;

class SupplierController extends Controller
{
    //
    public function index(){
        $title = 'Danh sách nhà cung cấp';
        $suppliers = Suppliers::query()->paginate(10);
        return view('CMS.supplier.index',compact('title','suppliers'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255|regex:/[A-Za-z]/',
            'contact_person' => 'required|max:255|regex:/[A-Za-z]/',
            'contact_number' => 'min:10|required|regex:/^0[1-9][0-9]{8}$/|max:10|unique:suppliers,contact_number'
        ], [
            'name.required' => 'Bạn cần nhập tên',
            'name.max' => 'Tên không được quá 255 ký tự',
            'name.regex' => 'Tên bạn nhập phải là chữ cái',
            'contact_person.required' => 'Bạn cần nhập tên',
            'contact_person.max' => 'Tên không được quá 255 ký tự',
            'contact_person.regex' => 'Tên bạn nhập phải là chữ cái',
            'contact_number.required' => 'Bạn cần nhập số điện thoại',
            'contact_number.min' => 'Số điện thoại bạn nhập phải ít nhất 10 ký tự',
            'contact_number.max' => 'Số điện thoại bạn nhập được nhiều nhất 10 ký tự',
            'contact_number.regex' => 'Số điện thoại bạn nhập phải là 1 số điện thoại ở Việt Nam',
            'contact_number.unique'=>'Số điện thoại đã được sử dụng',
        ]);
        $data = $request->only(['name','contact_person','contact_number']);
        try {
            Suppliers::query()->create($data);
            return response()->json([
                'success' => true,
                'message' => 'Thêm nhà cung cấp thành công'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit(Request $request){
        $supplier = Suppliers::query()->findOrFail($request->supplier_id);
        return view('CMS.supplier.edit_modal',compact('supplier'))->render();
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required|max:255|regex:/[A-Za-z]/',
            'contact_person' => 'required|max:255|regex:/[A-Za-z]/',
            'contact_number' => 'min:10|required|regex:/^0[1-9][0-9]{8}$/|max:10|unique:suppliers,contact_number,'.$request->id
        ], [
            'name.required' => 'Bạn cần nhập tên',
            'name.max' => 'Tên không được quá 255 ký tự',
            'name.regex' => 'Tên bạn nhập phải là chữ cái',
            'contact_person.required' => 'Bạn cần nhập tên',
            'contact_person.max' => 'Tên không được quá 255 ký tự',
            'contact_person.regex' => 'Tên bạn nhập phải là chữ cái',
            'contact_number.required' => 'Bạn cần nhập số điện thoại',
            'contact_number.min' => 'Số điện thoại bạn nhập phải ít nhất 10 ký tự',
            'contact_number.max' => 'Số điện thoại bạn nhập được nhiều nhất 10 ký tự',
            'contact_number.regex' => 'Số điện thoại bạn nhập phải là 1 số điện thoại ở Việt Nam',
            'contact_number.unique'=>'Số điện thoại đã được sử dụng',
        ]);
        $data = $request->only(['name','contact_person','contact_number']);
        try {
            Suppliers::query()->findOrFail($request->id)->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật nhà cung cấp thành công'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete(Request $request){
        $id = $request->supplier_id;
        try {
            Suppliers::query()->findOrFail($id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Xóa nhà cung cấp thành công'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
