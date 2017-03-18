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

use Vainyl\Redis\RedisInterface;

/**
 * Class MixedModeRedisException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class MixedModeRedisException extends AbstractRedisException
{
    /**
     * MixedModeRedisException constructor.
     *
     * @param RedisInterface $redis
     */
    public function __construct(RedisInterface $redis)
    {
        parent::__construct($redis, 'Misc mode of multi and pipeline is not allowed on single connection');
    }
}
