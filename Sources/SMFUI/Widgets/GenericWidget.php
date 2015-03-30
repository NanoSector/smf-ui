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

abstract class GenericWidget implements \SMFUI\Interfaces\IGenericWidget
{
	/**
	 * The contents of the widget.
	 * @var string
	 */
	protected $contents = '';

	/**
	 * Instance of the template-side widget.
	 * @var object
	 */
	protected $templateWidget;

	/**
	 * ID of the widget, if available.
	 * @var string
	 */
	protected $id = '';

	/**
	 * Widgets to insert.
	 * @var array
	 */
	protected $children = array();

	/**
	 * Custom classes.
	 * @var string[]
	 */
	protected $classes = array();

	/**
	 * HTML parameters.
	 * @var array
	 */
	protected $params = array();

	/**
	 * Replacements class.
	 * @var \SMFUI\Replacements
	 */
	protected $replacements;

	/**
	 * @see \SMFUI\Interfaces\IGenericWidget
	 */
	public function __toString()
	{
		if (!($this->replacements instanceof \SMFUI\Replacements))
				$this->replacements = new \SMFUI\Replacements;

		$this->replacements->updateReplacement('%id%', !empty($this->id) ? 'id="' . $this->getID() . '"' : '');
		$this->replacements->updateReplacement('%add_classes%', implode(' ', $this->getAdditionalClasses()));

		return $this->replacements->doReplacements($this->templateWidget->getHTML());
	}

	/**
	 * @see \SMFUI\Interfaces\IGenericWidget
	 */
	public function setID($id)
	{
		$this->id = $id;
	}

	/**
	 * @see \SMFUI\Interfaces\IGenericWidget
	 */
	public function getID()
	{
		return $this->id;
	}

	/**
	 * @see \SMFUI\Interfaces\IGenericWidget
	 */
	public function setAdditionalClasses($classes)
	{
		$this->classes = explode(' ', $classes);
	}

	/**
	 * @see \SMFUI\Interfaces\IGenericWidget
	 */
	public function getAdditionalClasses()
	{
		return $this->classes;
	}
}
