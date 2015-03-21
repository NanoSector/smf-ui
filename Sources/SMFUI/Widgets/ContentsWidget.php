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

use \SMFUI\Exceptions;
use \SMFUI\Interfaces;

abstract class ContentsWidget extends GenericWidget implements \SMFUI\Interfaces\IContentsWidget
{
	/**
	 * The contents of the widget.
	 * @var string
	 */
	protected $contents = '';

	/**
	 * The children of the widget.
	 * @var array
	 */
	protected $children;

	/**
	 * @see \SMFUI\Interfaces\IGenericWidget
	 */
	public function __toString()
	{
		$this->assembleChildren();
		$replacements = array(
			'%contents%' => $this->getContents(),
			'%id%' => !empty($this->id) ? 'id="'.$this->getID().'"' : '',
			'%add_classes%' => implode(' ', $this->getAdditionalClasses()),
		);
		return $this->templateWidget->assemble($replacements);
	}

	/**
	 * @see \SMFUI\Interfaces\IContentsWidget
	 */
	public function setContents($html)
	{
		$this->contents = $html;
	}

	/**
	 * @see \SMFUI\Interfaces\IContentsWidget
	 */
	public function getContents()
	{
		return $this->contents;
	}

	/**
	 * @see \SMFUI\Interfaces\IContentsWidget
	 */
	public function canContain($widget)
	{
		// We can't put a block widget into a non-block widget.
		return !($widget instanceof Interfaces\IBlock && !($this instanceof Interfaces\IBlock));
	}

	/**
	 * @see \SMFUI\Interfaces\IContentsWidget
	 */
	public function insertChildBefore($newWidget, $existingWidget)
	{
		// Try to find the existing widget.
		if (($existingIndex = $this->searchChild($existingWidget)) === false || !is_object($newWidget))
			throw new Exceptions\InvalidWidgetException('The widget you are searching for does not exist or the widget you are inserting is not a valid object.');

		// Can we actually contain a widget?
		if (!$this->canContain($newWidget))
			throw new Exceptions\InvalidWidgetException('Can not put a widget of type '.get_class($newWidget).' in a widget of type '.get_class($this));

		// Insert it.
		array_splice($this->children, $existingIndex, 0, array($newWidget));
	}

	/**
	 * @see \SMFUI\Interfaces\IContentsWidget
	 */
	public function insertChild($widget)
	{
		if (!$this->canContain($widget))
			throw new Exceptions\InvalidWidgetException('Can not put a widget of type '.get_class($widget).' in a widget of type '.get_class($this));

		$this->children[] = $widget;
	}

	/**
	 * @see \SMFUI\Interfaces\IContentsWidget
	 */
	public function getChild($index)
	{
		return (array_key_exists($index, $this->children) ? $this->children[$index] : false);
	}

	/**
	 * @see \SMFUI\Interfaces\IContentsWidget
	 */
	public function searchChild($widget)
	{
		if (!is_object($widget))
			return false;

		foreach ($this->children as $index => $child)
		{
			if ($child == $widget)
				return (int) $index;
		}
		return false;
	}

	/**
	 * @see \SMFUI\Interfaces\IContentsWidget
	 */
	public function assembleChildren()
	{
		// Start off empty.
		$this->contents = '';

		// No children? Bummer.
		if (empty($this->children))
			return;

		foreach ($this->children as $widget)
			$this->contents .= $widget->__toString();
	}
}
