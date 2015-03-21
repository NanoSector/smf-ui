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
	 * The icon database for any non-matching icons.
	 * @var array
	 */
	private $iconDb = array(
		'buddy_off' => 'buddy_useroff.gif',
		'buddy_on' => 'buddy_useron.gif',
		'female' => 'Female.gif',
		'help' => 'helptopics.gif',
		'newmsg' => 'im_sm_newmsg.gif',
		'prefs' => 'im_sm_prefs.gif',
		'male' => 'Male.gif',
		'msg' => 'message_sm.gif',
		'msn' => 'msntalk.gif',
		'delete' => 'pm_recipient_delete.gif',
		'off' => 'useroff.gif',
		'on' => 'useron.gif',
	);

	public function getHTML()
	{
		return '
		<img class="icon %add_classes%" src="%iconpath%" alt="%alt%" %id% />';
	}

	public function checkIcon($icon)
	{
		global $settings;
		return array_key_exists($icon, $this->iconDb) || file_exists($settings['theme_dir'].'/images/'.$icon.'.gif');
	}

	public function getIconPath($icon)
	{
		global $settings;
		return ($settings['images_url'].'/'.(!empty($this->iconDb[$icon]) ? $this->iconDb[$icon] : $icon.'.gif'));
	}
}
