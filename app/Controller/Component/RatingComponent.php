<?php
require_once APP . 'Vendor/phpinsight/lib/PHPInsight/Sentiment.php';
App::uses('Component', 'Controller');

class RatingComponent extends Component {

    public function updateRating($id = null) {

        $commentModel = ClassRegistry::init('Comment');
        $productModel = ClassRegistry::init('Product');
        $sentiment = new Sentiment();

        $comments = $commentModel->find('list',[
            'conditions' => ['product_id' => $id, 'deleted' => 0],
            'fields' => ['content']
        ]);

        $total_score = 0;

        foreach ($comments as $comment) {

            // calculations:
            $scores = $sentiment->score($comment);
            $class = $sentiment->categorise($comment);

            $total_score += $scores['neg']*5;
            $total_score += $scores['pos']*5;
            $total_score += $scores['neu']*5;
            $total_score = $total_score/3;
        }

        $productModel->id = $id;
        $productModel->saveField('rating' , $total_score);

    }

    public function getDataPoints() {
        $commentModel = ClassRegistry::init('Comment');
        $sentiment = new Sentiment();

        $comments = $commentModel->find('list', [
            'conditions' => ['deleted' => 0],
            'fields' => ['content']
        ]);

        $total_pos = 0;
        $total_neu = 0;
        $total_neg = 0;
        $total_comments = count($comments);

        foreach ($comments as $comment) {

            $class = $sentiment->categorise($comment);

            switch ($class) {
                case 'pos':
                    $total_pos += 1;
                    break;
                case 'neu':
                    $total_neu += 1;
                    break;
                case 'neg': 
                    $total_neg += 1;
                    break;
            }

        }

        $dataPoints = [ 
            ["label"=>"Neutral Comments", "y"=>($total_neu/$total_comments)*100],
            ["label"=>"Positive Comments", "y"=>($total_pos/$total_comments)*100],
            ["label"=>"Negative Comments", "y"=>($total_neg/$total_comments)*100]
            
        ];
        return $dataPoints;
    }

}