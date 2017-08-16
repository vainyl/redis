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

namespace Vainyl\Redis\Exception;

use Vainyl\Cache\CacheInterface;
use Vainyl\Core\Exception\AbstractCoreException;
use Vainyl\Database\DatabaseInterface;
use Vainyl\Redis\RedisInterface;

/**
 * Class AbstractRedisException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractRedisException extends AbstractCoreException implements RedisExceptionInterface
{
    private $redis;

    /**
     * RedisException constructor.
     *
     * @param RedisInterface $redis
     * @param string         $message
     * @param int            $code
     * @param \Exception     $previous
     */
    public function __construct(RedisInterface $redis, string $message, int $code = 500, \Exception $previous = null)
    {
        $this->redis = $redis;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function getCache(): CacheInterface
    {
        return $this->getRedis();
    }

    /**
     * @inheritDoc
     */
    public function getDatabase(): DatabaseInterface
    {
        return $this->getRedis();
    }

    /**
     * @inheritDoc
     */
    public function getRedis(): RedisInterface
    {
        return $this->redis;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['redis' => $this->redis->getName()], parent::toArray());
    }
}
