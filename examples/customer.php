<?php

  /*
  *
  * Example of using the PrestShop WebService to create and edit customers
  *
  */

  define('DEBUG', true);
  define('_PS_DEBUG_SQL_', true);
  define('PS_SHOP_PATH', 'http://yourdomain.com');
  define('PS_WS_AUTH_KEY', '12345H26EDWN12345TSB512345HNUIFD');
  require_once ('../PSWebServiceLibrary.php');
  /*
  *
  * Using the PrestShop WebService to create a new customer
  *
  */

function createCustomer($passwd, $lastname, $firstname, $email) {

      //Here we take the customer schema and add our datas
      $webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
      $xml = $webService->get(array('url' => PS_SHOP_PATH . '/api/customers?schema=blank'));
      $resources = $xml->children()->children();
      $resources->id_default_group = 3;
      $resources->passwd = $passwd;
      $resources->lastname = $lastname;
      $resources->firstname = $firstname;
      $resources->email = $email;
      $resources->active = true;
      $resources->associations->groups->group->id = 3;

      //Here we call to add a new customer
      try {
        $opt = array('resource' => 'customers');
        $opt['postXml'] = $xml->asXML();
        $xml_request = $webService->add($opt);

      } catch (PrestaShopWebserviceException $ex) {

        echo '<b>Error : '.$ex->getMessage().'</b>';
        $trace = $ex->getTrace();
        print_r($trace);

      }
}

  /*
  *
  * Using the PrestShop WebService to edit a customer
  *
  */

function editCustomer($passwd, $lastname, $firstname, $oldemail, $newemail) {

      //Here we take the customer schema and add our datas
      $webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
      $xml = $webService->get(array('url' => PS_SHOP_PATH . '/api/customers?filter[email]=['.$oldemail.']'));
      $resources = $xml->children()->children();
      $attr = $resources->customer->attributes();
      $id = $attr['id'];
      $xml = $webService->get(array('url' => PS_SHOP_PATH . '/api/customers/'.$id.''));
      $resources = $xml->children()->children();
      $resources->id_default_group = 3;
      $resources->passwd = $passwd;
      $resources->lastname = $lastname;
      $resources->firstname = $firstname;
      $resources->email = $newemail;
      $resources->active = true;
      $resources->associations->groups->group->id = 3;

      //Here we call to edit a customer
      try {
        $opt = array('resource' => 'customers');
        $opt['putXml'] = $xml->asXML();
        $opt['id'] = $id;
        $xml_request = $webService->edit($opt);

      } catch (PrestaShopWebserviceException $ex) {

        echo '<b>Error : '.$ex->getMessage().'</b>';
        $trace = $ex->getTrace();
        print_r($trace);

      }
}

?>