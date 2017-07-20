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

namespace Vainyl\Redis;

use Vainyl\Database\AbstractDatabase;

/**
 * Class AbstractRedis
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractRedis extends AbstractDatabase implements RedisInterface
{
    /**
     * @inheritDoc
     */
    public function clear()
    {
        return $this->flush();
    }

    /**
     * @inheritDoc
     */
    public function getMultiple($keys, $default = null)
    {
        return $this->mGet($keys);
    }

    /**
     * @inheritDoc
     */
    public function has($key)
    {
        return $this->exists($key);
    }

    /**
     * @inheritDoc
     */
    public function setMultiple($values, $ttl = null)
    {
        return $this->mSet($values);
    }
}