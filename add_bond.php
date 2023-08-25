<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Add bond</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <a href="index.php">Cancel</a>
        
       <form method="POST" action="classes/insertbond.php">
       <button type="submit" name="submit" class="Add bond">Add bond</button>
        <select id="bondType" name="bondType">
            <option value="one-year">1 - year</option>
            <option value="two-year">2 - Year</option>
            <option value="three-year">3 - Year</option>
            <option value="four-year">4 - year</option>
            <option value="ten-year">10 - year</option>
        </select><br>
        <label for="amount">Value</label>
        <input type="number" name="amount">
        <label for="date">Purchase date</label>
        <input type="date" name="date">
        <div class="int-inputs">
            <div class="six">
                    <label for="int1">Interest period 01</label>
                    <input type="number" name="int1"><br>
                    <label for="int2">Interest period 02</label>
                    <input type="number" name="int2"><br>
                    <label for="int3">Interest period 03</label>
                    <input type="number" name="int3"><br>
                    <label for="int4">Interest period 04</label>
                    <input type="number" name="int4"><br>
                    <label for="int5">Interest period 05</label>
                    <input type="number" name="int5"><br>
                    <label for="int6">Interest period 06</label>
                    <input type="number" name="int6"><br>
            </div>
            <div class="twelve">
                    <label for="int7">Interest period 07</label>
                    <input type="number" name="int7"><br>
                    <label for="int8">Interest period 08</label>
                    <input type="number" name="int8"><br>
                    <label for="int9">Interest period 09</label>
                    <input type="number" name="int9"><br>
                    <label for="int10">Interest period 10</label>
                    <input type="number" name="int10"><br>
                    <label for="int11">Interest period 11</label>
                    <input type="number" name="int11"><br>
                    <label for="int12">Interest period 12</label>
                    <input type="number" name="int12"><br>
            </div>
            <div class="eightteen">
                    <label for="int13">Interest period 13</label>
                    <input type="number" name="int13"><br>
                    <label for="int14">Interest period 14</label>
                    <input type="number" name="int14"><br>
                    <label for="int15">Interest period 15</label>
                    <input type="number" name="int15"><br>
                    <label for="int16">Interest period 16</label>
                    <input type="number" name="int16"><br>
                    <label for="int17">Interest period 17</label>
                    <input type="number" name="int17"><br>
                    <label for="int18">Interest period 18</label>
                    <input type="number" name="int18"><br>
            </div>
            <div class="twentyfour">
                    <label for="int19">Interest period 19</label>
                    <input type="number" name="int19"><br>
                    <label for="int20">Interest period 20</label>
                    <input type="number" name="int20"><br>
                    <label for="int21">Interest period 21</label>
                    <input type="number" name="int21"><br>
                    <label for="int22">Interest period 22</label>
                    <input type="number" name="int22"><br>
                    <label for="int23">Interest period 23</label>
                    <input type="number" name="int23"><br>
                    <label for="int24">Interest period 24</label>
                    <input type="number" name="int24"><br>
            </div>
        </div>
       </form>
       
        
        <script src="" ></script>
    </body>
</html>