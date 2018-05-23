<?php
interface Prices
{
    public function setPrice($price);
    public function setShipping($shipping);
    public function setDiscount($discount);
    public function setWeight($weight);
    public function getPrice();
    public function getShipping();
    public function getDiscount();
    public function getWeight();
    public function printPrice();
    public function printShipping();
}
interface Ages
{
    public function setAges($minAge, $maxAge);
    public function getMinAge();
    public function getMaxAge();
    public function printAges();
}
interface Fluid
{
    public function setVolume($volume);
    public function getVolume();
    public function printVolume();
}
trait volume
{
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    public function getVolume()
    {
        return $this->volume;
    }
    public function printVolume()
    {
        echo '<p>Объем: '.$this->volume.' л</p>';
    }
}
class Product implements Prices
{
    protected $name;
    protected $price;
    protected $discount = 10;
    protected $weight;
    protected $shipping;
    public function __construct($name, $price, $weight)
    {
        $this->name = $name;
        $this->price = $price;
        $this->weight = $weight;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function setShipping($shipping)
    {
        $this->shipping = $shipping;
    }
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
    public function getPrice()
    {
        if ((isset($this->discount))&&($this->discount)){
            $this->shipping = 300;
            return round($this->price*(100-$this->discount)/100,2);
        }
        else {
            $this->shipping = 250;
            return $this->price;
        }
    }
    public function getShipping()
    {
        $this->getPrice();
        return $this->shipping;
    }
    public function getDiscount()
    {
        return $this->discount;
    }
    public function getWeight()
    {
        return $this->weight;
    }
    public function printPrice()
    {
        echo '<p>Цена: '.$this->getPrice().' руб.</p>';
    }
    public function printShipping()
    {
        echo '<p>Доставка: '.$this->getShipping().' руб.</p>';
    }
    public function printProductGeneral()
    {
        echo "<h3>$this->name</h3>";
        $this->printPrice();
        $this->printShipping();
    }
}
class Toy extends Product implements Ages
{
    protected $minAge;
    protected $maxAge;
    public function setAges($minAge, $maxAge)
    {
        $this->minAge = $minAge;
        $this->maxAge = $maxAge;
    }
    public function getMinAge()
    {
        return $this->minAge;
    }
    public function getMaxAge()
    {
        return $this->maxAge;
    }
    public function printAges()
    {
        if ((isset($this->minAge))&&(isset($this->minAge)))
            echo "<p>Для детей от $this->minAge до $this->maxAge лет</p>";
    }
}
class Drink extends Product implements Fluid
{
    use volume;
    protected $volume;
    protected $alc;
    public function setAlc($alc)
    {
        $this->alc = $alc;
    }
    public function getAlc()
    {
        return $this->alc;
    }
    public function printAlc()
    {
        if ((isset($this->alc))&&($this->alc!=0))
            echo "<p>Крепость: $this->alc%</p>";
    }
}
class MotorOil extends Product implements Fluid
{
    use volume;
    protected $viscosity;
    public function setViscosity($viscosity)
    {
        $this->viscosity = $viscosity;
    }
    public function getViscosity()
    {
        return $this->viscosity;
    }
    public function printViscosity()
    {
        echo "Вязкость: $this->viscosity";
    }
}
class Tires extends Product //На этот товар скидка не распространяется
{
    protected $discount = 0;
}
class Vege extends Product //На этот товар скидка распространяется только если вес больше 10кг
{
    public function getPrice()
    {
        if ((isset($this->discount)) && ($this->weight>10)){
            $this->shipping = 300;
            return round($this->price*(100-$this->discount)/100,2);
        }
        else {
            $this->shipping = 250;
            return $this->price;
        }
    }
}
?>