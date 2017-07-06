<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\State;
use App\Country;

class StateController extends Controller
{
    public function index()
    {
    	$data['state_list'] = State::all();
    	return view('admin.state.list',$data);
    }

    public function add()
    {
    	$country_list = Country::where('status','Active')->pluck('name','id');
    	$data['country_list'] = $country_list;
    	return view('admin.state.add',$data);
    }

    public function store(Request $Request)
    {
    	$state = new State;
    	$this->validate($Request,[
    		'country_id' 		=> 'required',
    		'state_name' 	=> 'required',
    		'state_code'	=> 'required|unique:states,code',
    		'status'		=> 'required'
    	]);
		
		$state->country_id 	= $Request->country_id;
		$state->name 		= $Request->state_name;
		$state->code 		= $Request->state_code;
		$state->status 		= $Request->status;
		$state->save();

		return redirect('admin/state');
    }

    public function edit($id)
    {
    	$country_list = Country::where('status','Active')->pluck('name','id');
    	$data['country_list'] = $country_list;
    	$data['record'] = State::find($id);
    	return view('admin.state.edit',$data);
    }

    public function update(Request $Request, $id)
    {
    	$state = State::find($id);
    	$this->validate($Request,[
    		'country_id' 	=> 'required',
    		'state_name' 	=> 'required',
    		'state_code'	=> 'required|unique:states,code,'.$id.',id',
    		'status'		=> 'required'
    	]); 

    	$state->country_id 	= $Request->country_id;
		$state->name 		= $Request->state_name;
		$state->code 		= $Request->state_code;
		$state->status 		= $Request->status;
		$state->save();

		return redirect('admin/state')->with('message','Record Updated Successfully');
    }

    public function delete($id)
    {
    	State::where('id',$id)->delete();
    	return redirect('admin/state')->with('message','Record Deleted Successfully');
    }
}
