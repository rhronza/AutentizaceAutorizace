<?php
// source: C:\Users\Roman Hronza\OneDrive\Php\htdocs\AutentizaceAutorizace\app\presenters/templates/Autorizace/roleZdrojeCinnosti.latte

use Latte\Runtime as LR;

class Templateb3d8023736 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['error'])) trigger_error('Variable $error overwritten in foreach on line 24');
		if (isset($this->params['radek'])) trigger_error('Variable $radek overwritten in foreach on line 60, 117, 158, 195, 233');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div style="text-align: right">
    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:hlavni")) ?>">
        <i class="fa fa-home fa-2x" style="color: bl;" aria-hidden="true" title="Hlavní"></i>
    </a>
</div>   

<table border="0" style="table-layout: fixed; width: 100%; border: none; /*border-collapse: collapse; */margin-top: -30px">
    <tr>
        <td colspan="2" align="center" style="vertical-align: top; width: 800px; word-wrap: break-word; border-style: solid; border-radius: 14px; background-color: #EEE">
            <h1 style="color: #D51616; margin: 3px">Přístupová práva</h1>
            <?php
		/* line 14 */
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $this->global->formsStack[] = $this->global->uiControl["pristupovaPrava"], []);
?>

                <div style="text-align: center">
<?php
		$iterations = 0;
		foreach ($form->ownErrors as $error) {
			?>                    <li style="color: red; font-weight: bold; background-color: white"><?php echo LR\Filters::escapeHtmlText($error) /* line 24 */ ?></li>
<?php
			$iterations++;
		}
?>
                    
                    <?php echo end($this->global->formsStack)["user_id"]->getControl() /* line 26 */ ?>

                    <?php echo end($this->global->formsStack)["role_id"]->getControl() /* line 27 */ ?>

                    <?php echo end($this->global->formsStack)["zdroj_id"]->getControl() /* line 28 */ ?>

                    <?php echo end($this->global->formsStack)["cinnost_id"]->getControl() /* line 29 */ ?>

                    <?php echo end($this->global->formsStack)["send"]->getControl() /* line 30 */ ?>

                </div>  
            <?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack));
?>

              
                
            <table border='1' cellpadding="5px" align="center"
                   style="border-collapse: collapse; 
                          border-color: black; 
                          margin: 0px auto; 
                          top: auto; 
                          margin-top: 10px;
                          table-layout: fixed;
                          width: 380px"
                   >
                <tr style="background: #006AEB; color: white; font:12px Verdana">
                    <th style="width: 25px">ID</th>
                    <th style="width: 158px">Uživatel</th>
                    <th style="width: 158px">Role</th>
                    <th style="width: 158px">Zdroj</th>
                    <th style="width: 158px">Činnost</th>
                    <th style="width: 25px; writing-mode: vertical-lr">storno</th>
                    <th style="width: 25px; writing-mode: vertical-rl">změnit</th>

                </tr>
                
<?php
		$predchoziUserName='';
		$predchoziRole_nazev='';
		$predchoziZdroj_nazev='';
		$predchoziCinnost_nazev='';
?>
                
