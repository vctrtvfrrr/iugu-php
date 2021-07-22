<?php

declare(strict_types=1);

/**
 * Iugu_Object manages the Object State
 * Values that changed, values that need to be saved.
 */
class Iugu_Object implements ArrayAccess
{
    protected $_attributes;
    protected $_unsavedAttributes;

    public function __construct($attributes = [])
    {
        $this->_attributes = [];
        $this->_unsavedAttributes = [];

        foreach ($attributes as $key => $value) {
            $this->_attributes[$key] = $value;
        }
    }

    public function __set($key, $value): void
    {
        $this->offsetSet($key, $value);
    }

    public function __isset($key)
    {
        return $this->offsetExists($key);
    }

    public function __unset($key): void
    {
        $this->offsetUnset($key);
    }

    public function __get($key)
    {
        return $this->offsetGet($key);
    }

    public function __toString()
    {
        if (isset($this->_attributes['id'])) {
            return $this->_attributes['id'];
        }

        return static::class;
    }

    public function offsetSet($key, $value): void
    {
        $this->_attributes[$key] = $value;
        $this->_unsavedAttributes[$key] = 1;
    }

    public function offsetExists($k)
    {
        return array_key_exists($k, $this->_attributes);
    }

    public function offsetUnset($key): void
    {
        unset($this->_attributes[$key], $this->_unsavedAttributes[$key]);
    }

    public function offsetGet($key)
    {
        return array_key_exists($key, $this->_attributes) ? $this->_attributes[$key] : null;
    }

    public function keys()
    {
        return array_keys($this->_attributes);
    }

    public function modifiedAttributes()
    {
        return array_intersect_key($this->_attributes, $this->_unsavedAttributes);
    }

    public function resetStates(): void
    {
        $this->_unsavedAttributes = [];
    }

    public function is_new()
    {
        return ! isset($this->_attributes['id']);
    }

    public function copy($object): void
    {
        foreach ($object->keys() as $key) {
            $this->_attributes[$key] = $object[$key];
        }
    }
}
