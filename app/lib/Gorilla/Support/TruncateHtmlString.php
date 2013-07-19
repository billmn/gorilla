<?php namespace Gorilla\Support;

use DomDocument;
use Patchwork\Utf8;

/**
 * Truncate Html string without stripping tags
 * inspired from : https://gist.github.com/leon/2857883
 */
class TruncateHtmlString {

	public function __construct($string, $limit, $end = '')
	{
		// create dom element using the html string
		$this->tempDiv = new DomDocument();
		$this->tempDiv->loadXML('<div>'.$string.'</div>');

		// init Utf8 class
		Utf8\Bootup::initAll();

		// keep the characters count till now
		$this->charCount = 0;

		// character limit need to check
		$this->limit = $limit;

		// end string
		$this->end = $end;
	}

	public function cut()
	{
		// create empty document to store new html
		$this->newDiv = new DomDocument();

		// cut the string by parsing through each element
		$this->searchEnd($this->tempDiv->documentElement, $this->newDiv);
		$newhtml = $this->newDiv->saveHTML();
		return $newhtml;
	}

	public function deleteChildren($node)
	{
		while (isset($node->firstChild))
		{
			$this->deleteChildren($node->firstChild);
			$node->removeChild($node->firstChild);
		}
	}

	public function searchEnd($parseDiv, $newParent)
	{
		foreach($parseDiv->childNodes as $element)
		{
			// not text node
			if ($element->nodeType != 3)
			{
				$newElement = $this->newDiv->importNode($element, true);

				if (count($element->childNodes) === 0)
				{
					$newParent->appendChild($newElement);
					continue;
				}

				$this->deleteChildren($newElement);
				$newParent->appendChild($newElement);
				$res = $this->searchEnd($element, $newElement);

				if ($res)
					return $res;
				else
					continue;
			}


			// the limit of the char count reached
			if (Utf8::strlen($element->nodeValue) + $this->charCount >= $this->limit)
			{
				$newElement = $this->newDiv->importNode($element);
				$newElement->nodeValue = substr($newElement->nodeValue, 0, $this->limit - $this->charCount);
				$newElement->nodeValue .= $this->end;
				$newParent->appendChild($newElement);
				return true;
			}

			$newElement = $this->newDiv->importNode($element);
			$newParent->appendChild($newElement);
			$this->charCount += Utf8::strlen($newElement->nodeValue);
		}

		return false;
	}
}