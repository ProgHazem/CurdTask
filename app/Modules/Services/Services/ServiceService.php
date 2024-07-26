<?php
namespace App\Modules\Services\Services;

use App\Modules\Customers\Models\Customer;
use App\Modules\Services\Models\Service;
use Exception;
use App\Modules\Services\Repositories\ServiceRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ServiceService
{
    /**
     * @param ServiceRepository $serviceRepository
     */
    public function __construct(private ServiceRepository $serviceRepository)
    {
    }
   
    public function index($data)
    {
        $search = strtolower($data['search'] ?? '');
        $per_page = $data['per_page'] ?? 10;
        return $this->serviceRepository->query()->whereRaw("lower(name) like (?)", ["{$search}%"])
            ->paginate($per_page);
    }

    
    public function getServicesCustomer(Customer $customer)
    {
        if (!$customer->id) {
            throw new ModelNotFoundException(trans('CustomerLocalization::general.customer.notFound'));
        }
        return $customer->services;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function store($data): mixed
    {
        return $this->serviceRepository->create($data);
    }

    /**
     * @param Service $service
     * @param $data
     * @return bool
     */
    public function update(Service $service, $data): bool
    {
        if (!$service->id) {
            throw new ModelNotFoundException(trans('ServiceLocalization::general.service.notFound'));
        }
        $updatedData = $service->fill($data);
        return $this->serviceRepository->update($updatedData->toArray());
    }

    /**
     * @param Service $service
     * @return bool|null
     */
    public function delete(Service $service): ?bool
    {
        if (!$service->id) {
            throw new ModelNotFoundException(trans('ServiceLocalization::general.service.notFound'));
        }
        return $this->serviceRepository->delete($service->id);
    }

}