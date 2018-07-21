<?php 
require_once "sessions.php";
require_once "db.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Contacts list</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- link rel="shortcut icon" href="favicon.png" / -->
        <link rel="stylesheet" href="css/main.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="lib/tablesorter/css/theme.default.css">
        <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.min.css">            
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-8">    			
                    Current user: <?php echo @$user['login']; ?> (<a href="logout.php">Logout</a>)
                </div>
            </div>
            <?php
            // if user admin - show link for manage other users
            if (@$user['is_admin']) {
                ?>
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-8">
                        You can manage other users <a href="userlist.php">here</a>.
                    </div>
                </div>
                <?php
            };
            ?>         
            <div class="row">	        
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="data">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <th>Date/Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div> 
        <link rel="stylesheet" href="lib/datatables/css/jquery.dataTables.css" />
        <script src="lib/datatables/js/jquery.js"></script>  
        <script src="lib/datatables/js/jquery.dataTables.min.js"></script>        
        <script>
            $(function () {
                $('#data').dataTable({
                    oLanguage: {
                        sProcessing: "<img src='lib/datatables/loader.gif'>"
                    },
                    "sScrollY": "100%",
                    "bProcessing": true,
                    "bServerSide": true,
                    "sServerMethod": "GET",
                    "sAjaxSource": "customerlist.php",
                    "iDisplayLength": 25,
                    "aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
                    "aaSorting": [[5, 'desc']],
                    "aoColumns": [
                        {"bVisible": true, "bSearchable": true, "bSortable": true},
                        {"bVisible": true, "bSearchable": true, "bSortable": true},
                        {"bVisible": true, "bSearchable": true, "bSortable": true},
                        {"bVisible": true, "bSearchable": true, "bSortable": true},
                        {"bVisible": true, "bSearchable": true, "bSortable": true},
                        {"bVisible": true, "bSearchable": true, "bSortable": true},
                        {"bVisible": true, "bSearchable": false, "bSortable": false}
                        
                    ]
                }).fnSetFilteringDelay(700);

            });
        </script>      
    </body>

