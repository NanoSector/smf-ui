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

use \SMFUI\Exceptions;

class Replacements
{
		protected $replacements = array();

		/**
		 * Add a replacement handler.
		 * @param string $find The data to find.
		 * @param string $replace The data to replace with.
		 * @throws \SMFUI\Exceptions\ReplacementExistsException when the replacement already exists.
		 */
		public function addReplacement($find, $replace)
		{
				if ($this->replacementExists($find))
						throw new Exceptions\ReplacementExistsException();

				// Add it.
				$this->replacements[$find] = $replace;
		}

		/**
		 * Update a replacement and add it if it does not exist yet.
		 * @param string $find The data to find.
		 * @param string $replace The data to replace it with.
		 */
		public function updateReplacement($find, $replace)
		{
				if (!$this->replacementExists($find))
				{
						$this->addReplacement($find, $replace);
						return;
				}

				$this->replacements[$find] = $replace;
		}

		/**
		 * Check if a replacement exists.
		 * @param string $key The key to find.
		 * @return boolean
		 */
		public function replacementExists($key)
		{
				return array_key_exists($key, $this->replacements);
		}

		/**
		 * Perform the actual replacements.
		 * @param string $subject the subject to perform surgery on.
		 * @return string
		 */
		public function doReplacements($subject)
		{
				return str_replace(array_keys($this->replacements), array_values($this->replacements), $subject);
		}
}
