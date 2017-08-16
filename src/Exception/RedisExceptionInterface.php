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

use Vainyl\Cache\Exception\CacheExceptionInterface;
use Vainyl\Core\Exception\CoreExceptionInterface;
use Vainyl\Database\Exception\DatabaseExceptionInterface;
use Vainyl\Redis\RedisInterface;

/**
 * Interface RedisExceptionInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface RedisExceptionInterface extends CoreExceptionInterface, DatabaseExceptionInterface, CacheExceptionInterface
{
    /**
     * @return RedisInterface
     */
    public function getRedis(): RedisInterface;
}
