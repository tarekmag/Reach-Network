<?php

namespace App\Mail;

use App\Models\Ad;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdRemainderEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $advertiser;
    protected $ads;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($advertiser, $ads)
    {
        $this->advertiser = $advertiser;
        $this->ads = $ads;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['advertiserName'] = $this->advertiser->name;
        $data['ads'] = $this->ads;
        return $this->view('mail.ad-remainder-email')->with($data);
    }
}
