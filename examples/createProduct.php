<?php

  /*
  *
  * Example of using the PrestShop WebService to create a product with
  * its stock and its image
  *
  */

  define('DEBUG', true);
  define('_PS_DEBUG_SQL_', true);
  define('PS_SHOP_PATH', 'http://yourdomain.com');
  define('PS_WS_AUTH_KEY', '12345H26EDWN12345TSB512345HNUIFD');
  require_once ('../PSWebServiceLibrary.php');

  //Here we take the product schema and add our datas
  $webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
  $xml = $webService->get(array('url' => PS_SHOP_PATH . '/api/products?schema=blank'));
  $resources = $xml->children()->children();
  $resources->id;
  $resources->id_manufacturer;
  $resources->id_supplier;
  $resources->id_category_default=10;
  $resources->new;
  $resources->cache_default_attribute;
  $resources->id_default_image=1;
  $resources->id_default_combination;
  $resources->id_tax_rules_group;
  $resources->position_in_category;
  $resources->type="virtual";
  $resources->id_shop_default;
  $resources->reference = "ref_product";
  $resources->supplier_reference;
  $resources->location;
  $resources->width;
  $resources->height;
  $resources->depth;
  $resources->weight;
  $resources->quantity_discount;
  $resources->ean13;
  $resources->upc;
  $resources->cache_is_pack;
  $resources->cache_has_attachments;
  $resources->is_virtual;
  $resources->on_sale;
  $resources->online_only;
  $resources->ecotax;
  $resources->minimal_quantity;
  $resources->price = 22.65;
  $resources->wholesale_price;
  $resources->unity;
  $resources->unit_price_ratio;
  $resources->additional_shipping_cost;
  $resources->customizable;
  $resources->text_fields;
  $resources->uploadable_files;
  $resources->active=1;
  $resource->redirect_type;
  $resource->id_product_redirected;
  $resources->available_for_order = 1;
  $resources->available_date;
  $resources->condition;
  $resources->show_price=1;
  $resources->indexed;
  $resources->visibility;
  $resources->advanced_stock_management;
  $resources->date_add;
  $resources->date_upd;

  $node = dom_import_simplexml($resources->meta_description->language[0][0]);
  $no = $node->ownerDocument;
  $node->appendChild($no->createCDATASection("cdata meta description"));
  $resources->meta_description->language[0][0] = "meta description";
  $resources->meta_description->language[0][0]['id'] = 1;
  $resources->meta_description->language[0][0]['xlink:href'] = PS_SHOP_PATH . '/api/languages/1';

  $node = dom_import_simplexml($resources->meta_keywords->language[0][0]);
  $no = $node->ownerDocument;
  $node->appendChild($no->createCDATASection("cdata meta keywords"));
  $resources->meta_keywords->language[0][0] = "meta keywords1, keywords2, keywords3";
  $resources->meta_keywords->language[0][0]['id'] = 1;
  $resources->meta_keywords->language[0][0]['xlink:href'] = PS_SHOP_PATH . '/api/languages/1';

  $node = dom_import_simplexml($resources->meta_title->language[0][0]);
  $no = $node->ownerDocument;
  $node->appendChild($no->createCDATASection("cdata meta title"));
  $resources->meta_title->language[0][0] = "meta title";
  $resources->meta_title->language[0][0]['id'] = 1;
  $resources->meta_title->language[0][0]['xlink:href'] = PS_SHOP_PATH . '/api/languages/1';

  $node = dom_import_simplexml($resources->link_rewrite->language[0][0]);
  $no = $node->ownerDocument;
  $node->appendChild($no->createCDATASection("cdata link_rewrite"));
  $resources->link_rewrite->language[0][0] = "link-rewrite";
  $resources->link_rewrite->language[0][0]['id'] = 1;
  $resources->link_rewrite->language[0][0]['xlink:href'] = PS_SHOP_PATH . '/api/languages/1';

  $node = dom_import_simplexml($resources->name->language[0][0]);
  $no = $node->ownerDocument;
  $node->appendChild($no->createCDATASection("cdata name"));
  $resources->name->language[0][0] = "New product name";
  $resources->name->language[0][0]['id'] = 1;
  $resources->name->language[0][0]['xlink:href'] = PS_SHOP_PATH . '/api/languages/1';

  $node = dom_import_simplexml($resources->description->language[0][0]);
  $no = $node->ownerDocument;
  $node->appendChild($no->createCDATASection("cdata description"));
  $resources->description->language[0][0] = "description";
  $resources->description->language[0][0]['id'] = 1;
  $resources->description->language[0][0]['xlink:href'] = PS_SHOP_PATH . '/api/languages/1';

  $node = dom_import_simplexml($resources->description_short->language[0][0]);
  $no = $node->ownerDocument;
  $node->appendChild($no->createCDATASection("cdata description_short"));
  $resources->description_short->language[0][0] = "description_short";
  $resources->description_short->language[0][0]['id'] = 1;
  $resources->description_short->language[0][0]['xlink:href'] = PS_SHOP_PATH . '/api/languages/1';

  $node = dom_import_simplexml($resources->available_now->language[0][0]);
  $no = $node->ownerDocument;
  $node->appendChild($no->createCDATASection("cdata In stock"));
  $resources->available_now->language[0][0] = "In stock";
  $resources->available_now->language[0][0]['id'] = 1;
  $resources->available_now->language[0][0]['xlink:href'] = PS_SHOP_PATH . '/api/languages/1';

  $node = dom_import_simplexml($resources->available_later->language[0][0]);
  $no = $node->ownerDocument;
  $node->appendChild($no->createCDATASection("cdata available_later"));
  $resources->available_later->language[0][0] = "available_later";
  $resources->available_later->language[0][0]['id'] = 1;
  $resources->available_later->language[0][0]['xlink:href'] = PS_SHOP_PATH . '/api/languages/1';

  $resources->associations->categories->addChild('category')->addChild('id', 1);
  $resources->associations->categories->addChild('category')->addChild('id', 4);

  //Here we call to add a new product
  try {
    $opt = array('resource' => 'products');
    $opt['postXml'] = $xml->asXML();
    $xml_request = $webService->add($opt);

  } catch (PrestaShopWebserviceException $ex) {

    echo '<b>Error : '.$ex->getMessage().'</b>';
    $trace = $ex->getTrace();
    print_r($trace);

  }

  //We take the reponse of call to do
  $xml_response = $xml_request['response'];
  $response = new SimpleXMLElement($xml_response);
  $resources = $response->children()->children();

  /*
    When new product created a new stck available id was created and we can take this id to use.
   */
  $stock_available_id = $resources->associations->stock_availables->stock_available[0]->id;

  $id_created_product = $resources->id;


  /*
  Here we get the sotck available with were product id
   */
  try
  {

    $opt = array('resource' => 'stock_availables');
    $opt['id'] = $stock_available_id;
    $xml = $webService->get($opt);

  }
  catch (PrestaShopWebserviceException $e)
  {
    // Here we are dealing with errors
    $trace = $e->getTrace();
    if ($trace[0]['args'][0] == 404) echo 'Bad ID';
    else if ($trace[0]['args'][0] == 401) echo 'Bad auth key';
    else echo 'Other error<br />'.$e->getMessage();
  }

  $resources = $xml->children()->children();
  //There we put our stock
  $resources->quantity = 6666;

  /*
  There we call to save our stock quantity.
   */
  try
  {
    $opt = array('resource' => 'stock_availables');
    $opt['putXml'] = $xml->asXML();
    $opt['id'] = $stock_available_id;
    $xml = $webService->edit($opt);
    // if WebService don't throw an exception the action worked well and we don't show the following message
    echo "Successfully updated.";
  }
  catch (PrestaShopWebserviceException $ex)
  {
    // Here we are dealing with errors
    $trace = $ex->getTrace();
    if ($trace[0]['args'][0] == 404) echo 'Bad ID';
    else if ($trace[0]['args'][0] == 401) echo 'Bad auth key';
    else echo 'Other error<br />'.$ex->getMessage();
  }

  /*
  Here we add an image a created product
   */
  $url = "http://prestashop16.conf/api/images/products/$id_created_product";

  /**.
  * Uncomment the following line in order to update an existing image
  */
  //$url = 'http://myprestashop.com/api/images/products/1/2?ps_method=PUT';

  $image_path = '/path/your/image.jpg';

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_USERPWD, PS_WS_AUTH_KEY.':');
  curl_setopt($ch, CURLOPT_POSTFIELDS, array('image' => '@'.$image_path.';type=image/jpg'));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  curl_close($ch);