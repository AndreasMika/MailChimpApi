   <div id="main">
   Select table
   <br /><br />
   <pre>
   <?php 
   		foreach($data['cfg']['mcTables'] as $mcTable) {
			echo '	<a href="#" class="dbShowTable" data-url="'.$data['cfg']['host_path'].'db/showTable/'.$mcTable.'">'.$mcTable.'</a>';
			}
    ?>
   </pre>
   </div>   
   <div id="mcResult"></div>
	                 
	
       