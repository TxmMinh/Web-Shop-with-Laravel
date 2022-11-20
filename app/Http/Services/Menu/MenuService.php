<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;

class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get(); //Lấy những row có parent_id=0
    }

    public function create($request)
    {
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active'),
            ]);

            Session::flash('success', 'Tạo Danh Mục Thành Công');
        } catch (\Exception $error) {
            Session::flash('error', $error->getMessage());
            return false;
        }
    }

    public function getAll()
    {
        return Menu::orderbyDesc('id')->paginate(8);
    }

    public function delete($request)
    {
        $id = (int)$request->input('id');
        $menu = Menu::where('id', $id)->first();
        if ($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }

    public function update($request, $menu)
    {
        $menu->name = (string) $request->input('name');
        if ($request->input('parent_id') != $menu->id) {
            $menu->parent_id = (int) $request->input('parent_id');
        }
        $menu->description = (string) $request->input('description');
        $menu->content = (string) $request->input('content');
        $menu->action = (string) $request->input('action');

        // $menu->fill($request->input()); // Quét toàn bộ thông tin request gửi lên
        $menu->save();

        Session::flash('success', 'Cập Nhập Danh Mục thành công');
        return true;
    }
}
