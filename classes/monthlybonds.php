<?php

class MonthlyBonds extends Bonds implements BondInterface
{

    protected function getMonthlyBonds()
    {
        $sql = "SELECT * FROM types WHERE bond_type = '1 - year' or bond_type = '2 - year'";
        $result = mysqli_query($this->connect(), $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $data;
    }

    public function calcTotalInterest($bond, $i)
    {
        $diff_days = (new DateTime($bond['purchase_date']))->diff(new DateTime(date("Y-m-d")))->days;
        $interest = (($bond['interest_' . $i] / 100) * 0.81 * $bond['amount']) / 12;
        $interest = round($interest, 2);
        return $interest;
    }
    public function calcInterest($bond, $i)
    {
        $diff_days = (new DateTime($bond['purchase_date']))->diff(new DateTime(date("Y-m-d")))->days;
        if ($diff_days - (($i * 30)) > 0) {
            $interest = $this->calcTotalInterest($bond, $i);
        } elseif (($diff_days - ($i * 30)) > -30) {
            $diff_days = $diff_days - (($i - 1) * 30);
            $interest = (($bond['interest_' . $i] / 100) * ($diff_days / 30) * 0.81 * $bond['amount']) / 12;
            $interest = round($interest, 2);
        } else {
            $interest = 0;
        }
        return $interest;
    }



    public function showBonds()
    {
        $data = $this->getMonthlyBonds();
        $sum_total = 0;
        foreach ($data as $bond) {
            $sum = 0;
            for ($i = 1; $i <= $bond['interest_periods']; $i++) {
                $sum += $this->calcInterest($bond, $i);
                $sum_total += $this->calcInterest($bond, $i);
            }
            echo "<tr class='bond'>";
            echo "<td>${bond['bond_type']}</td>";
            echo "<td>${bond['amount']}</td>";
            echo "<td>${sum}</td>";
            echo "<td>${bond['purchase_date']}</td>";
            //echo "<td><i class='arrow right'></i></td>";
            echo "</tr>";
            echo "<tr class='details'>";
            echo "<td colspan='5'>";
                echo "<table>";
                echo "<th>Period</th>";
                echo "<th>Interest rate</th>";
                echo "<th>Interest gained</th>";
                echo "<th>Interest total</th>";
                echo "<th>Daily interest</th>";
                for ($i = 1; $i <= $bond['interest_periods']; $i++) {
                
                    echo "<tr>";
                    echo "<td>Period " . $i . "</td>";
                    echo "<td>${bond['interest_' . $i]} %</td>";
                    echo "<td>" . $this->calcInterest($bond, $i) . "</td>";
                    echo "<td>" . $this->calcTotalInterest($bond, $i) . "</td>";
                    echo "<td>" . round(($this->calcTotalInterest($bond, $i) / 30), 3) . "</td>";
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
            
        }
    }
