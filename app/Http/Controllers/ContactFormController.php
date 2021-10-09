<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactFormController extends Controller
{
    // Create Contact Form
    public function createForm(Request $request) {
        return view('contact.index');
      }
  
      // Store Contact Form data
      public function ContactForm(Request $request) {
  
          // Form validation
          $this->validate($request, [
              'firstName' => 'required',
              'lastName' => 'required',
              'email' => 'required|email',
              'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
              'message' => 'required'
           ]);
  
          //  Store data in database
          Contact::create($request->all());
  
          // 
          return back()->with('success', 'We have received your message and would like to thank you for writing to us.');

      }
}
