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
use Cake\I18n\Time;
$topics = Configure::read('topics');
$activeTopic = Configure::read('main_nav')[$this->request->controller][$this->request->action]['topic'];

$this->start('navbar');
    echo $this->element('Navbar/Navbar', ['active' => $activeTopic ]);
$this->end();

$this->start('sidebar');
    if ($this->elementExists('Sidebar/' . $activeTopic )) {
        echo $this->element('Sidebar/'. $activeTopic );  
    }
    echo $this->element('Sidebar/Links');
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
                <nav aria-label="breadcrumb" class="">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><?= $this->Html->link(Configure::read('topics')[$activeTopic]['name'], Configure::read('topics')[$activeTopic]['home']) ?></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= h(Configure::read('main_nav')[$this->request->controller][$this->request->action]['name']) ?></li>
                    </ol>
                </nav>

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
    <div class="bg-dark text-white font-weight-bold">
        <p class="text-center"> <?= Configure::read(['application_data'])['name'] ?> <?= Configure::read(['application_data'])['version'] ?> - &copy; o55o <?= Time::now()->year ?></p>
    </div>
    <?= $this->Html->bootstrapScript(); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</body>
</html>
