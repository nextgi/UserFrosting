<?php

namespace UserFrosting\Sprinkle\Account\Extension;

use Interop\Container\ContainerInterface;
use RocketTheme\Toolbox\ResourceLocator\UniformResourceLocator;
use Slim\Http\Uri;

class AccountExtension extends \Twig_Extension
{

    protected $services;
    protected $config;

    public function __construct(ContainerInterface $services)
    {
        $this->services = $services;
        $this->config = $services->get('config');
    }

    public function getName()
    {
        return 'userfrosting/account';
    }
    
    public function getFunctions()
    {        
        return array(
            // Add Twig function for checking permissions during dynamic menu rendering
            new \Twig_SimpleFunction('checkAccess', function ($hook, $params = []) {
                return $this->services['currentUser']->checkAccess($hook, $params);
            })
        );
    }
    
    public function getGlobals()
    {
        return array(
            'currentUser'   => $this->services['currentUser']
        );
    }

}