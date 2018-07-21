<?php
/**
 * Show users list
 */
require_once "sessions.php";
require_once "db.php";

// get users from db
$listQ = $db->prepare("SELECT * FROM users");
$listQ->execute();
$list = $listQ->fetchAll();
$tmp = array();

// prepare data for table
foreach ($list as $value) {
    $tmp[$value['id']]['firstname'] = $value['firstname'];
    $tmp[$value['id']]['lastname'] = $value['lastname'];
    $tmp[$value['id']]['login'] = $value['login'];
    $tmp[$value['id']]['email'] = $value['email'];
    $tmp[$value['id']]['is_admin'] = $value['is_admin'] ? '<span class="status-true">True</span>'
                                                        : '<span class="status-false">False</span>';
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Users list</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- link rel="shortcut icon" href="favicon.png" / -->
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="lib/tablesorter/css/theme.default.css">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="lib/tablesorter/js/jquery.tablesorter.min.js"></script>
    <script src="lib/tablesorter/js/jquery.tablesorter.widgets.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
            Current user: <?php echo $user['login']; ?> (<a href="logout.php">Logout</a>)
        </div>
        <div class="col-sm-4 col-sm-offset-8">
            Back to <a href="main.php">contacts list</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            Filter by any column: <input class="search" type="search" data-column="all">
        </div>
    </div>
    <div class="row">
        <table class="tablesorter" id="contactsList">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Login</th>
                <th>Email</th>
                <th>Is admin</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // generate table rows from users array
            foreach ($tmp as $key => $item) {
                echo "<tr>";
                foreach ($item as $value) {
                    echo "<td>".$value."</td>";
                }
                ?>
                <td>
                    <span class="btn-toggle frm-toggle" data-id="<?php echo $key; ?>" title="Toggle admin status"><i class="fa fa-undo"></i></span>
                    <span class="btn-delete frm-toggle" data-id="<?php echo $key; ?>" title="Delete user"><i class="fa fa-remove"></i></span>
                </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    jQuery(document).ready(function() {
        jQuery("#contactsList").tablesorter({
            theme: 'default',
            widgets: ["zebra", "filter"],
            widgetOptions : {
                // filter_anyMatch replaced! Instead use the filter_external option
                // Set to use a jQuery selector (or jQuery object) pointing to the
                // external filter (column specific or any match)
                filter_external : '.search',
                // add a default type search to the first name column
                filter_defaultFilter: { 1 : '~{query}' },
                // include column filters
                filter_columnFilters: true,
                filter_placeholder: { search : 'Search...' },
                filter_saveFilters : true,
                filter_reset: '.reset'
            }
        });

        // make search button work
        jQuery('button[data-column]').on('click', function(){
            var $this = $(this),
                totalColumns = $table[0].config.columns,
                col = $this.data('column'), // "all"
                filter = [];

            // text to add to filter
            filter[ col === 'all' ? totalColumns : col ] = $this.text();
            $table.trigger('search', [ filter ]);
            return false;
        });

        jQuery(".btn-delete").click(function() {
            if (confirm("Do you really want to delete this user?")) { // ask confirmation
                // generate url
                var url = "delete.php?table=user&id="+jQuery(this).data('id');
                // run delete script via ajax
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (resp) {
                        console.log(resp);
                        var result = JSON.parse(resp);
                        if (result['status']) {
                            location.reload();
                        } else {
                            alert(result['description']);
                        }
                    },
                    error: function (resp, textStatus, errorThrown) {
                        console.log(resp, textStatus, errorThrown);
                        alert("Got an error while deleting, check console for details");
                    }
                });
            }
        })
        jQuery(".btn-toggle").click(function() {
            if (confirm("Do you really want to toggle admin status for this user?")) { // ask confirmation
                // generate url
                var url = "tadmin.php?id="+jQuery(this).data('id');
                // call toggle script via ajax
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (resp) {
                        console.log(resp);
                        var result = JSON.parse(resp);
                        if (result['status']) {
                            location.reload();
                        } else {
                            alert(result['description']);
                        }
                    },
                    error: function (resp, textStatus, errorThrown) {
                        console.log(resp, textStatus, errorThrown);
                        alert("Got an error while toggling, check console for details");
                    }
                });
            }
        })
    });
</script>
</body>