<?php

return [

	'hi_email' => 'Hi :email',
	'sincerely' => "<p style='padding:0px; margin:0px; ' >Sincerely,</p>",
	'faq' => 'Do you have any question?. Visit our <a href=":url_faq" target="_blank">Click here to visit our FAQ</a> ',
	'url' => 'URL',
	'the_team' => 'The :team_name team ',
	'sign' => "
    <p style='padding:0px; margin:0px; font-weight:bold;' >:team_name.</p>
    <p style='padding:0px; margin:0px; ' > 
      <a href=':domain_url' target='_blank' > <small>:domain_url</small> </a> 
    </p>
    <p style='padding:0px; margin:0px; line-height: 1em;' > <small>:store_legal_name</small> </p>
    <p style='padding:0px; margin:0px; line-height: 1em;' > 
      <small> <a href='mailto::email_support' >:email_support</a> </small> 
    </p>
  ",

	'footer' => '<small>:store_legal_name - Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved </small>',

	'user.welcome' => 'Welcome to :app_name!',

	'user.go_to_create_password' => 'Go to the following link to create your password.
		<br><br> 
		<a href=":base_url/en-US/password/reset/:token" target="_blank">:base_url/en-US/password/reset/:token</a> 
		<br><br>
		If you cannot click on the link, copy and paste in the navigation bar of your favorite browser',
	'user.reset_password_subject' => 'Request for reset password',
	'user.reset_password' => 'Hello :email.',
	'user.go_to_reset_password' => 'You are receiving this email because we received a password reset request for your account.
		<br><br> 
		Go to the following link to reset your password.
		<br><br> 
		<a href=":base_url/en-US/password/reset/:token" target="_blank">:base_url/en-US/password/reset/:token</a> 
		<br><br>
		If you cannot click on the link, copy and paste in the navigation bar of your favorite browser
		<br><br>
		<br><br>
		This password reset link will expire in 60 minutes.
		<br><br>
		If you did not request a password reset, no further action is required.',

	'user.go_to_login' => 'Contact support to request your access credentials, if you already have them you can go to the following link to enter
		<br><br> 
		<a href=":base_url/login" target="_blank">:base_url/login</a>',

	'user.new_order.title' => 'Your purchase in :app_name.',
	'user.new_order.subject' => 'Your purchase in :app_name.',
	'user.new_order.thank_for_you_purchase' => 'Thank you for your purchase, your order number is: :order_number.',
	'user.new_order.instruction_for_pay_label' => 'Instructions to complete the payment of your order',
	'user.new_order.detail' => 'Order detail:',
	'user.new_order.bank_accounts' => 'Bank Accounts',

	'user.order_updated.title' => 'Your order #:order_number.',
	'user.order_updated.subject' => 'Your order #:order_number in :app_name was updated.',
	'user.order_updated.message' => 'Your order number <b>#:order_number</b> has been updated, and is in status <b>:status</b>, if you want to know more detail contact us or visit our website',
	'user.order_updated.detail' => 'Order detail:',

	'product.detail.product_title' => 'Product',
	'product.detail.product_quantity' => 'Quantity',
	'product.detail.product_price' => 'Price',
	'product.detail.product_total' => 'Total',
	'product.detail.subtotal' => 'Sub-Total',
	'product.detail.discount' => 'Discount',
	'product.detail.taxes' => 'Taxes',
	'product.detail.total' => 'Total',

	'contact.new_message' => 'New message from :app_name.',
	'contact.new_message_from_contact_page' => 'A user has sent a message from the contact page of :app_name.',
	'contact.firstname' => 'Firstname',
	'contact.lastname' => 'Lastname',
	'contact.email' => 'E-mail',
	'contact.message' => 'Message',
	
	'question.buyer_new_title' => 'You question on :app_name',
	'question.buyer_new_subject' => 'You question on :app_name as received.',
	'question.your_question_has_received'	=> 'Your question has been received, our team will reply as soon as possible <br><br> Thank you for choosing our products.',

	'question.admin_new_title' => 'You have a new question',
	'question.admin_new_subject' => 'You have a new question',
	'question.your_has_received_new_question' => 'You have received a new question from the user :user about the article :product, below the details',
	'question.label.customer_name' => 'Customer',
	'question.label.customer_email' => 'Customer e-mail',
	'question.label.product_name' => 'Product name',
	'question.label.question_body' => 'Question',
	'question.label.for_reply_click_here' => 'You can respond by <a href=":question_url" target="_blank">clicking here<a>, or copy and paste the following link into your web browser',

	'reply.buyer_reply_title' => 'Your question in :app_name has been answered',
	'reply.buyer_reply_subject' => 'Your question in :app_name has been answered',
	'reply.buyer_has_received_reply' => 'We have answered your question about the product <a href=":product_url" target="_blank">:product</a> in our store :app_name',
	'reply.reply_detail' => 'Reply detail',
	'reply.label.question' => 'Question',
	'reply.label.reply' => 'Reply',
	'reply.label.thank_you' => 'Thanks for choosing us',
	'reply.hi_customer' => 'Hi :curtomer_name',

	'payment_notification.admin_new_title' => 'New payment notification',
	'payment_notification.admin_new_subject' => 'Order #:order_number has been notified as paid',
	'payment_notification.your_has_received_new_payment' => '
		You have a new payment notification pertaining to order #:order_number.
		<br>
		<br>
		You can check the order by <a href=":order_detail_url" target="_blank" >clicking here</a>
	',

	'telegram.new_question' => '<b>[NEW QUESTION]</b>%0AYou have a new question about the product (:product_name) in your store (:domain_name).%0A%0AQuestion: "<b>:question_body</b>"%0A%0AYou can answer by clicking on the following link. :question_url',
	'telegram.new_order' => '<b>[NEW ORDER]</b>%0AYou have a new order in your store (:domain_name)%0A%0A<b>Order detail:</b>%0ANumber: :order_number%0AAmount: :amount%0A%0AYou can see the details of the order by clicking on the following link :order_url',
	'telegram.new_contact' => '<b>[NEW CONTACT MESSAGE]</b>%0AYou have received a new message in you store (:domain_name).%0A%0ADetails below:%0A%0AUser email: :user_email%0AMessage: :message',
	'telegram.payment_notification' => '<b>[NEW PAYMEN NOTIFICATION]</b>%0AYou have a payment notification about the order (:order_number) in your store (:domain_name).%0A%0AYou can see the details of the order by clicking on the following link :order_url',

	'whatsapp.new_question' => 'New question on your ShopiLite store, reply clicking on the following link. :question_url',
	'whatsapp.new_order' =>'New order on your ShopiLite store, you can see clicking on the following link. :order_url',
	'whatsapp.new_contact' =>'New message was sent on your ShopiLite store, delivered to the following email :email_delivered, please check as soon...',
	'whatsapp.payment_notification' =>'New payment notification for order :order_number, you can see clicking on the following link. :order_url',


];
