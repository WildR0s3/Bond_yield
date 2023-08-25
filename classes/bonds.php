<?php

class Bonds extends database {
    protected function getAllBonds() {
        $sql = "SELECT * FROM types";
        $result = mysqli_query($this->connect(), $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $data;
    }

    protected function int_periods($type) {
        switch ($type) {
            case 'one-year':
                return 12;
            case 'two-year':
                return 24; 
            case 'three-year':
                return 3;
            case 'four-year':
                return 4;
            case 'ten-year':
                return 10;
        }
    }

    public function insertBond() {
        $type = $_POST['bondType'];
        $value = $_POST['amount'];
        $periods = $this->int_periods('$type');
        $date = $_POST['date'];
        $int1 = $_POST['int1'];
        $int2 = $_POST['int2'];
        $int3 = $_POST['int3'];
        $int4 = $_POST['int4'];
        $int5 = $_POST['int5'];
        $int6 = $_POST['int6'];
        $int7 = $_POST['int7'];
        $int8 = $_POST['int8'];
        $int9 = $_POST['int9'];
        $int10 = $_POST['int10'];
        $int11 = $_POST['int11'];
        $int12 = $_POST['int12'];
        $int13 = $_POST['int13'];
        $int14 = $_POST['int14'];
        $int15 = $_POST['int15'];
        $int16 = $_POST['int16'];
        $int17 = $_POST['int17'];
        $int18 = $_POST['int18'];
        $int19 = $_POST['int19'];
        $int20 = $_POST['int20'];
        $int21 = $_POST['int21'];
        $int22 = $_POST['int22'];
        $int23 = $_POST['int23'];
        $int24 = $_POST['int24'];
        $sql = "INSERT INTO types (bond_type, amount, interest_periods, purchase_date, interest_1, interest_2, interest_3, interest_4, 
                                    interest_5, interest_6, interest_7, interest_8, interest_9, interest_10, interest_11, 
                                    interest_12, interest_13, interest_14, interest_15, interest_16, interest_17, interest_18, interest_19, interest_20, 
                                    interest_21, interest_22, interest_23, interest_24) VALUES 
                                    ('$type', '$value', '$periods', '$date', '$int1', '$int2', '$int3', '$int4', '$int5', '$int6', 
                                    '$int7', '$int8', '$int9', '$int10', '$int11', '$int12', '$int13', '$int14', '$int15', '$int16', '$int17',
                                    '$int18', '$int19', '$int20', '$int21', '$int22', '$int23', '$int24')";
        mysqli_query($this->connect(), $sql);
        
    } 
}

    