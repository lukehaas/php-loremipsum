<?php

/**
 * Lorem Ipsum Generator
 *
 * PHP version 5.3+
 *
 * Licensed under The MIT License.
 * Redistribution of these files must retain the above copyright notice.
 *
 * @author    Josh Sherman <josh@gravityblvd.com>
 * @copyright Copyright 2014, 2015, 2016 Josh Sherman
 * @license   http://www.opensource.org/licenses/mit-license.html
 * @link      https://github.com/joshtronic/php-loremipsum
 */

namespace joshtronic;

class LoremIpsum
{
    /**
     * First
     *
     * Array of opening lorem ipsum words
     *
     * @access private
     * @var    array
     */
    private $first = array(
      'lorem',        'ipsum',       'dolor',        'sit',
      'amet',         'consectetur', 'adipiscing',   'elit'
    );

    /**
     * Words
     *
     * A lorem ipsum vocabulary of sorts. Not a complete list as I'm unsure if
     * a complete list exists and if so, where to get it.
     *
     * @access private
     * @var    array
     */
    public $words = array(
        'a',            'ac',          'accumsan',     'ad',
        'aenean',       'aliquam',     'aliquet',      'ante',
        'aptent',       'arcu',        'at',           'auctor',
        'augue',        'bibendum',    'blandit',      'class',
        'commodo',      'condimentum', 'congue',       'consequat',
        'conubia',      'convallis',   'cras',         'cubilia',
        'cum',          'curabitur',   'curae',        'cursus',
        'dapibus',      'diam',        'dictum',       'dictumst',
        'dignissim',    'dis',         'donec',        'dui',
        'duis',         'egestas',     'eget',         'eleifend',
        'elementum',    'enim',        'erat',         'eros',
        'est',          'et',          'etiam',        'eu',
        'euismod',      'facilisi',    'facilisis',    'fames',
        'faucibus',     'felis',       'fermentum',    'feugiat',
        'fringilla',    'fusce',       'gravida',      'habitant',
        'habitasse',    'hac',         'hendrerit',    'himenaeos',
        'iaculis',      'id',          'imperdiet',    'in',
        'inceptos',     'integer',     'interdum',     'justo',
        'lacinia',      'lacus',       'laoreet',      'lectus',
        'leo',          'libero',      'ligula',       'litora',
        'lobortis',     'luctus',      'maecenas',     'magna',
        'magnis',       'malesuada',   'massa',        'mattis',
        'mauris',       'metus',       'mi',           'molestie',
        'mollis',       'montes',      'morbi',        'mus',
        'nam',          'nascetur',    'natoque',      'nec',
        'neque',        'netus',       'nibh',         'nisi',
        'nisl',         'non',         'nostra',       'nulla',
        'nullam',       'nunc',        'odio',         'orci',
        'ornare',       'parturient',  'pellentesque', 'penatibus',
        'per',          'pharetra',    'phasellus',    'placerat',
        'platea',       'porta',       'porttitor',    'posuere',
        'potenti',      'praesent',    'pretium',      'primis',
        'proin',        'pulvinar',    'purus',        'quam',
        'quis',         'quisque',     'rhoncus',      'ridiculus',
        'risus',        'rutrum',      'sagittis',     'sapien',
        'scelerisque',  'sed',         'sem',          'semper',
        'senectus',     'sociis',      'sociosqu',     'sodales',
        'sollicitudin', 'suscipit',    'suspendisse',  'taciti',
        'tellus',       'tempor',      'tempus',       'tincidunt',
        'torquent',     'tortor',      'tristique',    'turpis',
        'ullamcorper',  'ultrices',    'ultricies',    'urna',
        'ut',           'varius',      'vehicula',     'vel',
        'velit',        'venenatis',   'vestibulum',   'vitae',
        'vivamus',      'viverra',     'volutpat',     'vulputate',
    );

    /**
     * Word
     *
     * Generates a single word of lorem ipsum.
     *
     * @access public
     * @param  mixed  $tags string or array of HTML tags to wrap output with
     * @return string generated lorem ipsum word
     */
    public function word($tags = false)
    {
        return $this->words(1, $tags);
    }

