<!DOCTYPE html>
<html lang='en-US'>
<head>
<link rel="icon" href="chbc-icon.jpg" type="image/gif">

</head>
<style>
body{
    background: url('chbc-background.jpg') no-repeat center fixed;
    margin: 23px;
    background-size: cover;
    font-family: 'Open Sans', sans-serif;
    overflow: hidden;
}

*{
    box-sizing: border-box;
}


#log-in-body{
    width: 700px;
    background-color: #ffffffc9;
    padding: 12px;
    margin: 60px auto;  
    overflow: auto;
    border-radius: 15px;
    box-shadow: 3px 3px 20px #000000;
}

.log-header-text-container-main{
    width: 100%;
    overflow: auto;
    background-color: #c6800e;
    border-radius: 3px;
}

.logo-container{
    padding: 4px;
    width: 20%;
    overflow: auto;
    float: left;
}

.chbc-log-header-1{
    width: 100%;
    height: auto;
}

.text-header-container{
    padding: 4px;
    width: 80%;
    overflow: auto;
    float: left;
    text-align: center;
    color: #000000;
}

/* this is the input submit division */
.imput-submit-container{
    width: 600px;
    margin: 0 auto;
    overflow: auto;
}

input[type=text]{
    width: 100%;
    padding: 12px;
    margin-top: 3%;
    float: left;
    background-color: #2b2c48;
    color: #ffffff;
    border-radius: 5px;
}

input[type=text]:focus{
    background-color: #45476f;
    color: #ffffff;
}


/* this is price division */
.price-container{
    width: 500px;
    padding: 0;
    overflow: auto;
    margin: 0 auto;
    text-align: center;
}

.price-container p{
    margin: 5px;
    font-size: 60px;
    font-weight: bold;
}


/* this is the info container division */
.info-container{
    width: 100%;
    height: 240px;
    overflow: hidden;
    margin-top: 12px;
}

.info-container h3{
    line-height: 40px;
    margin-left: 40px;
    color: #000000;
}

.info-text{
    float: left;
}



.division-details-output{
    width: 66%;
    height: 200px;
    background-color: #00000096;
    padding: 1px;
    overflow: auto;
    float: left;
    margin-left: 20px;
    border-radius: 12px;
}

.division-details-output h3{
    margin-left: 12px;
    color: white;
}



.info-text-output{
    line-height: 40px;
    margin-left: 40px;
    color: #000000;
}

/* this is the footer division */
.footer-dividion{
    max-width: 100%;
    background-color: #a5a5a5;
    padding: 1px;
    text-align: center;
}



</style>
<body>

<?php include 'connection.php' ?>
<div id="log-in-body">
    <div class="log-header-text-container-main">
        <div class="logo-container">
             <img class="chbc-log-header-1" src="chbc-logo.jpg">
        </div>
        <div class="text-header-container">
            <h2>CEBU HOME AND BUILDERS CENTRE</h2>
        </div>
    </div>

    <div class="price-container">
        <?php
            if(isset($_GET['item_barcode'])){ 
                $item_barcode = ($_GET['item_barcode']);
                $getPriceResult =$conn->prepare(" SELECT * FROM products where barcode_list = '$item_barcode' ");
                $getPriceResult->execute();
                $priceResult = $getPriceResult->fetchAll(PDO::FETCH_BOTH);
                if(count($priceResult) >0){
                    foreach($priceResult as $rowprice){
                        echo '<p> ₱' .number_format($rowprice['retail_price'],2).  '</p>';     
                    }
                }
                else{
                    echo "<p>₱ 0.00</p>";
                }
            } 
            
        ?>
    </div>

    <div class="imput-submit-container">
    <form class="form-horizontal style-form" NAME="theForm" action="index.php" method="get" autocomplete="off" >
 
    <?php
    if(isset($_GET['item_barcode'])){ 
        $item_barcode = ($_GET['item_barcode']);
    }
    ?>
        <input class="form-control" type="text"autofocus maxlength="15" onkeyup="return(DoCheckLength(this));" ID="firstTextBox" name="item_barcode" placeholder="Scan your item">
    </form>

    </div>
    
    <div class="info-container">
        <h3 class="info-text">DISCRIPTION:<br>
            UOM:<br>
            ARTICLE:<br>
            BARCODE:
        </h3>
        
        <div class="division-details-output">
            <?php 
                if(empty($item_barcode)){
                    echo '<h1><div style="color:red;font-size:40px; margin-top:50px"><center> Please enter a barcode! </center> </div></h1>';
                }
                else{
                    $getResults =$conn->prepare(" SELECT * FROM products where barcode_list = '$item_barcode' ");
                    $getResults->execute();
                    $results = $getResults->fetchAll(PDO::FETCH_BOTH);
                    echo '<h3 class="info-text-output">';
                        if(count($results) >0){
                            
                            foreach($results as $row){
                                echo $row['name'] .'<br>'; 
                                echo $row['unit_name'].'<br>' ; 
                                echo $row['reference'].'<br>';     
                                echo $row['barcode_list'].'<br>';     
                            }
                        }
                        else{
                            echo '<h1><div style="color:red;font-size:40px; margin-top:50px"><center> Data not Found! </center> </div></h1>';
                        }
                    echo '</h3>';  
                }
            ?>
                
        </div>
    </div>

    <div class="footer-dividion">
        <h3>Date:<?php echo date("F j, Y"); ?></h3>
    </div>

</div>

</body>
</html>