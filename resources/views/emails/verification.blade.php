@props(['otp_code'])
<x-mail::message>
<style>
.ev-img{
    width: 150px;
    margin-inline: auto;
}
.ev-content{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-content: center;
    width: 100%;
}
.ev-title{
    text-align: center !important;
    margin-top: 15px;
    font-size: 30px;
}
.ev-blocks-container{
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    margin-bottom: 10px
}
.ev-block{
    border: 1px solid #d4d4d4;
    height: 50px;
    width: 50px;
    border-radius: 4px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: 500px;
    font-size: 25px;
}
</style>
<div class="ev-content">
    <img class="ev-img" src="http://localhost:8000/storage/icons/password.png" alt="verification icon">
    <h1 class="ev-title">Welcome! Here’s Your OTP Code</h1>
    <div class="ev-blocks-container">
        @for ($index = 0;$index <= strlen($otp_code) - 1;$index++)
        <div class="ev-block">{{ $otp_code[$index] }}</div>
        @endfor
    </div>
    <h2 style="text-align:center;">Use this One-Time Password to Continue</h2>
</div>
<p>If you didn't request this OTP, you can ignore this email. Your account is secure.</p>
<p>Contact our support team if you have any questions or need assistance.</p>

</div>
</x-mail::message>
