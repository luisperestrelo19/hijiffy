<?php

namespace App\Http\Controllers;

use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Cloud\Dialogflow\V2\TextInput;
use Symfony\Component\HttpFoundation\Response;

class DialogFlowController extends Controller
{
    private string $projectId = 'hijiffy-challenge';
    private string $filePath;

    public function __construct()
    {
        $this->filePath = storage_path('app/hijiffy.json');
    }
    public function question()
    {
        $input          = (request()->query('question'));

        if ($input === null) {
            return response()->json(['data' => 'Input text not set.'], Response::HTTP_BAD_REQUEST);
        }

        $sessionsClient = new SessionsClient([
            'credentials' => $this->filePath
        ]);

        $session    = $sessionsClient->sessionName($this->projectId, uniqid());
        $queryInput = new QueryInput();
        $queryInput->setText(new TextInput([
            'text'          => $input,
            'language_code' => 'en-US',
        ]));

        $response     = $sessionsClient->detectIntent($session, $queryInput);
        if ($response->getQueryResult()->getIntent() === null) {
            return response()->json(['message' => 'No results.'], Response::HTTP_BAD_REQUEST);
        }

        $responseText = $response->getQueryResult()->getFulfillmentText();
        $sessionsClient->close();

        return response()->json(['message' => $responseText]);
    }
}
