	
    
     
    <a href="#" id='mcSyncUsersToDb' data-url="<?php echo  $data['cfg']['host_path']; ?>client/mcSyncUsersToDb/<?php echo $data['listID'] ?>">Sync list to database</a>
    <br/><br/> 
              
	<div class="tbl">    
    <div class="tblHeader">First name</div>
    <div class="tblHeader">Last name</div>
    <div class="tblHeader">Email</div>   
    <div class="tblHeader notOnMobile">Birthdate</div>    
    </div>
    <?php 		
				
		foreach($data['list']['members'] as $member) {
			echo '<div class="tbl">  ';
			echo '<div class="tblCell">'.$member['merge_fields']['FNAME'].'</div>';
			echo '<div class="tblCell">'.$member['merge_fields']['LNAME'].'</div>';
			echo '<div class="tblCell">'.$member['email_address'].'</div>';
			echo '<div class="tblCell notOnMobile">'.$member['merge_fields']['BIRTHDAY'].'</div>';	
			echo '</div>';
		}
	?> 
       
	