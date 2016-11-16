<?php

namespace Medz\Component;

use Closure;

/**
 * 用于生成字典本.
 */
class CreateOrderLength
{
    /**
     * 需要循环生成的keys.
     *
     * @var array
     */
    protected $keys = array();

    /**
     * 需要生成的长度.
     *
     * @var int
     */
    protected $length = 0;

    /**
     * 是否生成固定长度.
     *
     * @var bool
     */
    protected $isStaticLength = false;

    /**
     * 每一次生成的回调方法.
     *
     * @var Closure
     */
    protected $callable;

    /**
     * 构造方法，用于实例化的时候生成默认数据.
     *
     * @param int     $length   The length that needs to be generated
     * @param Closure $callable call function
     * @param array   $keys     User-generated characters
     *
     * @author Seven Du <lovevipdsw@outlook.com>
     * @homepage http://medz.cn
     */
    public function __construct(
        $length = 1,
        Closure $callable = null,
        array $keys = array(
            '1', '2', '3', '4', '5', '6', '7', '8', '9', '0',
            'q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p',
            'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'z',
            'x', 'c', 'v', 'b', 'n', 'm',
        )
    ) {
        $this->setLength($length);
        if (is_array($length)) {
            list($length, $isStaticLength) = $length;
            $this->setLength($length, $isStaticLength);
        }

        if ($callable !== null) {
            $this->setCallable($callable);
        }

        $this->setKeys($keys);
    }

    /**
     * Set crater length.
     *
     * @param int  $length         The length that needs to be generated
     * @param bool $isStaticLength [false] Generates only the specified length
     *
     * @author Seven Du <lovevipdsw@outlook.com>
     * @homepage http://medz.cn
     */
    public function setLength($length, $isStaticLength = false)
    {
        $length = intval($length);
        if ($length < 1) {
            throw new \Exception('set create length < 1.');
        }

        $this->length = $length;
        $this->isStaticLength = (bool) $isStaticLength;

        return $this;
    }

    /**
     * Set callable closure function.
     *
     * @param Closure $callable call function
     *
     * @author Seven Du <lovevipdsw@outlook.com>
     * @homepage http://medz.cn
     */
    public function setCallable(Closure $callable)
    {
        $this->callable = $callable;

        return $this;
    }

    /**
     * Set create base keys.
     *
     * @param array $keys User-generated characters
     *
     * @author Seven Du <lovevipdsw@outlook.com>
     * @homepage http://medz.cn
     */
    public function setKeys(array $keys)
    {
        $this->keys = $keys;

        return $this;
    }

    /**
     * Start functuon. [Recursive, call fn function].
     *
     * @param string $string Prefix the string
     *
     * @author Seven Du <lovevipdsw@outlook.com>
     * @homepage http://medz.cn
     */
    public function start($string = '')
    {
        foreach ($this->keys as $key) {
            $this->fn($string.$key);
        }
    }

    /**
     *  Call function, run callable.
     *
     * @param string $string The resulting string (concatenated with the previous string)
     *
     * @author Seven Du <lovevipdsw@outlook.com>
     * @homepage http://medz.cn
     */
    protected function fn($string)
    {
        if ($this->isStaticLength === false) {
            call_user_func_array($this->callable, array($string));
        }

        if (isset($string[$this->length - 1])) {
            if ($this->isStaticLength === true) {
                call_user_func_array($this->callable, array($string));
            }

            // stop.
            return;
        }

        $this->start($string);
    }
}
