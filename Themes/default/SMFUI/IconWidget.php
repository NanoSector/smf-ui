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

namespace SMFUI;

class IconWidget extends \SMFUI\Widgets\IconTemplateWidget
{
	/**
	 * The icon database.
	 * @var array
	 */
	private $iconDb = array(
		// 'icon name' => 'path relative to images URL'
		'collapse' => 'collapse.gif',
		'expand' => 'expand.gif',
		'help' => 'helptopics.gif',
	);

	public function getHTML()
	{
		return '
		<img class="icon %add_classes%" src="%iconpath%" alt="%alt%" />';
	}

	public function checkIcon($icon)
	{
		return array_key_exists($icon, $this->iconDb);
	}

	public function getIconPath($icon)
	{
		global $settings;

		return ($settings['images_url'] . '/' . $this->iconDb[$icon]);
	}
}
