<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion; // Nhớ import Model bạn đã tạo ở bước trước

class PromotionController extends Controller
{
    // Hiển thị danh sách
    public function index()
    {
        $promotions = Promotion::orderBy('promotionid', 'desc')->paginate(10);
        return view('Admin.promotions.index', compact('promotions'));
    }

    // Thêm mã mới
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:tbl_promotion,code|max:50',
            'discount_percent' => 'required|numeric|min:1|max:100',
            'startdate' => 'required|date',
            'enddate' => 'required|date|after_or_equal:startdate',
            'quantity' => 'required|integer|min:1',
        ], [
            'code.unique' => 'Mã giảm giá này đã tồn tại!',
            'enddate.after_or_equal' => 'Ngày kết thúc phải sau ngày bắt đầu.'
        ]);

        Promotion::create($request->all());

        return back()->with('success', 'Thêm mã giảm giá thành công!');
    }

    // Cập nhật mã
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|max:50|unique:tbl_promotion,code,'.$id.',promotionid',
            'discount_percent' => 'required|numeric|min:1|max:100',
            'startdate' => 'required|date',
            'enddate' => 'required|date|after_or_equal:startdate',
            'quantity' => 'required|integer|min:0',
        ]);

        $promotion = Promotion::findOrFail($id);
        $promotion->update($request->all());

        return back()->with('success', 'Cập nhật mã giảm giá thành công!');
    }

    // Xóa mã
    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();

        return back()->with('success', 'Đã xóa mã giảm giá!');
    }
}