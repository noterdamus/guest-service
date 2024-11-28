<?php

namespace App\Repositories;

use App\Exceptions\ApiException;
use App\Models\Guest;
use Illuminate\Database\Eloquent\Collection;
use Propaganistas\LaravelPhone\PhoneNumber;

class GuestRepository
{
    protected string $model = Guest::class;

    /**
     * Получение всех гостей
     * @return Collection
     */
    public function getGuests(): Collection
    {
        return $this->model::query()->get();
    }

    /**
     * Создание гостя
     * @param array $data
     * @return Guest
     */
    public function createGuest(array $data): Guest
    {
        if (empty($data['country'])) {
            $data['country'] = $this->getCountryFromPhone($data['phone']);
        }

        return (new $this->model())->create($data);
    }

    /**
     * Обновление гостя
     * @param array $data
     * @param int $id
     * @return void
     * @throws ApiException
     */
    public function updateGuest(int $id, array $data): void
    {
        $guest = $this->getGuest($id);

        if (empty($guest->country) && empty($data['country']) && !empty($data['phone'])) {
            $data['country'] = $this->getCountryFromPhone($data['phone']);
        }

        $guest->update($data);
    }

    /**
     * Получение гостя
     * @param int $id
     * @return Guest
     * @throws ApiException
     */
    public function getGuest(int $id): Guest
    {
        $guest = $this->model::query()->find($id);

        if (empty($guest)) {
            throw new ApiException('Гость с таким ID не найден', 404);
        }

        return $guest;
    }

    /**
     * Удаление гостя
     * @param int $id
     * @throws ApiException
     */
    public function deleteGuest(int $id): void
    {
        $guest = $this->getGuest($id);
        $guest->delete();
    }

    /**
     * Получение страны по номеру телефона
     * @param string $phone
     * @return string|null
     */
    private function getCountryFromPhone(string $phone): string|null
    {
        $phoneNumber = new PhoneNumber($phone);
        $countryCode = $phoneNumber->getCountry();

        if (!empty($countryCode)) {
            return \Locale::getDisplayRegion('-' . $countryCode, 'ru');
        }

        return null;
    }
}
