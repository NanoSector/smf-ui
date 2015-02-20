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

class Autoloader
{
	/**
	 * Load the class specified.
	 * @param string $class The class name.
	 * @return bool
	 */
	static public function load($class)
	{
		global $sourcedir, $settings;

		// Split $class to the "path" and "classname" parts
		$class = explode('\\', $class);
		$classpath = $class;
		array_pop($classpath);
		$classname = end($class) . '.php';

		// Assemble path
		$classpath = implode('/', $classpath) . '/';

		$paths = array(
			$sourcedir .  '/' . $classpath . $classname,
			$settings['actual_theme_dir'] . '/' . $classpath . $classname,
		);

		foreach ($paths as $path)
		{
			if(file_exists($path))
			{
				require $path;
				return true;
			}
		}

		return false;
	}
}
