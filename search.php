<html>
    <head>
        <title> Form </title>
        <style>
            table {
            border-collapse: collapse;
            width: 100%;
            }

            th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            border-left: 1px solid #ddd;
            }
        </style>
    </head>
    <body>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <centre>
                <b>
                    <h1> Search Page</h1>
                </b>
            </centre>
            <hr>
            S.N. <input type="SN" name= "SN" size="20"><br /><br />
            Name <input type="Name" name= "Name" size="20"><br /><br />
            Contact number <input type="contact" name= "contact" size="10"><br /><br />
            Card number <input type="card" name="card" size="5"><br /><br />
            <centre>
                <input type="submit" name="submit" value="Search">
                <button type="button" name="Search" onclick="index()">Registration</button>
            </centre>
        </form>

    </body>
    <?php
        if(isset($_POST['submit']))
        {
            $sn = $_POST['SN'];
            $name = $_POST['Name'];
            $card = $_POST['card'];
            $contact = $_POST['contact'];
        
            $sn = trim($sn);
            $name = trim($name);
            $card = trim($card);
            $contact = trim($contact);
            
            

            if (empty($name) && empty($card) && empty($contact) && empty($sn)) 
                {
                    echo "<p>Please fill at least one of the fields.</p>";
                    // echo "Please fill at least one of the fields.";
                   // header("Location: index.php?error=Please fill in all the required fields."); //if want to refresh the page or move to another page
                    exit();
                }    
            else
                {   
                    //database information
                    $servername = "fdb26.awardspace.net";
                    $username = "3442939_shubhampokhrel";
                    $password = "@12345Zxcv";
                    $dbname = "3442939_shubhampokhrel";
                
                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) 
                        {
                            die("Connection failed: " . $conn->connect_error);
                        }

    
                            $sql = "SELECT * FROM DBMS WHERE ";
                            $conditions = array();
                            // if (empty($name) && empty($card) && !empty($contact))
                            //     {
                            //         // echo "search with contact";
                            //         $conditions[] = "CONTACT_NUMBER = '$contact'";
                            //     }
                            // elseif(empty($name) && empty($contact) && !empty($card))
                            //     {
                            //         // echo "search with card";
                            //         $conditions[] = "ID_CARD_NO = '$card'";
                            //     } 
                            // elseif(empty($card) && empty($contact) && !empty($name))
                            //     {
                            //         // echo "search with name";
                            //         $conditions[] = "NAME LIKE '%$name%'";
                            //     } 
                                if (!empty($contact))
                                    {
                                        // echo "search with contact";
                                        $conditions[] = "CONTACT_NUMBER = '$contact'";
                                    }
                                if (!empty($sn))
                                    {
                                        // echo "search with contact";
                                        $conditions[] = "SN = '$sn'";
                                    }
                                if(!empty($card))
                                    {
                                        // echo "search with card";
                                        $conditions[] = "ID_CARD_NO = '$card'";
                                    } 
                                if(!empty($name))
                                    {
                                        // echo "search with name";
                                        $conditions[] = "NAME LIKE '%$name%'";
                                    } 
                              
                            $sql .= implode(' AND ', $conditions);
                            //echo "$sql";
                            $result = $conn->query($sql);

                            //$result = mysqli_query($conn,$sql) or die(mysqli_error($conn)); // SQL query executing
                            if ($result->num_rows > 0) 
                            {
                                echo "<h2>Search Results:</h2>";
                                echo "<table>
                                    <thead>
                                      <tr>
                                        <th>S.N.</th>
                                        <th>Name</th>
                                        <th>Card</th>
                                        <th>Contact</th>
                                      </tr>
                                    </thead>
                                    <tbody>";
                                
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>".$row['SN']."</td>
                                            <td>".$row['NAME']."</td>
                                            <td>".$row['ID_CARD_NO']."</td>
                                            <td>".$row['CONTACT_NUMBER']."</td>
                                          </tr>";
                                }
                                echo "</tbody>
                                </table>";
                            }
                            else 
                            {
                                echo "<p>No records found.</p>";
                            }
                    $conn->close();
                }    
            
        }
    ?>
    <script>
        function index()
            {
               window.location.href = "index.php";        
            }
    </script>        
</html>