    /**
     * Words Array
     *
     * Generates an array of lorem ipsum words.
     *
     * @access public
     * @param  integer $count how many words to generate
     * @param  mixed   $tags string or array of HTML tags to wrap output with
     * @return array   generated lorem ipsum words
     */
    public function wordsArray($count = 1, $tags = false, $swl = true)
    {
        return $this->words($count, $tags, true, $swl);
    }

    /**
     * Words
     *
     * Generates words of lorem ipsum.
     *
     * @access public
     * @param  integer $count how many words to generate
     * @param  mixed   $tags string or array of HTML tags to wrap output with
     * @param  boolean $array whether an array or a string should be returned
     * @return mixed   string or array of generated lorem ipsum words
     */
    public function words($count = 1, $tags = false, $array = false, $swl = true)
    {
        $words      = array();
        $word_count = 0;

        // Shuffles and appends the word list to compensate for count
        // arguments that exceed the size of our vocabulary list
        while ($word_count < $count) {
            $shuffle = true;

            while ($shuffle) {
                shuffle($this->words);

                // Checks that the last word of the list and the first word of
                // the list that's about to be appended are not the same
                if (!$word_count || $words[$word_count - 1] != $this->words[0]) {
                    $words      = array_merge($words, $this->words);
                    $word_count = count($words);
                    $shuffle    = false;
                }
            }
        }
        if($swl) {
          $words = array_merge($this->first, $words);
        }

        $words = array_slice($words, 0, $count);

        if(!$array) {
          $words = implode(" ",$this->sentencise($words));
          $words = explode(" ",$words);
        }

        return $this->output($words, $tags, $array);
    }

    /**
     * Sentence
     *
     * Generates a full sentence of lorem ipsum.
     *
     * @access public
     * @param  mixed  $tags string or array of HTML tags to wrap output with
     * @return string generated lorem ipsum sentence
     */
    public function sentence($tags = false)
    {
        return $this->sentences(1, $tags);
    }

    /**
     * Sentences Array
     *
     * Generates an array of lorem ipsum sentences.
     *
     * @access public
     * @param  integer $count how many sentences to generate
     * @param  mixed   $tags string or array of HTML tags to wrap output with
     * @return array   generated lorem ipsum sentences
     */
    public function sentencesArray($count = 1, $tags = false, $swl = true)
    {
        return $this->sentences($count, $tags, true, $swl);
    }

    /**
     * Sentences
     *
     * Generates sentences of lorem ipsum.
     *
     * @access public
     * @param  integer $count how many sentences to generate
     * @param  mixed   $tags string or array of HTML tags to wrap output with
     * @param  boolean $array whether an array or a string should be returned
     * @return mixed   string or array of generated lorem ipsum sentences
     */
    public function sentences($count = 1, $tags = false, $array = false, $swl = true)
    {
        $sentences = array();

        for ($i = 0; $i < $count; $i++) {
            $sentences[] = $this->wordsArray($this->gauss(24.46, 5.08),false,$swl);
            $swl = false;
        }

        $this->punctuate($sentences);

        return $this->output($sentences, $tags, $array);
    }

    /**
     * Paragraph
     *
     * Generates a full paragraph of lorem ipsum.
     *
     * @access public
     * @param  mixed  $tags string or array of HTML tags to wrap output with
     * @return string generated lorem ipsum paragraph
     */
    public function paragraph($tags = false)
    {
        return $this->paragraphs(1, $tags);
    }

    /**
     * Paragraph Array
     *
     * Generates an array of lorem ipsum paragraphs.
     *
     * @access public
     * @param  integer $count how many paragraphs to generate
     * @param  mixed   $tags string or array of HTML tags to wrap output with
     * @return array   generated lorem ipsum paragraphs
     */
    public function paragraphsArray($count = 1, $tags = false, $swl = true)
    {
        return $this->paragraphs($count, $tags, true, $swl);
    }

