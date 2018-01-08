<?php
/**
 * Created by PhpStorm.
 * User: fpokoj
 * Date: 04.01.18
 * Time: 15:24
 */

namespace RFM\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class RFMExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('rfm.config', $config);

        foreach ($config as $key => $value) {
            $container->setParameter('rfm.' . $key, $value);
        }
    }
}