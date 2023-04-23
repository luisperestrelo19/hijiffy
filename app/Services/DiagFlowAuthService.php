<?php

namespace App\Services;

use Google\Cloud\Dialogflow\V2\Agent as V2Agent;
use Google\Cloud\Dialogflow\V2\AgentsClient;

class DiagFlowAuthService
{
    private string $projectId = 'hijiffy-challenge';
    private string $filePath;

    public function __construct()
    {
        $this->filePath = storage_path('app/hijiffy.json');
    }

    public function createAgent()
    {
        $agentClient = new AgentsClient();
        $parent = $agentClient->projectName($this->projectId);

        $agent = (new V2Agent())
            ->setParent($parent)
            ->setDisplayName('api-agent2')
            ->setTimeZone('Europe/Paris');

        $agentClient->setAgent($agent);

        return $agentClient->close();
    }

    public function createIntent()
    {
        $create = new IntentService($this->projectId, $this->filePath);

        $createIntentData = [
            [
                'displayName' => 'Weather question',
                'trainingPhrases' => [
                    'give me the weather', 'whats the weather?',
                ],
                'messages' => [
                    'The weather for today is QWERT.',
                    'Today will be ZXCV',
                ]
            ],
            [
                'displayName' => 'Current time question',
                'trainingPhrases' => [
                    'Give me the time',
                ],
                'messages' => [
                    'It\'s XX:XX',
                ]
            ]

        ];

        foreach ($createIntentData as $data) {
            $create->createIntent($data);
        }

    }
}
