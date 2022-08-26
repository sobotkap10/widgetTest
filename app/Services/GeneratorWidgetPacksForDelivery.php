<?php

namespace App\Services;


class GeneratorWidgetPacksForDelivery
{

    protected $avaliablePackSizes;

    protected $orderedAmount;
    protected $smalestSize;
    protected $onlySmallestSize;
    protected $packToSend = [];


    public function __construct($avaliablePackSizes){
        $this->avaliablePackSizes = $avaliablePackSizes;
    }



    public function setOrderedAmount($amount)
    {
        $this->orderedAmount = $amount;
        $this->generateSmallPacks();
    }


    protected function generateSmallPacks()
    {
        $avaliablePacks = $this->sortAvaliablePacks();
        $this->smalestSize = $avaliablePacks[0];

        $onlySmallPacks = is_float($this->orderedAmount/$this->smalestSize) ? (int) (ceil($this->orderedAmount/$this->smalestSize)) : (int) ($this->orderedAmount/$this->smalestSize);

        $this->onlySmallestSize = $onlySmallPacks;

    }

    protected function sortAvaliablePacks()
    {
        $sortedAvaliablePacks = $this->avaliablePackSizes;
        sort($sortedAvaliablePacks);
        return $sortedAvaliablePacks;
    }

    protected function generateSizeMatrix()
    {
        $reverseAvaliablePackSizes = array_reverse($this->avaliablePackSizes);

        $sizeMatrix = [];

        foreach ($reverseAvaliablePackSizes as $size) {
            $sizeMatrix[$size] =  (int) floor($size/$this->smalestSize);
        }

        return $sizeMatrix;
    }


    public function generateResults(){

        $sizeMatrix = $this->generateSizeMatrix();

        foreach ($sizeMatrix as $size => $amountOfSmallPacksPerSize) {

            if ($this->onlySmallestSize === 0) {
                return $this->packToSend;
            }
            
            if (($this->onlySmallestSize >= $amountOfSmallPacksPerSize) && ($this->onlySmallestSize > 1)) {
                $this->packToSend[] = $size;
                $this->onlySmallestSize -= $amountOfSmallPacksPerSize;
                $this->generateResults();
            }

            if ($this->onlySmallestSize === 1) {
                $this->packToSend[] = $this->smalestSize;
                $this->onlySmallestSize -= 1;
            }

        }
    }


}