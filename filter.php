<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * textsubstitute filter
 *
 * Documentation: {@link https://moodledev.io/docs/apis/plugintypes/filter}
 *
 * @package    filter_textsubstitute
 * @copyright  2024 Felipe Lima
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class filter_textsubstitute extends moodle_text_filter {

    /**
     * Filter text
     *
     * @param string $text some HTML content to process.
     * @param array $options options passed to the filters
     * @return string the HTML content after the filtering has been applied.
     */
    public function filter($text, array $options = []) {
        $config = get_config('filter_textsubstitute');
        $searchterm = $config->searchterm;
        $replacewith = $config->substituteterm;

        if (!isset($options['originalformat']) || empty($searchterm)) {
            return $text;
        }
        if (in_array($options['originalformat'], explode(',', get_config('filter_textsubstitute', 'formats')))) {
            return $this->substitute_term($text, $searchterm, $replacewith);
        }
        return $text;
    }

    /**
     * Summary of substitute_term
     * @param mixed $text
     * @param string $searchterm
     * @param string $replacewith
     * @return array|string
     */
    protected function substitute_term($text, string $searchterm, string $replacewith) {
        $text = str_replace($searchterm, $replacewith, $text);
        return $text;
    }
}
