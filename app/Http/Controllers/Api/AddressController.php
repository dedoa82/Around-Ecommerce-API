<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    /**
     * Create a new CartController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin', ['except' => ['store','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * for admin only 
     * 
     */
    public function index() // Secured Endpoint
    {
        $addresses = DB::table('addresses')->paginate(5);
        
        return response()->json([
            'success' => true,
            'payload' => $addresses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     *  for Auth user
     * 
     */
    public function store(AddressRequest $request) // Secured Endpoint
    {
        $request = $request->validated();

        $address = Address::create( $request );

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Address $address
     * @return \Illuminate\Http\Response
     * 
     * for admin only 
     * 
     */
    public function show(Address $address) // Secured Endpoint
    {
        return response()->json([
            'success' => true,
            'payload' => $address
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Address $address
     * @return \Illuminate\Http\Response
     * 
     * for specific user, who created this recored 
     * 
     */
    public function update(AddressRequest $request, Address $address) // Secured Endpoint
    {
        if ($address->user_id != Auth::user()->id ) 
        {
            return response()->json([
                'message' => "Unauthenticated, this action for specific user only",
            ],401);
        }
        
        $request = $request->validated();

        $address = $address->update( $request );

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Address $address
     * @return \Illuminate\Http\Response
     * 
     * for specific user, who created this recored 
     * 
     */
    public function destroy(Address $address) // Secured Endpoint
    {
        if ($address->user_id != Auth::user()->id ) 
        {
            return response()->json([
                'message' => "Unauthenticated, this action for specific user only",
            ],401);
        }

        $address = $address->delete( $address );

        if ($address) return response()->json([
            'success' => true,
        ]);
    }
}