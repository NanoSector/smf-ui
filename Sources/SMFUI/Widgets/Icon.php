<?php

/*
	SMFUI - Object-oriented UI framework for SMF

	Copyright (c) 2015 Rick Kerkhof

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in all
	copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
	SOFTWARE.
*/

namespace SMFUI\Widgets;

class Icon extends GenericWidget implements \SMFUI\Interfaces\IIconWidget
{
	/**
	 * The icon name.
	 * @var string
	 */
	private $icon = '';

	/**
	 * Alternative text
	 * @var string
	 */
	private $alt = '';

	public function __construct($icon)
	{
		$this->setIcon($icon);
		$this->templateWidget = new \SMFUI\IconWidget();
	}

	/**
	 * @see \SMFUI\Interfaces\IIconWidget
	 */
	public function setIcon($icon)
	{
		$this->icon = $icon;
	}

	/**
	 * @see \SMFUI\Interfaces\IIconWidget
	 */
	public function getIcon()
	{
		return $this->icon;
	}

	/**
	 * @see \SMFUI\Interfaces\IIconWidget
	 */
	public function setAlt($alt)
	{
		$this->alt = $alt;
	}

	/**
	 * @see \SMFUI\Interfaces\IIconWidget
	 */
	public function getAlt()
	{
		return $this->alt;
	}

	/**
	 * @see \SMFUI\Interfaces\IGenericWidget
	 */
	public function __toString()
	{
		$this->replacements = new \SMFUI\Replacements;
		$this->replacements->updateReplacement('%alt%', $this->getAlt());
		$this->replacements->updateReplacement('%iconpath%', $this->templateWidget->getIconPath($this->getIcon()));
		return parent::__toString();
	}
}
