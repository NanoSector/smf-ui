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
use SMFUI\Interfaces;
use SMFUI\Exceptions;

abstract class RestrictedWidget extends ContentsWidget implements \SMFUI\Interfaces\IRestrictedWidget
{
	/**
	 * All allowed child widget types. Required if $deniedChildWidgets is empty.
	 * @var string[]
	 */
	protected $allowedChildWidgets = array();

	/**
	 * All denied child widget types. Required if $allowedChildWidgets is empty.
	 * @var string[]
	 */
	protected $deniedChildWidgets = array();

	/**
	 * Checks if the allowed/denied lists are valid.
	 */
	public function __construct()
	{
		if (empty($this->allowedChildWidgets) && empty($this->deniedChildWidgets))
			throw new Exceptions\InvalidRestrictionsException();

		$this->construct();
	}

	/**
	 * @see \SMFUI\Interfaces\IRestrictedWidget
	 */
	abstract public function construct($contents = '');

	/**
	 * Checks if the widget complies to our filters.
	 * @param object $widget the widget to check.
	 */
	public function canContain($widget)
	{
		// Is it in the array of allowed children?
		if ($this->isWidgetBlacklisted($widget) || !$this->isWidgetWhitelisted($widget))
			return false;

		return parent::canContain($widget);
	}
	
	/**
	 * Checks if the widget is blacklisted.
	 * @param object $widget The widget to check.
	 * @return boolean
	 */
	public function isWidgetBlacklisted($widget)
	{
		// No blacklist, then we're done.
		if (empty($this->deniedChildWidgets))
			return false;
		
		return in_array(get_class($widget), $this->deniedChildWidgets);
	}
	
	/**
	 * Checks if the widget is whitelisted.
	 * @param object $widget The widget to check.
	 * @return boolean
	 */
	public function isWidgetWhitelisted($widget)
	{
		// No whitelist, then we're done.
		if (empty($this->allowedChildWidgets))
			return true;
		
		return in_array(get_class($widget), $this->allowedChildWidgets);
	}
}
