<?php

namespace Medz\Component;

// use callable;

/**
 * 用于生成字典本.
 */
class CreateOrderLength
{
    /**
     * 默认keys.
     */
    const DEFAULT_KEYS = array(
        '1', '2', '3', '4', '5', '6', '7', '8', '9', '0',
        'q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p',
        'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'z',
        'x', 'c', 'v', 'b', 'n', 'm',
    );

    /**
     * 需要循环生成的keys.
     *
     * @var array
     */
    protected $keys = [];

    /**
     * 需要生成的长度.
     *
     * @var integer
     */
    protected $length = 0;

    /**
     * 每一次生成的回调方法.
     *
     * @var \callable
     */
    protected $callable;

    /**
     * 构造方法，用于实例化的时候生成默认数据.
     *
     * @param int $length 生成的长度，default length 1.
     * @param \callable $callable 回调方法
     * @param array $keys 用于生产的key
     * 
     * @author Seven Du <lovevipdsw@outlook.com>
     * @homepage http://medz.cn
     */
    public function __construct($length = 1, callable $callable = null, array $keys = self::DEFAULT_KEYS)
    {
        $this->setLength($length);

        if ($callable !== null) {
            $this->setCallable($callable);
        }

        $this->setKeys($keys);
    }

    /**
     * 设置生成长度方法.
     *
     * @param int $length
     * @author Seven Du <lovevipdsw@outlook.com>
     * @homepage http://medz.cn
     */
    public function setLength($length)
    {
        $length = intval($length);
        if ($length < 1) {
            throw new \Exception('set create length < 1.');
        }

        $this->length = $length;

        return $this;
    }

    /**
     * 设置回调函数方法.
     *
     * @param \callable $callable 回调函数
     * @author Seven Du <lovevipdsw@outlook.com>
     * @homepage http://medz.cn
     */
    public function setCallable(callable $callable)
    {
        $this->callable = $callable;

        return $this;
    }

    /**
     * 设置用于生成的key值.
     *
     * @param array $keys
     * @author Seven Du <lovevipdsw@outlook.com>
     * @homepage http://medz.cn
     */
    public function setKeys(array $keys)
    {
        $this->keys = $keys;

        return $this;
    }

    /**
     * 开始生成|fn递归函数.
     *
     * @param string $string 生成长度前默认字符串
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
     * 生成函数循环执行方法.
     *
     * @param string $string 生成的字符串（拼接上了之前的字符串）
     *
     * @author Seven Du <lovevipdsw@outlook.com>
     * @homepage http://medz.cn
     */
    protected function fn($string)
    {
        call_user_func_array($this->callable, array($string));
        if (isset($string[$this->length])) {
            // 生成到了指定长度，终止继续递归，开始递归下一条.
            return null;
        }

        $this->start($string);
    }
}
