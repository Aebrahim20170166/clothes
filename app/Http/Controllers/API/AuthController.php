<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\loginRequest;
use App\Http\Requests\User\addUserRequest;
use App\Http\Resources\User\userResource;
use App\Http\Traits\APIGeneralTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use APIGeneralTrait;
    public function __construct(private User $userModel)
    {

    }

    public function login(loginRequest $request)
    {
        try{

            if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = $this->userModel::where(['email' => $request->email])->first();
            // if ($user->status == 0) {
            //     return $this->returnError(401, 'غير مصرح لك بالدخول');
            // }
            $token = $user->createToken("API TOKEN")->plainTextToken;
            $token = "Bearer " . $token;
            $user->update(['token' => $token, 'device_token' => $request->device_token]);
            if (!$token) {
                return $this->returnError(401, 'غير مصرح لك بالدخول');
            }
            $data = $this->userModel::where(['email' => $request->email, 'status' => 1])->first(['id','username', 'email', 'phone', 'image', 'token']);
            if (!$data->image) {
                $data->image = "https://ui-avatars.com/api/?name=" . $data->name . ".png";
            }

            return $this->returnData('data', ['user' => $data], 'تم التسجيل بنجاح');
            }
        } catch (\Throwable $error) {
            return $this->returnError(401, $error->getMessage());
        }

    }

    //endpoint for sign up
    public function signup(addUserRequest $request)
    {
        try{

            if($request->has('image'))
            {
                $imagePath = request()->file('image')->store('uploads/users', 'public');
            }

            $user = $this->userModel->create([
                'username' => $request->username,
                'email' => $request->email,
                'password' =>  Hash::make($request->password),
                'phone' => $request->phone,
                'status' => 1,
                'image' => ($imagePath) ? $imagePath : "",
                'role_id' => 1
            ]);

            $token = $user->createToken("API TOKEN")->plainTextToken;
            $token = "Bearer " . $token;
            $user->update(['token' => $token, 'device_token' => $request->device_token]);
            if (!$token) {
                return $this->returnError(401, 'غير مصرح لك بالدخول');
            }
            $data = userResource::make($user);
            return $this->returnData("data", $data, "user data successfully");
        } catch(\Throwable $error)
        {
            return $this->returnError(401, $error->getMessage());
        }
    }


}
