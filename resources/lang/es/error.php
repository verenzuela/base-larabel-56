<?php
return [
  'unauthorized' => 'No autorizado',
  'not_permissions' => 'No tienes permiso para ejecutar esta función',
  'server_error' => 'Error del Servidor',
  'not_found' => 'No encontrado',
  'integrity_constraint' => 'Restricción de integridad de datos: 1451 No se puede eliminar o actualizar una fila principal: falla una restricción de clave externa, (El elemento que intentas eliminar tiene uno o mas items asociados)',

  'can_not_delete_main_category' => 'No puedes borrar <strong>categoria principal</strong>',
  'can_not_edit_main_category' => 'No puedes editar <strong>categoria principal</strong>',

  'product_need_least_one_attr' => 'El producto necesita al menos un atributo',
  'error_limit_images' => 'Solo se permiten 6 imágenes por producto',
  'title-warning' => 'Advertencia!',

  'quantity_is_not_valid' => 'La cantidad no es válida, ingrese un número válido',
  'product_is_sold_out' => 'Producto agotado',
  'quantity_not_set' => 'Cantidad no establecida.',
  'error_adding_product_in_cart' => 'Error al agregar producto en el carrito.',
  'unknown_error' => 'Error desconocido',
  'product_stock_not_available' => 'Stock de producto no disponible',

  'attribute_no_select' => 'Seleccione :attribute_name para continuar.',

  'checkout.data_required' => 'Error, faltan datos requeridos, verifique primero...',
  'checkout.error_processing_payment' => 'Error al procesar el pago, inténtalo de nuevo',
  'unsuported_payment_type_currency' => 'Este tipo de pago no soporta la moneda activa en su tienda',

  'paypal_direct_payment' => '
    <div class="container">
      <p style="color: green;">
        Se ha creado su pedido, pero su pago no se procesó debido a los siguientes errores:
      </p>  
      <br>
      <p style="color: red;">
        <strong>Código de error:</strong> :code
        <br>
        <strong>Mensaje de error:</strong> :message
        <br>
        <strong>Detalle del error:</strong> :detail
      </p>
      <br>
      <p style="color: green; text-align: center;">
        <strong>Para ir al detalle del pedido y proceder con el pago <a href=":order_detail_url" style="color:blue">haga clic aquí</a></strong>
      </p>
    </div>
  ',

  'error_getting_order_detail' => 'Error obteniendo detalle del pedido',
  'error_getting_payment_gateway' => 'Error obteniendo detalles de pasarela de pago',
  'error_getting_paypal_url' => 'Error obteniendo url de autorización de Paypal',
  'not_enabled_payment_gateway' => 'Lo sentimos, esta pasarela de pago no se encuentra activa',
  
];