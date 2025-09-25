<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class BlogStatusMail extends Mailable
{
    public $name;
    public $status;

    public function __construct($name, $status)
    {
        $this->name = $name;
        $this->status = $status;
    }

    public function build()
    {
        return $this->subject("Your Blog Has Been {$this->status}")
                    ->view('emails.blog_status');
    }
}