<?php
		$iterations = 0;
		foreach ($pristupovaprava as $radek) {
?>
                    <tr>
                         <td style="background: #EEE"><?php echo LR\Filters::escapeHtmlText($radek->pp_id) /* line 62 */ ?></td>
                         
<?php
			if ($predchoziUserName<>$radek->username) {
				?>                            <td style="background: #EEE; font-weight: bold"><?php echo LR\Filters::escapeHtmlText($radek->username) /* line 65 */ ?></td>
<?php
				$predchoziUserName=$radek->username;
				?>                        <?php
			}
			else {
?>  <td style="text-align: left; color: #acacac; font-style: italic; padding-left: 20px"> 
                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                </td>
<?php
			}
?>
                        
<?php
			if ($predchoziRole_nazev<>$radek->role_nazev) {
				?>                            <td style="background: #EEE"><?php echo LR\Filters::escapeHtmlText($radek->role_nazev) /* line 73 */ ?></td>
<?php
				$predchoziRole_nazev=$radek->role_nazev;
				?>                        <?php
			}
			else {
?>  <td style="text-align: left; color: #acacac; font-style: italic; padding-left: 20px">
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                </td>
<?php
			}
?>
                        
                        <td style="background: #EEE"><?php echo LR\Filters::escapeHtmlText($radek->zdroj_nazev) /* line 80 */ ?></td>
                        <td style="background: #EEE"><?php echo LR\Filters::escapeHtmlText($radek->cinnost_nazev) /* line 81 */ ?></td>
                        
                        <td style="text-align: center">
                           <a onclick="return  confirm('Skutečně chcete stornovat záznam?')" href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Autorizace:zrusitPristupovePravo", [$radek->pp_id])) ?>">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                           </a>
                        </td>
                        <td style="text-align: center">
                            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Autorizace:editPristupovaPrava", [$radek->pp_id])) ?>"> 
                               <i class="fa fa-pencil" aria-hidden="true"></i> 
                            </a>
                        </td>                        
                    </tr>
<?php
			$iterations++;
		}
?>
            </table>
            <br>
        </td>
        
        <td align="center" style="vertical-align: top; width: 400px; word-wrap: break-word;">
            <h2 style="color: #06B">Uživatelé</h2>               
            <table border='1' cellpadding="5px" align="center"
                   style="border-collapse: collapse; 
                          border-color: black; 
                          margin: 0px auto; 
                          top: auto; 
                          margin-top: 10px;
                          table-layout: fixed;
                          width: 380px"
                   >
                <tr style="background: #C1D3FF;">
                    <th style="width: 25px">ID</th>
                    <th style="width: 150px">Uživatel</th>
                    <th style="width: 150px">email</th>
                    <th style="width: 25px; writing-mode: vertical-lr">storno</th>

                </tr>
<?php
		$iterations = 0;
		foreach ($uzivatele as $radek) {
?>
                    <tr>
                        <td><?php echo LR\Filters::escapeHtmlText($radek->id) /* line 119 */ ?></td>
                        <td><?php echo LR\Filters::escapeHtmlText($radek->username) /* line 120 */ ?></td>
                        <td><?php echo LR\Filters::escapeHtmlText($radek->email) /* line 121 */ ?></td>
                        <td style="text-align: center;">
                            <a onclick="return  confirm('Skutečně chcete stornovat záznam?')" href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Autorizace:zrusitUzivatele", [$radek->id])) ?>">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>                         
                        </td>
                    </tr>
<?php
			$iterations++;
		}
?>
            </table>
            <p style="text-align: center; margin-top: 10px">
                    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:up")) ?>">
                        <i class="fa fa-male fa-2x" aria-hidden="true" title="Nový uživatel" style="color: #06B"></i><br>
                    </a>
            </p>    
        </td>   
    </tr>
    <tr>
        <td align="center" style="vertical-align: top; width: 400px; word-wrap: break-word">
            <h2 style="color: #06B">Uživatelské role</h2>   
<?php
		/* line 140 */ $_tmp = $this->global->uiControl->getComponent("role");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>
            <table border='1' cellpadding="7px" align="center" 
                   style="border-collapse: collapse; 
                          border-color: black; 
                          margin: 0px; 
                          top: auto; 
                          margin-top: 10px;
                          table-layout: fixed;
                          width:380px;"                          
                         
                   >
                <tr style="background: #C1D3FF;">
                    <th style="width: 25px">ID</th>
                    <th style="width: 280px">Název role</th>
                    <th style="width: 25px; writing-mode: vertical-lr">storno</th>
                    <th style="width: 25px; writing-mode: vertical-lr">změnit</th>
                    
                </tr>
