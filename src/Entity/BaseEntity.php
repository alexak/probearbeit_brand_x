<?php

namespace App\Entity;

class BaseEntity
{
    public function setAttribute($attribute, $value, $type='string') {
        if (property_exists($this, $attribute)) {
            $this->$attribute = $this->castValue($value, $type);
        }
    }

    private function castValue($value, $type) {
        switch ($type) {
            case 'integer':
                return (int) $value;
            case 'float':
                return (float) $value;
            case 'boolean':
                return (bool) $value;
            case 'datetime':
                return new \DateTime($value);
            case 'date':
                return new \DateTime($value);
            case 'time':
                return new \DateTime($value);
            default:
                return (string) $value;
        }
    }

}
