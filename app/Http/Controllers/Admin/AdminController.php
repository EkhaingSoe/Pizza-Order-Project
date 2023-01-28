<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
     //direct admin profile page
     public function profile(){
        $id=auth()->user()->id;
        $userData = User::where('id',$id)->first();
        return view('admin.profile.index')->with(['user'=>$userData]);
    }

    //update profile
    public function updateProfile($id,REQUEST $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',

        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $updateData =$this->requestUpdateData($request);
        User :: where('id',$id)->update($updateData);
        return back()->with(['updateSuccess'=>'User Information Updated...']);

    }

    //change Password page
    public function changePasswordPage(){
        return view('admin.profile.changePasswordPage');
    }

    //change Password
    public function changePassword($id,REQUEST $request){

        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'comfirmPassword' => 'required',


        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = User::where('id',$id)->first();
        $oldPassword = $request -> oldPassword ;
        $newPassword = $request->newPassword;
        $comfirmPassword = $request->comfirmPassword;
        $hashPassword = $data['password'];
        if (Hash::check($oldPassword, $hashPassword)) {
            if($newPassword != $comfirmPassword){
                return back()->with(['newPasswordError'=>"Password Comfirmation do not match...not same"]);

            }else{
                if(strlen($newPassword) <= 6 || strlen($comfirmPassword) <= 6){
                    return back()->with(['lengthError'=>"Password must be greater than 6"]);
                }else{

                   $hash = Hash::make($newPassword);

                   User :: where('id',$id)->update([
                    'password' => $hash
                   ]);

                    return back()->with(['changeSuccess'=>"Changing password is successful..."]);

                }
            }
        }else{
            return back()->with(['oldPasswordError'=>"Old Password do not match.Try Again..."]);
        }
    }

    private function requestUpdateData($request){
        return[
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address
        ];
    }
}
