<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Send extends Mailable
{
    use Queueable, SerializesModels;
    protected $config;
    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($config, $data)
    {
        $this->config = $config;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view($this->config['template'])
            ->with($this->data)
            ->from($this->config['from_email'], $this->config['from_name'])
            ->subject($this->config['subject']);
    }
}
