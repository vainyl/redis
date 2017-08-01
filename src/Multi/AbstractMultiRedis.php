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

use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Database\Exception\LevelIntegrityException;
use Vainyl\Redis\RedisInterface;

/**
 * Class AbstractMultiRedis
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractMultiRedis extends AbstractIdentifiable implements MultiRedisInterface
{
    private $redis;

    private $level = 1;

    /**
     * MultiRedis constructor.
     *
     * @param RedisInterface $redisInterface
     */
    public function __construct(RedisInterface $redisInterface)
    {
        $this->redis = $redisInterface;
    }

    /**
     * @inheritDoc
     */
    public function add(string $key, $value, $ttl = null): MultiRedisInterface
    {
        $this->setNx($key, $value);
        if (null === $ttl) {
            return $this;
        }

        return $this->expire($key, (int)$ttl);
    }

    /**
     * @inheritDoc
     */
    public function append(string $key, string $value): MultiRedisInterface
    {
        $this->redis->append($key, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function bLPop(string $key, int $timeout = 0): MultiRedisInterface
    {
        $this->redis->bLPop($key, $timeout);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function bRPop(string $key, int $timeout = 0): MultiRedisInterface
    {
        $this->redis->bRPop($key, $timeout);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function bRPopLPush(string $source, string $destination, int $timeout = 0): MultiRedisInterface
    {
        $this->redis->bRPopLPush($source, $destination, $timeout);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function bgRewriteAof(): MultiRedisInterface
    {
        $this->redis->bgRewriteAof();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function bgSave(): MultiRedisInterface
    {
        $this->redis->bgSave();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function bitCount(string $key, int $start = 0, int $end = -1): MultiRedisInterface
    {
        $this->redis->bitCount($key, $start, $end);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function bitField(string $key, array $commands): MultiRedisInterface
    {
        $this->redis->bitField($key, $commands);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function bitOp(string $key, string $operation, string $destination, array $sources): MultiRedisInterface
    {
        $this->redis->bitOp($key, $operation, $destination, $sources);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function bitPos(string $key, int $bit, int $start = 0, int $end = -1): MultiRedisInterface
    {
        $this->redis->bitPos($key, $bit, $start, $end);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function decr(string $key): MultiRedisInterface
    {
        $this->redis->decr($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function decrBy(string $key, int $value): MultiRedisInterface
    {
        $this->redis->decrBy($key, $value);

        return $this;
    }

    /**
     * @return int
     */
    protected function decreaseLevel(): int
    {
        return --$this->level;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $key): MultiRedisInterface
    {
        $this->redis->delete($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function exec(): array
    {
        $currentLevel = $this->decreaseLevel();

        if (0 < $currentLevel) {
            return [];
        }

        if (0 > $currentLevel) {
            throw new LevelIntegrityException($this->redis, $currentLevel);
        }

        return $this->redis->exec($this);
    }

    /**
     * @inheritDoc
     */
    public function exists(string $key): MultiRedisInterface
    {
        $this->redis->exists($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function expire(string $key, int $ttl): MultiRedisInterface
    {
        $this->redis->expire($key, $ttl);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function expireAt(string $key, int $ttl): MultiRedisInterface
    {
        $this->redis->expireAt($key, $ttl);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function flush(): MultiRedisInterface
    {
        $this->redis->flush();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function flushAll(): MultiRedisInterface
    {
        $this->redis->flushAll();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function geoAdd(string $key, float $longitude, float $latitude, $value): MultiRedisInterface
    {
        $this->redis->geoAdd($key, $longitude, $latitude, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function geoDist(string $key, $from, $to): MultiRedisInterface
    {
        $this->redis->geoDist($key, $from, $to);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function geoHash(string $key, $value): MultiRedisInterface
    {
        $this->redis->geoHash($key, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function geoPos(string $key, $value): MultiRedisInterface
    {
        $this->redis->geoPos($key, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function geoRadius(
        string $key,
        float $longitude,
        float $latitude,
        float $radius,
        string $uom,
        array $options = []
    ): MultiRedisInterface {
        $this->redis->geoRadius($key, $longitude, $latitude, $radius, $uom, $options);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function geoRadiusByMember(
        string $key,
        $member,
        float $radius,
        string $uom,
        array $options = []
    ): MultiRedisInterface {
        $this->redis->geoRadiusByMember($key, $member, $radius, $uom, $options);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function get(string $key, $default = null): MultiRedisInterface
    {
        $this->redis->get($key, $default);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getBit(string $key, int $offset): MultiRedisInterface
    {
        $this->redis->getBit($key, $offset);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return spl_object_hash($this);
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @inheritDoc
     */
    public function getRange(string $key, int $from, int $to): MultiRedisInterface
    {
        $this->redis->getRange($key, $from, $to);

        return $this;
    }

    /**
     * @return RedisInterface
     */
    public function getRedis(): RedisInterface
    {
        return $this->redis;
    }

    /**
     * @inheritDoc
     */
    public function getSet(string $key, $value): MultiRedisInterface
    {
        $this->redis->getSet($key, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hDel(string $key, string $field): MultiRedisInterface
    {
        $this->redis->hDel($key, $field);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hExists(string $key, string $field): MultiRedisInterface
    {
        $this->redis->hExists($key, $field);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hGet(string $key, string $field): MultiRedisInterface
    {
        $this->redis->hGet($key, $field);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hGetAll(string $key): MultiRedisInterface
    {
        $this->redis->hGetAll($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hIncrBy(string $key, string $field, int $value): MultiRedisInterface
    {
        $this->redis->hIncrBy($key, $field, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hIncrByFloat(string $key, string $field, float $floatValue): MultiRedisInterface
    {
        $this->redis->hIncrByFloat($key, $field, $floatValue);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hKeys(string $key): MultiRedisInterface
    {
        $this->redis->hKeys($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hLen(string $key): MultiRedisInterface
    {
        $this->redis->hLen($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hMGet(string $key, array $fields): MultiRedisInterface
    {
        $this->redis->hMGet($key, $fields);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hMSet(string $key, array $keysAndValues): MultiRedisInterface
    {
        $this->redis->hMSet($key, $keysAndValues);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hScan(int $cursor, string $pattern = '', int $count = 0): MultiRedisInterface
    {
        $this->redis->hScan($cursor, $pattern, $count);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hSet(string $key, string $field, $value): MultiRedisInterface
    {
        $this->redis->hSet($key, $field, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hSetNx(string $key, string $field, $value): MultiRedisInterface
    {
        $this->redis->hSetNx($key, $field, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hStrLen(string $key, string $field): MultiRedisInterface
    {
        $this->redis->hStrLen($key, $field);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hVals(string $key): MultiRedisInterface
    {
        $this->redis->hVals($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function has(string $key): MultiRedisInterface
    {
        $this->redis->has($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function incr(string $key): MultiRedisInterface
    {
        $this->redis->incr($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function incrBy(string $key, int $value): MultiRedisInterface
    {
        $this->redis->incrBy($key, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function incrByFloat(string $key, float $value): MultiRedisInterface
    {
        $this->redis->incrByFloat($key, $value);

        return $this;
    }

    /**
     * @return int
     */
    protected function increaseLevel(): int
    {
        return ++$this->level;
    }

    /**
     * @inheritDoc
     */
    public function info(): MultiRedisInterface
    {
        $this->redis->info();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function keys(string $pattern): MultiRedisInterface
    {
        $this->redis->keys($pattern);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function lIndex(string $key, int $index): MultiRedisInterface
    {
        $this->redis->lIndex($key, $index);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function lInsert(string $key, int $index, string $pivot, $value): MultiRedisInterface
    {
        $this->redis->lInsert($key, $index, $pivot, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function lLen(string $key): MultiRedisInterface
    {
        $this->redis->lLen($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function lPop(string $key): MultiRedisInterface
    {
        $this->redis->lPop($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function lPush(string $key, $value): MultiRedisInterface
    {
        $this->redis->lPush($key, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function lPushX(string $key, $value): MultiRedisInterface
    {
        $this->redis->lPushX($key, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function lRange(string $key, int $start, int $stop): MultiRedisInterface
    {
        $this->redis->lRange($key, $start, $stop);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function lRem(string $key, $reference, int $count): MultiRedisInterface
    {
        $this->redis->lRem($key, $reference, $count);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function lSet(string $key, int $index, $value): MultiRedisInterface
    {
        $this->redis->lSet($key, $index, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function lTrim(string $key, int $start, int $stop): MultiRedisInterface
    {
        $this->redis->lTrim($key, $start, $stop);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function lastSave(): MultiRedisInterface
    {
        $this->redis->lastSave();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function mGet(array $keys): MultiRedisInterface
    {
        $this->redis->mGet($keys);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function mSet(array $keysAndValues): MultiRedisInterface
    {
        $this->redis->mSet($keysAndValues);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function mSetNx(array $keysAndValues): MultiRedisInterface
    {
        $this->redis->mSetNx($keysAndValues);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function move(string $key, int $db): MultiRedisInterface
    {
        $this->redis->move($key, $db);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function pExpire(string $key, int $milliseconds): MultiRedisInterface
    {
        $this->redis->pExpire($key, $milliseconds);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function pExpireAt(string $key, int $milliseconds): MultiRedisInterface
    {
        $this->redis->pExpireAt($key, $milliseconds);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function pSetEx(string $key, int $milliseconds, $value): MultiRedisInterface
    {
        $this->redis->pSetEx($key, $milliseconds, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function pSubscribe(string $pattern): MultiRedisInterface
    {
        $this->redis->pSubscribe($pattern);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function pTtl(string $key): MultiRedisInterface
    {
        $this->redis->pTtl($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function pUnSubscribe(string $pattern): MultiRedisInterface
    {
        $this->redis->pUnSubscribe($pattern);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function persist(string $key): MultiRedisInterface
    {
        $this->redis->persist($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function pfAdd(string $key, $value): MultiRedisInterface
    {
        $this->redis->pfAdd($key, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function pfCount(string $key): MultiRedisInterface
    {
        $this->redis->pfCount($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function pfMerge(string $destination, array $sources): MultiRedisInterface
    {
        $this->redis->pfMerge($destination, $sources);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function ping(string $message = ''): MultiRedisInterface
    {
        $this->redis->ping($message);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function pubSub(string $subCommand, array $arguments): MultiRedisInterface
    {
        $this->redis->pubSub($subCommand, $arguments);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function publish(string $channel, string $message): MultiRedisInterface
    {
        $this->redis->publish($channel, $message);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function quit(): MultiRedisInterface
    {
        $this->redis->quit();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function rPop(string $key): MultiRedisInterface
    {
        $this->redis->rPop($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function rPopLPush(string $source, string $destination): MultiRedisInterface
    {
        $this->redis->rPopLPush($source, $destination);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function rPush(string $key, $value): MultiRedisInterface
    {
        $this->redis->rPush($key, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function rPushX(string $key, $value): MultiRedisInterface
    {
        $this->redis->rPushX($key, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function randomKey(): MultiRedisInterface
    {
        $this->redis->randomKey();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function rename(string $oldName, string $newName): MultiRedisInterface
    {
        $this->redis->rename($oldName, $newName);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function renameNx(string $oldName, string $newName): MultiRedisInterface
    {
        $this->redis->renameNx($oldName, $newName);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function runQuery($query, array $bindParams, array $bindTypes = []): MultiRedisInterface
    {
        $this->redis->runQuery($query, $bindParams, $bindTypes);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sAdd(string $key, string $member): MultiRedisInterface
    {
        $this->redis->sAdd($key, $member);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sCard(string $key): MultiRedisInterface
    {
        $this->redis->sCard($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sDiff(array $keys): MultiRedisInterface
    {
        $this->redis->sDiff($keys);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sDiffStore(string $destination, array $sources): MultiRedisInterface
    {
        $this->redis->sDiffStore($destination, $sources);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sInter(array $keys): MultiRedisInterface
    {
        $this->redis->sInter($keys);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sInterStore(string $destination, array $sources): MultiRedisInterface
    {
        $this->redis->sInterStore($destination, $sources);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sIsMember(string $key, string $member): MultiRedisInterface
    {
        $this->redis->sIsMember($key, $member);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sMembers(string $key): MultiRedisInterface
    {
        $this->redis->sMembers($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sMove(string $member, string $destination, string $source): MultiRedisInterface
    {
        $this->redis->sMove($member, $destination, $source);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sPop(string $key, int $count = 1): MultiRedisInterface
    {
        $this->redis->sPop($key, $count);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sRandMember(string $key, int $count = 1): MultiRedisInterface
    {
        $this->redis->sRandMember($key, $count);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sRem(string $key, string $member): MultiRedisInterface
    {
        $this->redis->sRem($key, $member);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sScan(int $cursor, string $pattern = '', int $count = 0): MultiRedisInterface
    {
        $this->redis->sScan($cursor, $pattern, $count);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sUnion(array $keys): MultiRedisInterface
    {
        $this->redis->sUnion($keys);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sUnionStore(string $destination, array $sources): MultiRedisInterface
    {
        $this->redis->sUnionStore($destination, $sources);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function save(): MultiRedisInterface
    {
        $this->redis->save();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function scan(int $cursor, string $pattern = '', int $count = 0): MultiRedisInterface
    {
        $this->redis->scan($cursor, $pattern, $count);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function select(int $database): MultiRedisInterface
    {
        $this->redis->select($database);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function set(string $key, $value, $ttl = null): MultiRedisInterface
    {
        $this->redis->set($key, $value, $ttl);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setBit(string $key, int $offset, int $value): MultiRedisInterface
    {
        $this->redis->setBit($key, $offset, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setEx(string $key, int $ttl, $value): MultiRedisInterface
    {
        $this->redis->setEx($key, $value, $ttl);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setNx(string $key, $value): MultiRedisInterface
    {
        $this->redis->setNx($key, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setRange(string $key, int $offset, $value): MultiRedisInterface
    {
        $this->redis->setRange($key, $offset, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sort(
        string $key,
        string $pattern = '',
        int $limit = 0,
        int $offset = 0,
        string $destination
    ): MultiRedisInterface {
        $this->redis->sort($key, $pattern, $limit, $offset, $destination);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function strLen(string $key): MultiRedisInterface
    {
        $this->redis->strLen($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function subscribe(string $channel): MultiRedisInterface
    {
        $this->redis->subscribe($channel);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function swapDb(int $source, int $destination): MultiRedisInterface
    {
        $this->redis->swapDb($source, $destination);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function time(): MultiRedisInterface
    {
        $this->redis->time();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function touch(string $key): MultiRedisInterface
    {
        $this->redis->touch($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function ttl(string $key): MultiRedisInterface
    {
        $this->redis->ttl($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function type(string $key): MultiRedisInterface
    {
        $this->redis->type($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function unSubscribe(string $channel): MultiRedisInterface
    {
        $this->redis->unSubscribe($channel);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function unlink(string $key): MultiRedisInterface
    {
        $this->redis->unlink($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function unwatch(): MultiRedisInterface
    {
        $this->redis->unwatch();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function watch(string $key): MultiRedisInterface
    {
        $this->redis->watch($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zAdd(string $key, int $score, $value): MultiRedisInterface
    {
        $this->redis->zAdd($key, $score, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zAddMod(string $key, string $mode, int $score, $value): MultiRedisInterface
    {
        $this->redis->zAddMod($key, $mode, $score, $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zCard(string $key): MultiRedisInterface
    {
        $this->redis->zCard($key);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zCount(string $key, int $fromScore, int $toScore): MultiRedisInterface
    {
        $this->redis->zCount($key, $fromScore, $toScore);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zDelete(string $key, string $member): MultiRedisInterface
    {
        $this->redis->zDelete($key, $member);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zDeleteRangeByScore(string $key, int $fromScore, int $toScore): MultiRedisInterface
    {
        $this->zRemRangeByScore($key, $fromScore, $toScore);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zIncrBy(string $key, float $score, string $member): MultiRedisInterface
    {
        $this->redis->zIncrBy($key, $score, $member);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zInterStore(string $destination, array $sources): MultiRedisInterface
    {
        $this->redis->zInterStore($destination, $sources);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zLexCount(string $key, $from, $to): MultiRedisInterface
    {
        $this->redis->zLexCount($key, $from, $to);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zRange(string $key, int $from, int $to): MultiRedisInterface
    {
        $this->redis->zRange($key, $from, $to);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zRangeByLex(string $key, $from, $to): MultiRedisInterface
    {
        $this->redis->zRangeByLex($key, $from, $to);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zRangeByScore(string $key, int $fromScore, int $toScore, array $options = []): MultiRedisInterface
    {
        $this->redis->zRangeByScore($key, $fromScore, $toScore, $options);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zRank(string $key, string $member): MultiRedisInterface
    {
        $this->redis->zRank($key, $member);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zRem(string $key, string $member): MultiRedisInterface
    {
        $this->redis->zrem($key, $member);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zRemRangeByLex(string $key, $from, $to): MultiRedisInterface
    {
        $this->redis->zRemRangeByLex($key, $from, $to);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zRemRangeByRank(string $key, int $start, int $stop): MultiRedisInterface
    {
        $this->redis->zRemRangeByRank($key, $start, $stop);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zRemRangeByScore(string $key, int $fromScore, int $toScore): MultiRedisInterface
    {
        $this->redis->zRemRangeByScore($key, $fromScore, $toScore);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zRevRange(string $key, int $from, int $to): MultiRedisInterface
    {
        $this->redis->zRevRange($key, $from, $to);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zRevRangeByLex(string $key, $from, $to): MultiRedisInterface
    {
        $this->redis->zRevRangeByLex($key, $from, $to);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zRevRangeByScore(
        string $key,
        int $fromScore,
        int $toScore,
        array $options = []
    ): MultiRedisInterface {
        $this->redis->zRevRangeByScore($key, $fromScore, $toScore, $options);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zRevRangeByScoreLimit(
        string $key,
        int $fromScore,
        int $toScore,
        int $offset,
        int $count
    ): MultiRedisInterface {
        return $this->zRevRangeByScore(
            $key,
            $fromScore,
            $toScore,
            [
                RedisInterface::ZRANGE_LIMIT  => $count,
                RedisInterface::ZRANGE_OFFSET => $offset,
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function zRevRangeWithScores(string $key, int $from, int $to): MultiRedisInterface
    {
        $this->redis->zRevRangeWithScores($key, $from, $to);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zRevRank(string $key, string $member): MultiRedisInterface
    {
        $this->redis->zRevRank($key, $member);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zScan(int $cursor, string $pattern = '', int $count = 0): MultiRedisInterface
    {
        $this->redis->zscan($cursor, $pattern, $count);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zScore(string $key, string $member): MultiRedisInterface
    {
        $this->redis->zScore($key, $member);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function zUnionStore(string $destination, array $sources): MultiRedisInterface
    {
        $this->redis->zUnionStore($destination, $sources);

        return $this;
    }
}
