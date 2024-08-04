<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Size\addSizeRequest;
use App\Http\Requests\Size\updateSizeRequest;
use App\Http\Traits\APIGeneralTrait;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    use APIGeneralTrait;
    public function __construct(private Size $sizeModel)
    {

    }

    public function allSizes(Request $request)
    {
        //check if user have the permission or not
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }

        $sizes = $this->sizeModel->get();

        return $this->returnData("data", $sizes, "Sizes data");

    }

    public function store(addSizeRequest $request)
    {
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }
        try{
            $size = $this->sizeModel->create([
                "size" => $request->size,
                "name" => $request->name
            ]);

            return $this->returnData("data", $size, "Size created successfully");
        } catch(\Throwable $error)
        {
            return $this->returnError(422, $error->getMessage());
        }

    }

    public function getSize(Request $request, $id)
    {
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }

        $size = $this->sizeModel::find($id);
        if (!$size)
        {
            return $this->returnError(404, "Size not found");
        }

        return $this->returnData("data", $size, "Size data");
    }

    //endpoint for update size record
    public function update(updateSizeRequest $request, $id)
    {
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }
        $size = $this->sizeModel::find($id);
        if (!$size)
        {
            return $this->returnError(404, "Size not found");
        }

        try{
            $size->update([
                "size" => $request->size,
                "name" => $request->name
            ]);

            return $this->returnData("data", $size, "Size updated successfully");
        } catch(\Throwable $error)
        {
            return $this->returnError(422, $error->getMessage());
        }

    }

    //endpoint for deleting size record
    public function destroy(Request $request, $id)
    {
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }

        $size = $this->sizeModel::find($id);
        if (!$size)
        {
            return $this->returnError(404, "Size not found");
        }

        try{
            $size->delete();
            return $this->returnData("data", null, "Size deleted successfully");
        } catch(\Throwable $error)
        {
            return $this->returnError(422, $error->getMessage());
        }
    }
}
