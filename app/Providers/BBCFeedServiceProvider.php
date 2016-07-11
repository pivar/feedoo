<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;

/*******
 @description : ServiceProvider for feeds, getting config params to load feeds
 @author : Ravi T
 @authdate : 12 July 16
********/

class BBCFeedServiceProvider extends ServiceProvider {
  public function boot(){}
  public function register(){ $this->registerFeedFactory(); }
    public function registerFeedFactory(){
        // get config values from ENV file
        // separate config can be made here for multi urls
        $config = array('feed_url' =>env('FEED_URL'), 'item_limit' => env('FEED_ITEM_LIMIT', 10));
        
        $this->app->bindShared('bbcfeed', function () use ($config) {
            if (!$config['feed_url']) {
                throw new \RunTimeException('Seems you missed Feed URL parameter in config file ?');
            }
            return new FeedFactory($config);
        });
    }

    public function provides()
    {
        return ['bbcfeed'];
    }
}
