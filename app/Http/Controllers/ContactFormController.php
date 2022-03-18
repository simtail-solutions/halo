<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\Contact\CreateContactRequest;

use Mail;

class ContactFormController extends Controller
{
    // Create Contact Form
    public function createForm(Request $request) {
        return view('contact.index');
      }
  
      // Store Contact Form data
      public function ContactForm(CreateContactRequest $request) {
  //dd($request->all());
          // Form validation
          $this->validate($request, [
              'firstName' => 'required',
              'lastName' => 'required',
              'businessName' => 'required',
              'email' => 'required|email',
              'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
              'message' => 'required'
           ]);
  
          //  Store data in database
          Contact::create($request->all());
          //dd($request->all());
    

           //  Send mail to admin 
            \Mail::send('contact.contactMail', array( 
                'firstName' => $request['firstName'], 
                'lastName' => $request['lastName'],
                'businessName' => $request['businessName'],
                'email' => $request['email'], 
                'phone' => $request['phone'], 
                'form_message' => $request['message']), 
                function($message) use ($request){ 
                    $message->from($request->email); 
                    $message->to('admin@admin.com', 'Admin')->subject('Contact form from' . ' ' . ($request->get('businessName'))); 
                    }); 
            //  Send mail to entrant 
            \Mail::send('contact.responseMail', array( 
                'firstName' => $request['firstName'], 
                'businessName' => $request['businessName'],
                'email' => $request['email']), 
                function($message) use ($request){ 
                    $message->from('admin@admin.com', 'Admin'); 
                    $message->to($request->email, $request->businessName)->subject('Thank you for contacting Halo Finance'); 
                    }); 
  
          // success
          return back()->with('success', 'We have received your message and would like to thank you for writing to us.');

      }
}
