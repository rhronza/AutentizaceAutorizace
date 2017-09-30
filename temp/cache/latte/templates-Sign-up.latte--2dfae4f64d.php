<?php
// source: C:\Users\Roman Hronza\OneDrive\Php\htdocs\AutentizaceAutorizace\app\presenters/templates/Sign/up.latte

use Latte\Runtime as LR;

class Template2dfae4f64d extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'title' => 'blockTitle',
	];

	public $blockTypes = [
		'content' => 'html',
		'title' => 'html',
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
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<table style=" margin: 20px auto; top:auto;/* ; background: #99f999; padding: 10px 80px; border-radius: 12px*/"> 
    <td>
<?php
		$this->renderBlock('title', get_defined_vars());
		/* line 5 */ $_tmp = $this->global->uiControl->getComponent("signUpForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>
    </td>    
</table>
<div class="centered-Oblast">
    <a  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:hlavni")) ?>">
        <i class="fa fa-home fa-4x" style="color: #006AEB; padding-right: 30px" aria-hidden="true" title="Hlavní">
        </i>
    </a>
        
    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Autorizace:roleZdrojeCinnosti")) ?>">
        <i class="fa fa-id-card fa-4x" style="color: #006AEB" aria-hidden="true" title="Přístupová práva"></i>
    </a>
</div>
    
    
<?php
	}


	function blockTitle($_args)
	{
		extract($_args);
?>        <h1>Vytvoření uživatelského účtu</h1>
<?php
	}

}
