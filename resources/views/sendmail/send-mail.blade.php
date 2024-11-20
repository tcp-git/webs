<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DHS {{ $subject }}</title>
</head>

<body >
    <div class="email">
        {{-- <img src="{{url('/external/h1i123-svnr-200h.png')}}" alt="Image" /> --}}
        <img src="https://static.wixstatic.com/media/5e1ad1_11bf3e4eb45a4446ad643984e4c6c333~mv2.png/v1/fill/w_239,h_42,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/LogoColorTextLand.png"
            alt="Image" />

        <h4>{{ $subject }} {{ $name }}</h4>
        <p>{{ $mailMessage }}</p>
        <h4>รหัส OTP {{ $otp }} Ref : {{$ref}} เพื่อเข้าระบบภายใน {{now()->addMinute(5)->addHour(7)}}</h4>
        
    </div>
</body>

</html>
