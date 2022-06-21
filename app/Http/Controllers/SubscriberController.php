<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Models\FieldValue;
use App\Models\Field;

class SubscriberController extends Controller
{
    public function index(){
        return view('subscribers.index');
    }

    /**
     * Get subscribers via ajax. Used by datatables
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribersAjax(Request $request){
        $subscribers = Subscriber::query();

        $datatable = DataTables::of($subscribers)
                        ->addColumn('action', function($subscriber){
                            return '<a href="/subscribers/create?id='.$subscriber->id.'" class="text-primary"><i class="mdi mdi-square-edit-outline"></i></a><a href="/subscribers/delete?id='.$subscriber->id.'" class="text-danger"><i class="mdi mdi-delete"></i></a>';
                        })
                        ->editColumn('state', function($subscriber){
                            return '<span class="badge badge-pill bg-'.$subscriber->state_class.'">'.$subscriber->state.'</span>';
                        })
                        ->rawColumns(['state', 'action']);

        return $datatable->make(true);
    }

    /**
     * Display subscriber form
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $subscriber = Subscriber::findOrNew($request->id);

        if(!Gate::allows('update-subscriber', $subscriber)){
            abort(403);
        }

        $subscriber->attachValues(); //For the form fields for cases of editing
        
        if(!$subscriber->exists){
            $subscriber->state = 'active';
        }

        $states = [
            'active',
            'unsubscribed',
            'junk',
            'bounced',
            'unconfirmed'
        ];

        $fields = Field::orderBy('title')->get();

        return view('subscribers.create', compact('states', 'fields', 'subscriber'));
    }

    /**
     * Process subscriber form submission
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $subscriber = Subscriber::findOrNew($request->id);

        if(!Gate::allows('update-subscriber', $subscriber)){
            abort(403);
        }

        $rules = [
            'name' => 'required',
            'email' => 'required|email:rfc,dns'
        ];

        $messages = [];

        $fields = Field::all();
        foreach($fields as $field){
            $rule = '';

            switch($field->type){
                case 'date':
                case 'boolean':
                    $rule = $field->type;
                    break;
                case 'number':
                    $rule = 'integer';
            }

            if($rule){
                $rules['field_'.$field->id] = 'nullable|'.$rule;
                $messages['field_'.$field->id.'.'.$rule] = $field->title.' is invalid';
            }            
        }

        $request->validate($rules, $messages);

        $subscriber->name = $request->name;
        $subscriber->email = $request->email;
        $subscriber->state = $request->state ? $request->state : 'active';
        $subscriber->user_id = auth()->id();
        $subscriber->save();

        $subscriber->fieldvalues()->delete();
        
        foreach($fields as $field){
            $value = $request->{'field_'.$field->id};

            if($value){
                $fieldValue = new FieldValue;
                $fieldValue->subscriber_id = $subscriber->id;
                $fieldValue->field_id = $field->id;
                $fieldValue->value = $value;
                $fieldValue->save();
            }
        }

        if($request->expectsJson()){
            return $subscriber;
        }

        return redirect('/')->with('message', 'Subscriber saved');
    }

    /**
     * API Method: Get the list of subscribers
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSubscribers(Request $request){
        $subscribers = Subscriber::orderBy('name')
                            ->simplePaginate(5);

        return $subscribers;
    }

    /**
     * Delete a subscriber
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request){
        $subscriber = Subscriber::findOrFail($request->id);

        if(!Gate::allows('update-subscriber', $subscriber)){
            abort(403);
        }
        
        $subscriber->delete();

        if($request->expectsJson()){
            return $subscriber;
        }

        return redirect()->back()->with('message', 'Subscriber deleted');
    }
}
