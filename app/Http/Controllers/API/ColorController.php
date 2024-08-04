<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Color\addColorRequest;
use App\Http\Traits\APIGeneralTrait;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{

    use APIGeneralTrait;

    public function __construct(private Color $colorModel)
    {
    }

    //endpoint to get all colors
    public function allColors(Request $request)
    {
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }

        $colors = $this->colorModel->get();
        return $this->returnData("data", $colors, "colors data");
    }

    //endpoint to create a new color
    public function store(addColorRequest $request)
    {
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }

        try{
            $color = $this->colorModel->create([
                "name" => $request->name
            ]);

            return $this->returnData("data", $color, "color created successfully");
        } catch(\Throwable $error)
        {
            return $this->returnError(422, $error->getMessage());
        }
    }

    //endpoint to get color by id
    public function getColor($id, Request $request)
    {
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }

        $color = $this->colorModel->find($id);

        if($color)
            return $this->returnData("data", $color, "color data");
        else
            return $this->returnError(404, "color not found");
    }

    //endpoint to update a color
    public function update(addColorRequest $request, $id)
    {
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }

        $color = $this->colorModel->find($id);

        if (!$color)
        {
            return $this->returnError(404, "color not found");
        }

        try{

            $color->update([
                "name" => $request->name
            ]);
        } catch(\Throwable $error) {
            return $this->returnError(422, $error->getMessage());
        }
    }

    //endpoint to delete a color
    public function destroy($id, Request $request)
    {
        if (!$this->checkAdmin($request))
        {
            return $this->returnError(401, 'غير مصرح لك بالدخول');
        }

        $color = $this->colorModel->find($id);

        if (!$color)
        {
            return $this->returnError(404, "color not found");
        }

        $color->delete();

        return $this->returnSuccess("color deleted successfully");
    }
}
