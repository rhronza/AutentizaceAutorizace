<?php
// source: C:\Users\Roman Hronza\OneDrive\Php\htdocs\AutentizaceAutorizace\app\presenters/templates/Homepage/hlavni.latte

use Latte\Runtime as LR;

class Template00c509e8f6 extends Latte\Runtime\Template
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

<body class="hlavniObrazovka">
    <div class="centered-Oblast"> 
    	<div style="margin: 0px; padding:10px; font: 12px Verdana; font-weight: bold; font-style: italic">Uživatel: 
            <span>
<?php
		if (($user->isLoggedIn())) {
			?>                    <?php echo LR\Filters::escapeHtmlText($user->getIdentity()->username) /* line 10 */ ?>

                    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:out")) ?>">(Odhlášení)</a>
<?php
		}
		else {
?>
                    (Nejste přihlášen)
<?php
		}
?>
            </span>
        </div>        
        <br>
        <div class="obsah">
            <a  class="hlavniVolbyObrazovky" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Autorizace:roleZdrojeCinnosti")) ?>">
                <i class="fa fa-id-card fa-4x" style="padding:30px" aria-hidden="true" title="Přístupová práva">&nbsp; Přístupová práva</i>
            </a>
            <br>
            <a class="hlavniVolbyObrazovky"  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:up")) ?>">
                <i class="fa fa-male fa-4x" style="padding:30px" aria-hidden="true" title="Nový uživatel">&nbsp; Nový uživatel</i>
            </a>
            <br>
            <a class="hlavniVolbyObrazovky" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:changePassword")) ?>">  
                <i class="fa fa-exchange fa-4x" style="padding:30px" aria-hidden="true" title="Změna hesla uživatele">&nbsp; Změna hesla uživatele</i>
            </a>

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
    .hlavniObrazovka{
        background: #006aeb; 
        width: 60%; 
        height: 100%; 
        margin: auto    
    }
    .obsah{
        font: 12px Verdana;
        margin-top: -40px;
        text-align: left; 
        padding-left: 8px;
    }
</style><?php
	}

}
