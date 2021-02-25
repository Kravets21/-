<h1>Task №1</h1>
<h2>Get data without JOIN</h2>

<table border="1">
    	      <tr>
		<th>ID</th>
		<th>Buyer</th>
		<th>Sum</th>
		<th>Info</th>
	      </tr>    
	
	<?php foreach($data as $data_key => $buyers):?>
	      <tr>
	<?php foreach ($buyers as $buyers_key => $buyers_value):?>
	<?php foreach ($buyers_value as $key => $buyer):?>
	   
	<?php if (isset($buyer['buyer_id']) && isset($buyer['name'])) {
	    echo "<td>";
	    echo $buyer['buyer_id'];
	    echo "</td>";
	}?>
		
	
	<?php if (isset($buyer['name']) && isset($buyer['buyer_id'])) {
	    echo "<td>";
	    echo $buyer['name'];
	    echo "</td>";
	}?>
	
	
	<?php if (isset($buyer['sum'])) {
	    echo "<td>";
	    echo $buyer['sum'];
	    echo "</td>";
	}?>
	
	
	<?php if (isset($buyer['info'])) {
	    echo "<td>";
	    echo $buyer['info'];
	    echo "</td>";
	}?>
	
	<?php endforeach;?>
	<?php endforeach;?>
	       </tr>
	<?php endforeach;?>
	    

</table>

