<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

use App\Http\Requests;

class OrdersController extends Controller
{
    public function fetchOrdersList()
    {
    	return view('admin.orders');
    }

    public function loadOrders()
    {
        $data['orders'] = Order::get();
        return $data;
    }

    public function addOrder(Request $request)
    {
    	$order = new Order();
    	$order->user_id = $request->user_id;
    	$order->sender_phone = $request->sender_phone;
    	$order->sender_street = $request->sender_street;
    	$order->sender_address_1 = $request->sender_address_1;
    	$order->sender_city = $request->sender_city;
    	$order->sender_state = $request->sender_state;
    	$order->sender_zipcode = $request->sender_zipcode;
    	$order->sender_country = $request->sender_country;

    	$order->reciever_name = $request->reciever_name;
		$order->reciever_email = $request->reciever_email;
		$order->reciever_phone = $request->reciever_phone;
		$order->reciever_street = $request->reciever_street;
		$order->reciever_address_1 = $request->reciever_address_1;
		$order->reciever_city = $request->reciever_city;
		$order->reciever_state = $request->reciever_state;
		$order->reciever_zipcode = $request->reciever_zipcode;
		$order->reciever_country = $request->reciever_country;
		$order->pickup_date = $request->pickup_date;
		$order->shipment_info = serialize($request->shipment_info);
    	$order->save();
    }

    public function loadAddOrderForm()
    {
    	return view('admin.add_order_form');
    }
}
