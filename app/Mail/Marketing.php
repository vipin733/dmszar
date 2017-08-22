<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Marketing extends Mailable 
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       // return $this->view('emails.welcome');
            return $this->from('sales@dmszar.com','DMSZar.com Sales Team')
                ->subject('30 Days Free trial School ERP!')
                ->view('emails.school')
                //->param('o:tag', 'marketing')
                  //->attach('/email/1.pdf')
                 // ->attach(storage_path('app\public\email\Digital _school.pptx'))
                  ;
       // return $this->view('emails.school');
    }
}
