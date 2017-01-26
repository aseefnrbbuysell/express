<?php

namespace App\Http\Controllers;

use App\Courier;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CourierController extends Controller
{
    public function fetchCouriersList()
    {
        return view('admin.couriers');
    }

    public function loadCouriers()
    {
        $data['couriers'] = Courier::get();
        return $data;
    }

    public function loadAddCourierForm()
    {
        return view('admin.add_courier_form');
    }

    public function addCourier(Request $request)
    {
        $courier = Courier::create($request->all());
        $courier->present_address = serialize($request->present_address);
        $courier->permanent_address = serialize($request->permanent_address);

        if($request->cv){
            $file_extension = $request->file('cv')->guessExtension();
            $file_name = "cv_".time().".".$file_extension;
            $request->file('cv')->move('uploads', $file_name);
        }else{
            $file_name = "no_image.png";
        }
        if($request->national_id_number_doc){
            $file_extension = $request->file('national_id_number_doc')->guessExtension();
            $ni_file_name = "ni_".time().".".$file_extension;
            $request->file('national_id_number_doc')->move('uploads', $ni_file_name);
        }else{
            $ni_file_name = "no_image.png";
        }
        if($request->dob_doc){
            $file_extension = $request->file('dob_doc')->guessExtension();
            $dob_file_name = "dob_".time().".".$file_extension;
            $request->file('dob_doc')->move('uploads', $dob_file_name);
        }else{
            $dob_file_name = "no_image.png";
        }
        if($request->address_verification_doc){
            $file_extension = $request->file('address_verification_doc')->guessExtension();
            $address_file_name = "address_".time().".".$file_extension;
            $request->file('address_verification_doc')->move('uploads', $address_file_name);
        }else{
            $address_file_name = "no_image.png";
        }
        if($request->photo){
            $file_extension = $request->file('photo')->guessExtension();
            $photo_file_name = "photo_".time().".".$file_extension;
            $request->file('photo')->move('uploads', $photo_file_name);
        }else{
            $photo_file_name = "no_image.png";
        }
        $courier->picture = $photo_file_name;
        $courier->cv = $file_name;
        $courier->national_id_number_doc = $ni_file_name;
        $courier->address_verification_doc = $address_file_name;
        $courier->dob_doc = $dob_file_name;
        $courier->cv = $file_name;
        if($courier->save())
        {
            //return Redirect::to('/')->with('message', 'Login Failed');
        }
    }


}
