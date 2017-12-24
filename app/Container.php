<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 23.12.2017
 * Time: 20:39
 */

namespace App;


/**
 * @property mixed config
 */
class Container implements \ArrayAccess
{

    protected $items = [];
    protected $cache = [];

    public function __get($property)
    {
        return $this->offsetGet($property);
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    /**
     * Shorter version for offsetExists()
     * @param $offset
     * @return bool
     */
    public function has($offset)
    {
        return $this->offsetExists($offset);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        if(!$this->has($offset)) {
            return null;
        }

        if(isset($this->cache[$offset])) {
            return $this->cache[$offset];
        }

        $this->cache[$offset] = $this->items[$offset]();

        return $this->items[$offset]();
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->items[$offset] = $value;
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        if ($this->has($offset)) {
            unset($this->items[$offset]);
        }
    }
}