<?php


namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class TermNotification extends Mailable
{
    use Queueable;

    protected $term;

    public function __construct($term)
    {
        $this->term = $term;
    }

    public function build()
    {
        $this->from('lynx-test@email.com');
        $this->view('terms.new-term-notification')->with(['term' => $this->term]);
    }
}
