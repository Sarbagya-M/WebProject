<html>
    <head>
        <title> Form </title>
    </head>
    <style>
        body {
            background-color: #1f2a33;
            color: #fff;
            font-family: Arial, sans-serif;
            padding: 20px;
            display: flex;
            justify-content: center; /* Center align everything horizontally */
            align-items: center; /* Center align everything vertically */
            height: 100vh; /* Ensure full viewport height */
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
            align-items:center;
        }
    </style>
    <body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <centre>
                <b>
                    <h1> Registration Page</h1>
                </b>
            </centre>
            <hr>
           <div>
                    Name </br><input type="Name" name= "Name" size="20"><br /><br />
                    Contact number </br><input type="contact" name= "contact" size="10"><br /><br />
                    Card number</br> <input type="card" name="card" size="5"><br /><br />
                    <centre>
                        <input type="submit" name="submit" value="Submit">
                        <button type="button" name="Search" onclick="search()">Search</button>
                    </centre>
            </div>
           
        </form>

    </body>
    <?php
        
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

        // SQL query to count the number of rows in the table
        $sqlrow = "SELECT COUNT(*) AS total_rows FROM cust";

        // Execute the query and get the result
        $result = $conn->query($sqlrow);

       
        if(isset($_POST['submit']))
        {
           
            $name = $_POST['Name'];
            $card = $_POST['card'];
            $contact = $_POST['contact'];
        
            
            $name = trim($name);
            $card = trim($card);
            $contact = trim($contact);
            
       

            if (empty($name) || empty($card) || empty($contact)) 
                {
                    echo "Please fill in all the fields.";
                    exit();
                }    
            else
                {   
               
                
                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) 
                        {
                            die("Connection failed: " . $conn->connect_error);
                        }
                    $sql_check = "SELECT * FROM cust WHERE card_number = '$card'";
                    $sql_check1 = "SELECT * FROM cust WHERE contact_number = '$contact'";
                    $result_check = $conn->query($sql_check);
                    $result_check1 = $conn->query($sql_check1);

                    if ($result_check1->num_rows > 0) 
                        {
                            // Contact number already exists
                            echo "<p>Given contact number is already registered for another user.</p>";
                        }
                    elseif($result_check->num_rows > 0) 
                    {
                        // Card number already exists
                        echo "<p>Given card number is already registered for another user.</p>";
                    }
                    else
                        {
                            // Card number not exists in database
                            $sql = "INSERT INTO cust (name, contact_number, card_number) VALUES ('$name', '$contact', '$card')"; 
                            echo '<script>alert("Form submitted successfully");</script>';
                            mysqli_query($conn,$sql) or die(mysqli_error($conn));
                        }
                    
                
                    $conn->close();
                }    

        }
    ?>
    <script>
        function search()
            {
                window.location.href = "search.php";           
            }
    </script>        
</html>