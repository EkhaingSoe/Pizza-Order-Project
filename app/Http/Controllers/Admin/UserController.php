<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //direct userList page
    public function userList(){
        $userData=User::where('role','user')->paginate(5);

        return view('admin.user.userList')->with(['user'=>$userData]);
    }

     //direct adminList page
     public function adminList(){
        $userData=User::where('role','admin')->paginate(5);

        return view('admin.user.adminList')->with(['admin'=>$userData]);
    }

    //search user
    public function userSearch(Request $request){
        $response=$this->search('user',$request);


        return view('admin.user.userList')->with(['user'=>$response]);

    }

    //delete user account
    public function userDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'User account deleted!']);
    }

    //search admin
    public function adminSearch(Request $request){
        $response=$this->search('admin',$request);


        return view('admin.user.adminList')->with(['admin'=>$response]);

    }

    //delete admin account
    public function adminDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Admin account Deleted!']);
    }

    //data searching
    private function search($role,$request){
        $searchData = User::where('role',$role)
                            ->where(function($query) use ($request){
                                $query->orWhere('name','like','%'.$request->searchData.'%')
                                ->orWhere('email','like','%'.$request->searchData.'%')
                                ->orWhere('phone','like','%'.$request->searchData.'%')
                                ->orWhere('address','like','%'.$request->searchData.'%');
                            })
                            ->paginate(5);
        $searchData->appends($request->all());
        return $searchData;
    }
}
