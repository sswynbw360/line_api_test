<?php

require('../vendor/autoload.php');

//POST

$input = file_get_contents('php://input');

$json = json_decode($input);

$event = $json->events[0];



$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('OvxAonnSUuCByCAiQ4wG0Q+zY7wTwTgvgxxe52foKRdDf5W8umsFwn1P6yMYXYzthRRzaeqdrpot7ZlQGLc8oOcDEtGOQcAvDMBGCb7p414ugd3O96abmreqgIuks4tPrzY7nSq8z+zxJZsjY4M0BQdB04t89/1O/w1cDnyilFU=');

$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '28624147ebfe7c7c27c3103e475c9403']);



//イベントタイプ判別

if ("message" == $event->type) {            //一般的なメッセージ(文字・イメージ・音声・位置情報・スタンプ含む)

    if ("@myjob" == $event->message->text) {
      $action0 = new \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder("了解", "わかった");

         $button = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder("あなたの役職は", "人狼です", "https://" . $_SERVER['SERVER_NAME'] . "/kyojin.jpeg", [$action0]);
         $button_message = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("あなたの役職が表示されてるよ", $button);


         $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("");
         $response = $bot->pushMessage($event->source->userId, $button_message);
    	/*if("group" == $event->source->type) {
    		$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($event->message->text);
    		$response2 = $bot->replyMessage($event->replyToken, $textMessageBuilder);
    		$response3 = $bot->pushMessage('R9b7dbfd03cbc9c2e4ab3624051c6b011', $textMessageBuilder);
    		$response = $bot->leaveGroup($event->source->groupId);
    	} else if("room" == $event->source->type) {
    		$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($event->message->text);
    		$response2 = $bot->replyMessage($event->replyToken, $textMessageBuilder);
    		$response3 = $bot->pushMessage('C56e234e2a4de4a584436e5b303f774ac', $textMessageBuilder);
    		$response = $bot->leaveRoom('R9b7dbfd03cbc9c2e4ab3624051c6b011');
    	}*/


    } else if ("@join" == $event->message->text) {
      $columns = []; // カルーセル型カラムを5つ追加する配列
      $a=0;
      while(true){
    // カルーセルに付与するボタンを作る
      $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("$a");
      $response = $bot->pushMessage($event->source->userId, $textMessageBuilder);
      $action = new \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder("クリックしてね", "https://" . $_SERVER['SERVER_NAME'] . "/kyojin.jpeg");
    // カルーセルのカラムを作成する
      $column = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder("タイトル(40文字以内)","http://www.hivelocity.co.jp/wp-content/uploads/2015/09/001.jpg" , [$action]);
      $columns[] = $column;
      $a++;
      if($a>=4){
        brake;
      }
    }
// カラムの配列を組み合わせてカルーセルを作成する
      $carousel = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder($columns);
// カルーセルを追加してメッセージを作る
      $carousel_message = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("メッセージのタイトル", $carousel);
      $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("");
      $response = $bot->pushMessage($event->source->userId, $carousel_message);

    } else if ("text" == $event->message->type) {

        //$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($event->message->text);

        if("group" == $event->source->type) {
    		//$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($event->message->text);
    		$response_format_text = [
    			"type" => "template",
    			"altText" => "はろはろー",
    			"template" => [
    				"type" => "buttons",
    				"thumbnailImageUrl" => "https://" . $_SERVER['SERVER_NAME'] . "/kyojin.jpeg",
    				"title" => "めにゅー",
    				"text" => "めにゅーだよ！",
    				"actions" => [
    					[
    						"type" => "message",
    						"label" => "まる１",
    						"text" => "@1"
    					],
    					[
    						"type" => "message",
    						"label" => "まる２",
    						"text" => "@2"
    					],
    					[
    						"type" => "message",
    						"label" => "まる３",
    						"text" => "@3"
    					]
    				]
    			]
    		];
    		$post_data = [
				"to" => 'R9b7dbfd03cbc9c2e4ab3624051c6b011',
				"messages" => [$response_format_text]
			];
			$ch = curl_init("https://api.line.me/v2/bot/message/push");
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			    'Content-Type: application/json; charser=UTF-8',
			    'Authorization: Bearer ' . 'OvxAonnSUuCByCAiQ4wG0Q+zY7wTwTgvgxxe52foKRdDf5W8umsFwn1P6yMYXYzthRRzaeqdrpot7ZlQGLc8oOcDEtGOQcAvDMBGCb7p414ugd3O96abmreqgIuks4tPrzY7nSq8z+zxJZsjY4M0BQdB04t89/1O/w1cDnyilFU='
			    ));
			$result = curl_exec($ch);
			curl_close($ch);

    		//$actionBuilders = new \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder("ぬ！", "nu");
    		//$buttonsMessageBuilder = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder("めにゅー", "めにゅーだよ！", "https://" . $_SERVER['SERVER_NAME'] . "/kyojin.jpeg", $actionBuilders);
    		//$response = $bot->pushMessage('R9b7dbfd03cbc9c2e4ab3624051c6b011', $textMessageBuilder);
    	} else if("room" == $event->source->type) {
    		//$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($event->message->text);
    		$response_format_text = [
    			"type" => "template",
    			"altText" => "はろはろー",
    			"template" => [
    				"type" => "buttons",
    				"thumbnailImageUrl" => "https://" . $_SERVER['SERVER_NAME'] . "/kyojin.jpeg",
    				"title" => "めにゅー",
    				"text" => "めにゅーだよ！",
    				"actions" => [
    					[
    						"type" => "message",
    						"label" => "まる１",
    						"text" => "@1"
    					],
    					[
    						"type" => "message",
    						"label" => "まる２",
    						"text" => "@2"
    					],
    					[
    						"type" => "message",
    						"label" => "まる３",
    						"text" => "@3"
    					]
    				]
    			]
    		];
    		$post_data = [
				"to" => 'C56e234e2a4de4a584436e5b303f774ac',
				"messages" => [$response_format_text]
			];
			$ch = curl_init("https://api.line.me/v2/bot/message/push");
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			    'Content-Type: application/json; charser=UTF-8',
			    'Authorization: Bearer ' . 'OvxAonnSUuCByCAiQ4wG0Q+zY7wTwTgvgxxe52foKRdDf5W8umsFwn1P6yMYXYzthRRzaeqdrpot7ZlQGLc8oOcDEtGOQcAvDMBGCb7p414ugd3O96abmreqgIuks4tPrzY7nSq8z+zxJZsjY4M0BQdB04t89/1O/w1cDnyilFU='
			    ));
			$result = curl_exec($ch);
			curl_close($ch);


    		//$actionBuilders = new \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder("ぬ！", "nu");
    		//$buttonsMessageBuilder = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder("めにゅー", "めにゅーだよ！", "https://" . $_SERVER['SERVER_NAME'] . "/kyojin.jpeg", $actionBuilders);
    		//$response = $bot->pushMessage('C56e234e2a4de4a584436e5b303f774ac', $textMessageBuilder);
    	}

    } else {

        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("ごめん、わかんなーい(*´ω｀*)");

    }

} elseif ("follow" == $event->type) {        //お友達追加時

    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("よろしくー");

} elseif ("join" == $event->type) {           //グループに入ったときのイベント

    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('こんにちは よろしくー');

} elseif ('beacon' == $event->type) {         //Beaconイベント

    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('Godanがいんしたお(・∀・) ');

} else {

    //なにもしない

}



//$response = $bot->replyMessage($event->replyToken, $textMessageBuilder);

syslog(LOG_EMERG, print_r($event->replyToken, true));

syslog(LOG_EMERG, print_r($response, true));

return;
