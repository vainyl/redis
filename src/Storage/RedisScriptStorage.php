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

namespace Vainyl\Redis\Storage;

use Vainyl\Core\Storage\Decorator\AbstractStorageDecorator;
use Vainyl\Redis\RedisScriptInterface;

/**
 * Class RedisScriptStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class RedisScriptStorage extends AbstractStorageDecorator implements RedisScriptStorageInterface
{
    /**
     * @inheritDoc
     */
    public function addScript(RedisScriptInterface $redisScript): RedisScriptStorageInterface
    {
        $this->offsetSet($redisScript->getId(), $redisScript);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getScript(string $hash): RedisScriptInterface
    {
        return $this->offsetGet($hash);
    }
}