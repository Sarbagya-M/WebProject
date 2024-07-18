<html>
    <head>
        <title> Form </title>
        <style>
                body {
                    background-color: #1f2a33;
                    color: #fff;
                    font-family: Arial, sans-serif;
                    padding: 20px;
                    
                }
                h1 {
                    color: #fff;
                    text-align: center;
                }

                input[type="Name"],
                input[type="contact"],
                input[type="card"] {
                    text-align:center;
                    width: 70%;
                    padding: 10px;
                    margin: 10px 0;
                    border: none;
                    background-color: #444;
                    color: #fff;
                    border-radius: 12px;

                }

                input[type="submit"],button{
                    background-color: #517896;
                    color: white;
                    padding: 10px 20px;
                    border: none;
                    cursor: pointer;
                    border-radius: 4px;
                    transition: background-color 0.3s ease;
                }
                div{
                    display: flex;
                    justify-content: center; 
                    align-items: center;
                    height: 70vh;
                    
                }
                table {
                    border-collapse: collapse;
                    width: 100%;
                }

                th, td {
                    padding: 8px;
                    text-align: center;
                    border: 1px solid #ddd;
                }
                h2{
                    margin:0px
                }
           </style>
    </head>
    <body>
        <div>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <centre>
                    <b>
                        <h1> Search Page</h1>
                    </b>
                </centre>
                <hr>
                Search by Name </br><input type="name" name= "name" size="20"><br /><br />
                Serch by Contact number</br> <input type="contact" name= "contact" size="10"><br /><br />
                Search by Card number </br><input type="card" name="card" size="5"><br /><br />
                <centre>
                    <input type="submit" name="submit" value="Search">
                    <button type="button" name="Search" onclick="index()">Registration</button>
                </centre>
            </form>
        </div>
       

    </body>
    <?php
        if(isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $card = $_POST['card'];
            $contact = $_POST['contact'];

            $name = trim($name);
            $card = trim($card);
            $contact = trim($contact);
            
            

            if (empty($name) && empty($card) && empty($contact)) 
                {
                    echo "<p>Please fill at least one of the fields.</p>";
                    exit();
                }    
            else
                {   
                    //database information
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "webproject";
                
                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) 
                        {
                            die("Connection failed: " . $conn->connect_error);
                        }

    
                            $sql = "SELECT * FROM cust WHERE ";
                            $conditions = array();
            
                                if (!empty($contact))
                                    {
                                        // echo "search with contact";
                                        $conditions[] = "contact_number = '$contact'";
                                    }
                               
                                if(!empty($card))
                                    {
                                        // echo "search with card";
                                        $conditions[] = "card_number = '$card'";
                                    } 
                                if(!empty($name))
                                    {
                                        // echo "search with name";
                                        $conditions[] = "name LIKE '%$name%'";
                                    } 
                              
                            $sql .= implode(' AND ', $conditions);
                            
                            $result = $conn->query($sql);

                           
                            if ($result->num_rows > 0) 
                            {
                                echo "<h2>Search Results:</h2>";
                                echo "<table>
                                    <thead>
                                      <tr>
                                        <th>S.N.</th>
                                        <th>name</th>
                                        <th>Contact</th>
                                        <th>Card</th>
                                      </tr>
                                    </thead>
                                    <tbody>";
                                
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . $row["Id"] . "</td>
                                            <td>".$row['name']."</td>
                                            <td>".$row['contact_number']."</td>
                                            <td>".$row['card_number']."</td>
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