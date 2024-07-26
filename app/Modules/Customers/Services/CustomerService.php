<?php
namespace App\Modules\Customers\Services;

use App\Modules\Customers\Models\Customer;
use Exception;
use App\Modules\Customers\Repositories\CustomerRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomerService
{
    /**
     * @param CustomerRepository $customerRepository
     */
    public function __construct(private CustomerRepository $customerRepository)
    {
    }
   
    public function index($data)
    {
        $search = strtolower($data['search'] ?? '');
        $per_page = $data['per_page'] ?? 10;
        return $this->customerRepository->query()->whereRaw("lower(first_name) like (?)", ["{$search}%"])
            ->paginate($per_page);
    }

    /**
     * @param Customer $customer
     * @return Customer|null
     * @throws Exception
     */
    public function show(Customer $customer): Customer|null
    {
        if (!$customer->id) {
            throw new ModelNotFoundException(trans('CustomerLocalization::general.customer.notFound'));
        }
        return $customer;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function store($data): mixed
    {
        return $this->customerRepository->create($data);
    }

    /**
     * @param Customer $customer
     * @param $data
     * @return bool
     */
    public function update(Customer $customer, $data): bool
    {
        if (!$customer->id) {
            throw new ModelNotFoundException(trans('CustomerLocalization::general.customer.notFound'));
        }
        $updatedData = $customer->fill($data);
        return $this->customerRepository->update($updatedData->toArray());
    }

    /**
     * @param Customer $customer
     * @return bool|null
     */
    public function delete(Customer $customer): ?bool
    {
        if (!$customer->id) {
            throw new ModelNotFoundException(trans('CustomerLocalization::general.customer.notFound'));
        }
        return $this->customerRepository->delete($customer->id);
    }

}