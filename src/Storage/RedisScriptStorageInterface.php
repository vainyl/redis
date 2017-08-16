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

use Vainyl\Core\IdentifiableInterface;
use Vainyl\Redis\RedisScriptInterface;

/**
 * Interface RedisScriptStorageInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface RedisScriptStorageInterface extends IdentifiableInterface, \Traversable
{
    /**
     * @param RedisScriptInterface $redisScript
     *
     * @return RedisScriptStorageInterface
     */
    public function addScript(RedisScriptInterface $redisScript) : RedisScriptStorageInterface;

    /**
     * @param string $hash
     *
     * @return RedisScriptInterface
     */
    public function getScript(string $hash) : RedisScriptInterface;
}