<?php
		$iterations = 0;
		foreach ($role as $radek) {
?>
                    <tr>
                        <td><?php echo LR\Filters::escapeHtmlText($radek->id) /* line 160 */ ?></td>
                        <td><?php echo LR\Filters::escapeHtmlText($radek->nazev) /* line 161 */ ?></td>
                        <td style="text-align: center">
                            <a onclick="return  confirm('Skutečně chcete stornovat záznam?')" href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Autorizace:zrusitRoli", [$radek->id])) ?>">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td style="text-align: center">
                            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Autorizace:editRole", [$radek->id])) ?>">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
<?php
			$iterations++;
		}
?>
            </table>
        </td>
        <td align="center" style="vertical-align: top;width: 400px; word-wrap: break-word">
            <h2 style="color: #06B">Zdroje aplikace</h2>
<?php
		/* line 178 */ $_tmp = $this->global->uiControl->getComponent("zdroje");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>
            <table border='1' cellpadding="7px" align="right"
                   style="border-collapse: collapse; 
                          border-color: black; 
                          margin: 0px auto; 
                          top: auto; 
                          margin-top: 10px;
                          table-layout: fixed;
                          width: 380px;"
                   >
                <tr style="background: #C1D3FF;">
                    <th style="width: 25px">ID</th>
                    <th style="width: 280px">Název zdroje</th>
                    <th style="width: 25px; writing-mode: vertical-lr">storno</th>
                    <th style="width: 25px; writing-mode: vertical-lr">změnit</th>

                </tr>
<?php
		$iterations = 0;
		foreach ($zdroje as $radek) {
?>
                    <tr>
                        <td><?php echo LR\Filters::escapeHtmlText($radek->id) /* line 197 */ ?></td>
                        <td><?php echo LR\Filters::escapeHtmlText($radek->nazev) /* line 198 */ ?></td>
                        <td style="text-align: center">
                            <a onclick="return  confirm('Skutečně chcete stornovat záznam?')" href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Autorizace:zrusitZdroj", [$radek->id])) ?>">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td style="text-align: center">
                            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Autorizace:editZdroj", [$radek->id])) ?>">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>

                        </td>                        
                    </tr>
<?php
			$iterations++;
		}
?>
            </table>
        </td>
        <td align="center" style="vertical-align: top; width: 400px; word-wrap: break-word">
            <h2 style="color: #06B">Činnosti aplikace</h2>
<?php
		/* line 216 */ $_tmp = $this->global->uiControl->getComponent("cinnosti");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>
            <table border='1' cellpadding="7px" align="center"
                   style="border-collapse: collapse; 
                          border-color: black; 
                          margin: 0px auto; 
                          top: auto; 
                          margin-top: 10px;
                          table-layout: fixed;
                          width: 380px"
                   >
                <tr style="background: #C1D3FF;">
                    <th style="width: 25px">ID</th>
                    <th style="width: 280px">Název činnosti</th>
                    <th style="width: 25px; writing-mode: vertical-lr">storno</th>
                    <th style="width: 25px; writing-mode: vertical-rl">změnit</th>

                </tr>
<?php
		$iterations = 0;
		foreach ($cinnosti as $radek) {
?>
                    <tr>
                        <td><?php echo LR\Filters::escapeHtmlText($radek->id) /* line 235 */ ?></td>
                        <td><?php echo LR\Filters::escapeHtmlText($radek->nazev) /* line 236 */ ?></td>
                        <td style="text-align: center">
                            <a onclick="return  confirm('Skutečně chcete stornovat záznam?')" href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Autorizace:zrusitCinnost", [$radek->id])) ?>">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td style="text-align: center">
                            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Autorizace:editCinnost", [$radek->id])) ?>">
                               <i class="fa fa-pencil" aria-hidden="true"></i> 
                            </a>

                        </td>                        
                    </tr>
<?php
			$iterations++;
		}
?>
            </table>

        </td>
    </tr>

</table>




  
<?php
	}

}
