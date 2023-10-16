<?php

namespace App\Services;

use App\Api\RandomUser;
use App\Models\Employee;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ImportService
{
    /**
     * @return array
     */
    public function run(): array
    {
        $collection = $this->getCleanCollection();
        $collectionCount = $collection->count();
        $countUntilIntervention = Employee::count();

        Employee::upsert($collection->toArray(), ['first_name', 'last_name'], ['email', 'age']);

        $all = Employee::count();
        $created = $all - $countUntilIntervention;
        $updated = $collectionCount - $created;

        return ['all' => $all, 'created' => $created, 'updated' => $updated];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getUsersCollectionFromApi(): \Illuminate\Support\Collection
    {
        try {
            return (new RandomUser())->setInc(['dob', 'name', 'email'])->setCount(5000)->fetch()->getCollectionFromResponse();
        } catch (RequestException) {
            throw new HttpException(500, __('Упс... Импорт пользователей временно недоступен, повторите попытку немного позже.'));
        }
    }

    /**
     * @return array[]
     */
    public function rulesForEachEntityInCollection(): array
    {
        return [
            'email' => [
                'required', 'string', 'email', 'max:255'
            ],
            'dob.age' => [
                'required', 'integer', 'min:0', 'max:127'
            ],
            'name.last' => [
                'required', 'string', 'max:128'
            ],
            'name.first' => [
                'required', 'string', 'max:128'
            ],
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getCleanCollection(): \Illuminate\Support\Collection
    {
        $collection = collect();

        foreach ($this->getUsersCollectionFromApi() as $entity) {
            if (Validator::make($entity, $this->rulesForEachEntityInCollection())->passes()) {
                $collection->push(
                    collect([
                        'first_name' => $entity['name']['first'],
                        'last_name' => $entity['name']['last'],
                        'email' => $entity['email'],
                        'age' => $entity['dob']['age'],
                    ])
                );
            }
        }

        return $collection;
    }
}
