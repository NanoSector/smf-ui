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

class ButtonListButton extends GenericWidget
{
	protected $text = '';
	protected $url = '';
	public function __construct($contents = '', $url = '')
	{
		$this->templateWidget = new \SMFUI\ButtonListButtonWidget();
		$this->setText($contents);
		$this->setURL($url);
	}

	public function __toString()
	{
		
		$replacements = array(
			'%id%' => !empty($this->id) ? 'id="'.$this->getID().'"' : '',
			'%add_classes%' => implode(' ', $this->getAdditionalClasses()),
			'%text%' => $this->getText(),
			'%url%' => $this->getURL(),
		);
		return $this->templateWidget->assemble($replacements);
	}

	public function setText($text)
	{
		$this->text = htmlspecialchars($text);
	}

	public function getText()
	{
		return $this->text;
	}
	
	public function setURL($url)
	{
		$this->url = $url;
	}
	
	public function getURL()
	{
		return $this->url;
	}
}
