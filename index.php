<?php

class goods {

    public $id;
    public $category;
    public $name;
    public $investmentPack;
    public $price;

    function __construct($id, $cat, $name, $quantity, $price) {
        $this->id = $id;
        $this->category = $cat;
        $this->name = $name;
        $this->investmentPack = $quantity;
        $this->price = $price;
    }

    function getInfo() {
        $info  = "арт. {$this->id}; ";
        $info .= "кат. {$this->category}; ";
        $info .= "наим. {$this->name}; ";
        $info .= "груп. упак. {$this->investmentPack} шт.; ";
        $info .= "цена {$this->price} руб.";
        return $info;
    }

}

$produce = new goods(100, "Для кухни", "Газовая плита", 1, 12290);
echo $produce->getInfo();