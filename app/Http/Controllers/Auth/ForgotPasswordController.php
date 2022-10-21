<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /*
        To enable 'Forgot Your Password' feature for Auth, do the following steps:
        -   register in: https://mailtrap.io
        -   go to Sandbox > Inboxes > Integrations > Select 'Laravel 7+'
        -   copy the values and paste them into the .env file of the project
            ex.
                MAIL_MAILER=smtp
                MAIL_HOST=smtp.mailtrap.io
                MAIL_PORT=2525
                MAIL_USERNAME=8fe9241b801557
                MAIL_PASSWORD=2c63074963522a
                MAIL_ENCRYPTION=tls
        -   if the project is running through 'php artisan serve', you need to stop the project by CTRL + C
        -   afterwards, in the terminal, run this command: php artisan config:cache
        -   you can now run the project again and use the 'Forgot Your Password' feature.
    */
}
