<?php
// source: C:\Users\Roman Hronza\OneDrive\Php\htdocs\AutentizaceAutorizace\app\presenters/templates/Sign/out.latte

use Latte\Runtime as LR;

class Template5b685a3e08 extends Latte\Runtime\Template
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
<table style=" margin: 0px auto; top:auto; "> 
    <td>
<?php
		$this->renderBlock('title', get_defined_vars());
?>
        <p style="text-align: center">
            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("in")) ?>">
                <i class="fa fa-arrow-circle-right fa-4x" style="color: #006AEB" aria-hidden="true" title="Znovu přihlásit">
                </i>
            </a>
        </p>
    </td>
</table>
<?php
	}


	function blockTitle($_args)
	{
		extract($_args);
?>        <h1>Byl jste odhlášen</h1>
<?php
	}

}
