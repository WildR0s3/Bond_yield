<?php

class TenYearBonds extends Bonds {

    protected function getYearlyBonds() {
        $sql = "SELECT * FROM types WHERE bond_type IN ('10 - year', '3 - year')";
        $result = mysqli_query($this->connect(), $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $data;
    }
    public function calculateBondValue($principal, $interestRates) {
        $currentValue = $principal;
        $numPeriods = count($interestRates);
    
        for ($i = 0; $i < $numPeriods; $i++) {
            $interestRate = $interestRates[$i];
            $currentValue *= (1 + $interestRate / 100);
        }
    
        return round($currentValue, 2);
    }
    public function calculateInterest($principal, $interestRates, $numYears) {
        $interest = [];
    
        for ($i = 0; $i < $numYears; $i++) {
            $interestRate = $interestRates[$i];
            $interest[] = ($interestRate / 100) * $principal;
            $principal *= (1 + $interestRate / 100);
        }
    
        return $interest;
    }
    public function ez($bond, $numYears, $interest, $interestRates) {
        $total = 0;
        for ($i = 1; $i <= $numYears; $i++) { 
            $interestRate = $interestRates[$i - 1];
            $diff_days = (new DateTime($bond['purchase_date']))->diff(new DateTime(date("Y-m-d")))->days;
            if ($diff_days - (($i * 365)) > 0) {
                $interestGain = $interest[$i - 1] * 0.81;
            } elseif (($diff_days - ($i * 365)) > -365) {
                $diff_days = $diff_days - (($i-1) * 365);
                $interestGain = $interest[$i - 1] * ($diff_days/365);
                $interestGain = round($interestGain * 0.81, 2) ;
            } else {
                $interestGain = 0;
            }
            $total += $interestGain;
        }
        return $total; 
    }

    public function calculateTotalDaily() {
        $data = $this->getYearlyBonds();
        $totalDaily = 0;
        foreach ($data as $bond) {
            $interestRates = [];
            $principal = $bond['amount'];
            $numYears = $bond['interest_periods'];
            for ($i = 1; $i <= $numYears; $i++) {
                $interestRates[] = $bond['interest_' . $i];
            }
            $interest = $this->calculateInterest($principal, $interestRates, $numYears);
            for ($i = 1; $i <= $numYears; $i++) {
                $interestRates[] = $bond['interest_' . $i];
                $interestTotal = round($interest[$i - 1] * 0.81, 2);
                $interestRate = $interestRates[$i - 1];
                $diff_days = (new DateTime($bond['purchase_date']))->diff(new DateTime(date("Y-m-d")));
                $diff_days = $diff_days->invert ? -$diff_days->days : $diff_days->days;
                if ($diff_days - (($i * 365)) > 0) {
                    $interestGain = $interest[$i - 1] * 0.81;
                } elseif (($diff_days - ($i * 365)) > -365) {
                    $diff_days = $diff_days - (($i-1) * 365);
                    $interestGain = $interest[$i - 1] * ($diff_days/365);
                    $interestGain = round($interestGain * 0.81, 2) ;
                } else {
                    $interestGain = 0;
                }
                $interestTotal = round($interest[$i - 1] * 0.81, 2);
                if ($interestGain < $interestTotal && $interestGain != 0) {
                    $totalDaily += round($interestTotal / 365, 3);
                }
            }
        } return $totalDaily;
    }


    public function showBonds() {
        $data = $this->getYearlyBonds();
        $sum_total = 0;
    
        foreach ($data as $bond) {
            $interestRates = [];
            $numYears = $bond['interest_periods'];
    
            for ($i = 1; $i <= $numYears; $i++) {
                $interestRates[] = $bond['interest_' . $i];
            }
    
            $principal = $bond['amount'];
            $bondValue = $this->calculateBondValue($principal, $interestRates);
            $interest = $this->calculateInterest($principal, $interestRates, $numYears);
            $sum = round(array_sum($interest) * 0.81, 2);
            
            $total = $this->ez($bond, $numYears, $interest, $interestRates);
            $sum_total += $total;
    
            echo "<tr class='bond'>";
            echo "<td>${bond['bond_type']}</td>";
            echo "<td>${bond['amount']}</td>";
            echo "<td>${total}</td>";
            echo "<td>${bond['purchase_date']}</td>";
            echo "</tr>";
            echo "<tr class='details'>";
            echo "<td colspan='5'>";
                echo "<table>";
                echo "<th>Period</th>";
                echo "<th>Interest rate</th>";
                echo "<th>Interest gained</th>";
                echo "<th>Interest total</th>";
                echo "<th>Daily interest</th>";
    
            for ($i = 1; $i <= $numYears; $i++) {
                $interestRate = $interestRates[$i - 1];
                $diff_days = (new DateTime($bond['purchase_date']))->diff(new DateTime(date("Y-m-d")));
                $diff_days = $diff_days->invert ? -$diff_days->days : $diff_days->days;
                if ($diff_days - (($i * 365)) > 0) {
                    $interestGain = $interest[$i - 1] * 0.81;
                } elseif (($diff_days - ($i * 365)) > -365) {
                    $diff_days = $diff_days - (($i-1) * 365);
                    $interestGain = $interest[$i - 1] * ($diff_days/365);
                    $interestGain = round($interestGain * 0.81, 2) ;
                } else {
                    $interestGain = 0;
                }
                $interestTotal = round($interest[$i - 1] * 0.81, 2); //array_sum(array_slice($interest, 0, $i))
                $dailyInterest = round($interestTotal / 365, 3);
    
                echo "<tr>";
                echo "<td>Period " . $i . "</td>";
                echo "<td>${interestRate} %</td>";
                echo "<td>${interestGain}</td>";
                echo "<td>${interestTotal}</td>";
                echo "<td>${dailyInterest}</td>";
                echo "</tr>";
            }
    
                echo "</table>";
            echo "</td>";
            echo "</tr>";
        }
    
        echo "<tr class='bond'>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td>${sum_total}</td>";
        echo "</tr>";
        echo "</table>"; 
        
    }
    
    
    
    
}
