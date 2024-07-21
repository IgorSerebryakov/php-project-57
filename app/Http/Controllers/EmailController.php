<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendWelcomeEmail()
    {
        $toEmail = 'serebryakov09@mail.ru';
        $mailMessage = 'Welcome to TODOList';
        $subject = 'Welcome Email in Laravel';

        Mail::to($toEmail)->send(new WelcomeEmail($mailMessage, $subject));
    }
}
