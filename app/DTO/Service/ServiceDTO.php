<?php
namespace App\DTO\Service;
use App\DTO\BaseDTO;
use Illuminate\Support\Arr;
class ServiceDTO extends BaseDTO
{
    /**
     * @param string $name
     * @param float $price
     */
    public function __construct(
        protected string $name,
        protected float $price,
    ) {}
    public static function fromRequest($request): self
    {
        return new self(
            name: $request->name,
            price: (float) $request->price,
        );
    }
    /**
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: Arr::get($data, 'name'),
            price: (float) Arr::get($data, 'price'),
        );
    }
    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
        ];
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
}
