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

namespace Vainyl\Redis;

use Psr\SimpleCache\CacheInterface;
use Vainyl\Database\DatabaseInterface;
use Vainyl\Redis\Multi\MultiRedisInterface;

/**
 * Interface RedisInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface RedisInterface extends CacheInterface, DatabaseInterface
{
    const POSITIVE_INFINITY = '+inf';
    const NEGATIVE_INFINITY = '-inf';
    const ZADD_MODE_CH = 'CH';
    const ZADD_MODE_XX = 'XX';
    const ZADD_MODE_NX = 'NX';
    const WITH_SCORES = 'withscores';
    const ZRANGE_LIMIT = 'limit';
    const ZRANGE_OFFSET = 'offset';

    /**
     * @param string $key
     * @param string $value
     *
     * @return bool
     */
    public function append(string $key, string $value): bool;

    /**
     * @param string $key
     * @param int    $timeout
     *
     * @return mixed
     */
    public function bLPop(string $key, int $timeout = 0);

    /**
     * @param string $key
     * @param int    $timeout
     *
     * @return mixed
     */
    public function bRPop(string $key, int $timeout = 0);

    /**
     * @param string $source
     * @param string $destination
     * @param int    $timeout
     *
     * @return mixed
     */
    public function bRPopLPush(string $source, string $destination, int $timeout = 0);

    /**
     * @return bool
     */
    public function bgRewriteAof(): bool;

    /**
     * @return bool
     */
    public function bgSave(): bool;

    /**
     * @param string $key
     * @param int    $start
     * @param int    $end
     *
     * @return int
     */
    public function bitCount(string $key, int $start = 0, int $end = -1): int;

    /**
     * @param string $key
     * @param array  $commands
     *
     * @return bool
     */
    public function bitField(string $key, array $commands): bool;

    /**
     * @param string $key
     * @param string $operation
     * @param string $destination
     * @param array  $sources
     *
     * @return bool
     */
    public function bitOp(string $key, string $operation, string $destination, array $sources): bool;

    /**
     * @param string $key
     * @param int    $bit
     * @param int    $start
     * @param int    $end
     *
     * @return int
     */
    public function bitPos(string $key, int $bit, int $start = 0, int $end = -1): int;

    /**
     * @param string $key
     *
     * @return int
     */
    public function decr(string $key): int;

    /**
     * @param string $key
     * @param int    $value
     *
     * @return int
     */
    public function decrBy(string $key, int $value): int;

    /**
     * @param string $key
     *
     * @return bool
     */
    public function exists(string $key): bool;

    /**
     * @param string $ket
     * @param int    $ttl
     *
     * @return bool
     */
    public function expire(string $ket, int $ttl): bool;

    /**
     * @param string $key
     * @param int    $ttl
     *
     * @return bool
     */
    public function expireAt(string $key, int $ttl): bool;

    /**
     * @return RedisInterface
     */
    public function flush(): RedisInterface;

    /**
     * @return RedisInterface
     */
    public function flushAll(): RedisInterface;

    /**
     * @param string $key
     * @param float  $longitude
     * @param float  $latitude
     * @param mixed  $value
     *
     * @return bool
     */
    public function geoAdd(string $key, float $longitude, float $latitude, $value): bool;

    /**
     * @param string $key
     * @param mixed  $from
     * @param mixed  $to
     *
     * @return float
     */
    public function geoDist(string $key, $from, $to): float;

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return string
     */
    public function geoHash(string $key, $value): string;

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return array
     */
    public function geoPos(string $key, $value): array;

    /**
     * @param string $key
     * @param float  $longitude
     * @param float  $latitude
     * @param float  $radius
     * @param string $uom
     * @param array  $options
     *
     * @return array
     */
    public function geoRadius(
        string $key,
        float $longitude,
        float $latitude,
        float $radius,
        string $uom,
        array $options = []
    ): array;

    /**
     * @param string $key
     * @param mixed  $member
     * @param float  $radius
     * @param string $uom
     * @param array  $options
     *
     * @return array
     */
    public function geoRadiusByMember(string $key, $member, float $radius, string $uom, array $options = []): array;

    /**
     * @param string $key
     * @param int    $offset
     *
     * @return bool
     */
    public function getBit(string $key, int $offset): bool;

    /**
     * @param string $key
     * @param int    $from
     * @param int    $to
     *
     * @return string
     */
    public function getRange(string $key, int $from, int $to): string;

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return mixed
     */
    public function getSet(string $key, $value);

    /**
     * @param string $key
     * @param string $field
     *
     * @return bool
     */
    public function hDel(string $key, string $field): bool;

    /**
     * @param string $key
     * @param string $field
     *
     * @return bool
     */
    public function hExists(string $key, string $field): bool;

    /**
     * @param string $key
     * @param string $field
     *
     * @return mixed
     */
    public function hGet(string $key, string $field);

    /**
     * @param string $key
     *
     * @return array
     */
    public function hGetAll(string $key): array;

    /**
     * @param string $key
     * @param string $field
     * @param int    $value
     *
     * @return int
     */
    public function hIncrBy(string $key, string $field, int $value): int;

    /**
     * @param string $key
     * @param string $field
     * @param float  $floatValue
     *
     * @return float
     */
    public function hIncrByFloat(string $key, string $field, float $floatValue): float;

    /**
     * @param string $key
     *
     * @return array
     */
    public function hKeys(string $key): array;

    /**
     * @param string $key
     *
     * @return int
     */
    public function hLen(string $key): int;

    /**
     * @param string $key
     * @param array  $fields
     *
     * @return array
     */
    public function hMGet(string $key, array $fields): array;

    /**
     * @param string $key
     * @param array  $keysAndValues
     *
     * @return bool
     */
    public function hMSet(string $key, array $keysAndValues): bool;

    /**
     * @param int    $cursor
     * @param string $pattern
     * @param int    $count
     *
     * @return array
     */
    public function hScan(int $cursor, string $pattern = '', int $count = 0): array;

    /**
     * @param string $key
     * @param string $field
     * @param string $value
     *
     * @return bool
     */
    public function hSet(string $key, string $field, $value): bool;

    /**
     * @param string $key
     * @param string $field
     * @param string $value
     *
     * @return bool
     */
    public function hSetNx(string $key, string $field, $value): bool;

    /**
     * @param string $key
     * @param string $field
     *
     * @return int
     */
    public function hStrLen(string $key, string $field): int;

    /**
     * @param string $key
     *
     * @return array
     */
    public function hVals(string $key): array;

    /**
     * @param string $key
     *
     * @return int
     */
    public function incr(string $key): int;

    /**
     * @param string $key
     * @param int    $value
     *
     * @return int
     */
    public function incrBy(string $key, int $value): int;

    /**
     * @param string $key
     * @param float  $value
     *
     * @return float
     */
    public function incrByFloat(string $key, float $value): float;

    /**
     * @return array
     */
    public function info(): array;

    /**
     * @param string $pattern
     *
     * @return array
     */
    public function keys(string $pattern): array;

    /**
     * @param string $key
     * @param int    $index
     *
     * @return mixed
     */
    public function lIndex(string $key, int $index);

    /**
     * @param string $key
     * @param int    $index
     * @param string $pivot
     * @param mixed  $value
     *
     * @return bool
     */
    public function lInsert(string $key, int $index, string $pivot, $value): bool;

    /**
     * @param string $key
     *
     * @return int
     */
    public function lLen(string $key): int;

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function lPop(string $key);

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return bool
     */
    public function lPush(string $key, $value): bool;

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return bool
     */
    public function lPushX(string $key, $value): bool;

    /**
     * @param string $key
     * @param int    $start
     * @param int    $stop
     *
     * @return array
     */
    public function lRange(string $key, int $start, int $stop): array;

    /**
     * @param string $key
     * @param mixed  $reference
     * @param int    $count
     *
     * @return int
     */
    public function lRem(string $key, $reference, int $count): int;

    /**
     * @param string $key
     * @param int    $index
     * @param mixed  $value
     *
     * @return bool
     */
    public function lSet(string $key, int $index, $value): bool;

    /**
     * @param string $key
     * @param int    $start
     * @param int    $stop
     *
     * @return array
     */
    public function lTrim(string $key, int $start, int $stop): array;

    /**
     * @return int
     */
    public function lastSave(): int;

    /**
     * @param array $keys
     *
     * @return array
     */
    public function mGet(array $keys): array;

    /**
     * @param array $keysAndValues
     *
     * @return bool
     */
    public function mSet(array $keysAndValues): bool;

    /**
     * @param array $keysAndValues
     *
     * @return bool
     */
    public function mSetNx(array $keysAndValues): bool;

    /**
     * @param string $key
     * @param int    $db
     *
     * @return bool
     */
    public function move(string $key, int $db): bool;

    /**
     * @return MultiRedisInterface
     */
    public function multi(): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $milliseconds
     *
     * @return bool
     */
    public function pExpire(string $key, int $milliseconds): bool;

    /**
     * @param string $key
     * @param int    $milliseconds
     *
     * @return bool
     */
    public function pExpireAt(string $key, int $milliseconds): bool;

    /**
     * @param string $key
     * @param int    $milliseconds
     * @param mixed  $value
     *
     * @return bool
     */
    public function pSetEx(string $key, int $milliseconds, $value): bool;

    /**
     * @param string $pattern
     *
     * @return mixed
     */
    public function pSubscribe(string $pattern);

    /**
     * @param string $key
     *
     * @return int
     */
    public function pTtl(string $key): int;

    /**
     * @param string $pattern
     *
     * @return mixed
     */
    public function pUnSubscribe(string $pattern);

    /**
     * @param string $key
     *
     * @return bool
     */
    public function persist(string $key): bool;

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return bool
     */
    public function pfAdd(string $key, $value): bool;

    /**
     * @param string $key
     *
     * @return int
     */
    public function pfCount(string $key): int;

    /**
     * @param string $destination
     * @param array  $sources
     *
     * @return int
     */
    public function pfMerge(string $destination, array $sources): int;

    /**
     * @param string $message
     *
     * @return string
     */
    public function ping(string $message = ''): string;

    /**
     * @return MultiRedisInterface
     */
    public function pipeline(): MultiRedisInterface;

    /**
     * @param string $subCommand
     * @param array  $arguments
     *
     * @return mixed
     */
    public function pubSub(string $subCommand, array $arguments);

    /**
     * @param string $channel
     * @param string $message
     *
     * @return bool
     */
    public function publish(string $channel, string $message): bool;

    /**
     * @return RedisInterface
     */
    public function quit(): RedisInterface;

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function rPop(string $key);

    /**
     * @param string $source
     * @param string $destination
     *
     * @return mixed
     */
    public function rPopLPush(string $source, string $destination);

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return bool
     */
    public function rPush(string $key, $value): bool;

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return bool
     */
    public function rPushX(string $key, $value): bool;

    /**
     * @return string
     */
    public function randomKey(): string;

    /**
     * @param string $oldName
     * @param string $newName
     *
     * @return bool
     */
    public function rename(string $oldName, string $newName): bool;

    /**
     * @param string $oldName
     * @param string $newName
     *
     * @return bool
     */
    public function renameNx(string $oldName, string $newName): bool;

    /**
     * @param string $key
     * @param mixed  $member
     *
     * @return bool
     */
    public function sAdd(string $key, string $member): bool;

    /**
     * @param string $key
     *
     * @return int
     */
    public function sCard(string $key): int;

    /**
     * @param array $keys
     *
     * @return array
     */
    public function sDiff(array $keys): array;

    /**
     * @param string $destination
     * @param array  $sources
     *
     * @return int
     */
    public function sDiffStore(string $destination, array $sources): int;

    /**
     * @param array $keys
     *
     * @return array
     */
    public function sInter(array $keys): array;

    /**
     * @param string $destination
     * @param array  $sources
     *
     * @return int
     */
    public function sInterStore(string $destination, array $sources): int;

    /**
     * @param string $key
     * @param string $member
     *
     * @return bool
     */
    public function sIsMember(string $key, string $member): bool;

    /**
     * @param string $key
     *
     * @return array
     */
    public function sMembers(string $key): array;

    /**
     * @param string $member
     * @param string $destination
     * @param string $source
     *
     * @return bool
     */
    public function sMove(string $member, string $destination, string $source): bool;

    /**
     * @param string $key
     * @param int    $count
     *
     * @return array
     */
    public function sPop(string $key, int $count = 1): array;

    /**
     * @param string $key
     * @param int    $count
     *
     * @return array
     */
    public function sRandMember(string $key, int $count = 1): array;

    /**
     * @param string $key
     * @param mixed  $member
     *
     * @return bool
     */
    public function sRem(string $key, string $member): bool;

    /**
     * @param int    $cursor
     * @param string $pattern
     * @param int    $count
     *
     * @return array
     */
    public function sScan(int $cursor, string $pattern = '', int $count = 0): array;

    /**
     * @param array $keys
     *
     * @return array
     */
    public function sUnion(array $keys): array;

    /**
     * @param string $destination
     * @param array  $sources
     *
     * @return int
     */
    public function sUnionStore(string $destination, array $sources): int;

    /**
     * @return bool
     */
    public function save(): bool;

    /**
     * @param int    $cursor
     * @param string $pattern
     * @param int    $count
     *
     * @return array
     */
    public function scan(int $cursor, string $pattern = '', int $count = 0): array;

    /**
     * @param int $database
     *
     * @return bool
     */
    public function select(int $database): bool;

    /**
     * @param string $key
     * @param int    $offset
     * @param int    $value
     *
     * @return int
     */
    public function setBit(string $key, int $offset, int $value): int;

    /**
     * @param string $key
     * @param int    $ttl
     * @param mixed  $value
     *
     * @return bool
     */
    public function setEx(string $key, int $ttl, $value): bool;

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return bool
     */
    public function setNx(string $key, $value): bool;

    /**
     * @param string $key
     * @param int    $offset
     * @param int    $value
     *
     * @return bool
     */
    public function setRange(string $key, int $offset, $value): bool;

    /**
     * @param string $key
     * @param string $pattern
     * @param int    $limit
     * @param int    $offset
     * @param string $destination
     *
     * @return array
     */
    public function sort(
        string $key,
        string $pattern = '',
        int $limit = 0,
        int $offset = 0,
        string $destination
    ): array;

    /**
     * @param string $key
     *
     * @return int
     */
    public function strLen(string $key): int;

    /**
     * @param string $channel
     *
     * @return bool
     */
    public function subscribe(string $channel): bool;

    /**
     * @param int $source
     * @param int $destination
     *
     * @return bool
     */
    public function swapDb(int $source, int $destination): bool;

    /**
     * @return int
     */
    public function time(): int;

    /**
     * @param string $key
     *
     * @return bool
     */
    public function touch(string $key): bool;

    /**
     * @param string $key
     *
     * @return int
     */
    public function ttl(string $key): int;

    /**
     * @param string $key
     *
     * @return string
     */
    public function type(string $key): string;

    /**
     * @param string $channel
     *
     * @return bool
     */
    public function unSubscribe(string $channel): bool;

    /**
     * @param string $key
     *
     * @return bool
     */
    public function unlink(string $key): bool;

    /**
     * @return RedisInterface
     */
    public function unwatch(): RedisInterface;

    /**
     * @param string $key
     *
     * @return RedisInterface
     */
    public function watch(string $key): RedisInterface;

    /**
     * @param string $key
     * @param int    $score
     * @param mixed  $value
     *
     * @return bool
     */
    public function zAdd(string $key, int $score, $value): bool;

    /**
     * @param string $key
     * @param string $mode
     * @param int    $score
     * @param mixed  $value
     *
     * @return mixed
     */
    public function zAddMod(string $key, string $mode, int $score, $value): bool;

    /**
     * @param string $key
     *
     * @return int
     */
    public function zCard(string $key): int;

    /**
     * @param string $key
     * @param int    $fromScore
     * @param int    $toScore
     *
     * @return int
     */
    public function zCount(string $key, int $fromScore, int $toScore): int;

    /**
     * @param string $key
     * @param string $member
     *
     * @return bool
     */
    public function zDelete(string $key, string $member): bool;

    /**
     * @param string $key
     * @param int    $fromScore
     * @param int    $toScore
     *
     * @return int
     */
    public function zDeleteRangeByScore(string $key, int $fromScore, int $toScore): int;

    /**
     * @param string $key
     * @param float  $score
     * @param string $member
     *
     * @return float
     */
    public function zIncrBy(string $key, float $score, string $member): float;

    /**
     * @param string $destination
     * @param array  $sources
     *
     * @return int
     */
    public function zInterStore(string $destination, array $sources): int;

    /**
     * @param string $key
     * @param mixed  $from
     * @param mixed  $to
     *
     * @return int
     */
    public function zLexCount(string $key, $from, $to): int;

    /**
     * @param string $key
     * @param int    $from
     * @param int    $to
     *
     * @return array
     */
    public function zRange(string $key, int $from, int $to): array;

    /**
     * @param string $key
     * @param mixed  $from
     * @param mixed  $to
     *
     * @return array
     */
    public function zRangeByLex(string $key, $from, $to): array;

    /**
     * @param string $key
     * @param int    $fromScore
     * @param int    $toScore
     * @param array  $options
     *
     * @return array
     */
    public function zRangeByScore(string $key, int $fromScore, int $toScore, array $options = []): array;

    /**
     * @param string $key
     * @param string $member
     *
     * @return int
     */
    public function zRank(string $key, string $member);

    /**
     * @param string $key
     * @param string $member
     *
     * @return bool
     */
    public function zRem(string $key, string $member): bool;

    /**
     * @param string $key
     * @param mixed  $from
     * @param mixed  $to
     *
     * @return int
     */
    public function zRemRangeByLex(string $key, $from, $to): int;

    /**
     * @param string $key
     * @param int    $start
     * @param int    $stop
     *
     * @return int
     */
    public function zRemRangeByRank(string $key, int $start, int $stop): int;

    /**
     * @param string $key
     * @param int    $fromScore
     * @param int    $toScore
     *
     * @return int
     */
    public function zRemRangeByScore(string $key, int $fromScore, int $toScore): int;

    /**
     * @param string $key
     * @param int    $from
     * @param int    $to
     *
     * @return array
     */
    public function zRevRange(string $key, int $from, int $to): array;

    /**
     * @param string $key
     * @param mixed  $from
     * @param mixed  $to
     *
     * @return array
     */
    public function zRevRangeByLex(string $key, $from, $to): array;

    /**
     * @param string $key
     * @param int    $fromScore
     * @param int    $toScore
     * @param array  $options
     *
     * @return array
     */
    public function zRevRangeByScore(string $key, int $fromScore, int $toScore, array $options = []): array;

    /**
     * @param string $key
     * @param int    $fromScore
     * @param int    $toScore
     * @param int    $offset
     * @param int    $count
     *
     * @return array
     */
    public function zRevRangeByScoreLimit(string $key, int $fromScore, int $toScore, int $offset, int $count): array;

    /**
     * @param string $key
     * @param int    $from
     * @param int    $to
     *
     * @return array
     */
    public function zRevRangeWithScores(string $key, int $from, int $to): array;

    /**
     * @param string $key
     * @param string $member
     *
     * @return int
     */
    public function zRevRank(string $key, string $member): int;

    /**
     * @param int    $cursor
     * @param string $pattern
     * @param int    $count
     *
     * @return array
     */
    public function zScan(int $cursor, string $pattern = '', int $count = 0): array;

    /**
     * @param string $key
     * @param string $member
     *
     * @return float
     */
    public function zScore(string $key, string $member): float;

    /**
     * @param string $destination
     * @param array  $sources
     *
     * @return int
     */
    public function zUnionStore(string $destination, array $sources): int;
}
