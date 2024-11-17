<?php


namespace App\Http\Traits;


use Illuminate\Support\Facades\Mail;

trait SendEmail
{
    protected function sendEmailFun($email, $user_name, $code, $subject)
    {
        try {
            $contact_company = setting()->name;
            Mail::send([
                'html' => 'Email.email-tem'],
                ['code' => $code,'user_name' => $user_name],
                function ($message) use ($email, $user_name, $subject, $contact_company) {
                    $message->to($email, $user_name)->from('noreply@hardycx.com', $contact_company)->subject($subject);
                }
            );
            info('email sent to ' . $email);
        } catch (\Exception $e) {
            info('email exception ' . $e->getMessage());
        }
    }

}
