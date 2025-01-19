@component('mail::message')
# @lang('Welcome, :userName!', ['userName' => 'Nguyen Trong Hieu'])

@lang('Thank you for registering with :siteName. Below is your default password to access your account.', ['siteName' => config('setting.site.name')])

@component('mail::panel')
@lang('Your Default Password:') **{{ $code }}**
@endcomponent

@component('mail::button', ['url' => 'asdasd'])
@lang('Log In Now')
@endcomponent

@lang('If you have any questions, feel free to contact our support team at :contact.', ['contact' => 'asdasd'])

Thanks,<br>
{{ config('setting.site.name') }}
@endcomponent
