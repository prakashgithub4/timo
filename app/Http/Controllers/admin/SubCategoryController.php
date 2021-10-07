<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductSubCategoryRepository;
use App\Repositories\MenuRepository;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use File;

class SubCategoryController extends Controller
{
    use ImageTraits;
    protected $productCategory;
    protected $menu;
    protected $ProductSubCategory;

    public function __construct(ProductCategoryRepository $productCategory, MenuRepository $menu, ProductSubCategoryRepository $ProductSubCategory)
    {
        $this->productCategory = $productCategory;

        $this->ProductSubCategory = $ProductSubCategory;
        $this->menu = $menu;
        $this->middleware('admin');
    }

    function index()
    {
        $productSubCategory = $this->ProductSubCategory->_get();
        // return $productSubCategory;
        return view('admin.menu_sub_category.list', compact('productSubCategory'));
    }


    public function addOrEdit($id = null)
    {

        if (is_null($id)) {
            $getMenu = $this->ProductSubCategory->_edit($id);
            $menu = $this->menu->_getByStatus();
            $productCategory = $this->productCategory->_get();
            //  return $productCategory;
            return view('admin.menu_sub_category.add', compact('menu','getMenu'));
        } else {

            $getMenu = $this->ProductSubCategory->_edit($id);

            $menu = $this->menu->_getByStatus();

            $category = $this->productCategory->_get();


            return view('admin.menu_sub_category.edit', compact('getMenu', 'menu', 'category'));
        }
    }

    public function menuData(Request $request)
    {
        $menu_id = $request->menu_id;

        $fetchCategory = $this->productCategory->fetchCategory($menu_id);
        return $fetchCategory;
    }

    public function saveMenuCategory(Request $request)
    {


        // $request->validate([
        //     'menu_id' => 'required',
        //     'sub_category_name' => 'required',
        //     'sub_cateogry_name' => 'required'
        // ]);

        //return $request;
        if ($request->hasFile('sub_category_icon')) {
            $image = $this->Uploadfile($request->file('sub_category_icon'), 'uploads/subcat_icons');
        }

        $input_array = array(
            'menu_id' => $request->menu_id,
            'product_category_id' => $request->product_category_id,
            'sub_category_name' => $request->sub_category_name,
            'icon' => $request->file('sub_category_icon') ? $image['file'] : $request->hidden_file
        );
        // return $input_array;

        // print_r($request->all());
        // print_r($input_array);
        // exit();
        if ($request->id == 0) {
            $this->ProductSubCategory->_add($input_array);
            return redirect('admin/menu-sub-category')->with('success', 'sub category has been created successfully');
        } else {

            $this->ProductSubCategory->_update($request->id, $input_array);
            return redirect('admin/menu-sub-category')->with('success', 'sub category has been updated successfully');
        }
    }


    public function delete(Request $request, $id)
    {

        $getImageByid = $this->ProductSubCategory->_edit($id);
        if (File::exists(public_path('uploads/subcat_icons' . $getImageByid->icon))) {
            File::delete(public_path('uploads/subcat_icons' . $getImageByid->icon));
        }
        $delete = $this->ProductSubCategory->_delete($id);

        return redirect('admin/menu-sub-category')->with('success', 'Sub Category has been deleted successfully');
    }
}
