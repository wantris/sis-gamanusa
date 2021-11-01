<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailRegister extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($student)
    {
        $this->student = $student;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@gamanusa.com')
            ->subject('Pendaftaran Akun Berhasil')
            ->view('emails.success_register')
            ->with(
                [
                    'fullname' => $this->student->fullname,
                    'username' => $this->student->username,
                    'password' => "@Gamanusa123",
                    'nis' => $this->student->nis,
                ]
            );
    }
}
