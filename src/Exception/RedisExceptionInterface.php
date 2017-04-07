<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   redis
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Redis\Exception;

use Vainyl\Core\ArrayInterface;
use Vainyl\Redis\RedisInterface;

/**
 * Interface RedisExceptionInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface RedisExceptionInterface extends ArrayInterface, \Throwable
{
    /**
     * @return RedisInterface
     */
    public function getRedis(): RedisInterface;
}
