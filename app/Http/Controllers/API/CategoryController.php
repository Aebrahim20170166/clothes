<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\addRequest;
use App\Http\Traits\APIGeneralTrait;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use APIGeneralTrait;

    public function __construct(private Category $categoryModel)
    {
    }

    public function allCategories(Request $request)
    {
        //check if user have the permission or not
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }

        $categories = $this->categoryModel->get();

        return $this->returnData("data", $categories);
    }

    //endpoint to get category by id
    public function getCategory($categoryId, Request $request)
    {
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }

        $category = $this->categoryModel->find($categoryId);
        if (!$category)
        {
            return $this->returnError(404, 'القسم غير موجود');
        }

        return $this->returnData("data", $category);

    }

    //endpoint to create a new category
    public function store(addRequest $request)
    {
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }
        try{
            $category = $this->categoryModel->create([
                "name" => $request->name
            ]);
        } catch(\Throwable $error)
        {
            return $this->returnError(422, $error->getMessage());
        }

    }

    //endpoint to update a category
    public function update($categoryId, addRequest $request)
    {
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }

        $category = $this->categoryModel->find($categoryId);
        if (!$category)
        {
            return $this->returnError(404, 'التصنيف غير موجود');
        }

        try{
            $category->update([
                "name" => $request->name
            ]);
            return $this->returnData("data", $category, "تم تحديث التصنيف بنجاح");
        } catch(\Throwable $error)
        {
            return $this->returnError(422, $error->getMessage());
        }
    }

    //endpoint to delete a category
    public function destroy($categoryId, Request $request)
    {
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }

        $category = $this->categoryModel->find($categoryId);
        if (!$category)
        {
            return $this->returnError(404, 'التصنيف غير موجود');
        }

        try{
            $category->delete();
            return $this->returnSuccess("message", "تم حذف التصنيف بنجاح");
        } catch(\Throwable $error)
        {
            return $this->returnError(422, $error->getMessage());
        }
    }
}
