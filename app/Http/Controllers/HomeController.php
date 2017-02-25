<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Item;

class HomeController extends Controller
{
    public function getIndex() {
    	$items = Auth::user()->items;
    	return view('home', array(
    		'items' => $items,
    	));
    }

    public function postIndex() {
    	$id = Input::get('id');

    	$item = Item::findOrFail($id);

    	if($item->owner_id == Auth::user()->id) {
    		$item->mark();
    	}

    	return Redirect::route('home');
    }

    public function getNew() {
    	return view('new');
    }

    public function postNew() {
    	$rules = array('name' => 'required|min:3|max:255');
    	$validator = Validator::make(Input::all(), $rules);

    	if($validator->fails()) {
    		return Redirect::route('new')->withErrors($validator);
    	}

    	$item = new Item;
    	$item->owner_id = Auth::user()->id;
    	$item->name = Input::get('name');
    	$item->done = 0;
    	$item->save();

    	return Redirect::route('home');
    }

    public function getDelete(Item $task) {
    	if($task->owner_id == Auth::user()->id) {
    		$task->delete();
    	}

    	return Redirect::route('home');
    }
}
