<?php
use PhpOffice\PhpWord\Element\AbstractContainer;
use PhpOffice\PhpWord\Element\Text;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;
include_once("./config/apply.php");
require_once __DIR__ . '/vendor/autoload.php';

if(isset($_POST['upload_questions'])){
  $docMimes = array('doc', 'docx');
  $file = explode(".", $_FILES['file']['name']);
  $extension = end($file);
  if (!empty($_FILES['file']['name']) && in_array($extension, $docMimes)) {
    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
      $file_dir = './uploaded_question_docs/';
      move_uploaded_file($_FILES['file']['tmp_name'], $file_dir . $_FILES['file']['name']);
      $objReader = WordIOFactory::createReader('Word2007');

      $phpWord = $objReader->load($file_dir.$_FILES['file']['name']);
      $text = '';

      function getWordText($element)
      {
        $result = '';
        if ($element instanceof AbstractContainer) {
          foreach ($element->getElements() as $element) {
            $result .= getWordText($element);
          }
        } elseif ($element instanceof Text) {
          $result .= $element->getText();
        }
        return $result;
      }

      foreach ($phpWord->getSections() as $section) {
        foreach ($section->getElements() as $element) {
          $text .= getWordText($element) . '\n';
        }
      }

      $text = str_replace('\n', "<br>", $text);
      $questions = explode("~~~", $text);

      $exam_code = $_GET['exam_code'];
      $added_date = date('Y-m-d');

      $tbl_name = 'tbl_question';

      // itrate through each question
      for ($i = 0; $i < count($questions); $i++) {
        $question =  explode("```", $questions[$i]);
        $options = $question[1];
        $options = explode("<br>", $question[1]);
        array_splice($options, 0, 1);
        array_splice($options, count($options) - 1, 1);

        $first_answer = $obj->sanitize($conn, $options[0]);
        $second_answer = $obj->sanitize($conn, $options[1]);
        $third_answer = $obj->sanitize($conn, $options[2]);
        $fourth_answer = $obj->sanitize($conn, $options[3]);
        $fifth_answer = $obj->sanitize($conn, '');
        $answer = $obj->sanitize($conn, array_search($options[4], $options) + 1, true);
        $reason = $obj->sanitize($conn, '');
        $marks = $obj->sanitize($conn, $options[5]);
        $data = "question='$question[0]',
                                    first_answer='$first_answer',
                                    second_answer='$second_answer',
                                    third_answer='$third_answer',
                                    fourth_answer='$fourth_answer',
                                    fifth_answer='$fifth_answer',
                                    answer='$answer',
                                    reason='$reason',
                                    exam_id='$exam_code',
                                    marks='$marks',
                                    is_active='yes',
                                    added_date='$added_date',
                                    updated_date='$added_date',
                                    image_name=''
                                    ";
        $query = $obj->insert_data($tbl_name, $data);
        $res = $obj->execute_query($conn, $query);
        if ($res === true) {
          $qstring = 'status=succ';
        } else {
          $qstring = 'status=err';
        }

      }
      unlink($file_dir . $_FILES['file']['name']);
      $qstring = 'status=succ';
    }else {

      $qstring = 'status=err';
    }

  } else{

    $qstring = 'status=invalid_file';
  }

}
header('location:' . SITEURL . 'teacher/index.php?page=add_question&' . $qstring. '&exam_code='.$_GET['exam_code']);
