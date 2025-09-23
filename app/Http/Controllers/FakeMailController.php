<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SendCustomMail;
use Illuminate\Support\Facades\Mail;

class FakeMailController extends Controller
{
    public function send()
    {
        $message = "This is a fake mail just for testing in Laravel!";

        // Send email
        Mail::to('test@example.com')->send(new SendCustomMail($message));

        return "Fake mail sent! Check storage/logs/laravel.log";
    }
}
