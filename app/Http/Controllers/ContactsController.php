<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

use App\Http\Requests;

class ContactsController extends Controller
{

    public function __construct()
    {
        parent::middleware('auth', ['only' => ['contact_list']]);

    }
    public function save(Request $request)
    {

//ff
        $this->validate($request,[

        'name'=>'required',
        'email'=>'required|email',
        'message'=>'required',

        ]);
        $res = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'ip' => getIp()


        ]);

        return 1;
     }

    public function contact_list()
    {
        $contacts=Contact::orderBy('id','DESC')->paginate(30);
        return view('admin.contact_list',compact('contacts'));
    }
}
