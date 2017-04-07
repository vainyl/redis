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

namespace Vainyl\Redis\Multi\Transaction;

use Vainyl\Redis\Exception\MixedModeRedisException;
use Vainyl\Redis\Multi\AbstractMultiRedis;
use Vainyl\Redis\Multi\MultiRedisInterface;

/**
 * Class TransactionRedis
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class TransactionRedis extends AbstractMultiRedis
{
    /**
     * @inheritDoc
     */
    public function pipeline(): MultiRedisInterface
    {
        throw new MixedModeRedisException($this->getRedis());
    }

    /**
     * @inheritDoc
     */
    public function multi(): MultiRedisInterface
    {
        $this->increaseLevel();

        return $this;
    }
}
