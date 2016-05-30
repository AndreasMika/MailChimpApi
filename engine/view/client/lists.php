	 
    CLICK ON LIST-NAME TO RETRIEVE LIST-DATA 
    <br/><br/>
      
	<div class="tbl">    
        <div class="tblHeader">List-ID</div>
        <div class="tblHeader">List-Name</div>
        <div class="tblHeader">List-Contact</div>     
    </div>
    
    <div class="tbl">
    <?php 
		foreach($data['lists'] as $list) {
			echo '<div class="tblCell">'.$list['id'].'</div>';
			echo '<div class="tblCell"><a class="mcList" href="#" data-url="'.$data['cfg']['host_path'].'client/getList/'.$list['id'].'/">'.$list['name'].'</a></div>';
			echo '<div class="tblCell">'.$list['contact']['company'].'</div>';	
		}
	?>        
	</div>