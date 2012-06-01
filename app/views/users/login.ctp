 
<head>
    <?php echo $this->Html->css('bootstrap.css'); ?>



    <?php echo $this->Html->script('bootstrap'); ?>
</head>


<style type="text/css">
    body {
        padding-top: 60px;
        padding-bottom: 40px;
        alignment-adjust: center;

    }

    body form .input{
        font-family:"HelveticaNeue-Light","Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,sans-serif;
        font-weight:200;
        font-size:24px;

        width:100%;
        padding:0px;
        margin: 0px;
        border:1px solid #e5e5e5;
        background:#fbfbfb;
        outline:none;
    }
    input{
        color:#555;
    }
    .clear{clear:both;}#pass-strength-result{font-weight:bold;border-style:solid;border-width:1px;margin:12px 0 6px;padding:6px 5px;text-align:center;}

    form{
        margin-left:29%;padding:26px 24px 20px;font-weight:normal;

        width: 500px;
        margin-top: 20px;
        -moz-border-radius:3px;
        -khtml-border-radius:3px;
        -webkit-border-radius:3px;
        border-radius:3px;
        background:#fff;
        border:1px solid #e5e5e5;
        -moz-box-shadow:rgba(200,200,200,0.7) 0 4px 10px -1px;
        -webkit-box-shadow:rgba(200,200,200,0.7) 0 4px 10px -1px;
        -khtml-box-shadow:rgba(200,200,200,0.7) 0 4px 10px -1px;
        box-shadow:rgba(200,200,200,0.7) 0 4px 10px -1px;
       
    }

    #topheader {
        text-align: center;
        font-size: 28px;
        font-family: Helvetica, sans-serif;
        color: #414141;


    }
    
   

    
    

</style>



<div id ="topheader">  <h1>Welcome to Task Manager </h1>  </div>      

<?php
echo $form->create("User", array("controller" => "users", "action" => "login"));
?>


<h2 style="color: black;"><?php __('LOGIN'); ?></h2>

<?php echo $this->Session->flash('auth'); ?>
<?php
echo $this->Form->input('username');
echo $this->Form->input('password');
?>

<?php echo $this->Form->end(__('Submit', true)); ?>

