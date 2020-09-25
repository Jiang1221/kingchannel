<?php

namespace Jzb\common;
/**
 * 自定义的一个异常处理类
 */
class MyException extends \Exception
{
    public function __construct($message, $code = 0)
    {

        parent::__construct($message, $code);
    }

    public function __toString()
    {
        //重写父类方法，自定义字符串输出的样式
        return __CLASS__ . ":[" . $this->code . "]:" . $this->message . "<br>";
    }

}



