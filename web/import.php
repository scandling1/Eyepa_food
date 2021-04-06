<?php
    include('../include/views_controller.php');
    
    if (isset($_POST["import"])) {
    $view_dbs->import($_POST["import"]);
    }
?>
<!DOCTYPE html>
<html>

<head>
<?php
  $view_head->meta_head()
?>

</head>

<body>
    <h2>Import CSV file into Mysql using PHP</h2>

    <div id="response"
        class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
        <?php if(!empty($message)) { echo $message; } ?>
        </div>
    <div class="outer-scontainer">
        <div class="row">

            <?php
              $view_body->import_form()
            ?>

        </div>
               <?php
            $sqlSelect = "SELECT * FROM employees";
            $result = $view_dbs->select($sqlSelect);
            if (! empty($result)) {
                ?>
            <table id='userTable'>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>

                </tr>
            </thead>
<?php
                
                foreach ($result as $row) {
                    ?>
                    
                <tbody>
                <tr>
                    <td><?php  echo $row['userId']; ?></td>
                    <td><?php  echo $row['userName']; ?></td>
                    <td><?php  echo $row['firstName']; ?></td>
                    <td><?php  echo $row['lastName']; ?></td>
                </tr>
                    <?php
                }
                ?>
                </tbody>
        </table>
        <?php } ?>
    </div>
 <?php
    $view_footer->import_footer()
 ?>
</body>

</html>