<!DOCTYPE html>
<html>
	<head>
		<title>{!! $title !!}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
  	<link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
  	<meta name="theme-color" content="{{(session('themePrincipalColor')) ? session('themePrincipalColor') : '#ff084e' }}">
	</head>

	<body>
		<div style="max-width: 600px; margin:0 auto; font-family: Arial, Helvetica, sans-serif; color: dimgrey;" >
			<header>
				<div class="paragraphs">
					<div style="text-align: center; padding-top: 5px; padding-bottom: 3px; font-weight: bold;" >
						<span style="font-size: 30px; " >{{ env('APP_DOMAIN') }}</span>
					</div>
				</div>
			</header>
			<center>
				<h4 style="background: {{(session('themePrincipalColor')) ? session('themePrincipalColor') : '#ff084e' }}; border-bottom: solid 6px lightgray; border-top-left-radius: 5px; border-top-right-radius: 5px;  text-align: left; padding-top: 1.1em; padding-bottom: 1.1em; padding-left: 1.1em; font-size: 18px; ">
					<span style="color: white" >{!! $subject !!}</span>
				</h4>
			</center>

			<div style="font-family: Arial, Helvetica, sans-serif; color: dimgrey;" >
				@yield('content')
			</div>

			<p>{!! __('email.sincerely') !!}</p>

			<div style="text-align: left;">
				<hr size="1" width="70" style="margin: inherit; margin-bottom: .5em;" >	
			</div>
				
	 		<p style="padding: 0px; margin: 0px; " >
	 			{!! __('email.sign', [ 'team_name' => $team_name, 'store_legal_name' => $store_legal_name, 'domain_url' => $domain_url, 'email_support' => $email_support ]) !!}
	 		</p>
	 		<p><small>{!! __('email.faq', ['url_faq' => '#' ]) !!}</small></p>
	 		<br>

			<footer style="border-top: solid 0.5px #86c094; border-bottom: solid 0.5px #86c094; text-align: center; padding: 0px; margin: 0px; padding-top: .3em; padding-bottom: .3em;" >
				{!! __('email.footer', ['store_legal_name' => $store_legal_name]) !!}
			</footer>
		</div>	
	</body>
    
</html>