<?php
interface Prices
{
    public function getPrice();
    public function setPrice($price);
}
interface Transport
{
    public function startEngine();
    public function stopEngine();
}
interface MediaDevice
{
    public function nextChannel();
    public function prevChannel();
}
interface Tool
{
    public function switchIt();
}
interface Flying
{
    public function takeoff();
    public function landing();
}
class Goods implements Prices
{
    protected $vendor;
    protected $name;
    protected $price;

    public function __construct($vendor, $name)
    {
        $this->vendor = $vendor;
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
}
class Car extends Goods implements Transport
{
    protected $color;
    protected $velocity = 0;
    protected $acceleration = 0;

    public function __construct($vendor, $name, $price, $color)
    {
        parent::__construct($vendor,$name,$price);
        $this->color = $color;
    }

    public function startEngine()
    {
        echo 'Engine started';
    }

    public function stopEngine()
    {
        echo 'Engine stoped';
    }
}
class Tv extends Goods implements MediaDevice
{
    protected $screenSize;
    protected $channel = 0;

    public function __construct($vendor, $name, $screenSize)
    {
        parent::__construct($vendor,$name);
        $this->screenSize = $screenSize;
    }

    public function nextChannel()
    {
        $this->channel++;
    }

    public function prevChannel()
    {
        $this->channel--;
    }
}
class Pen  extends Goods implements Tool
{
    protected $color;
    protected $width;
    protected $switched;

    public function __construct($vendor, $name, $color, $width)
    {
        parent::__construct($vendor,$name);
        $this->color = $color;
        $this->width = $width;
    }

    public function switchIt()
    {
        $this->switched = !$this->switched;
    }
}
class Bird implements Flying
{
    protected $weight;
    protected $sex;

    public function __construct($weight, $sex)
    {
        $this->weight = $weight;
        $this->sex = $sex;
    }

    public function takeoff()
    {
        echo 'Wow! I can fly!';
    }

    public function landing()
    {
        echo "I'am landing";
    }
}
class Duck extends Bird
{
    public function sayQuack()
    {
        echo 'Quack';
    }
}
?>