    /**
     * Paragraphss
     *
     * Generates paragraphs of lorem ipsum.
     *
     * @access public
     * @param  integer $count how many paragraphs to generate
     * @param  mixed   $tags string or array of HTML tags to wrap output with
     * @param  boolean $array whether an array or a string should be returned
     * @return mixed   string or array of generated lorem ipsum paragraphs
     */
    public function paragraphs($count = 1, $tags = false, $array = false, $swl = true)
    {
        $paragraphs = array();

        for ($i = 0; $i < $count; $i++) {
            $paragraphs[] = $this->sentences($this->gauss(5.8, 1.93),false,false,$swl);
            $swl = false;
        }

        return $this->output($paragraphs, $tags, $array, "\n\n");
    }
    /**
     * List
     *
     * Generates a list item of lorem ipsum.
     *
     * @access public
     * @param  mixed  $tags string or array of HTML tags to wrap output with
     * @return string generated lorem ipsum list
     */
    public function list_($tags = false)
    {
      return $this->lists(1, $tags);
    }
    /**
     * List Array
     *
     * Generates an array of lorem ipsum list items.
     *
     * @access public
     * @param  integer $count how many list items to generate
     * @param  mixed   $tags string or array of HTML tags to wrap output with
     * @return array   generated lorem ipsum lists
     */
    public function listArray($count = 1, $tags = false, $swl = true) {
      return $this->lists($count, $tags, true, $swl);
    }
    /**
     * Lists
     *
     * Generates lists of lorem ipsum.
     *
     * @access public
     * @param  integer $count how many list itesm to generate
     * @param  mixed   $tags string or array of HTML tags to wrap output with
     * @param  boolean $array whether an array or a string should be returned
     * @return mixed   string or array of generated lorem ipsum list items
     */
    public function lists($count = 1, $tags = false, $array = false, $swl = true) {

      $lists = array();

      for ($i = 0; $i < $count; $i++) {
          $lists[] = $this->wordsArray($this->gauss(9.3, 1.24), false, $swl);
          $swl = false;
      }

      $this->punctuate($lists);

      return $this->output($lists, $tags, $array, "\n\n");
    }
    /**
     * Byte
     *
     * Generates a byte lorem ipsum.
     *
     * @access public
     * @param  mixed  $tags string or array of HTML tags to wrap output with
     * @return string generated lorem ipsum byte
     */
    public function byte($tags = false) {
      return $this->bytes(1, $tags);
    }
    /**
     * Byte Array
     *
     * Generates an array of lorem ipsum bytes.
     *
     * @access public
     * @param  integer $count how many bytes to generate
     * @param  mixed   $tags string or array of HTML tags to wrap output with
     * @return array   generated lorem ipsum bytes
     */
    public function byteArray($count = 1, $tags = false, $swl = true) {
      return $this->bytes($count, $tags, true, $swl);
    }
    /**
     * Bytes
     *
     * Generates bytes of lorem ipsum.
     *
     * @access public
     * @param  integer $count how many bytes to generate
     * @param  mixed   $tags string or array of HTML tags to wrap output with
     * @param  boolean $array whether an array or a string should be returned
     * @return mixed   string or array of generated lorem ipsum bytes
     */
    public function bytes($count = 1, $tags = false, $array = false, $swl = true) {
      $bytes = array();
      $letterCount = 0;
      $byteString = "";
      $secondLastElem = "";
      $lastElem = "";

      while($letterCount<$count) {
        $bytes[] = $this->sentences(1,false,false,$swl);
        $swl = false;
        $letterCount += strlen($bytes[count($bytes)-1]);
      }
      $byteString = implode(" ",$bytes);
      if(strlen($byteString)>$count) {
        $byteString = substr($byteString,0,$count);
        if(substr($byteString,-1)==" ") {
          $byteString = substr($byteString,0,-1) . "s";
        }

        $bytes = explode(" ",$byteString);

        $lastElem = $bytes[count($bytes)-1];

        if($bytes[count($bytes)-2]) {
          $secondLastElem = $bytes[count($bytes)-2];
          if(strlen($lastElem)<3 && strlen($secondLastElem)<10) {
            $lastElem = $this->wordOfLength(strlen($lastElem) + strlen($secondLastElem));
            array_pop($bytes);
          }
        }

        if(substr($lastElem,-1)!="." && strlen($byteString)>2) {
          $lastElem = substr($lastElem,0,-1) . ".";
        }
        $bytes[count($bytes)-1] = $lastElem;
      }

      return $this->output($bytes,$tags,$array);

    }
    /**
    * wordOfLength
    *
    * Private function to return a word of particular length
    */
    private function wordOfLength($count = 1) {
      $pos = mt_rand(0,count($this->words)-1);
  		$word = "";
  		$i = 0;
  		if($count===1) {
  			return "a";
  		}
  		if($count>0) {
  			while(strlen($word)!==$count) {

  				$word = $this->words[$pos];

  				$pos++;
  				if($pos>count($this->words)-1) {
  					$pos = 0;
  					$i++;
  					if($i>1) {
  						$count -= 1;
  					}
  				}
  			}
  		}


  		return $word;
    }

