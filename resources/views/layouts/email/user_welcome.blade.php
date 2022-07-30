@extends('layouts.email.master-store',  [
  	'title' => $title,
  	'email_support' => $email_support,
  ]
)
  @section('content')
  
  <p><b>{!! __('email.hi_email', [ 'email' => $user->name ]) !!}</b></p>
	
	<p>{!! __('email.user.welcome', ['app_name' => env('APP_NAME')] ) !!}</p>

	@if($token)
		<p>{!! __('email.user.go_to_create_password', [ 'token' => $user->password, 'base_url' => env('APP_URL') ]) !!}</p>
	@else
		<p>{!! __('email.user.go_to_login', [ 'base_url' => env('APP_URL') ] ) !!}</p>
	@endif

	@endsection
