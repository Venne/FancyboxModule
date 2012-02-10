<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace App\FancyboxModule\Subscribers;

use Venne;
use App\CoreModule\Events\RenderEvents;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class RenderSubscriber implements \Doctrine\Common\EventSubscriber {


	/** @var string */
	protected $selector;

	/** @var \Venne\Assets\AssetManager */
	protected $assetManager;



	public function __construct(\Nette\DI\Container $container, \Venne\Assets\AssetManager $assetManager)
	{
		$this->assetManager = $assetManager;
		$this->selector = $container->parameters["modules"]["fancybox"]["selector"];
	}



	/**
	 * @return array
	 */
	public function getSubscribedEvents()
	{
		return array(
			RenderEvents::onHeadEnd,
			RenderEvents::onHeadBegin
		);
	}


	public function onHeadBegin()
	{
		$this->assetManager->addJavascript("@FancyboxModule/jquery.easing-1.3.pack.js");
		$this->assetManager->addJavascript("@FancyboxModule/jquery.mousewheel-3.0.4.pack.js");
		$this->assetManager->addJavascript("@FancyboxModule/jquery.fancybox-1.3.4.pack.js");
		$this->assetManager->addStylesheet("@FancyboxModule/jquery.fancybox-1.3.4.css");
	}


	public function onHeadEnd()
	{
		echo "<script type=\"text/javascript\" charset=\"utf-8\">
  $(document).ready(function(){
    $(\"{$this->selector}\").fancybox();
  });
</script>
";
	}

}
