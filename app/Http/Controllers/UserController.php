<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
         $pizza = Pizza :: where('publish_status',1)->get();
         $status = count($pizza) == 0 ? 0 : 1 ;
         $data = Category :: get();
        return view('user.home')->with(['pizza'=>$pizza,'category'=>$data,'status'=>$status]);
    }

    public function pizzaSearch($id){
        $pizza = Pizza ::where('category_id',$id)->get();
        $status = count($pizza) == 0 ? 0 : 1 ;
        $data = Category :: get();
        return view('user.home')->with(['pizza'=>$pizza,'category'=>$data,'status'=>$status]);
    }

    public function searchItem(Request $request){
        $searchData = $request->searchData;
        $dataPizza = Pizza :: where('pizza_name','like','%'.$searchData.'%')->get();
        $status = count($dataPizza) == 0 ? 0 : 1 ;
        $data = Category :: get();
        return view('user.home')->with(['pizza'=>$dataPizza,'category'=>$data,'status'=>$status]);
    }

    public function searchPizzaPrice(Request $request){
       $min=$request->minPrice;
       $max= $request -> maxPrice;

       $startDate = $request -> startDate;
       $endDate = $request -> endDate;

       $query = Pizza :: select('*');

       if(!is_null($startDate) && is_null($endDate)){
        // dd("start");
        $query = $query -> whereDate('created_at','>=',$startDate);
       }else if(is_null($startDate)&& !is_null($endDate)){
        // dd("end");
        $query = $query ->whereDate('created_at','<=',$endDate);
       }else{
        // dd("both");
        $query = $query -> whereDate('created_at','>=',$startDate)
                        -> whereDate('created_at','<=',$endDate);
       }


       if(!is_null($min) && is_null($max)){
            $query = $query->where('price','>=',$min);
       }else if(is_null($min) && !is_null($max)){
            $query = $query->where('price','<=',$max);
       }else{
            $query = $query->where('price','>=',$min)
                            ->where('price','<=',$max);
       }
       $query = $query->get();
       $status = count($query) == 0 ? 0 : 1 ;
        $data = Category :: get();
        return view('user.home')->with(['pizza'=>$query,'category'=>$data,'status'=>$status]);
    }

    public function pizzaDetail($id){
        $data = Pizza::where('pizza_id',$id)->first();
        Session :: put ('PIZZA_INFO',$data);
        return view('user.detail')->with(['pizza'=>$data]);
    }

    public function order(){
        $pizzaInfo = Session :: get('PIZZA_INFO');
        return view('user.order')->with(['pizza'=>$pizzaInfo]);
    }

    public function orderPlace(Request $request){
        $pizzaInfo = Session :: get('PIZZA_INFO');
        $userId = auth()->user()->id;
        $count = $request->totalCount;

        $validator = Validator::make($request->all(), [
            'totalCount' => 'required',
            'paymentType' => 'required',

        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $orderData = $this -> requestOrderData($pizzaInfo,$userId,$request);

        for($i=0;$i<$count;$i++){
            Order::create($orderData);
        }

        $waitingTime = $pizzaInfo['waiting_time']*$count;

        return back()->with(['order'=>$waitingTime]);

    }

    private function requestOrderData($pizzaInfo,$userId,$request){
        return[
            'customer_id'=>$userId,
            'pizza_id'=> $pizzaInfo['pizza_id'],
            'carrier_id'=>0,
            'payment_status'=>$request->paymentType,
            'order_time'=>Carbon::now()
        ];
    }
}
