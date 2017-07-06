<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;
use App\Country;

class CountryController extends Controller
{
    public function index()
    {
    	$data['country_list'] = Country::all();
    	return view('admin.country.list',$data);
    }

    public function add()
    {

    	return view('admin.country.add');
    }

    public function store(Request $Request)
    {

    	$this->validate($Request, [
	        'country_name' => 'required|unique:countries,name',
	        'country_code' => 'required|unique:countries,code',
	        'country_status' => 'required',
	    ],
	    [
	    	'country_code.unique'	=> 'Country Code already exists'
	    ]
	    );

    	$country = new Country;

    	$country->name = $Request->country_name;
    	$country->code = $Request->country_code;
    	$country->status = $Request->country_status;
    	$country->save();

    	return redirect('admin/country');
    }

    public function edit($id)
    {
    	$data['record'] = Country::find($id);
    	return view('admin.country.edit',$data);	
    }

    public function update(Request $Request,$id)
    {
    	$country = Country::find($id);

    	$this->validate($Request, [
	        'country_name' => 'required|unique:countries,name,'.$id.',id',
	        'country_code' => 'required|unique:countries,code,'.$id.',id',
	        'country_status' => 'required',
	    ],
	    [
	    	'country_code.unique'	=> 'Country Code already exists'
	    ]
	    );

    	$country->name = $Request->country_name;
    	$country->code = $Request->country_code;
    	$country->status = $Request->country_status;
    	$country->save();

    	return redirect('admin/country');
    }

    public function delete($id)
    {
        Country::where('id',$id)->delete();
        return redirect('admin/country')->with('message','Record Deleted Successfully');
    }

}
