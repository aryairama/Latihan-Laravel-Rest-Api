<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Province;
use App\Http\Resources\CitiesCollection;
use App\Http\Resources\ProvincesCollection;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only(['shipping','services','couriers']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function provinces()
    {
        return new ProvincesCollection(Province::get());
    }

    public function cities()
    {
        return new CitiesCollection(City::get());
    }

    public function shipping(Request $request)
    {
        $user = Auth::user();
        $status = "error";
        $message = "";
        $data  = null;
        $code = 200;
        if ($user) {
            $request->validate([
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'province_id' => 'required',
                'city_id' => 'required'
            ]);
            $user->name = $request->name;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->province_id = $request->province_id;
            $user->city_id = $request->city_id;
            if ($user->save()) {
                $status = "success";
                $message = "Update shipping success";
                $data = $user->toArray();
            } else {
                $message = "Update shipping failed";
            }
        } else {
            $message = "User not found";
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function couriers()
    {
        $couriers = [
            ['id' => 'jne','text' => 'JNE'],
            ['id' => 'tiki','text' => 'TIKI'],
            ['id' => 'pos','text' => 'POS']
        ];
        return response()->json([
            'status' => 'success',
            'message' => 'data couriers',
            'data' => $couriers
        ], 200);
    }

    public function services(Request $request)
    {
    }
}
