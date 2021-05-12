<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\Feild;
use App\Models\Slot;

use Carbon\Carbon;

class FieldsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addfield()
    {
        return view("form");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function field_Add(Request $request)
    { 

        
        $request->validate([
            'title' => 'required | string ',
            'start' => 'required | date_format:Y-m-d\TH:i|after_or_equal:'.date('Y-m-d H:i').' | before:end',
            'end' => 'required | date_format:Y-m-d\TH:i| after:start',
            'field.*.name' => 'required|string',
            'field.*.email' => 'required|string|min:1|max:25',
            'field.*.DOB' => 'required|date_format:Y-m-d|before:today',
        ]);
        
        $event = new Event();
        $event->title = request('title');
        $event->save();


        dd($request->field);
        foreach ($request->addmore as $key => $value) {
            Field::create($value);
        }
        return Redirect::action('EventsController@calculate_date');
    }
}
