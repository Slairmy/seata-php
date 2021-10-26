<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Hyperf\Seata\Core\Protocol\Transaction;

abstract class AbstractBranchEndResponse extends AbstractTransactionResponse
{
    protected string $xid = '';

    protected int $branchId;

    /**
     * @see \Hyperf\Seata\Core\Model\BranchStatus
     */
    protected int $branchStatus;

    public function getXid(): string
    {
        return $this->xid;
    }

    public function setXid(string $xid): static
    {
        $this->xid = $xid;
        return $this;
    }

    public function getBranchId(): int
    {
        return $this->branchId;
    }

    public function setBranchId(int $branchId): static
    {
        $this->branchId = $branchId;
        return $this;
    }

    public function getBranchStatus(): int
    {
        return $this->branchStatus;
    }

    public function setBranchStatus(int $branchStatus): static
    {
        $this->branchStatus = $branchStatus;
        return $this;
    }
}
