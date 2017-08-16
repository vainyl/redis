<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Redis
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Redis\Extension;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Vainyl\Core\Exception\MissingRequiredServiceException;

/**
 * Class RedisScriptCompilerPass
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class RedisScriptCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        if (false === ($container->hasDefinition('redis.script.storage'))) {
            throw new MissingRequiredServiceException($container, 'redis.script.storage');
        }

        $storageDefinition = $container->getDefinition('redis.script.storage');
        foreach ($container->findTaggedServiceIds('redis.script') as $id => $tags) {
            $storageDefinition
                ->addMethodCall('addScript', [new Reference($id)]);
        }

        return $this;
    }
}