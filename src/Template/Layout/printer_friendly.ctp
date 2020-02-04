<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Configure;

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Skatepark Manager - Printer Friendly Page
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->Html->bootstrapCss(); ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/custom.css">
    <?= $this->fetch('script') ?>
    <script src="/js/jquery,min.js"></script>
</head>
<body>
	<div class="container mt-2">
		<div class="d-print-none bg-info rounded"><?= $this->Html->link(__('Indietro'), 'javascript:history.back()') ?></div>
	    <?= $this->fetch('content') ?>
	</div>
</body>
</html>