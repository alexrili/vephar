<?php


namespace Hell\Vephar;

use Hell\Vephar\Contracts\CollectionContract;
use Hell\Vephar\Contracts\ContractException;
use Hell\Vephar\Contracts\ResourceContract;
use Illuminate\Support\Arr;

/**
 * Class Response
 * @package Hell\Vephar
 */
class Response
{

    /**
     * @var
     */
    protected $resource;

    /**
     * @var
     */
    protected $collection;


    /**
     * Response constructor.
     * @param string $resource
     * @param string $collection
     * @throws \Throwable
     */
    public function __construct(string $resource = Resource::class, string $collection = Collection::class)
    {
        $this->setResource($resource);
        $this->setCollection($collection);
    }

    /**
     * @param string $resource
     * @throws \Throwable
     */
    public function setResource(string $resource): void
    {
        throw_unless((new $resource instanceof ResourceContract), new ContractException(ResourceContract::class));
        $this->resource = $resource;
    }


    /**
     * @param string $collection
     * @throws \Throwable
     */
    public function setCollection(string $collection): void
    {
        throw_unless((new $collection instanceof CollectionContract), new ContractException(CollectionContract::class));
        $this->collection = $collection;
    }


    /**
     * @param array $data
     * @param string $resource
     * @param string $collection
     * @return mixed
     * @throws \Throwable
     */
    public static function collection(
        $data = [],
        string $resource = Resource::class,
        string $collection = Collection::class
    ) {
        return (new Response($resource, $collection))->make($data);
    }


    /**
     * @param array $data
     * @return mixed
     */
    protected function toCollect($data = [])
    {
        $items = [];
        foreach ($data as $item) {
            $items[] = new $this->resource($item);
        }

        return new $this->collection($items);
    }


    /**
     * @param array $data
     * @param string $resource
     * @return mixed
     * @throws \Throwable
     */
    public static function resource($data = [], string $resource = Resource::class)
    {
        return (new Response($resource))->make($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function toResource(array $data)
    {
        return new $this->resource($data);
    }


    /**
     * @param $data
     * @return mixed
     */
    public function make($data)
    {
        if (Arr::isAssoc($data)) {
            return $this->toResource($data);
        }
        return $this->toCollect($data);
    }
}
