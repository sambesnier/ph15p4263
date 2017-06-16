<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 15/06/2017
 * Time: 16:29
 */


// Récupération de la liste des compétences
// Chemin vers le fichier json
$filePath = ROOT_PATH. '/src/data/quiz.json';

// Récupération des données sous la forme d'un tableau
$data = json_decode(file_get_contents($filePath), true);

$errors = [];

$correction = [];

$isSubmitted = filter_has_var(
    INPUT_POST,
    'submit'
);

if ($isSubmitted) {
	$size = count($data['quiz']);	
	$score = 0;
	for ($i=0; $i < $size; $i++) { 
		$indexRightAnswer = $data['quiz'][$i]['bonneReponse'];
		$rightAnswer = $data['quiz'][$i]['reponses'][$indexRightAnswer-1][$indexRightAnswer];

		if($indexRightAnswer != $_POST['question'.($i+1)]) {
			$correction[] = 
			[ 
				"reponse" => 
				[
					"good" => "no", 
					"rightAnswer" => $rightAnswer, 
					"question" => $i+1
				] 
			];
		} else {
			$correction[] = 
			[ 
				"reponse" => 
				[
					"good" => "yes", 
					"rightAnswer" => $rightAnswer, 
					"question" => $i+1
				] 
			];
			$score++;
		}
	}
	$correction[] = 
		[
			"score" => $score,
			"total" => $size
		];
}

// Appel de la fontion renderView
renderView(
    'quiz',
    [
        'pageTitle' => 'Quiz',
        'quiz' => $data['quiz'],
        'errors' => $errors,
        'correction' => $correction
    ]
);
