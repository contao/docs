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
    private const CELL_MARKER = '{{cell}}';

    private $alignments = [];

    /**
     * @return string
     */
    public function convert(ElementInterface $element)
    {
        switch ($element->getTagName()) {
            case 'tr':
                $line = [];

                foreach ($element->getChildren() as $td) {
                    $value = trim($td->getValue());

                    if ('' === $value) {
                        continue;
                    }

                    // Add value without the cell marker
                    $line[] = str_replace(self::CELL_MARKER, '', $value);
                
                }

                return '| ' . implode(' | ', $line) . " |\n";

            case 'td':
            case 'th':
                // Save the text alignment
                if (preg_match('/text-align:([^;]+)/', $element->getAttribute('style'), $matches)) {
                    $this->alignments[(int) $element->getSiblingPosition() - 1] = trim($matches[1]);
                }

                // "Mark" the table cell to identify valid empty cells
                return self::CELL_MARKER.trim($element->getValue());

            case 'tbody':
                return $this->getTrimmedValue($element);

            case 'thead':
                $value = $this->getTrimmedValue($element);
                $headers = array_map('trim', explode('|', trim($value, '|')));
                $separators = [];

                // Create the thead separator
                foreach ($headers as $pos => $header) {
                    switch ($this->alignments[$pos] ?? 'left') {
                        case 'right': 
                            $separator = str_repeat('-', max(mb_strlen($header), 3) - 1);
                            $separators[] = $separator.':';
                            break;
                        case 'center': 
                            $separator = str_repeat('-', max(mb_strlen($header), 3) - 2);
                            $separators[] = ':'.$separator.':';
                            break;
                        default:
                            $separator = str_repeat('-', max(mb_strlen($header), 3));
                            $separators[] = $separator;
                    }
                }

                $separator = '| '.implode(' | ', $separators).' |';

                return $value."\n".$separator."\n";
            case 'table':
                return $this->getTrimmedValue($element) . "\n\n";
        }

        return $element->getValue();
    }

    /**
     * @return array<string>
     */
    public function getSupportedTags()
    {
        return ['table', 'tr', 'thead', 'th', 'td', 'tbody'];
    }

    /**
     * Returns the individually trimmed values of all of the element's children
     * and disregards empty children.
     */
    private function getTrimmedValue(ElementInterface $element): string
    {
        return trim(implode("\n", array_filter(array_map(function($e) {
            return trim($e->getValue());
        }, $element->getChildren()))));
    }
}
