<?php
require_once __DIR__.'/config.php';
function e(?string $s):string{return htmlspecialchars($s??'',ENT_QUOTES,'UTF-8');}
function require_login():void{if(empty($_SESSION['user_id'])){header('Location: login.php');exit;}}
function uid():int{return (int)($_SESSION['user_id']??0);}
function csym():string{return ['INR'=>'₹','USD'=>'$','EUR'=>'€','GBP'=>'£','LKR'=>'Rs '][$_SESSION['currency']??'INR']??'₹';}
function money(float|string $n):string{return csym().number_format((float)$n,2);}
function start_page(string $title,string $active=''):void{
 $name=e($_SESSION['user_name']??'User');
 $nav=['dashboard.php'=>['⌂','Dashboard'],'transactions.php'=>['↔','Transactions'],'budget.php'=>['◷','Budgets'],'reports.php'=>['▥','Reports'],'export.php'=>['⇩','Export CSV'],'settings.php'=>['⚙','Settings']];
 echo '<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>'.e($title).' · Expense Tracker</title><link rel="stylesheet" href="assets/style.css"><script src="https://cdn.jsdelivr.net/npm/chart.js"></script><script defer src="assets/app.js"></script></head><body><div class="shell"><aside class="sidebar"><a class="logo" href="dashboard.php"><span class="mark">E</span><span>Expense<span class="muted-logo">Tracker</span></span></a><div class="nav-caption">WORKSPACE</div><nav>';
 foreach($nav as $url=>$it)echo '<a class="nav-link '.($active===$url?'active':'').'" href="'.$url.'"><span>'.$it[0].'</span>'.$it[1].'</a>';
 echo '</nav><div class="profile-mini"><span class="avatar">'.strtoupper(substr($name,0,1)).'</span><div><b>'.$name.'</b><small>'.e($_SESSION['user_email']??'Personal account').'</small></div><a href="logout.php">↗</a></div></aside><main class="main"><header class="topbar"><div><small>PERSONAL FINANCE</small><b>'.e($title).'</b></div><div class="top-right"><button class="icon-btn" data-theme-toggle title="Toggle theme">☼</button><a class="avatar" href="settings.php">'.strtoupper(substr($name,0,1)).'</a></div></header><div class="content"><p class="hello">Hi '.$name.' <span>✦</span></p>';
}
function end_page():void{echo '</div><footer>Expense Tracker · Make every rupee count.</footer></main></div></body></html>';}
