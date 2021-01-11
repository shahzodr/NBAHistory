<!DOCTYPE>
<html>
    <body>
        <h2>Historical Information on the NBA teams</h2>
        <p></p>
        <!-- start PHP code -->
        <?php
            //get the input search text
            $selectId = $_GET["optionKey"];

            //access (connect) the database: nba_db
            //set up parameters (4)
            $server = "localhost";
            $user = "root";
            $password= "root";
            $database = "nba_db";

            //for later use
            $dbtable = "nba_table";

            //connect to the database: PHP has  a function for it!!
            $mycon = mysqli_connect($server,$user,$password,$database) or die("no connection");

            if ($selectId == 1){
                $title = "The Information on All of the Teams";
                //create a String variable that holds SQL select command that searches the database
                $SQLselect = "select * from nba_table order by team;";
            }

            if ($selectId == 2){
                $title = "The Top Five Oldest Teams";
                //create a String variable that holds SQL select command that searches the database
                $SQLselect = "select * from nba_table order by yfounded limit 5;";
            }

            if ($selectId == 3){
                $title = "The Top Five Most Recently Founded Teams";
                //create a String variable that holds SQL select command that searches the database
                $SQLselect = "select * from nba_table order by yfounded desc limit 5;";
            }

            if ($selectId == 4){
                $title = "Team Won the Championship the Most";
                //create a String variable that holds SQL select command that searches the database
                $SQLselect = "select * from nba_table order by wins desc;";
            }

            if ($selectId == 5){
                $title = "Team(s) Won the NBA Championship in 1970, 1980, and 1990";
                //create a String variable that holds SQL select command that searches the database
                $SQLselect = "select * from nba_table where yowins like '%1970%' or yowins like '%1980%' or yowins like '%1990%' order by wins;";
            }

            //running above command - PHP has a function for it!!
            $results = mysqli_query($mycon,$SQLselect) or die("query did not run");

            //how many matched record(s)
            $numrecs = mysqli_num_rows($results);

            if ($numrecs > 0)
            {
                //start sending a table back to HTML page
                print "<table border='1'>";
                print "<tr><th colspan='4'>".$title."</th></tr>";
                print "<tr><th>Team</th><th>Year Founded</th><th>Wins</th><th>Year of Win(s)</th></tr>";
                
                //loop through the record(s)
                while ($matchArray = mysqli_fetch_array($results))
                {
                    //extracting the fields(columns)' values
                    $team = $matchArray[0];
                    $yfounded = $matchArray[1];
                    $wins = $matchArray[2];
                    $yowins = $matchArray[3];
            
                    //send back a row at a time
                    print "<tr><td>".$team."</td><td>".$yfounded."</td><td>".$wins."</td><td>".$yowins."</td></tr>";
                }//end of loop 
        
                print "</table>";
            }
            else print "No record(s) found";
        ?>
        <p></p>
        <a href="nba.html">Back</a> 
    </body>
</html>