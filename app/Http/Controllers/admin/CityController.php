<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\City;
use App\State;
use App\Country;

class CityController extends Controller
{
    public function index()
    {
    	$data['city_list'] = City::all();
    	return view('admin.city.list',$data);
    }

    public function add()
    {
    	$country_list          = Country::where('status','Active')->pluck('name','id');
    	$data['country_list']  = $country_list;
        $data['state_list']    = State::where('status','Active')->pluck('name','id'); 
    	return view('admin.city.add',$data);
    }

    public function store(Request $Request)
    {
    	$city = new City;
    	$this->validate($Request,[
    		'country_id' 	=> 'required',
            'state_id'      => 'required',
    		'city_name' 	=> 'required',
    		'status'		=> 'required'
    	]);
		
		$city->country_id 	= $Request->country_id;
        $city->state_id     = $Request->state_id;
		$city->name 		= $Request->city_name;
		$city->status 		= $Request->status;
		$city->save();

		return redirect('admin/city');
    }

    public function edit($id)
    {
    	$country_list          = Country::where('status','Active')->pluck('name','id');
        $record                = City::find($id);
    	$data['country_list']  = $country_list;
        $data['state_list']    = State::where('status','Active')->where('country_id',$record->country_id)->pluck('name','id'); 
    	$data['record']        = $record;
    	return view('admin.city.edit',$data);
    }

    public function update(Request $Request, $id)
    {
    	$city = City::find($id);
    	$this->validate($Request,[
    		'country_id' 	=> 'required',
            'state_id'      => 'required',
    		'city_name' 	=> 'required',
    		'status'		=> 'required'
    	]); 

    	$city->country_id 	= $Request->country_id;		
		$city->state_id 	= $Request->state_id;
        $city->name         = $Request->city_name;
		$city->status 		= $Request->status;
		$city->save();

		return redirect('admin/city')->with('message','Record Updated Successfully');
    }

    public function delete($id)
    {
    	City::where('id',$id)->delete();
    	return redirect('admin/city')->with('message','Record Deleted Successfully');
    }

    public function getState(Request $Request)
    {
        $country_id = $Request->country_id;
        //$state_list = State::where([["status","'Active'"],['country_id',$country_id]])->pluck('id','name'); 
        $state_list = State::where('status','Active')
                            ->where('country_id',$country_id)
                            ->get(); 
        $select = '<option value=""">Select</option>';
        if($state_list->count())
        {
            foreach ($state_list as $key => $state) {
                $select .= '<option value="'.$state['id'].'">'.$state['name'].'</option>';
            }
        }
        echo $select;
    }
}
