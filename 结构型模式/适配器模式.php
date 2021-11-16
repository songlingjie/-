<?php
/**
 * Created by PhpStorm.
 * User: songlingjie
 * Date: 11/15/21
 * Time: 10:33 AM
 */


/**
 * 定义：适配器模式是一种事后补救的策略，适配器提供和原始类不同的接口而代理模式装饰器模式都是提供和原始类相同的接口
 * 举例：mac不支持use接口传输数据，使用U盘与Mac传输数据就需要使用适配器
 */


class UDisk
{
    public function usbTransmission()
    {
        echo "使用USB传输";
    }
}

interface MacTransmission
{
    public function TypeCTransport();
}


class MacTransmissionAdapter implements MacTransmission
{
    /**
     * @var UDisk
     */
    private $disk;

    public function __construct(UDisk $disk)
    {
        $this->$disk = $disk;
    }

    public function TypeCTransport()
    {
        $this->disk->usbTransmission();
        echo "使用type c 和mac 传输";
    }
}


