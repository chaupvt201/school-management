@component('mail::message') 
Hello {{$user->name}}, 

<p> Quên mật khẩu </p> 

@component('mail::button', ['url' => url('reset/'.$user->remember_token)]) 
Reset mật khẩu
@endcomponent 

<p>Nếu cần hỗ trợ hãy liên hệ với chúng tôi </p> 

Thanks, <br> 
{{config('app.name')}} 
@endcomponent 
