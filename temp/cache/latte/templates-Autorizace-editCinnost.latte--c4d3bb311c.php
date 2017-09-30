<?php
// source: C:\Users\Roman Hronza\OneDrive\Php\htdocs\AutentizaceAutorizace\app\presenters/templates/Autorizace/editCinnost.latte

use Latte\Runtime as LR;

class Templatec4d3bb311c extends Latte\Runtime\Template
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
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<div class="centered-Oblast-nahoru">
<h1>Úprava ČINNOSTI</h1>
<?php
		/* line 7 */ $_tmp = $this->global->uiControl->getComponent("cinnosti");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>
<p style="text-align: left; text-align: right">
    <a  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Autorizace:roleZdrojeCinnosti")) ?>">
        <i class="fa fa-arrow-circle-left fa-4x" aria-hidden="true" title="Zpět" ></i>
    </a>
</p>
</div>
<?php
	}

}
