<?php

namespace Demand\Soap;

class Container extends \stdClass implements \ArrayAccess, \Iterator, \Countable
{
    /**
     * Array that contains values when only one parameter is set when calling __construct method
     * @var array
     */
    private $internalArray;

    /**
     * Bool that tells if array is set or not
     * @var bool
     */
    private $arraySet = false;

    /**
     * Items index browser
     * @var int
     */
    private $arrayOffset;

    /**
     * @param array $values
     */
    public function __construct($values = array())
    {
        /**
         * Init array of values if set
         */
        $this->initInternalArray($values);

        /**
         * Generic set methods
         */
        if (is_array($values)) {
            foreach ($values as $name => $value)
                $this->_set($name, $value);
        }
    }

    /**
     * Generic method called when an object has been exported with var_export() functions
     * It allows to return an object instantiated with the values
     * @param array $arr the exported values
     * @param string $className optional (used by inherited classes in order to always call this method)
     * @return Container|null
     */
    public static function __set_state(array $arr)
    {
        $className = get_called_class();
//        if (class_exists($className)) {
            $object = new $className();
            if (is_object($object) && $object instanceof Container) {
                foreach ($arr as $name => $value)
                    $object->_set($name, $value);
            }
            return $object;
//        }
//        return null;
    }

    /**
     * Generic method setting value
     * @param string $_name property name to set
     * @param mixed $_value property value to use
     * @return bool
     */
    public function _set($_name, $_value)
    {
        $setMethod = 'set' . ucfirst($_name);
        if (method_exists($this, $setMethod)) {
            $this->$setMethod($_value);
            return true;
        };
        return false;
    }

    /**
     * Generic method getting value
     * @param string $_name property name to get
     * @return mixed
     */
    public function _get($_name)
    {
        $getMethod = 'get' . ucfirst($_name);
        if (method_exists($this, $getMethod)) {
            return $this->$getMethod();
        }
        return false;
    }

    /**
     * Method returning actual class name
     * @return string __CLASS__
     */
    public function __toString()
    {
        return get_called_class();
    }

    /**
     * Method returning internal array to iterate through
     * @return array
     */
    public function getInternalArray()
    {
        return $this->internalArray;
    }

    /**
     * Method setting intern array to iterate trough
     * @param array $arr
     * @return array
     */
    public function setInternalArray(array $arr)
    {
        return ($this->internalArray = $arr);
    }

    /**
     * Method returning internal array index when iterating trough
     * @return int
     */
    public function getInternalArrayOffset()
    {
        return $this->arrayOffset;
    }

    /**
     * Method setting intern array offset when iterating trough
     * @param int $offset
     */
    public function setInternalArrayOffset($offset)
    {
        $this->arrayOffset = $offset;
    }

    /**
     * Method returning true if intern array is an actual array
     * @return bool true|false
     */
    public function isInternalArraySet()
    {
        return $this->arraySet;
    }

    /**
     * Method setting if intern array is an actual array
     * @param bool $arraySet
     * @return bool true|false
     */
    public function setInternalArraySet($arraySet = false)
    {
        $this->arraySet = $arraySet;
    }

    /**
     * Method returning a lone attribute name when class is *array* type
     * @return string
     */
    public function getAttributeName()
    {
        return '';
    }

    /**
     * Method initiating internArrayToIterate
     *
     * @param array $arr the array to iterate trough
     * @param bool $recursive indicates that methods is calling itself
     * @return void
     */
    public function initInternalArray($arr = array(), $recursive = false)
    {
        if (stripos($this->__toString(), 'array') !== false) {
            if (is_array($arr) && count($arr)) {
                $this->setInternalArray($arr);
                $this->setInternalArrayOffset(0);
                $this->setInternalArraySet(true);
            } elseif (
                !$recursive &&
                $this->getAttributeName() != '' &&
                property_exists($this->__toString(), $this->getAttributeName())
            ) {
                $this->initInternalArray($this->_get($this->getAttributeName()), true);
            }
        }
    }

    /**
     * Default method adding item to array
     * @param mixed $item value
     * @return bool true|false
     */
    public function add($item)
    {
        if ($this->getAttributeName() != '' && stripos($this->__toString(),'array') !== false) {
            /* init array */
            if (!is_array($this->_get($this->getAttributeName())))
                $this->_set($this->getAttributeName(),array());
            /* current array */
            $currentArray = $this->_get($this->getAttributeName());
            array_push($currentArray,$item);
            $this->_set($this->getAttributeName(),$currentArray);
            $this->setInternalArray($currentArray);
            $this->setInternalArraySet(true);
            $this->setInternalArrayOffset(0);
            return true;
        }
        return false;
    }

    /* implement array interface */

    /**
     * Method returning item length, alias to length
     * @return int
     */
    public function count()
    {
        return $this->isInternalArraySet() ? count($this->getInternalArray()) : -1;
    }

    /**
     * Method returning the current element
     * @return mixed
     */
    public function current()
    {
        return $this->offsetGet($this->getInternalArrayOffset());
    }

    /**
     * Method moving the current position to the next element
     */
    public function next()
    {
        $this->setInternalArrayOffset($this->getInternalArrayOffset() + 1);
    }

    /**
     * Method resetting itemOffset
     */
    public function rewind()
    {
        $this->setInternalArrayOffset(0);
    }

    /**
     * Method checking if current itemOffset points to an existing item
     * @return bool true|false
     */
    public function valid()
    {
        return $this->offsetExists($this->getInternalArrayOffset());
    }

    /**
     * Method returning current itemOffset value, alias to getInternalArrayOffset
     * @return int
     */
    public function key()
    {
        return $this->getInternalArrayOffset();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset)
    {
        return ($this->isInternalArraySet() && array_key_exists($offset,$this->getInternalArray()));
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->internalArray[$offset] : null;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        return;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     */
    public function offsetUnset($offset)
    {
        return;
    }

}