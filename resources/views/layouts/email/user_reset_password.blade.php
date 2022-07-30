@extends('layouts.email.master-store', 
  ['title' => $title,
  ]
)
  @section('content')
				
		<p>{!! __('email.user.reset_password', [ 'email' => $email ] ) !!}</p>

		<p>{!! __('email.user.go_to_reset_password', [ 'token' => $token, 'base_url' => env('APP_URL') ]) !!}</p>
		
		<br>
		<hr>
		<br>
		
		<p><small>{!! __('email.faq', ['url_faq' => '#']) !!}</small></p>

	@endsection
