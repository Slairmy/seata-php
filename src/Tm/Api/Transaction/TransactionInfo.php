<?php


namespace Hyperf\Seata\Tm\Api\Transaction;


use Throwable;

class TransactionInfo
{
    /**
     * @var int
     */
    private $timeOut;

    /**
     * @var string
     */
    private $name;

    /**
     * @var RollbackRule[]
     */
    private $rollbackRules;

    /**
     * @var Propagation
     */
    private $propagation;

    /**
     * @var int
     */
    private $lockRetryInterval;

    /**
     * @var int
     */
    private $lockRetryTimes;

    /**
     * @return int
     */
    public function getTimeOut(): int
    {
        return $this->timeOut;
    }

    /**
     * @param int $timeOut
     */
    public function setTimeOut(int $timeOut): void
    {
        $this->timeOut = $timeOut;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return RollbackRule[]
     */
    public function getRollbackRules(): array
    {
        return $this->rollbackRules;
    }

    /**
     * @param RollbackRule[] $rollbackRules
     */
    public function setRollbackRules(array $rollbackRules): void
    {
        $this->rollbackRules = $rollbackRules;
    }

    public function rollbackOn(Throwable $e)
    {
        $winner = null;
        $deepest = PHP_INT_MAX;
        if (! empty($this->rollbackRules)) {
            $winner = new NoRollbackRule(NoRollbackRule::$DEFAULT_NO_ROLLBACK_RULE);
            foreach ($this->rollbackRules as $rollbackRule) {
                $depth = $rollbackRule->getDepth($e);
                if ($depth >= 0 && $depth < $deepest) {
                    $deepest = $depth;
                    $winner = $rollbackRule;
                }
            }
        }
        return !($winner instanceof NoRollbackRule);
    }

    /**
     * @return Propagation
     */
    public function getPropagation(): Propagation
    {
        if ($this->propagation !== null) {
            return $this->propagation;
        }
        // default propagation
        return new Propagation(Propagation::REQUIRED);
    }

    /**
     * @param Propagation $propagation
     */
    public function setPropagation(Propagation $propagation): void
    {
        $this->propagation = $propagation;
    }

    /**
     * @return int
     */
    public function getLockRetryInterval(): int
    {
        return $this->lockRetryInterval;
    }

    /**
     * @param int $lockRetryInterval
     */
    public function setLockRetryInterval(int $lockRetryInterval): void
    {
        $this->lockRetryInterval = $lockRetryInterval;
    }

    /**
     * @return int
     */
    public function getLockRetryTimes(): int
    {
        return $this->lockRetryTimes;
    }

    /**
     * @param int $lockRetryTimes
     */
    public function setLockRetryTimes(int $lockRetryTimes): void
    {
        $this->lockRetryTimes = $lockRetryTimes;
    }





}