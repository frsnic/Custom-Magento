<?php
class Chiragdodia_Mymodule_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "Hello tuts+ World11111111111231";
    }

    public function testAction()
    {
      echo "test action"."<br>";
      
      /*
        Test 1 custom sql
      */
      $w = Mage::getSingleton('core/resource')->getConnection('core_write');
      $result = $w->query('select entity_id from catalog_product_entity');

      if (!$result) {
          return false;
      }

      $row = $result->fetch(PDO::FETCH_ASSOC);
      if (!$row) {
          return false;
      }
      else {
        echo "no result"."<br>";
        echo $result;
      }
      echo "<hr>";
      
      /*
        Test 2 use getModel get product 
      */
      $product = Mage::getModel('catalog/product')
                ->loadByAttribute('entity_id', 232);
                
      if($product !== false)
      {
        $newurl = $product->getProductUrl();
      }
      else
      {
        echo "not found";
      }
      echo $newurl."<br>";
      echo "<hr>";

      /*
        Test 3 get order 
      */
      Mage::app($mageRunCode,$mageRunType);
      $orders = Mage::getModel('sales/order')
      ->getCollection()
      ->addFieldToFilter('store_id', Mage::app()->getStore()->getId())
      ->addAttributeToFilter('status', Mage_Sales_Model_Order::STATE_COMPLETE)
      ->addAttributeToSort('entity_id', 'DESC');

      echo "<html><body>";

      foreach($orders as $order) {
          echo $order->getCustomerName() . "\t" .
          $order->getCustomerEmail() . "\r\n<br />";
      }
      echo "<hr>";
    }
}

