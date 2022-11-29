<?php
$json = '{
    "quiz": {
        "sport": {
            "q1": {
                "question": "Which one is correct team name in NBA?",
                "options": [
                    "New York Bulls",
                    "Los Angeles Kings",
                    "Gem State Warriros",
                    "Huston Rocket"
                ],
                "answer": "Huston Rocket"
            }
        },
        "maths": {
            "q1": {
                "question": "5 + 7 = ?",
                "options": [
                    "10",
                    "11",
                    "12",
                    "13"
                ],
                "answer": "12"
            },
            "q2": {
                "question": "12 - 8 = ?",
                "options": [
                    "1",
                    "2",
                    "3",
                    "4"
                ],
                "answer": "4"
            }
        }
    }
}';
$quiz = json_decode($json,true);
print_r($quiz);
$question1= $quiz['quiz']['sport']['q1'];
print $question1['answer'];
foreach($question1['options'] as $key=>$value) {
    print "$key $value<br>";
}


foreach($quiz['quiz']['maths'] as $value) {
    print $value['question'];
    print '<select name="q1[]" id="quiz" multiple>';
    foreach($value['options'] as $key=>$v) {
        //print "$key $value<br>";
        print"<option value='$key'>$v</option>";
    }
    print "</select>";
}




?>