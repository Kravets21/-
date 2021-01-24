<h1>Task №1</h1>
<h2>Get data without JOIN</h2>

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
	if(empty($info[$i]))
	{echo 'empty';}
	else
	{echo $info[$i];}?></td> 
	
	</tr>
	<?php endfor; ?>

</table>

