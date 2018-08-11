<?php
/* Smarty version 3.1.32, created on 2018-06-18 10:32:24
  from '/Users/razib/Dropbox/valet/stackb/ui/theme/default/client_receipt.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b27c278a8b7a2_75334027',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0726c053cc0d2637faff002a054c3737a7bf7d63' => 
    array (
      0 => '/Users/razib/Dropbox/valet/stackb/ui/theme/default/client_receipt.tpl',
      1 => 1510616783,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b27c278a8b7a2_75334027 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Receipt</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.2.3/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>@page { size: A5 landscape }</style>

    <link href="https://fonts.googleapis.com/css?family=Asap+Condensed" rel="stylesheet">

    <!-- Custom styles for this document -->
    <link href='https://fonts.googleapis.com/css?family=Tangerine:700' rel='stylesheet' type='text/css'>
    <style>
        body   { font-family: 'Asap Condensed', sans-serif; }
        h1     { font-family: 'Tangerine', cursive; font-size: 40pt; line-height: 18mm}
        h2, h3 { font-family: 'Tangerine', cursive; font-size: 24pt; line-height: 7mm }
        h4     { font-size: 32pt; line-height: 14mm }
        h2 + p { font-size: 18pt; line-height: 7mm }
        h3 + p { font-size: 14pt; line-height: 7mm }
        li     { font-size: 11pt; line-height: 5mm }
        h1      { margin: 0 }
        h1 + ul { margin: 2mm 0 5mm }
        h2, h3  { margin: 0 3mm 3mm 0; float: left }
        h2 + p,
        h3 + p  { margin: 0 0 3mm 50mm }
        h4      { margin: 2mm 0 0 50mm; border-bottom: 2px solid black }
        h4 + ul { margin: 5mm 0 0 50mm }
        article { border: 2px dotted black; padding: 5mm 10mm;  }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A5 landscape">

<!-- Each sheet element should have the class "sheet" -->
<!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
<section class="sheet padding-20mm">


    <article>

        <table style="width:100%">

            <tr>
                <td align="left"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Receipt'];?>
 # <?php echo $_smarty_tpl->tpl_vars['transaction']->value->id;?>
</td>
                <td align="right"><?php echo $_smarty_tpl->tpl_vars['config']->value['CompanyName'];?>
 <br> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Date'];?>
: <?php echo date($_smarty_tpl->tpl_vars['config']->value['df'],strtotime($_smarty_tpl->tpl_vars['transaction']->value->date));?>
</td>

            </tr>

        </table>

        <hr>


        <h2><?php if (($_smarty_tpl->tpl_vars['transaction']->value->type) == 'Expense') {?>Spent To: <?php } else { ?>Received from:<?php }?></h2>
        <p><?php if ($_smarty_tpl->tpl_vars['transaction']->value->payer == '') {?> n/a <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['transaction']->value->payer;?>
 <?php }?></p>

        <h3>For:</h3>
        <p><?php echo $_smarty_tpl->tpl_vars['transaction']->value->description;?>
</p>

        <h4><?php echo ib_money_format($_smarty_tpl->tpl_vars['transaction']->value->amount,$_smarty_tpl->tpl_vars['config']->value,$_smarty_tpl->tpl_vars['currency_symbol']->value);?>
</h4>

        <table style="width:100%">

            <tr>
                <td align="left">
                    <?php echo $_smarty_tpl->tpl_vars['_L']->value['Method'];?>
: <?php echo $_smarty_tpl->tpl_vars['transaction']->value->method;?>
 <br>
                    <?php ob_start();
echo $_smarty_tpl->tpl_vars['_L']->value['Ref'];
$_prefixVariable1 = ob_get_clean();
echo $_prefixVariable1;?>
: <?php if ($_smarty_tpl->tpl_vars['transaction']->value->ref == '') {?>n/a<?php } else {
echo $_smarty_tpl->tpl_vars['transaction']->value->ref;
}?>
                </td>
                <td align="right">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['qr_url']->value;?>
">
                </td>

            </tr>

        </table>


        <hr>
        <p align="center" style="font-size: 14px;">Electronic Receipt. Generated On: <?php echo date($_smarty_tpl->tpl_vars['time_format']->value,time());?>
</p>
    </article>

</section>

</body>

</html><?php }
}
