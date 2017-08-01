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

namespace Vainyl\Redis\Multi;

use Vainyl\Core\IdentifiableInterface;

/**
 * Interface MultiRedisInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface MultiRedisInterface extends IdentifiableInterface
{
    /**
     * @param string $key
     * @param string $value
     *
     * @return MultiRedisInterface
     */
    public function append(string $key, string $value): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $timeout
     *
     * @return MultiRedisInterface
     */
    public function bLPop(string $key, int $timeout = 0): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $timeout
     *
     * @return MultiRedisInterface
     */
    public function bRPop(string $key, int $timeout = 0): MultiRedisInterface;

    /**
     * @param string $source
     * @param string $destination
     * @param int    $timeout
     *
     * @return MultiRedisInterface
     */
    public function bRPopLPush(string $source, string $destination, int $timeout = 0): MultiRedisInterface;

    /**
     * @return MultiRedisInterface
     */
    public function bgRewriteAof(): MultiRedisInterface;

    /**
     * @return MultiRedisInterface
     */
    public function bgSave(): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $start
     * @param int    $end
     *
     * @return MultiRedisInterface
     */
    public function bitCount(string $key, int $start = 0, int $end = -1): MultiRedisInterface;

    /**
     * @param string $key
     * @param array  $commands
     *
     * @return MultiRedisInterface
     */
    public function bitField(string $key, array $commands): MultiRedisInterface;

    /**
     * @param string $key
     * @param string $operation
     * @param string $destination
     * @param array  $sources
     *
     * @return MultiRedisInterface
     */
    public function bitOp(string $key, string $operation, string $destination, array $sources): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $bit
     * @param int    $start
     * @param int    $end
     *
     * @return MultiRedisInterface
     */
    public function bitPos(string $key, int $bit, int $start = 0, int $end = -1): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function decr(string $key): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $value
     *
     * @return MultiRedisInterface
     */
    public function decrBy(string $key, int $value): MultiRedisInterface;

    /**
     * @return array
     */
    public function exec(): array;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function exists(string $key): MultiRedisInterface;

    /**
     * @param string $ket
     * @param int    $ttl
     *
     * @return MultiRedisInterface
     */
    public function expire(string $ket, int $ttl): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $ttl
     *
     * @return MultiRedisInterface
     */
    public function expireAt(string $key, int $ttl): MultiRedisInterface;

    /**
     * @return MultiRedisInterface
     */
    public function flush(): MultiRedisInterface;

    /**
     * @return MultiRedisInterface
     */
    public function flushAll(): MultiRedisInterface;

    /**
     * @param string $key
     * @param float  $longitude
     * @param float  $latitude
     * @param mixed  $value
     *
     * @return MultiRedisInterface
     */
    public function geoAdd(string $key, float $longitude, float $latitude, $value): MultiRedisInterface;

    /**
     * @param string $key
     * @param mixed  $from
     * @param mixed  $to
     *
     * @return MultiRedisInterface
     */
    public function geoDist(string $key, $from, $to): MultiRedisInterface;

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return MultiRedisInterface
     */
    public function geoHash(string $key, $value): MultiRedisInterface;

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return MultiRedisInterface
     */
    public function geoPos(string $key, $value): MultiRedisInterface;

    /**
     * @param string $key
     * @param float  $longitude
     * @param float  $latitude
     * @param float  $radius
     * @param string $uom
     * @param array  $options
     *
     * @return MultiRedisInterface
     */
    public function geoRadius(
        string $key,
        float $longitude,
        float $latitude,
        float $radius,
        string $uom,
        array $options = []
    ): MultiRedisInterface;

    /**
     * @param string $key
     * @param mixed  $member
     * @param float  $radius
     * @param string $uom
     * @param array  $options
     *
     * @return MultiRedisInterface
     */
    public function geoRadiusByMember(
        string $key,
        $member,
        float $radius,
        string $uom,
        array $options = []
    ): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $offset
     *
     * @return MultiRedisInterface
     */
    public function getBit(string $key, int $offset): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $from
     * @param int    $to
     *
     * @return MultiRedisInterface
     */
    public function getRange(string $key, int $from, int $to): MultiRedisInterface;

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return MultiRedisInterface
     */
    public function getSet(string $key, $value): MultiRedisInterface;

    /**
     * @param string $key
     * @param string $field
     *
     * @return MultiRedisInterface
     */
    public function hDel(string $key, string $field): MultiRedisInterface;

    /**
     * @param string $key
     * @param string $field
     *
     * @return MultiRedisInterface
     */
    public function hExists(string $key, string $field): MultiRedisInterface;

    /**
     * @param string $key
     * @param string $field
     *
     * @return MultiRedisInterface
     */
    public function hGet(string $key, string $field): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function hGetAll(string $key): MultiRedisInterface;

    /**
     * @param string $key
     * @param string $field
     * @param int    $value
     *
     * @return MultiRedisInterface
     */
    public function hIncrBy(string $key, string $field, int $value): MultiRedisInterface;

    /**
     * @param string $key
     * @param string $field
     * @param float  $floatValue
     *
     * @return MultiRedisInterface
     */
    public function hIncrByFloat(string $key, string $field, float $floatValue): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function hKeys(string $key): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function hLen(string $key): MultiRedisInterface;

    /**
     * @param string $key
     * @param array  $fields
     *
     * @return MultiRedisInterface
     */
    public function hMGet(string $key, array $fields): MultiRedisInterface;

    /**
     * @param string $key
     * @param array  $keysAndValues
     *
     * @return MultiRedisInterface
     */
    public function hMSet(string $key, array $keysAndValues): MultiRedisInterface;

    /**
     * @param int    $cursor
     * @param string $pattern
     * @param int    $count
     *
     * @return MultiRedisInterface
     */
    public function hScan(int $cursor, string $pattern = '', int $count = 0): MultiRedisInterface;

    /**
     * @param string $key
     * @param string $field
     * @param string $value
     *
     * @return MultiRedisInterface
     */
    public function hSet(string $key, string $field, $value): MultiRedisInterface;

    /**
     * @param string $key
     * @param string $field
     * @param string $value
     *
     * @return MultiRedisInterface
     */
    public function hSetNx(string $key, string $field, $value): MultiRedisInterface;

    /**
     * @param string $key
     * @param string $field
     *
     * @return MultiRedisInterface
     */
    public function hStrLen(string $key, string $field): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function hVals(string $key): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function incr(string $key): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $value
     *
     * @return MultiRedisInterface
     */
    public function incrBy(string $key, int $value): MultiRedisInterface;

    /**
     * @param string $key
     * @param float  $value
     *
     * @return MultiRedisInterface
     */
    public function incrByFloat(string $key, float $value): MultiRedisInterface;

    /**
     * @return MultiRedisInterface
     */
    public function info(): MultiRedisInterface;

    /**
     * @param string $pattern
     *
     * @return MultiRedisInterface
     */
    public function keys(string $pattern): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $index
     *
     * @return MultiRedisInterface
     */
    public function lIndex(string $key, int $index): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $index
     * @param string $pivot
     * @param mixed  $value
     *
     * @return MultiRedisInterface
     */
    public function lInsert(string $key, int $index, string $pivot, $value): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function lLen(string $key): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function lPop(string $key): MultiRedisInterface;

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return MultiRedisInterface
     */
    public function lPush(string $key, $value): MultiRedisInterface;

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return MultiRedisInterface
     */
    public function lPushX(string $key, $value): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $start
     * @param int    $stop
     *
     * @return MultiRedisInterface
     */
    public function lRange(string $key, int $start, int $stop): MultiRedisInterface;

    /**
     * @param string $key
     * @param mixed  $reference
     * @param int    $count
     *
     * @return MultiRedisInterface
     */
    public function lRem(string $key, $reference, int $count): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $index
     * @param mixed  $value
     *
     * @return MultiRedisInterface
     */
    public function lSet(string $key, int $index, $value): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $start
     * @param int    $stop
     *
     * @return MultiRedisInterface
     */
    public function lTrim(string $key, int $start, int $stop): MultiRedisInterface;

    /**
     * @return MultiRedisInterface
     */
    public function lastSave(): MultiRedisInterface;

    /**
     * @param array $keys
     *
     * @return MultiRedisInterface
     */
    public function mGet(array $keys): MultiRedisInterface;

    /**
     * @param array $keysAndValues
     *
     * @return MultiRedisInterface
     */
    public function mSet(array $keysAndValues): MultiRedisInterface;

    /**
     * @param array $keysAndValues
     *
     * @return MultiRedisInterface
     */
    public function mSetNx(array $keysAndValues): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $db
     *
     * @return MultiRedisInterface
     */
    public function move(string $key, int $db): MultiRedisInterface;

    /**
     * @return MultiRedisInterface
     */
    public function multi(): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $milliseconds
     *
     * @return MultiRedisInterface
     */
    public function pExpire(string $key, int $milliseconds): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $milliseconds
     *
     * @return MultiRedisInterface
     */
    public function pExpireAt(string $key, int $milliseconds): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $milliseconds
     * @param mixed  $value
     *
     * @return MultiRedisInterface
     */
    public function pSetEx(string $key, int $milliseconds, $value): MultiRedisInterface;

    /**
     * @param string $pattern
     *
     * @return MultiRedisInterface
     */
    public function pSubscribe(string $pattern): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function pTtl(string $key): MultiRedisInterface;

    /**
     * @param string $pattern
     *
     * @return MultiRedisInterface
     */
    public function pUnSubscribe(string $pattern): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function persist(string $key): MultiRedisInterface;

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return MultiRedisInterface
     */
    public function pfAdd(string $key, $value): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function pfCount(string $key): MultiRedisInterface;

    /**
     * @param string $destination
     * @param array  $sources
     *
     * @return MultiRedisInterface
     */
    public function pfMerge(string $destination, array $sources): MultiRedisInterface;

    /**
     * @param string $message
     *
     * @return MultiRedisInterface
     */
    public function ping(string $message = ''): MultiRedisInterface;

    /**
     * @return MultiRedisInterface
     */
    public function pipeline(): MultiRedisInterface;

    /**
     * @param string $subCommand
     * @param array  $arguments
     *
     * @return MultiRedisInterface
     */
    public function pubSub(string $subCommand, array $arguments): MultiRedisInterface;

    /**
     * @param string $channel
     * @param string $message
     *
     * @return MultiRedisInterface
     */
    public function publish(string $channel, string $message): MultiRedisInterface;

    /**
     * @return MultiRedisInterface
     */
    public function quit(): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function rPop(string $key): MultiRedisInterface;

    /**
     * @param string $source
     * @param string $destination
     *
     * @return MultiRedisInterface
     */
    public function rPopLPush(string $source, string $destination): MultiRedisInterface;

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return MultiRedisInterface
     */
    public function rPush(string $key, $value): MultiRedisInterface;

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return MultiRedisInterface
     */
    public function rPushX(string $key, $value): MultiRedisInterface;

    /**
     * @return MultiRedisInterface
     */
    public function randomKey(): MultiRedisInterface;

    /**
     * @param string $oldName
     * @param string $newName
     *
     * @return MultiRedisInterface
     */
    public function rename(string $oldName, string $newName): MultiRedisInterface;

    /**
     * @param string $oldName
     * @param string $newName
     *
     * @return MultiRedisInterface
     */
    public function renameNx(string $oldName, string $newName): MultiRedisInterface;

    /**
     * @param string $key
     * @param mixed  $member
     *
     * @return MultiRedisInterface
     */
    public function sAdd(string $key, string $member): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function sCard(string $key): MultiRedisInterface;

    /**
     * @param array $keys
     *
     * @return MultiRedisInterface
     */
    public function sDiff(array $keys): MultiRedisInterface;

    /**
     * @param string $destination
     * @param array  $sources
     *
     * @return MultiRedisInterface
     */
    public function sDiffStore(string $destination, array $sources): MultiRedisInterface;

    /**
     * @param array $keys
     *
     * @return MultiRedisInterface
     */
    public function sInter(array $keys): MultiRedisInterface;

    /**
     * @param string $destination
     * @param array  $sources
     *
     * @return MultiRedisInterface
     */
    public function sInterStore(string $destination, array $sources): MultiRedisInterface;

    /**
     * @param string $key
     * @param string $member
     *
     * @return MultiRedisInterface
     */
    public function sIsMember(string $key, string $member): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function sMembers(string $key): MultiRedisInterface;

    /**
     * @param string $member
     * @param string $destination
     * @param string $source
     *
     * @return MultiRedisInterface
     */
    public function sMove(string $member, string $destination, string $source): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $count
     *
     * @return MultiRedisInterface
     */
    public function sPop(string $key, int $count = 1): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $count
     *
     * @return MultiRedisInterface
     */
    public function sRandMember(string $key, int $count = 1): MultiRedisInterface;

    /**
     * @param string $key
     * @param mixed  $member
     *
     * @return MultiRedisInterface
     */
    public function sRem(string $key, string $member): MultiRedisInterface;

    /**
     * @param int    $cursor
     * @param string $pattern
     * @param int    $count
     *
     * @return MultiRedisInterface
     */
    public function sScan(int $cursor, string $pattern = '', int $count = 0): MultiRedisInterface;

    /**
     * @param array $keys
     *
     * @return MultiRedisInterface
     */
    public function sUnion(array $keys): MultiRedisInterface;

    /**
     * @param string $destination
     * @param array  $sources
     *
     * @return MultiRedisInterface
     */
    public function sUnionStore(string $destination, array $sources): MultiRedisInterface;

    /**
     * @return MultiRedisInterface
     */
    public function save(): MultiRedisInterface;

    /**
     * @param int    $cursor
     * @param string $pattern
     * @param int    $count
     *
     * @return MultiRedisInterface
     */
    public function scan(int $cursor, string $pattern = '', int $count = 0): MultiRedisInterface;

    /**
     * @param int $database
     *
     * @return MultiRedisInterface
     */
    public function select(int $database): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $offset
     * @param int    $value
     *
     * @return MultiRedisInterface
     */
    public function setBit(string $key, int $offset, int $value): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $ttl
     * @param mixed  $value
     *
     * @return MultiRedisInterface
     */
    public function setEx(string $key, int $ttl, $value): MultiRedisInterface;

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return MultiRedisInterface
     */
    public function setNx(string $key, $value): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $offset
     * @param int    $value
     *
     * @return MultiRedisInterface
     */
    public function setRange(string $key, int $offset, $value): MultiRedisInterface;

    /**
     * @param string $key
     * @param string $pattern
     * @param int    $limit
     * @param int    $offset
     * @param string $destination
     *
     * @return MultiRedisInterface
     */
    public function sort(
        string $key,
        string $pattern = '',
        int $limit = 0,
        int $offset = 0,
        string $destination
    ): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function strLen(string $key): MultiRedisInterface;

    /**
     * @param string $channel
     *
     * @return MultiRedisInterface
     */
    public function subscribe(string $channel): MultiRedisInterface;

    /**
     * @param int $source
     * @param int $destination
     *
     * @return MultiRedisInterface
     */
    public function swapDb(int $source, int $destination): MultiRedisInterface;

    /**
     * @return MultiRedisInterface
     */
    public function time(): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function touch(string $key): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function ttl(string $key): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function type(string $key): MultiRedisInterface;

    /**
     * @param string $channel
     *
     * @return MultiRedisInterface
     */
    public function unSubscribe(string $channel): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function unlink(string $key): MultiRedisInterface;

    /**
     * @return MultiRedisInterface
     */
    public function unwatch(): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function watch(string $key): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $score
     * @param mixed  $value
     *
     * @return MultiRedisInterface
     */
    public function zAdd(string $key, int $score, $value): MultiRedisInterface;

    /**
     * @param string $key
     * @param string $mode
     * @param int    $score
     * @param mixed  $value
     *
     * @return MultiRedisInterface
     */
    public function zAddMod(string $key, string $mode, int $score, $value): MultiRedisInterface;

    /**
     * @param string $key
     *
     * @return MultiRedisInterface
     */
    public function zCard(string $key): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $fromScore
     * @param int    $toScore
     *
     * @return MultiRedisInterface
     */
    public function zCount(string $key, int $fromScore, int $toScore): MultiRedisInterface;

    /**
     * @param string $key
     * @param string $member
     *
     * @return MultiRedisInterface
     */
    public function zDelete(string $key, string $member): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $fromScore
     * @param int    $toScore
     *
     * @return MultiRedisInterface
     */
    public function zDeleteRangeByScore(string $key, int $fromScore, int $toScore): MultiRedisInterface;

    /**
     * @param string $key
     * @param float  $score
     * @param string $member
     *
     * @return MultiRedisInterface
     */
    public function zIncrBy(string $key, float $score, string $member): MultiRedisInterface;

    /**
     * @param string $destination
     * @param array  $sources
     *
     * @return MultiRedisInterface
     */
    public function zInterStore(string $destination, array $sources): MultiRedisInterface;

    /**
     * @param string $key
     * @param mixed  $from
     * @param mixed  $to
     *
     * @return MultiRedisInterface
     */
    public function zLexCount(string $key, $from, $to): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $from
     * @param int    $to
     *
     * @return MultiRedisInterface
     */
    public function zRange(string $key, int $from, int $to): MultiRedisInterface;

    /**
     * @param string $key
     * @param mixed  $from
     * @param mixed  $to
     *
     * @return MultiRedisInterface
     */
    public function zRangeByLex(string $key, $from, $to): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $fromScore
     * @param int    $toScore
     * @param array  $options
     *
     * @return MultiRedisInterface
     */
    public function zRangeByScore(string $key, int $fromScore, int $toScore, array $options = []): MultiRedisInterface;

    /**
     * @param string $key
     * @param string $member
     *
     * @return MultiRedisInterface
     */
    public function zRank(string $key, string $member): MultiRedisInterface;

    /**
     * @param string $key
     * @param string $member
     *
     * @return MultiRedisInterface
     */
    public function zRem(string $key, string $member): MultiRedisInterface;

    /**
     * @param string $key
     * @param mixed  $from
     * @param mixed  $to
     *
     * @return MultiRedisInterface
     */
    public function zRemRangeByLex(string $key, $from, $to): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $start
     * @param int    $stop
     *
     * @return MultiRedisInterface
     */
    public function zRemRangeByRank(string $key, int $start, int $stop): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $fromScore
     * @param int    $toScore
     *
     * @return MultiRedisInterface
     */
    public function zRemRangeByScore(string $key, int $fromScore, int $toScore): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $from
     * @param int    $to
     *
     * @return MultiRedisInterface
     */
    public function zRevRange(string $key, int $from, int $to): MultiRedisInterface;

    /**
     * @param string $key
     * @param mixed  $from
     * @param mixed  $to
     *
     * @return MultiRedisInterface
     */
    public function zRevRangeByLex(string $key, $from, $to): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $fromScore
     * @param int    $toScore
     * @param array  $options
     *
     * @return MultiRedisInterface
     */
    public function zRevRangeByScore(
        string $key,
        int $fromScore,
        int $toScore,
        array $options = []
    ): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $fromScore
     * @param int    $toScore
     * @param int    $offset
     * @param int    $count
     *
     * @return MultiRedisInterface
     */
    public function zRevRangeByScoreLimit(
        string $key,
        int $fromScore,
        int $toScore,
        int $offset,
        int $count
    ): MultiRedisInterface;

    /**
     * @param string $key
     * @param int    $from
     * @param int    $to
     *
     * @return MultiRedisInterface
     */
    public function zRevRangeWithScores(string $key, int $from, int $to): MultiRedisInterface;

    /**
     * @param string $key
     * @param string $member
     *
     * @return MultiRedisInterface
     */
    public function zRevRank(string $key, string $member): MultiRedisInterface;

    /**
     * @param int    $cursor
     * @param string $pattern
     * @param int    $count
     *
     * @return MultiRedisInterface
     */
    public function zScan(int $cursor, string $pattern = '', int $count = 0): MultiRedisInterface;

    /**
     * @param string $key
     * @param string $member
     *
     * @return MultiRedisInterface
     */
    public function zScore(string $key, string $member): MultiRedisInterface;

    /**
     * @param string $destination
     * @param array  $sources
     *
     * @return MultiRedisInterface
     */
    public function zUnionStore(string $destination, array $sources): MultiRedisInterface;
}
