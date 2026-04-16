<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Location;
use App\Enum\LocationType;

class ValidLocationHierarchy implements Rule
{
    private $message = '';
    private $currentType;
    private $currentId;

    public function __construct($type, $currentId = null)
    {
        $this->currentType = $type;
        $this->currentId = $currentId;
    }

    public function passes($attribute, $value)
    {
        // إذا parent_id فارغ، يجب أن يكون النوع governorate فقط
        if (is_null($value)) {
            if ($this->currentType !== LocationType::GOVERNORATE->value) {
                $this->message = 'Only Governorate can have no parent';
                return false;
            }
            return true;
        }

        // التحقق من وجود الـ parent
        $parent = Location::find($value);
        if (!$parent) {
            return true; // سيتم التحقق من exists في rule آخر
        }

        // التحقق من الهرمية الصحيحة
        $validParentTypes = [
            LocationType::GOVERNORATE->value => null, // بدون parent
            LocationType::CITY->value => LocationType::GOVERNORATE->value,
            LocationType::AREA->value => LocationType::CITY->value,
        ];

        $expectedParentType = $validParentTypes[$this->currentType] ?? null;

        if ($expectedParentType === null) {
            $this->message = "{$this->currentType} cannot have a parent";
            return false;
        }

        if ($parent->type !== $expectedParentType) {
            $this->message = "Parent of {$this->currentType} must be {$expectedParentType}, got {$parent->type}";
            return false;
        }

        return true;
    }

    public function message()
    {
        return $this->message ?: 'Invalid location hierarchy';
    }
}
