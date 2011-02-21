<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initView()
    {
        // initialize view
        $view = new Zend_View();
        
        // get it's configuration file
        $site = new Zend_Config_Ini(APPLICATION_PATH . '/configs/site.ini', APPLICATION_ENV);

        // doctype
        $view->doctype($site->doctype);
        
        // encoding
        $view->setEncoding($site->encoding);
        
        // title
        $view->headTitle($site->name)
             ->setSeparator(' | ')
             ->setIndent(8);
        
        // meta tags
        $view->headMeta()->setName('keywords', $site->keywords)
                         ->appendName('description', $site->description)
                         ->appendName('google-site-verification', $site->googleVerification)
                         ->setIndent(8);
        
        // stylesheets & feeds (headLinks)
        $view->headLink()->setStylesheet('/css/layout.css', 'all')
                         ->appendStylesheet('/css/default.css', 'all')
                         ->appendStylesheet('/css/menu.css', 'all')
                         ->appendStylesheet('/css/jquery_theme_modifier.css')
                         ->headLink(
                             array(
                                'rel' => 'favicon',
                                'href' => '/images/favicon.ico'
                            ),
                            'PREPEND'
                        )
                         ->headLink(
                             array(
                                'rel' => 'shortcut icon',
                                'href' => '/images/favicon.ico'
                            ),
                            'PREPEND'
                         )
                         ->appendAlternate('/feed/', 'application/rss+xml', 'News')
                         ->setIndent(8);

        // jQuery and javascript
        $view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
        $view->headScript()->appendFile('/js/default.js', 'text/javascript', 
            array(
                'charset' => $site->encoding
            )
        )->setIndent(8);
        
        // add it to the ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->setView($view);
        
        // register viewRenderer
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);

        // return it, so that it can be stored by the bootstrap
        return $view;
    }

    protected function _initMenu()
    {
        // include the menu configuration (xml)
        $config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/menu.xml', 'nav');

        // generate the container
        $container = new Zend_Navigation($config);

        // register it
        Zend_Registry::set('Zend_Navigation', $container);
    }

    protected function _initSession()
    {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/sessions.ini', APPLICATION_ENV);
 
        Zend_Session::setOptions($config->toArray());
        
        // start session
        Zend_Session::start();
    }
    
    protected function _initMessages()
    {
        Zend_Controller_Action_HelperBroker::addHelper(new Zend_Controller_Action_Helper_FlashMessenger());
    }

    protected function _initFeed()
    {
        // set cache frontend options
        $frontendOptions = array(
            'lifetime' => 86400,
            'automatic_serialization' => true
        );

        // set cache backend options
        $backendOptions = array('cache_dir' => APPLICATION_PATH . '/../data/cache');

        // configure cache
        $cache = Zend_Cache::factory(
            'Core', 'File', $frontendOptions, $backendOptions
        );

        // set feed to use cache and httpConditionalGet
        Zend_Feed_Reader::setCache($cache);
        Zend_Feed_Reader::useHttpConditionalGet();
    }
}
