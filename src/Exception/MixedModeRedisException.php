<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-cache
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-cache
 */

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
