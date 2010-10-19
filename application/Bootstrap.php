<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initView()
    {
        // initialize view
        $view = new Zend_View();

        // doctype
#        $view->doctype('XHTML1_STRICT');
        
        // encoding
#        $view->setEncoding('UTF-8');
        
        // title
#        $view->headTitle('Ofelia')
#             ->setSeparator(' | ')
#             ->setIndent(8);
        
        // meta tags
        $view->headMeta()->appendHttpEquiv('Content-Language', 'en-US')
                         ->setName('keywords', 'Ofelia, Open-ended Front-end')
                         ->appendName('description', "PHPCabal's Open-ended Front-end")
                         ->appendName('google-site-verification', '')
                         ->setIndent(8);
        
        // stylesheets & feeds (headLinks)
        $view->headLink()->setStylesheet('/css/default.css', 'all')
                         ->appendStylesheet('/css/menu.css', 'all')
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
                         ->appendAlternate('/feed/', 'application/rss+xml', 'Noticias Generales')
                         ->setIndent(8);
        // javascript
        $view->headScript()->appendFile('/js/default.js', 'text/javascript', 
            array(
                'charset' => 'utf-8'
            )
        )->setIndent(8);

        // add it to the ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->setView($view);

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
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/sessions.ini', 'development');
 
        Zend_Session::setOptions($config->toArray());
        
        // start session
        Zend_Session::start();
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
