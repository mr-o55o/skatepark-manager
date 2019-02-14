<?php

?>

<div class="content">
    <h3><?= __('Lesson Editions Dashboard') ?></h3>

    <h4><?= __('Total number of Editions stored: {0}', $totalEditions) ?></h4>
    <hr>

    <div class="container">
    	<div class="row">
    		<div class="col">
    			<div class="card">
    				<div class="card-header"><?= __('Editions by status') ?></div>
    				<div class="card-body">
					    <table class="table table-striped">
					    	<thead>
					    		<th><?= __('Status') ?></th>
					    		<th><?= __('Editions') ?></th>
					    	</thead>
					    	<?php foreach ($countByStatus as $status): ?> 
						        <tr>
						            <th scope="row"><?= h($status['name']) ?></th>
						            <td><?= h($status['count']) ?></td>
						        </tr>
					        <?php endforeach; ?>
					    </table> 
				    </div>
    			</div>  			
    		</div>
    		<div class="col">
    			<div class="card">
    				<div class="card-header"><?= __('Editions by trainer') ?></div>
			    	<div class="card-body">
					    <table class="table table-striped">
					    	<thead>
					    		<th><?= __('Trainer') ?></th>
					    		<th><?= __('Booked') ?></th>
					    		<th><?= __('Completed') ?></th>
					    	</thead>
					    	<?php foreach ($countByTrainer as $trainer): ?> 
						        <tr>
						            <th scope="row"><?= h($trainer['_matchingData']['Users']['name']) ?> <?= h($trainer['_matchingData']['Users']['surname']) ?></th>
						            <td><?= h($trainer['number_booked']) ?></td>
						            <td><?= h($trainer['number_completed']) ?></td>
						        </tr>
					        <?php endforeach; ?>
					    </table> 
					 </div>
				</div>			
    		</div>
    		<div class="col">
    			<div class="card">
    				<div class="card-header"><?= __('Editions by athlete') ?></div>
			    	<div class="card-body">
					    <table class="table table-striped">
					    	<thead>
					    		<th><?= __('Athlete') ?></th>
					    		<th><?= __('Booked') ?></th>
					    		<th><?= __('Completed') ?></th>
					    	</thead>
					    	<?php foreach ($countByAthlete as $athlete): ?> 
						        <tr>
						            <th scope="row"><?= h($athlete['_matchingData']['Athletes']['name']) ?> <?= h($athlete['_matchingData']['Athletes']['surname']) ?></th>
						            <td><?= h($athlete['number_booked']) ?></td>
						            <td><?= h($athlete['number_completed']) ?></td>
						        </tr>
					        <?php endforeach; ?>
					    </table>
			    	</div>
			    </div>    			
    		</div>
    	</div>
    </div>
</div>