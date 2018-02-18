<?php

App::uses('Component', 'Controller');

class RatingComponent extends Component {

    
    public function updateRating($id = null) {

        require_once APP . 'Vendor/phpinsight/lib/PHPInsight/Sentiment.php';

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

}