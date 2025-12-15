<?php
namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\CommonRepositoryInterface;
use App\Models\Priority;
use App\Models\Status;

class CommonRepository implements CommonRepositoryInterface
{
    protected $status;
    protected $priority;

    public function __construct(Status $status,Priority $priority)
    {
        $this->status = $status;
        $this->priority = $priority;
    }

    public function StatusSelect()
    {
        return $this->status->all()->where('is_active',true);
    }

    public function PrioritySelect()
    {
        return $this->priority->all()->where('is_active',true);
    }
}