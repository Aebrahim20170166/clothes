<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\addRequest;
use App\Http\Resources\Product\productResource;
use App\Http\Traits\APIGeneralTrait;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use APIGeneralTrait;

    public function __construct(private Product $productModel)
    {
    }

    public function allProducts(Request $request)
    {
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }

        $products = $this->productModel->where("admin_id", $request->user()->id)->get();

        return $this->returnData("data", $products);
    }

    //endpoint to get product
    public function getProduct(Request $request, $id)
    {
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }

        $product = $this->productModel->where("id", $id)
                ->where("admin_id", $request->user()->id)->first();

        if (!$product)
        {
            return $this->returnError(404, 'المنتج غير موجود');
        }

        return $this->returnData("data", $product);
    }

    //endpoint to create new product
    public function store(addRequest $request)
    {
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }
        try{
            if ($request->has('image'))
            {
                $imagePath = request()->file('image')->store('uploads/products', 'public');
            }
            $product = $this->productModel->create([
                "name" => $request->name,
                "price_before" => $request->price,
                "description" => $request->description,
                "admin_id" => $request->user()->id,
                "color_id" => $request->color_id,
                "size_id" => $request->size_id,
                "category_id" => $request->category_id,
                "quantity" => $request->quantity,
                "image" => ($imagePath) ? $imagePath : ""
            ]);
            $data = productResource::make($product);
            return $this->returnData("data", $data);

        } catch(\Throwable $error){

            return $this->returnError(500, 'حدث خطأ ما في عملية الاضافة');
        }

    }

    //endpoint to update product
    public function update(addRequest $request, $id)
    {
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }

        $product = $this->productModel->where("id", $id)
                ->where("admin_id", $request->user()->id)->first();
        if (!$product)
        {
            return $this->returnError(404, 'المنتج غير موجود');
        }

        try{

            if ($request->has('image'))
            {
                Storage::disk('public')->delete($product->image);
                $imagePath = request()->file('image')->store('uploads/products', 'public');
            }
            $product->update([
                "name" => $request->name,
                "price_before" => $request->price,
                "description" => $request->description,
                "admin_id" => $request->user()->id,
                "color_id" => $request->color_id,
                "size_id" => $request->size_id,
                "category_id" => $request->category_id,
                "quantity" => $request->quantity,
                "image" => ($imagePath) ? $imagePath : $product->image
            ]);

            $data = productResource::make($product);
            return $this->returnData("data", $data, "تم تحديث المنتج بنجاح");
        } catch(\Throwable $error){

            return $this->returnError(422, 'حدث خطأ ما في عملية التحديث');
        }
    }

    //endpoint to delete product
    public function destroy(Request $request, $id){

        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }
        $product = $this->productModel->where("id", $id)
                    ->where("admin_id", $request->user()->id)->first();
        if (!$product)
        {
            return $this->returnError(404, 'المنتج غير موجود');
        }

        try{
            $product->delete();
            return $this->returnSuccess(200, "تم حذف المنتج بنجاح");
        } catch(\Throwable $error)
        {
            return $this->returnError(422, $error->getMessage());
        }

    }
}
