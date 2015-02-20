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

namespace SMFUI\Interfaces;

interface IContentsWidget extends IGenericWidget
{
	/**
	 * Set the contents of the widget, using HTML code.
	 * @param string $html The HTML code to set the contents to.
	 * @return void
	 */
	public function setContents($html);

	/**
	 * Returns the current contents of the widget.
	 * @return string
	 */
	public function getContents();

	/**
	 * Adds a child widget, before the other widget.
	 * @param object $newWidget The widget to insert.
	 * @param object $existingWidget The existing widget to insert before.
	 * @return boolean
	 */
	public function insertChildBefore($newWidget, $existingWidget);

	/**
	 * Adds a child widget at the end of the child list.
	 * @param object $widget The widget to insert.
	 * @return void
	 */
	public function insertChild($widget);

	/**
	 * Returns a child from the children array.
	 * @param int $index The child index.
	 * @return boolean|object
	 */
	public function getChild($index);

	/**
	 * Searches the children and returns the index of the matching child, or false on failure.
	 * @param object $widget The child widget to search for.
	 * @return boolean|int
	 */
	public function searchChild($widget);

	/**
	 * Assembles any children this parent has.
	 * @return void
	 */
	public function assembleChildren();
}
