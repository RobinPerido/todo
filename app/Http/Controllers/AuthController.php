<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth;

class AuthController extends Controller
{
    public function getLogin() {
        return view('login');
    }

    public function postLogin() {
    	$rules = array('username' => 'required', 'password' => 'required');
    	$validator = Validator::make(Input::all(), $rules);

    	if($validator->fails()) {
    		return Redirect::route('login')->withErrors($validator);
    	}

    	$auth = Auth::attempt(array(
    		'name' => Input::get('username'),
    		'password' => Input::get('password')
    	), false);

    	if(!$auth) {
    		return Redirect::route('login')->withErrors(array(
    			'Invalid credentials were provided'
    		));
    	}

    	return Redirect::route('home');
    }
}
