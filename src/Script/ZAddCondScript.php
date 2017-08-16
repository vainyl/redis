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
 * Class ZAddCondScript
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ZAddCondScript extends AbstractIdentifiable implements RedisScriptInterface
{
    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return '
                    local score = redis.call("zScore", KEYS[1], ARGV[3]);
                    if score == false then
                        return redis.call("zAdd", KEYS[1], "CH", ARGV[2], ARGV[3]);
                    end
                    if (ARGV[1] == "LT" and score > ARGV[2]) or (ARGV[1] == "GT" and score < ARGV[2]) then
                        return redis.call("zAdd", KEYS[1], "XX", "CH", ARGV[2], ARGV[3]);
                    end

                    return 0;
        ';
    }

    /**
     * @inheritDoc
     */
    public function getId(): ?string
    {
        return sha1($this->__toString());
    }
}