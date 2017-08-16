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

namespace Vainyl\Redis\Script;

use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Redis\RedisScriptInterface;

/**
 * Class ZAddNxXxScript
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ZAddNxXxScript extends AbstractIdentifiable implements RedisScriptInterface
{
    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return 'return redis.call(\'zAdd\', KEYS[1], ARGV[1], ARGV[2], ARGV[3])';
    }

    /**
     * @inheritDoc
     */
    public function getId(): ?string
    {
        return sha1($this->__toString());
    }
}