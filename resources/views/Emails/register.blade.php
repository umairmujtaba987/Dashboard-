@component('mail::message')

    <p>Hello {{$user->name}}</p>
    <p>"You are verified successfully now you can login to our system". </p>
    
@component('mail::button',['url' => url('account/login')])
    Log in
@endcomponent

<p>Thank You</p>



@endcomponent