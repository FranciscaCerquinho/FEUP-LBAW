<?php

namespace App;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;


    protected $email;
    protected $name;
    protected $sub;
    protected $msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $subject,$msg)
    {
        $this->email = $email;
        $this->name = $name;
        $this->sub = $subject;
        $this->msg=$msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from('topbid@gmail.com')
                  ->view('emails.sendContactUs')
                  ->subject($this->sub)
                  ->with(
                    [
                          'email' => $this->email,
                          'name' => $this->name,
                          'msg' => $this->msg,
                    ]);
    }
}
