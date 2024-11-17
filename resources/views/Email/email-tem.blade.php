<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            background-color: #f5f8fa;
            font-family: Arial, sans-serif;
            color: #2F3133!important;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #363657;
            padding: 20px;
            color: #fff;
            text-align: center;
        }

        .body {
            padding: 40px;
            background-color: #fcf8f8;
            text-align: center;
        }

        .footer {
            background-color: #363657;
            padding: 20px;
            color: #aeaeae;
            font-size: 12px;
            text-align: center;
        }

        .title {
            color: #2F3133;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        h3 {
            color: #2F3133;
        }

        .otp {
            font-size: 22px;
            font-weight: bold;
            margin: 20px 0;
            color: #500050;
        }

        .note {
            background-color: #fff3cd;
            border-left: 5px solid #ffecb5;
            color: #856404;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
            display: inline-block;
            width: 100%;
            box-sizing: border-box;
        }

        .note strong {
            font-weight: bold;
        }

        .note a {
            color: #856404;
            text-decoration: underline;
        }

        .thanks {
            margin-top: 30px;
            font-size: 16px;
            color:  #2F3133;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .container {
                width: 100%;
                margin: 20px;
                padding: 0;
                box-shadow: none;
            }

            .body, .header, .footer {
                padding: 20px;
            }

            .otp {
                font-size: 20px;
            }

            .note {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <a href="{{ asset('/') }}">
                <img src="{{ get_file(setting()->logo) }}" width="150" height="50" alt="{{setting()->name}}">
            </a>
        </div>

        <!-- Email Body -->
        <div class="body">
            <h1 class="title">Email Verification</h1>
            <h3>Hey {{$user_name}}</h3>
            <h3>Your one-time password (OTP) is:</h3>
            <div class="otp">{{$code}}</div>
            <h3>Please use this OTP to verify your email address. </h3>

            <!-- Styled Note -->
            <div class="note">
                <strong>Note:</strong> This is a temporary OTP which will expire in 15 minutes.
                If there’s been a mistake, visit <a href="https://hardycx.com">hardycx.com</a> or email our customer support for any help.
            </div>

            <p class="thanks">Thanks,<br><strong>Hardy Cx team</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Copyright © <strong>{{setting()->name}}</strong> {{ date('Y') }}.</p>
        </div>
    </div>

</body>
</html>
