<?php
// source: C:\Users\Roman Hronza\OneDrive\Php\htdocs\AutentizaceAutorizace\app\presenters/templates/Autorizace/role.latte

use Latte\Runtime as LR;

class Templatea16e9a250a extends Latte\Runtime\Template
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
		if (isset($this->params['radek'])) trigger_error('Variable $radek overwritten in foreach on line 27');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<table>
    <tr>
        <td style="vertical-align: top; width: 10%">
            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:hlavni")) ?>">
                <i class="fa fa-home fa-4x" style="color: #006AEB;" aria-hidden="true" title="Hlavní"></i>
            </a>
        </td>   
        <td align="center" style="vertical-align: top; width: 20%">
            <h1>Uživatelské role</h1>   
            
<?php
		/* line 13 */ $_tmp = $this->global->uiControl->getComponent("role");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>
            <table border='1' cellpadding="10px" 
                   style="border-collapse: collapse; 
                          border-color: black; 
                          margin: 0px auto; 
                          top: auto; 
                          margin-top: 10px"
                   >
                <tr style="background: #C1D3FF;">
                    <th>ID</th>
                    <th>Název</th>
                    <th>zrušit</th>
                    
                </tr>
<?php
		$iterations = 0;
		foreach ($role as $radek) {
?>
                    <tr>
                        <td><?php echo LR\Filters::escapeHtmlText($radek->id) /* line 29 */ ?></td>
                        <td><?php echo LR\Filters::escapeHtmlText($radek->nazev) /* line 30 */ ?></td>
                        <td><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Autorizace:zrusitRoli", [$radek->id])) ?>">Zrušit</a></td>
                    </tr>
<?php
			$iterations++;
		}
?>
            </table>
        </td>
        <td align="center" style="vertical-align: top; width: 20%">
            <h1>Zdroje aplikace</h1>
            
        </td>
        <td align="center" style="vertical-align: top; width: 20%">
            <h1>Činnosti</h1>
            
        </td>
    </tr>
</table>




  
<?php
	}

}
