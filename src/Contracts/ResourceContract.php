<?php


namespace Hell\Vephar\Contracts;

use Hell\Vephar\Response;

abstract class ResourceContract
{
    /**
     * ResourceContract constructor.
     * @param $data
     * @param bool $setters
     */
    public function __construct($data, $setters = true)
    {
        if ($setters) {
            $this->bySetMethod($data);
            return;
        }
        $this->byDinamicallyAttribute($data);
        return;
    }

    /**
     * @param $data
     * @return ResourceContract
     */
    public function bySetMethod($data)
    {
        $data = $this->arrayIndexToCamelCase($data);
        $object = $this;
        $methods = get_class_methods($object);
        foreach ($methods as $method) {
            preg_match(' /^(set)(.*?)$/i', $method, $results);
            $setMethod = $results[1] ?? '';
            $attritbuteName = toCamelCase($results[2] ?? '');
            if ($setMethod == 'set' && array_key_exists($attritbuteName, $data)) {
                $object->$method($this->getValue($data[$attritbuteName]));
            }
        }

        if (method_exists($object, "setCustomAttributes")) {
            $object->setCustomAttributes(new $this($data, false));
        }

        return $object;
    }

    /**
     * @param $data
     * @return array
     */
    protected function arrayIndexToCamelCase($data = [])
    {
        $newData = [];
        foreach ($data as $attribute => $value) {
            $attributeName = toCamelCase($attribute);
            $newData[$attributeName] = $value;
        }
        return $newData;
    }

    /**
     * @param $data
     */
    protected function byDinamicallyAttribute($data)
    {
        foreach ($data as $attribute => $value) {
            $attributeName = toCamelCase($attribute);
            $this->{$attributeName} = $this->getValue($value);
        }
    }

    /**
     * @param $value
     * @return mixed
     */
    protected function getValue($value)
    {
        if (!is_array($value) || !is_object_array($value)) {
            return $value;
        }
        return Response::resource($value);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $attributes = get_object_vars($this);
        $newAttributes = [];
        foreach ($attributes as $key => $value) {
            $newAttributes[toSnakeCase($key)] = $value;
        }
        return $newAttributes;
    }
}
