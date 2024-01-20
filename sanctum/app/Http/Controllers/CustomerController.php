<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\GeneralTrait;


class CustomerController extends Controller
{   
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            "Lname"=>"required|string|min:3|max:20|regex:/^[A-Za-z]+$/",
            "Fname"=>"required|string|min:3|max:20|regex:/^[A-Za-z]+$/",
            "mobile"=>"required|string|unique:customers,mobile|regex:/^(09)[0-9]{8}$/",
        ]);
        //$this->test($validate);
        if ($validatedData->fails()) {
            return $this->apiResponse( null, false, $validatedData->messages(), 401);
        }else{
        $customer = Customer::create([
            "Fname" => $request->Fname,
            "Lname" => $request->Lname,
            "mobile"=>$request->mobile,
            'uuid' => Str::uuid() ]);

            return $this->apiResponse( $customer, true, null, 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
