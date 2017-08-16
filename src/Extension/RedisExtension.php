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

namespace Vainyl\Redis\Extension;

use Vainyl\Core\Extension\AbstractFrameworkExtension;

/**
 * Class RedisExtension
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class RedisExtension extends AbstractFrameworkExtension
{
    /**
     * @inheritDoc
     */
    public function getCompilerPasses(): array
    {
        return [[new RedisScriptCompilerPass()]];
    }
}
