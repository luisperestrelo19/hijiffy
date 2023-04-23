<?php

namespace App\Services;

use Google\Cloud\Dialogflow\V2\Agent as V2Agent;
use Google\Cloud\Dialogflow\V2\AgentsClient;
use Google\Cloud\Dialogflow\V2\EntityTypesClient;
use Google\Cloud\Dialogflow\V2\Intent;
use Google\Cloud\Dialogflow\V2\Intent\Message;

use Google\Cloud\Dialogflow\V2\Intent\Message\Text;
use Google\Cloud\Dialogflow\V2\Intent\TrainingPhrase;
use Google\Cloud\Dialogflow\V2\Intent\TrainingPhrase\Part;
use Google\Cloud\Dialogflow\V2\IntentsClient;
use Google\Cloud\Dialogflow\V2\SessionsClient;
use GPBMetadata\Google\Cloud\Dialogflow\V2\Agent;


class IntentService
{
    public function __construct(private string $projectId, private string $filePath)
    {
    }

    public function setTrainingPhase(array $intentData): array
    {

        foreach ($intentData['trainingPhrases'] as $phrase) {
            $trainingPhrase[] = new TrainingPhrase([
                'parts' => [
                    new Part([
                        'text' => $phrase,
                    ]),
                ]
            ]);
        }

        return $trainingPhrase;
    }

    public function setMessages(Intent $intent, array $messages): Intent
    {
        $message = new Message();
        $text = new Text([
            'text' => $messages
        ]);
        $message->setText($text);

        $intent->setMessages([$message]);

        return $intent;
    }
    public function createIntent(array $intentData)
    {
        $createdIntent = null;
        try {
            $intentsClient = new IntentsClient([
                'projectId'   => $this->projectId,
                'credentials' => $this->filePath,
            ]);

            $intent = new Intent([
                'display_name'     => $intentData['displayName'],
                'training_phrases' =>  $this->setTrainingPhase($intentData)
            ]);
            
            $this->setMessages($intent, $intentData['messages']);

            $parent        = $intentsClient->projectAgentName($this->projectId);
            $createdIntent = $intentsClient->createIntent($parent, $intent);

            $intentsClient->close();
        } catch (\Exception $th) {

            $intentsClient->deleteIntent($createdIntent->getName());
            throw $th;
        }
    }
}
