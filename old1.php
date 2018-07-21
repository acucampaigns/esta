<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
if(isset($_GET["a"])&& $_GET["a"]=1){
require_once "sessions.php";
require_once "db.php";

// get contacts from db
$listQ = $db->prepare("SELECT * FROM entry3 ORDER BY id DESC");
$listQ->execute();
$list = $listQ->fetchAll();
$tmp = array();

// prepare contacts for table
foreach ($list as $value) {
	$tmp[$value['id']]['name'] = $value['first_name']." ".$value['family_name'];
	$tmp[$value['id']]['contact_phone'] = $value['mob_no'];
	$tmp[$value['id']]['contact_email'] = $value['email'];
	$tmp[$value['id']]['submit_date'] = $value['timestamp'];	
}

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
    	</div>
		<?php
		// if user admin - show link for manage other users
			if ($user['is_admin']) {
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
    		<div class="col-sm-12 col-md-6">    			
    			Filter by any column: <input class="search" type="search" data-column="all">
    		</div>
    	</div>
        <div class="row">	        
        	<table class="tablesorter" id="contactsList">
				<thead>
					<tr>
						<th>Name</th>				
					    <th>Phone</th>
					    <th>Email</th>
					    <th>Date/Time</th>
					    <th>Actions</th>
				    </tr>
				</thead>
				<tbody>
					<?php
					// generate table rows from contacts array
					foreach ($tmp as $key => $item) {
						echo "<tr>";
						foreach ($item as $value) {
							echo "<td>".$value."</td>";
						}
						?>
							<td>
								<a href="show.php?id=<?php echo $key; ?>" title="Show customer"><i class="fa fa-user"></i></a>
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
		});
    </script>
</body>
<?php } ?>