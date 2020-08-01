<?php

declare(strict_types=1);

/*
 * Contao Docs DeepL Translator
 *
 * @author     Fritz Michael Gschwantner <fmg@inspiredminds.at>
 * @license    MIT
 */

namespace Contao\Docs\DeeplTranslator;

use League\HTMLToMarkdown\Converter\ConverterInterface;
use League\HTMLToMarkdown\ElementInterface;

/**
 * Table converter for League\HTMLToMarkdown\HtmlConverter
 * 
 * @see https://github.com/Mark-H/Docs/blob/2.x/convert/util/TableConverter.php
 */
class TableConverter implements ConverterInterface
{
    private $alignments = [];

    /**
     * @param ElementInterface $element
     *
     * @return string
     */
    public function convert(ElementInterface $element)
    {
        switch ($element->getTagName()) {
            case 'tr':
                $line = [];
                $i = 1;
                foreach ($element->getChildren() as $td) {
                    $i++;
                    $v = $td->getValue();
                    $v = trim($v);
                    if ($v !== '') {
                        $line[] = $v;
                    }
                }
                return '| ' . implode(' | ', $line) . " |\n";

            case 'td':
            case 'th':               
                if (preg_match('/text-align:([^;]+)/', $element->getAttribute('style'), $matches)) {
                    $this->alignments[(int) $element->getSiblingPosition()] = trim($matches[1]);
                }

                return preg_replace("#\n+#", '\n', trim($element->getValue()));

            case 'tbody':
                return trim($element->getValue());

            case 'thead':
                $headerLine = '';

                foreach ($element->getChildren() as $child) {
                    $headerLine .= trim($child->getValue());
                }

                if (empty($headerLine)) {
                    return '';
                }

                $headers = array_filter(array_map('trim', explode('|', $headerLine)));

                $headerSeparators = [];

                foreach ($headers as $pos => $header) {
                    switch ($this->alignments[$pos]) {
                        case 'right': 
                            $separator = str_repeat('-', max(mb_strlen($header), 3) - 1);
                            $headerSeparators[] = $separator.':';
                            break;
                        case 'center': 
                            $separator = str_repeat('-', max(mb_strlen($header), 3) - 2);
                            $headerSeparators[] = ':'.$separator.':';
                            break;
                        default:
                            $separator = str_repeat('-', max(mb_strlen($header), 3));
                            $headerSeparators[] = $separator;
                    }
                }

                $headerSeparator = '| '.implode(' | ', $headerSeparators).' |';
                
                return $headerLine."\n".$headerSeparator."\n";
            case 'table':
                $inner = $element->getValue();
                if (strpos($inner, '-----') === false) {
                    $inner = explode("\n", $inner);
                    $single = explode(' | ', trim($inner[0], '|'));
                    $hr = [];
                    foreach ($single as $td) {
                        $length = strlen(trim($td)) + 2;
                        $hr[] = str_repeat('-', $length > 3 ? $length : 3);
                    }
                    $hr = '|' . implode('|', $hr) . '|';
                    array_splice($inner, 1, 0, $hr);
                    $inner = implode("\n", $inner);
                }
                return trim($inner) . "\n\n";
        }

        return $element->getValue();
    }

    /**
     * @return string[]
     */
    public function getSupportedTags()
    {
        return array('table', 'tr', 'thead', 'th', 'td', 'tbody');
    }
}
