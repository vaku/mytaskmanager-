<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php __('Your Task Manager'); ?>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('cake.generic');

        echo $this->Html->css('bootstrap.css');
        echo $this->Html->css('jquery-ui-1.7.3.custom.css');

        echo $this->Html->script('bootstrap.js');

        echo $this->Html->script('jquery.js');
        echo $this->Html->script('jquery-ui-1.7.3.custom.min.js');
        
        //echo $this->Html->script('datepicker.js');

        echo $scripts_for_layout;
        ?>

<style>
            #usernav{

                width: 100%;

                text-align: right;

            }

        </style>
        

    </head>
    <body>
        <div id="container">
            
            <div id = 'usernav'> 

                    <?php
                    if ($session->read("Auth.User")) {
                        ?>
                        Welcome, <?php echo $session->read("Auth.User.username"); ?> <?php echo $html->link('logout', array('controller' => 'users', 'action' => 'logout')); ?>
                        <?php
                    } else {
                        echo $html->link('Register', array('controller' => 'users', 'action' => 'add'));
                        echo " | "; 
                        echo $html->link('Login', array('controller' => 'users', 'action' => 'login'));
                    }
                    ?>
                </div>
          
            <div id="header">
                <h1></h1>
            </div>

            <div id="content">
                


                <?php echo $this->Session->flash(); ?>

                <?php echo $content_for_layout; ?>
            </div>



            <div id="footer">

                <p> TaskManager @ 2012</p>


            </div>
        </div>

    </body>
</html>
