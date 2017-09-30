<?php
// source: C:\Users\Roman Hronza\OneDrive\Php\htdocs\AutentizaceAutorizace\app\presenters/templates/Autorizace/editPristupovaPrava.latte

use Latte\Runtime as LR;

class Templateca2a2d0a95 extends Latte\Runtime\Template
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
		if (isset($this->params['error'])) trigger_error('Variable $error overwritten in foreach on line 8');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div class="centered-Oblast-nahoru" style="width: 100%">
    <h1 style="text-align: center">Úprava PŘÍSTUPOVÝCH PRÁV</h1>
<?php
		/* line 6 */
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $this->global->formsStack[] = $this->global->uiControl["pristupovaPrava"], []);
?>

    <div style="text-align: center">
<?php
		$iterations = 0;
		foreach ($form->ownErrors as $error) {
			?>        <li style="color: red; font-weight: bold; background-color: white"><?php echo LR\Filters::escapeHtmlText($error) /* line 8 */ ?></li>
<?php
			$iterations++;
		}
		?>        <?php echo end($this->global->formsStack)["user_id"]->getControl() /* line 9 */ ?>

        <?php echo end($this->global->formsStack)["role_id"]->getControl() /* line 10 */ ?>

        <?php echo end($this->global->formsStack)["zdroj_id"]->getControl() /* line 11 */ ?>

        <?php echo end($this->global->formsStack)["cinnost_id"]->getControl() /* line 12 */ ?>

        <?php echo end($this->global->formsStack)["send"]->getControl() /* line 13 */ ?>

    </div>  
<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack));
?>

<p style="text-align: center">
    <a  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Autorizace:roleZdrojeCinnosti")) ?>">
        <i class="fa fa-arrow-circle-left fa-4x" aria-hidden="true" title="Zpět" ></i>
    </a>
</p>
</div><?php
	}

}
