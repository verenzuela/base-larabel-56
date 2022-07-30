<?php

return [

  'hi_email' => 'Hola :email',
  'sincerely' => "<p style='padding:0px; margin:0px; ' >Atentamente,</p>",
  'faq' => '¿Tienes alguna pregunta?. Visitanos <a href=":url_faq" target="_blank">haciendo clic aquí</a> para ver nuestras página de preguntas frecuentes</a> ',
  'url' => 'URL',
  'the_team' => 'El equipo de :team_name',
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

  'footer' => '<small>:store_legal_name - Derechos de autor &copy;<script>document.write(new Date().getFullYear());</script> Todos los derechos reservados</small>',

  'user.welcome' => 'Bienvenido a :app_name!',

  'user.go_to_create_password' => 'Vaya al siguiente enlace para crear su contraseña.
    <br><br> 
    <a href=":base_url/en-US/password/reset/:token" target="_blank">:base_url/en-US/password/reset/:token</a> 
    <br><br>
    Si no puede hacer clic en el enlace, copie y pegue en la barra de navegación de su navegador favorito',
  'user.reset_password_subject' => 'Solicitud de restablecimiento de contraseña',
  'user.reset_password' => 'Hola :email.',
  'user.go_to_reset_password' => 'Estás recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para tu cuenta.
    <br><br> 
    Vaya al siguiente enlace para restablecer su contraseña.
    <br><br> 
    <a href=":base_url/en-US/password/reset/:token" target="_blank">:base_url/en-US/password/reset/:token</a> 
    <br><br>
    Si no puede hacer clic en el enlace, copie y pegue en la barra de navegación de su navegador favorito
    <br><br>
    <br><br>
    Este enlace de restablecimiento de contraseña caducará en 60 minutos.
    <br><br>
    Si no solicitó un restablecimiento de contraseña, no es necesario realizar ninguna otra acción.',

  'user.go_to_login' => 'Contacta con soporte para solicitar tus credenciales de acceso, si ya las tienes puedes ir al siguiente enlace para ingresar
    <br><br> 
    <a href=":base_url/login" target="_blank">:base_url/login</a>',
    
  'user.new_order.title' => 'Tu compra en :app_name.',
  'user.new_order.subject' => 'Tu compra en :app_name.',
  'user.new_order.thank_for_you_purchase' => 'Gracias por su compra, su número de pedido es: :order_number.',
  'user.new_order.instruction_for_pay_label' => 'Instrucciones para completar el pago de su pedido',
  'user.new_order.detail' => 'Detalle de la orden:',
  'user.new_order.bank_accounts' => 'Cuentas Bancarias',

  'user.order_updated.title' => 'Su pedido #:order_number.',
  'user.order_updated.subject' => 'Su pedido #:order_number en :app_name fue actualizado.',
  'user.order_updated.message' => 'Su número de orden <b>#:order_number</b> se ha actualizado y está en estado <b>:status</b>, si quieres conocer más detalles contáctanos o visita nuestro sitio web',
  'user.order_updated.detail' => 'Detalle de la orden:',

  'product.detail.product_title' => 'Producto',
  'product.detail.product_quantity' => 'Cantidad',
  'product.detail.product_price' => 'Precio',
  'product.detail.product_total' => 'Total',
  'product.detail.subtotal' => 'Sub-Total',
  'product.detail.discount' => 'Descuento',
  'product.detail.taxes' => 'Impuestos',
  'product.detail.total' => 'Total',

  'contact.new_message' => 'Nuevo mensaje de :app_name.',
  'contact.new_message_from_contact_page' => 'Un usuario ha enviado un mensaje desde la página de contacto de :app_name.',
  'contact.firstname' => 'Nombre',
  'contact.lastname' => 'Apellido',
  'contact.email' => 'Email',
  'contact.message' => 'Mensaje',

  'question.buyer_new_title' => 'Tu pregunta en :app_name',
  'question.buyer_new_subject' => 'Tu pregunta en :app_name fué recibida.',
  'question.your_question_has_received' => 'Tu pregunta ha sido recibida, nuestro equipo te responderá lo antes posible. <br><br> Gracias por elegir nuestros productos.',

  'question.admin_new_title' => 'Tienes una nueva pregunta',
  'question.admin_new_subject' => 'Tienes una nueva pregunta',
  'question.your_has_received_new_question' => 'Ha recibido una nueva pregunta del usuario <b>:user</b> sobre el articulo <b>:product</b>, a continuación tienes los detalles',
  'question.label.customer_name' => 'Cliente',
  'question.label.customer_email' => 'Correo electrónico del cliente',
  'question.label.product_name' => 'Nombre del producto',
  'question.label.question_body' => 'Pregunta',
  'question.label.for_reply_click_here' => 'Puedes responder <a href=":question_url" target="_blank">haciendo click aqui<a>, o copie y pegue el siguiente enlace en su navegador web',

  'reply.buyer_reply_title' => 'Tu pregunta en :app_name ha sido respondida',
  'reply.buyer_reply_subject' => 'Tu pregunta en :app_name ha sido respondida',
  'reply.buyer_has_received_reply' => 'Hemos respondido su pregunta sobre el producto <a href=":product_url" target="_blank">:product</a> en nuestra tienda :app_name',
  'reply.reply_detail' => 'Detalle de respuesta',
  'reply.label.question' => 'Pregunta',
  'reply.label.reply' => 'Respuesta',
  'reply.label.thank_you' => 'Gracias por elegirnos',
  'reply.hi_customer' => 'Hola :curtomer_name',

  'payment_notification.admin_new_title' => 'Nueva notificación de pago',
  'payment_notification.admin_new_subject' => 'El pedido #:order_number ha sido notificado como pagado',
  'payment_notification.your_has_received_new_payment' => '
    Tiene una nueva notificación de pago del pedido. #:order_number.
    <br>
    <br>
    Puede consultar el pedido <a href=":order_detail_url" target="_blank" >haciendo click aqui</a>
  ',

  'telegram.new_question' => '<b>[NUEVA PREGUNTA]</b> Tienes una nueva pregunta sobre el producto (:product_name) en tu tienda (:domain_name).%0A%0APregunta: "<b>:question_body</b>"%0A%0APuede responder haciendo clic en el siguiente enlace. :question_url',
  'telegram.new_order' => '<b>[NUEVO PEDIDO]</b>%0ATienes un nuevo pedido en tu tienda (:domain_name)%0A%0A<b>Detalle de pedido:</b>%0ANumero: :order_number%0AMonto: :amount%0A%0APuedes ver el detalle de tu pedido haciendo click en el siguiente enlace :order_url',
  'telegram.new_contact' => '<b>[NUEVO MENSAJE]</b>%0AHas recibido un nuevo mensaje en tu tienda (:domain_name).%0A%0ADetalles del mensaje:%0A%0AEmail: :user_email%0AMensaje: :message',
  'telegram.payment_notification' => '<b>[Nueva Notificacion de Pago]</b>%0AHas recibido una nueva notificación de pago del pedido (:order_number) en tu tienda (:domain_name).%0A%0APuedes ver el detalle de tu pedido haciendo click en el siguiente enlace :order_url',

  'whatsapp.new_question' => 'Nueva pregunta en tu tienda en ShopiLite, responde haciendo clic en el siguiente enlace. :question_url',
  'whatsapp.new_order' =>'Nuevo pedido en tu tienda ShopiLite, puedes verlo haciendo click en el siguiente enlace. :order_url',
  'whatsapp.new_contact' =>'Se envió un nuevo mensaje desde su tienda en ShopiLite, entregado al siguiente correo electrónico :email_delivered, por favor verifique pronto...',
  'whatsapp.payment_notification' =>'Nueva notificación de pago para el pedido :order_number, puedes ver el detalle haciendo click en el siguiente enlace. :order_url',

];