    /**
     * Gaussian Distribution
     *
     * This is some smart kid stuff. I went ahead and combined the N(0,1) logic
     * with the N(m,s) logic into this single function. Used to calculate the
     * number of words in a sentence, the number of sentences in a paragraph
     * and the distribution of commas in a sentence.
     *
     * @access private
     * @param  double  $mean average value
     * @param  double  $std_dev stadnard deviation
     * @return double  calculated distribution
     */
    private function gauss($mean, $std_dev)
    {
        $x = mt_rand() / mt_getrandmax();
        $y = mt_rand() / mt_getrandmax();
        $z = sqrt(-2 * log($x)) * cos(2 * pi() * $y);

        return $z * $std_dev + $mean;
    }
    /**
     * Sentencise
     *
     *
     * @access private
     * @param  array   $words to be arranged into sentences
     */
    private function sentencise($words = array()) {
      $end = min(round($this->gauss(24.46, 5.08)),count($words));
      $begin = 0;
      $count = 0;
      $sentences = array();

      if(count($words)<1) {
        return array();
      }

      $words[0] = ucfirst($words[0]);

      while($begin<count($words)) {
        if((count($words)-($begin+$end))<6) {
          $end = count($words)-$begin;
        }

        $sentences[] = array_slice($words,$begin,$end);

        $begin += $end;
        $end = min(round($this->gauss(24.46, 5.08)),count($words)-$begin);

      }

      $this->punctuate($sentences);

      return $sentences;

    }

    /**
     * Punctuate
     *
     * Applies punctuation to a sentence. This includes a period at the end,
     * the injection of commas as well as capitalizing the first letter of the
     * first word of the sentence.
     *
     * @access private
     * @param  array   $sentences the sentences we would like to punctuate
     */
    private function punctuate(&$sentences)
    {
        foreach ($sentences as $key => $sentence) {
            $words = count($sentence);
            // Only worry about commas on sentences longer than 4 words
            if ($words > 4) {
                $mean    = log($words, 6);
                $std_dev = $mean / 6;
                $commas  = round($this->gauss($mean, $std_dev));
                for ($i = 1; $i <= $commas; $i++) {
                    $word = round($i * $words / ($commas + 1));
                    if ($word < ($words - 1) && $word > 0) {
                        $sentence[$word] .= ',';
                    }
                }
            }
            $sentences[$key] = ucfirst(implode(' ', $sentence) . '.');
        }
    }

    /**
     * Output
     *
     * Does the rest of the processing of the strings. This includes wrapping
     * the strings in HTML tags, handling transformations with the ability of
     * back referencing and determining if the passed array should be converted
     * into a string or not.
     *
     * @access private
     * @param  array   $strings an array of generated strings
     * @param  mixed   $tags string or array of HTML tags to wrap output with
     * @param  boolean $array whether an array or a string should be returned
     * @param  string  $delimiter the string to use when calling implode()
     * @return mixed   string or array of generated lorem ipsum text
     */
    private function output($strings, $tags, $array, $delimiter = ' ')
    {
        if ($tags) {
            if (!is_array($tags)) {
                $tags = array($tags);
            } else {
                // Flips the array so we can work from the inside out
                $tags = array_reverse($tags);
            }

            foreach ($strings as $key => $string) {
                foreach ($tags as $tag) {
                    // Detects / applies back reference
                    if ($tag[0] == '<') {
                        $string = str_replace('$1', $string, $tag);
                    } else {
                        $string = sprintf('<%1$s>%2$s</%1$s>', $tag, $string);
                    }

                    $strings[$key] = $string;
                }
            }
        }

        if (!$array) {
            $strings = implode($delimiter, $strings);
        }

        return $strings;
    }
}
