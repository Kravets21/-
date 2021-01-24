<h1>Task №2</h1>
<h2>Get data with JOIN</h2>

<table border="1">
    	      <tr>
		<th>ID</th>
		<th>Buyer</th>
		<th>Sum</th>
		<th>Info</th>
	      </tr>    
	
	<?php for($i = 0; $i != sizeof($buyer_id);$i++):?>  
	    
	<tr>   
	<td><?php echo $buyer_id[$i]?></td>	
	
	<td><?php echo $name[$i]?></td>
	
	<td><?php echo $sum[$i]?></td>
	
	<td><?php 
	if($info[$i] == null)
	{echo 'empty';}
	else
	{echo $info[$i];}?></td> 
	
	</tr>
	<?php endfor; ?>

</table>

