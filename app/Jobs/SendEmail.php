<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\PostEmail as SendEmailTestMail;
use Mail;
class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        //
         $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        $email = new SendEmailTestMail();

        //loop
        if($details) {
            foreach($details as $detail) {
                //Mail::to($this->details['email'])->send($email);
                $em = $detail['email'];
                $unme = $detail['uname'];
                Mail::send($email, $detail['data'], function($message) use($em, $unme) {
                    $message->to($em, $unme)->subject
                       ('Post subscription successfull');
                    $message->from(config("mail.from.address"), config("mail.from.name"));
                 });
                
            }
        }
        
        
    }
}
