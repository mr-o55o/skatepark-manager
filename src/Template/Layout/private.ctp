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

$this->start('navbar');
    echo $this->element('Navbar/Navbar');
$this->end();

$this->start('sidebar');
    $topic = Configure::read('main_nav')['controllers'][$this->request->controller]['topic'];
    if ($this->elementExists('Sidebar/' . $topic )) {
        echo $this->element('Sidebar/'. $topic );  
    }
$this->end();

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Skatepark Manager - Reserved Area
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
    <!-- Navbar -->
    <?= $this->fetch('navbar'); ?>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-2 bg-dark text-white p-3">
                <?= $this->fetch('sidebar'); ?>           
            </div>
            <!-- Main Area -->
            <div class="col-lg-10 m-0 p-0">
                <!-- Controller Based Jumbotron -->
                <?= $this->Element($this->request->controller . '/jumbotron'); ?> 
                <!-- Main Container -->
                <div class="container clearfix">
                    <!-- Flash messages -->
                    <?= $this->Flash->render() ?>
                    <!-- Application Error messages -->
                    <?php if(isset($errors)) : ?>
                        <?= $this->Element('Errors/error_box'); ?>
                    <?php endif; ?>
                    <!-- Content -->
                    <?= $this->fetch('content') ?>
                </div>             
            </div>
        </div>
    </div>
    <div class="bg-dark text-white">
        <p class="text-center">&copy; EnjoyMore 2018</p>
    </div>
    <?= $this->Html->bootstrapScript(); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</body>
</html>
