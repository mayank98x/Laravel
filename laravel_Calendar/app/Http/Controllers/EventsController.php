<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Field;
use App\Models\Slot;
use DB;

use Carbon\Carbon;
use LaravelFullCalendar\Facades\Calendar;

class EventsController extends Controller
{
    public function index() {
    // $slots = Slot::all();
    $role = 'Student';
    

    $fields=DB::table('fields')
    ->join('events', 'fields.event_id', '=', 'events.id')
    // ->join('slots', 'events.id', '=', 'slots.event_id')
    ->where('fields.event_id',22)
    ->get();

    $slots=DB::table('events')
    // ->join('events', 'slots.event_id', '=', 'events.id')
    ->join('slots', 'events.id', '=', 'slots.event_id')
    // ->where('slots.event_id', 22)
    ->get();

    return View('eventPage', compact('slots','role','fields'));
    }

    public function index_teacher() {
    $role = 'Teacher';
    $fields=DB::table('fields')
    ->join('events', 'fields.event_id', '=', 'events.id')
    // ->where('fields.event_id', 23)
    ->get();

    $slots=DB::table('events')
    ->join('slots', 'events.id', '=', 'slots.event_id')
    // ->where('slots.event_id', 22)
    ->get();


    return View('teacher', compact('slots','role','fields'));
    }

    public function calculate_date(Request $request){

        // dd($request->all());
        $start=date("Y-m-d H:s:i",strtotime($request->start));
        $end=date("Y-m-d H:s:i",strtotime($request->end));
        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $start);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $end);
        $no_of_slots=floor(($to->diffInMinutes($from))/($request->time));  
       
        if($no_of_slots < 1){ return redirect()->back()->withInput()
            ->with('danger', 'Please Enter Time Difference greater than '.$request->time.' minutes' );
        }
        else{
        $start=date("Y-m-d H:s:i",strtotime($request->start));
        date_default_timezone_set('Asia/Kolkata');
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
            $event->start = $start;
            $event->end = $end;
           
            $event->save();
            $event_id = $event->id;
         
            for($i=1;$i<=$no_of_slots;$i++) {
            $slot=new Slot();
            $slot->event_id = $event_id;
            $slot->start = $start;
            $start= Carbon::parse($start)->addMinutes($request->time)->toDateTimeString();
            $slot->end = $start;
            $slot->color = '#257e4a';
            $slot->save();
            // $slots[$i] =array();
            // $slots[$i]['start'] = $start;
            // $start= Carbon::parse($start)->addMinutes($request->time)->toDateTimeString();
            // $slots[$i]['end'] = $start;
            }
            // dd($request->field[0]['name']);
            // dd();
            for($i=0;$i<count($request->field);$i++) {
            $field= new Field();
            $field->event_id= $event_id;
            $field->name=$request->field[$i]['name'];
            $field->email=$request->field[$i]['email'];
            $field->DOB=$request->field[$i]['DOB'];
            $field->save();
            }
            // $field->name = $request->field[][name];
            // return $this->save($request,$slots,$start,$end,$no_of_slots);
            return redirect('/events')->with('success', 'Data has been saved successfully');
            }}


            public function ajax_delete(Request $request)
            {
            echo $request->id;
            $slot = Slot::find($request->id)->delete();
            if($slot)
            {
            $bool=1;
            }
            return response()->json($bool);
            }


            public function ajax_update(Request $request){
            $slot = Slot::find($request->id)->update([
            'color' => '#800000'
            ]);
            if($slot){
            $flag=1;
            }
            return response()->json($flag);
    }


}
