<?php

namespace App\Modules\Services\Repositories;

use App\Repositories\BaseRepository;
use App\Modules\Services\Models\Service;
use App\Modules\Services\Repositories\Interfaces\ServiceInterface;

class ServiceRepository extends BaseRepository implements ServiceInterface
{
    public function __construct(private Service $service)
    {
        parent::__construct($service);
    }

}
