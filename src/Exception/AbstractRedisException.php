<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   Redis
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types = 1);

namespace Vainyl\Redis\Exception;

use Vainyl\Database\Exception\AbstractDatabaseException;
use Vainyl\Redis\RedisInterface;

/**
 * Class AbstractRedisException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractRedisException extends AbstractDatabaseException implements RedisExceptionInterface
{
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
        parent::__construct($redis, $message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function getRedis(): RedisInterface
    {
        return $this->getDatabase();
    }
}
