<?php
require_once APP . 'Vendor/phpinsight/lib/PHPInsight/Sentiment.php';
App::uses('Component', 'Controller');

class RatingComponent extends Component {

    public $negPrefixList = [
        'aren\'t',
        'isn\'t',
        'not'
    ];

    public function updateRating($id = null) {

        $commentModel = ClassRegistry::init('Comment');
        $productModel = ClassRegistry::init('Product');
        $keywordsModel = ClassRegistry::init('Keyword');

        $comments = $commentModel->find('list',[
            'conditions' => ['product_id' => $id, 'deleted' => 0],
            'fields' => ['content']
        ]);

        $keywords = $keywordsModel->find('list', ['fields' => ['word','point']]);

        $total_points = 0;
        $total_keywords = 0;

        foreach ($comments as $comment) {
            //For each negative prefix in the list
            foreach ($this->negPrefixList as $negPrefix) {

                //Search if that prefix is in the document
                if (strpos($comment, $negPrefix) !== false) {
                    //Reove the white space after the negative prefix
                    $comment = str_replace($negPrefix . ' ', $negPrefix, $comment);
                }
            }

            $tokens = $this->_getTokens($comment);

            foreach ($tokens as $token) {
                if (isset($keywords[$token])) {
                    $total_points += $keywords[$token];
                    $total_keywords++;
                }
            }
        }

        if ($total_keywords != 0) {
            $total_points = $total_points/$total_keywords;
        }
        
        $productModel->id = $id;
        $productModel->saveField('rating' , $total_points);

    }

    public function getDataPoints() {
        $commentModel = ClassRegistry::init('Comment');
        $keywordsModel = ClassRegistry::init('Keyword');

        $comments = $commentModel->find('list', [
            'conditions' => ['deleted' => 0],
            'fields' => ['content']
        ]);

        if ($comments) {
            $keywords = $keywordsModel->find('list', ['fields' => ['word','point']]);

            $total_pos = 0;
            $total_neu = 0;
            $total_neg = 0;
            $total_comments = count($comments);

            $maxNeg = Configure::read('NEG_MAX');
            $minPos = Configure::read('POS_MIN');


            foreach ($comments as $comment) {

                //For each negative prefix in the list
                foreach ($this->negPrefixList as $negPrefix) {

                    //Search if that prefix is in the document
                    if (strpos($comment, $negPrefix) !== false) {
                        //Reove the white space after the negative prefix
                        $comment = str_replace($negPrefix . ' ', $negPrefix, $comment);
                    }
                }

                $total_points = 0;
                $total_keywords = 0;
                $tokens = $this->_getTokens($comment);

                foreach ($tokens as $token) {
                    if (isset($keywords[$token])) {
                        $total_points += $keywords[$token];
                        $total_keywords++;
                    }
                }

                if ($total_keywords != 0) {
                    $total_points = $total_points/$total_keywords;
                }

                if ($total_points <= $maxNeg) {
                    $total_neg++;
                } else if ($total_points >= $minPos) {
                    $total_pos++;
                } else {
                    $total_neu++;
                }
            }

            $dataPoints = [ 
                ["label"=>"Neutral Comments", "y"=>($total_neu/$total_comments)*100],
                ["label"=>"Positive Comments", "y"=>($total_pos/$total_comments)*100],
                ["label"=>"Negative Comments", "y"=>($total_neg/$total_comments)*100]
                
            ];
        } else {
            $dataPoints = [ 
                ["label"=>"Neutral Comments", "y"=>0],
                ["label"=>"Positive Comments", "y"=>0],
                ["label"=>"Negative Comments", "y"=>0]
                
            ];
        }

        return $dataPoints;
    }

    /**
     * Break text into tokens
     *
     * @param str $string   String being broken up
     * @return array An array of tokens
     */
    private function _getTokens($string) {

        // Replace line endings with spaces
        $string = str_replace("\r\n", " ", $string);

        //Clean the string so is free from accents
        $string = $this->_cleanString($string);

        //Make all texts lowercase as the database of words in in lowercase
        $string = strtolower($string);

        //Break string into individual words using explode putting them into an array
        $matches = explode(" ", $string);

        //Return array with each individual token
        return $matches;
    }

    /**
     * Function to clean a string so all characters with accents are turned into ASCII characters. EG: ‡ = a
     * 
     * @param str $string
     * @return str
     */
    private function _cleanString($string) {

        $diac =
                /* A */ chr(192) . chr(193) . chr(194) . chr(195) . chr(196) . chr(197) .
                /* a */ chr(224) . chr(225) . chr(226) . chr(227) . chr(228) . chr(229) .
                /* O */ chr(210) . chr(211) . chr(212) . chr(213) . chr(214) . chr(216) .
                /* o */ chr(242) . chr(243) . chr(244) . chr(245) . chr(246) . chr(248) .
                /* E */ chr(200) . chr(201) . chr(202) . chr(203) .
                /* e */ chr(232) . chr(233) . chr(234) . chr(235) .
                /* Cc */ chr(199) . chr(231) .
                /* I */ chr(204) . chr(205) . chr(206) . chr(207) .
                /* i */ chr(236) . chr(237) . chr(238) . chr(239) .
                /* U */ chr(217) . chr(218) . chr(219) . chr(220) .
                /* u */ chr(249) . chr(250) . chr(251) . chr(252) .
                /* yNn */ chr(255) . chr(209) . chr(241);

        return strtolower(strtr($string, $diac, 'AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn'));
    }

}