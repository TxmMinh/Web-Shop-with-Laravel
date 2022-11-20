<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()  // Điều khiển hiển thị danh sách dữ liệu.
    {
        $menus = Menu::paginate(8);
        $title_form = "Danh Sách Danh Mục";
        return view('admin.menu.list', [
            'title' => 'Danh Sách Danh Mục Mới Nhất'
        ], compact('menus', 'title_form'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() // Điều khiển trang insert dữ liệu.
    {
        return view('admin.menu.add', [
            'title' => 'Thêm Danh Mục Mới',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFormRequest $request) // Thực hiện việc insert dữ liệu.
    {
        $menu = new Menu; // Gọi Model Menu và gán cho biến $menu.

        // Tiến hành xử lý dữ liệu từ form (từ thuộc tính name của input)
        $menu->name = $request->name;
        $menu->parent_id = $request->parent_id;
        $menu->description = $request->description;
        $menu->content = $request->content;
        $menu->active = $request->active;

        $menu->save(); // save vào table menus trong Database.
        return redirect()->action([MenuModelController::class, 'create']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // Hiển thị dữ liệu riêng biệt dựa theo $id.
    {
        $menu = Menu::where('id', '=', $id)->select('*')->first();
        $des = html_entity_decode($menu->description);
        return view('/admin/menu/list_detail', compact('menu', 'des'), [
            'title' => 'Chi tiết sản phẩm',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // Hiển thị trang cập nhật dữ liệu.
    {
        $menu = Menu::findOrFail($id);
        $pageName = 'Menu - update';
        return view('admin.menu.list_update', [
            'title' => 'Update Menu',
        ], compact('menu', 'pageName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // Thực thi việc cập nhật dữ liệu.
    {
        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->parent_id = $request->parent_id;
        $menu->description = $request->description;
        $menu->content = $request->content;
        $menu->active = $request->active;
        $menu->save();
        return redirect()->action([MenuModelController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id) // Xóa dữ liệu.
    {
        $menu = Menu::find($id);
        $menu->delete();
        return redirect()->action([MenuModelController::class, 'index'])
            ->with('success', 'Dữ liệu xóa thành công.');
    }
}
