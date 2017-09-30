<?php
// source: C:\Users\Roman Hronza\OneDrive\Php\htdocs\AutentizaceAutorizace\app\presenters/templates/Sign/changePassword.latte

use Latte\Runtime as LR;

class Template78175fff7e extends Latte\Runtime\Template
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
<div style="position: fixed;top: 10%;left: 30%; /*transform: translate(-50%, -50%); */">
    <h1>Změna hesla uživatele</h1>
<?php
		/* line 6 */ $_tmp = $this->global->uiControl->getComponent("changePasswordForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>
</div>
<a class="centered-Oblast" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:hlavni")) ?>">
    <i class="fa fa-home fa-4x" style="color: #006AEB" aria-hidden="true" title="Hlavní">
    </i>
</a><?php
	}

}
