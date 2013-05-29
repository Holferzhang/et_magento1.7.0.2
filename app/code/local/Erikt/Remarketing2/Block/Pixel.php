<?php

class Erikt_Remarketing2_Block_Pixel extends Mage_Core_Block_Template
{
	/**
	 * Constructor. Set template.
	 */
	protected function _construct()
	{
		parent::_construct();
	}

	protected function _toHtml()
	{
		echo '[[' . $this->getNameInLayout() . ']]';

		if (!$this->getTemplate()) {
			return '';
		}
		$html = $this->renderView();
		return $html;
	}
}