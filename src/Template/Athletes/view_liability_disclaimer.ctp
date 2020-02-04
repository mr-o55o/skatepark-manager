<?php
use Cake\Core\Configure;
?>

<h1 class="text-center"><?= __('Dichiarazione di scarico delle responsabilità') ?></h1>
<hr>

<ul class="list-unstyled text-right">
	<li><?= Configure::read('company_data')['name'] ?></li>
	<li><?= Configure::read('company_data')['registered_office']['address'] ?></li>
	<li><?= Configure::read('company_data')['registered_office']['postal_code'] ?>, <?= Configure::read('company_data')['registered_office']['city'] ?> (<?= Configure::read('company_data')['registered_office']['province'] ?>) - <?= Configure::read('company_data')['registered_office']['state'] ?></li>
	<li></li>
</ul>


 <p class="text-justify">Lorem ipsum <b><?= h($athlete->name) ?> <?= h($athlete->surname) ?></b> nato a <b><?= h($athlete->birth_city) ?></b> il <b><?= h($athlete->birthdate) ?></b> dolor sit amet, consectetur adipiscing elit. Vestibulum iaculis orci non lectus posuere, vel imperdiet nulla aliquet. Nulla sed velit ante. Ut quis rhoncus tortor. Aliquam luctus ipsum eget risus condimentum, id laoreet orci feugiat. Aliquam tempor tellus eget nunc consectetur iaculis. </p>

 <p class="text-justify">Aliquam nec arcu et nisi pharetra dapibus at nec nibh. Phasellus scelerisque lacinia metus, quis facilisis ligula varius id. Vestibulum aliquam erat molestie, tempus arcu a, pretium nulla. Donec dignissim sit amet lectus nec sodales. Aenean eu semper augue. Cras tincidunt pharetra vulputate. Morbi aliquam tellus ac purus feugiat pulvinar. Nam convallis consectetur felis, quis vulputate nisi porta eu. In nec elit feugiat, mollis felis et, cursus risus.</p>

<ul>
	<li>Nam tincidunt condimentum quam, sed venenatis dui accumsan et.</li>
	<li>Aliquam non urna faucibus, semper leo a, feugiat neque. </li>
	<li>Fusce vitae metus non lacus volutpat lobortis eu a velit. </li>
	<li>Suspendisse placerat finibus magna, vitae ultrices nisi lacinia non. </li>
	<li>In sit amet urna neque.</li>
	<li>Donec euismod risus augue, vitae interdum nulla maximus vel.</li> 
	<li>Donec ipsum magna, convallis non lectus a, lobortis placerat nulla.</li>
</ul>

<p class="text-justify">Aenean erat magna, maximus iaculis est eu, sodales maximus odio. Aenean vestibulum imperdiet lacus sit amet dignissim. Suspendisse congue laoreet nisl bibendum feugiat. Duis metus enim, ullamcorper sit amet imperdiet ut, iaculis et neque. Phasellus gravida nunc ac mi efficitur posuere. Nam interdum dictum porttitor. Vivamus et dolor scelerisque, rhoncus elit sed, feugiat velit. In auctor arcu quis dolor tincidunt placerat nec id ligula. Nullam imperdiet sed orci nec rutrum. Suspendisse massa risus, vulputate nec efficitur ac, viverra id enim. Aliquam quis eros sit amet tellus imperdiet aliquet sed vitae magna. Aliquam tristique pretium libero, porta pellentesque libero sagittis eu. Curabitur ipsum purus, sagittis eu pharetra non, gravida sed lectus.</p>

<p class="text-justify">Curabitur ante justo, tristique at bibendum ut, tempus et ex. Donec ut augue est. Phasellus efficitur ut mauris a dapibus. Proin tempor justo eu arcu finibus euismod. Integer pretium mi ac erat pharetra, ac fringilla nisi lobortis. Vestibulum eu gravida dolor, in luctus ante. Integer gravida faucibus tincidunt. Nullam sed dolor elementum, luctus sapien id, pretium sem. In congue dapibus tellus quis volutpat. Phasellus nunc felis, tristique in lorem sit amet, pretium tristique ipsum. Curabitur faucibus odio ut felis dignissim, eu molestie massa pellentesque. Etiam molestie consectetur nibh, sit amet rhoncus nibh aliquam id. Morbi risus dui, rutrum a orci at, vehicula egestas elit. </p>