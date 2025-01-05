<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Traits\Report;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    private $model;

    public function __construct(Contact $model){

        $this->model = $model;
       
    }

    public function index()
    {
        $contacts = $this->model->latest()->get();
        return view('dashboard.contacts.index' , compact('contacts'));
    }

    // public function create()
    // {
    //     return view('dashboard.contacts.create');
    // }

    public function replay(Request $request)
    {

        Mail::to($request->id)->send(new SendMail(['title' => 'ادارة هوزن' , 'message' =>  $request->replay_message]));
        Report::addToLog(' ارسال رد رسالة تواصل معنا ') ;

        return response()->json();
    }


  

    public function destroy($id)
    {
        $this->model->find($id)->delete();
        // Report::addToLog('  حذف رسالة تواصل ') ;
        return response()->json();

    }

    public function deleteAll(Request $request) {
        $requestIds = json_decode($request->data);
    
        foreach ($requestIds as $id) {
          $ids[] = $id->id;
        }
        if ($this->model->whereIn('id' ,$ids)->get()->each->delete()) {
            // Report::addToLog('  حذف مجموعة رسائل تواصل ') ;

          return response()->json('success');
        } else {
          return response()->json('failed');
        }
    }

}