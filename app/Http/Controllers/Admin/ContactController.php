<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function createContact(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'

        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data=$this->requestUserData($request);
        if(count($data)==0){
            $emptyStatus =0;
        }else{
            $emptyStatus = 1;
        }
        Contact :: create($data);//put data to database
        return back()->with(['contactSuccess'=>"Message sent...",'status'=>$emptyStatus]);

    }

    public function contactList(){
        $data= Contact::orderBy('contact_id','desc')->paginate(5);//get data from database
        return view('admin.contact.contact')->with(['contact'=>$data]);
    }

    public function contactSearch(Request $request){
        $searchData = Contact::orWhere('name','like','%'.$request->searchData.'%')
                                ->orWhere('email','like','%'.$request->searchData.'%')
                                ->orWhere('message','like','%'.$request->searchData.'%')
                                ->paginate(5);

        $searchData -> appends($request->all());
        if(count($searchData)==0){
            $emptyStatus =0;
        }else{
            $emptyStatus = 1;
        }
        return back('admin.contact.contact')->with(['contact'=>$searchData,'status'=>$emptyStatus]);
    }

    private function requestUserData($request){
        return[
            'user_id'=>Auth()->user()->id,
            'name'=> $request -> name,
            'email' => $request -> email,
            'message' => $request ->message
        ];
    }
}
