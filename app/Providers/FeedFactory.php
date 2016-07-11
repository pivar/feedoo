<?php
namespace App\Providers;

/*******
 @description : Factory for the feeds
 @author : Ravi T
 @authdate : 12 July 16
********/

class FeedFactory {
    protected $factoryConfig = array();
    protected $objFeeds;
    function __construct($config)
    {
        $this->factoryConfig = $config;
    }
    public function feedmaker()
    {
      try{
        // load feed from config url using simplexml
        $xml = simplexml_load_file($this->factoryConfig['feed_url']);
        // parse into object which can be forwarded to Providers
        // here channel->item is the path within XML we are
        // interested in mostly
        $this->objFeeds =(object) $xml->channel->item;
        // return the object
        return $this->objFeeds;
      }catch(\Exception $e){
        return array('error'=>'URL seems invalid or not working...');
      }

    }
}
