<?php

namespace App\Http\Controllers;
use Notification;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\Contact\CreateContactRequest;

use App\Notifications\ThankYouForContactingHaloFinance;
use App\Notifications\ContactForm;

use Mail;

class ContactFormController extends Controller
{
    // Create Contact Form
    public function createForm(Request $request) {
        return view('contact.index');
      }
  
      // Store Contact Form data
      public function ContactForm(CreateContactRequest $request, Contact $contact) {
  
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
          $contact = Contact::create($request->all());
         
           //  Send mail to admin 
           \Notification::route('mail', config('mail.from.address'))->notify(new ContactForm($contact));
          
            // //  Send mail to entrant 
            $contact->notify(new ThankYouForContactingHaloFinance($contact));
            
          // success
          return back()->with('success', 'We have received your message and would like to thank you for writing to us.');

      }
}
