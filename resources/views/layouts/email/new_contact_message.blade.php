@extends('layouts.email.master-store',  [
  	'title' => $title,
  	'email_support' => $email_support,
  ]
)
  @section('content')

  	<p>{!! __('email.contact.new_message_from_contact_page', ['app_name' => env('APP_NAME')] ) !!}</p>

    <p>
      @if($data['firstname'])
        {!! __('email.contact.firstname') . ':' . $data['firstname'] !!}<br>
      @endif
      @if($data['lastname'])
        {!! __('email.contact.lastname') . ':' . $data['lastname'] !!}<br>  
      @endif

      {!! __('email.contact.email') . ':' !!}  <a href="mailto:{!! $data['email'] !!}">{!! $data['email'] !!}</a><br>
      <strong>{!! __('email.contact.message') . ':' !!}</strong><br>
      {!! $data['message'] !!}
    </p>

    <br>

	@endsection
