<?php
// source: C:\Users\Roman Hronza\OneDrive\Php\htdocs\AutentizaceAutorizace\app\presenters/templates/Sign/in.latte

use Latte\Runtime as LR;

class Template4d5fb27b42 extends Latte\Runtime\Template
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
<body class="hlavniObrazovka">
    <div class="centered-Oblast-nahoru">
        <div class="obsah">
<?php
		$this->renderBlock('title', get_defined_vars());
		/* line 6 */ $_tmp = $this->global->uiControl->getComponent("signInForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>
        </div>
    </div>
</body>

<style>
    .hlavniVolbyObrazovky{
     color: #006AEB; 
     margin: 30px 30px 30px 30px;    
    }
    
    .centered-Oblast{ 
        position: fixed;
        top: 50%; 
        left: 50%; 
        /* bring your own prefixes */ 
        transform: translate(-50%, -50%);
        background: white; 
        border-radius: 30px; 
        padding: 20px; padding-bottom: 50px;
        /*margin: 70px; */
        text-align: right;
    }
    
    .centered-Oblast-nahoru{ 
        position: fixed;
        top: 50%; 
        left: 50%; 
        /* bring your own prefixes */ 
        transform: translate(-50%, -100%);
        background: white; 
        border-radius: 30px; 
        padding: 30px; 
        /*padding-bottom: 40px;*/
        /*margin: 70px; */
        text-align: right;
    }
    .hlavniObrazovka{
        background: #006aeb; 
        width: 100%; 
        height: 100%; 
        margin: auto    
    }
    .obsah{
        font: 12px Verdana;
        margin-top: 0px;
        text-align: left; 
        padding-left: 8px;
    }
</style><?php
	}


	function blockTitle($_args)
	{
		extract($_args);
?>            <h1 style="margin: 10px">Přihlášení do aplikace</h1>
<?php
	}

}
