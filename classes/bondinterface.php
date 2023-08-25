<?php

interface BondInterface {
    public function calcTotalInterest($bond, $i);
    public function calcInterest($bond, $i);

    public function showBonds();
}