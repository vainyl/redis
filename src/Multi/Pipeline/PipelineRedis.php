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

namespace Vainyl\Redis\Multi\Pipeline;

use Vainyl\Redis\Exception\MixedModeRedisException;
use Vainyl\Redis\Multi\AbstractMultiRedis;
use Vainyl\Redis\Multi\MultiRedisInterface;

/**
 * Class PipelineRedis
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PipelineRedis extends AbstractMultiRedis
{
    /**
     * @inheritDoc
     */
    public function multi(): MultiRedisInterface
    {
        throw new MixedModeRedisException($this->getRedis());
    }

    /**
     * @inheritDoc
     */
    public function pipeline(): MultiRedisInterface
    {
        $this->increaseLevel();

        return $this;
    }
}
