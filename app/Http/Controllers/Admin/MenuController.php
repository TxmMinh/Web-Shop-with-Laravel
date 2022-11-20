<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Services\Menu\MenuService;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()  // Điều khiển hiển thị danh sách dữ liệu.
    {
        // Dùng Services
        return view('admin.menu.list', [
            'title' => 'Danh Sách Danh Mục Mới Nhất',
            'menus' => $this->menuService->getAll(),
            'title_form' => "Danh Sách Danh Mục",
        ]);
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
            'menus' => $this->menuService->getParent(),
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
        $this->menuService->create($request); //Call function from MenuService to save value
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $result = $this->menuService->delete($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xoá thành công danh mục'
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }

    public function show(Menu $menu)
    {
        // dd($menu);

        return view('admin.menu.edit', [
            'title' => 'Chỉnh Sửa Danh Mục ' . $menu->name,
            'menu' => $menu,
            'menus' => $this->menuService->getParent(),
        ]);
    }

    public function update(Menu $menu, CreateFormRequest $request)
    {
        $this->menuService->update($request, $menu);
        return redirect('/admin/menu/list');
    }
}
