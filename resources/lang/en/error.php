<?php

return [
  'unauthorized' => 'Unauthorized',
  'not_permissions' => 'You don\'t have permission to execute this function',
  'server_error' => 'Server Error',
  'not_found' => 'Not Found',
  'integrity_constraint' => 'Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails, (The item you are trying to delete has one or more associated items)',

  'can_not_delete_main_category' => 'You can not delete <strong>Main Category</strong>',
  'can_not_edit_main_category' => 'You can not edit <strong>Main Category</strong>',

  'product_need_least_one_attr' => 'The product need least one attribute',
  'error_limit_images' => 'Only 6 images per product allowed',
  'title-warning' => 'Warning!',

  'quantity_is_not_valid' => 'The quantity is not valid, enter a valid number',
  'product_is_sold_out' => 'Product sold out',
  'quantity_not_set' => 'Quantity no set.',
  'error_adding_product_in_cart' => 'Error adding product in cart.',
  'unknown_error' => 'Unknown error',
  'product_stock_not_available' => 'Product stock not available',

  'attribute_no_select' => 'Select :attribute_name to continue.',

  'something_wrong_processing_paypal' => 'Something wrong has happened processing your payment with PayPal.',
  'validation_only_permited_values' => 'Error only the following values are allowed :values',

  'checkout.data_required' => 'Error, required data is missing, check first.',
  'checkout.error_processing_payment' => 'Error processing payment, try again.',
  'unsuported_payment_type_currency' => 'This type of payment does not support the active currency in your store',

  'paypal_direct_payment' => '
    <div class="container">
      <p style="color: green;">
        Your order has been created, but your payment was not processed due to the following errors:
      </p>  
      <br>
      <p style="color: red;">
        <strong>Error Code:</strong> :code
        <br>
        <strong>Error message:</strong> :message
        <br>
        <strong>Error detail:</strong> :detail
      </p>
      <br>
      <p style="color: green; text-align: center;">
        <strong>To go to the order detail and proceed with the payment <a href=":order_detail_url" style="color:blue">click here</a></strong>
      </p>
    </div>
  ',
  
  'error_getting_order_detail' => 'Error getting order detail',
  'error_getting_payment_gateway' => 'Error getting payment gateway',
  'error_getting_paypal_url' => 'Error getting PayPal url',
  'not_enabled_payment_gateway' => 'Sorry payment gateway is not enabled',

];