<?php
/**
 * Z-Blog with PHP
 * @author
 * @copyright (C) RainbowSoft Studio
 * @version
 */

require '../../../../../zb_system/function/c_system_base.php';
$zbp->Load();
ob_clean();

MyFormPro_ShowValidateImage(GetVars('id','GET'));