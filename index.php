<?php include 'classes/autoloader.php'; ?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Bond yield calculation</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="title-container">
            <h1>Yield calcualtion</h1>  
        </div>

        <div class="body-container">
            <table>
                <tr class="tbl-header">
                    <th>Bond Type</th>
                    <th>Amount</th>
                    <th>Interest gained</th>
                    <th>Purchase Date</th>
                    <th><a href="add_bond.php"><button type="button" id="add-bond" >Add bond</button></a></th>
                </tr>
                <?php
                (new YearlyBonds)->showBonds();
                (new MonthlyBonds)->showBonds();
                (new TenYearBonds)->showBonds();
                ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src='js/bond_list.js'></script>
    </body>
</html>